<?php

declare(strict_types=1);

namespace Doctrine\ORM\Query;

use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Filter\SQLFilter;
use InvalidArgumentException;

use function assert;
use function ksort;

/**
 * Collection class for all the query filters.
 */
class FilterCollection
{
    /* Filter STATES */

    /**
     * A filter object is in CLEAN state when it has no changed parameters.
     */
    public const FILTERS_STATE_CLEAN = 1;

    /**
     * A filter object is in DIRTY state when it has changed parameters.
     */
    public const FILTERS_STATE_DIRTY = 2;

    /**
     * The used Configuration.
     *
     * @var Configuration
     */
    private $config;

    /**
     * The EntityManager that "owns" this FilterCollection instance.
     *
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * Instances of enabled filters.
     *
     * @var SQLFilter[]
     * @phpstan-var array<string, SQLFilter>
     */
    private $enabledFilters = [];

    /**
     * Instances of suspended filters.
     *
     * @var SQLFilter[]
     * @phpstan-var array<string, SQLFilter>
     */
    private $suspendedFilters = [];

    /**
     * The filter hash from the last time the query was parsed.
     *
     * @var string
     */
    private $filterHash = '';

    /**
     * The current state of this filter.
     *
     * @var int
     * @phpstan-var self::FILTERS_STATE_*
     */
    private $filtersState = self::FILTERS_STATE_CLEAN;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em     = $em;
        $this->config = $em->getConfiguration();
    }

    /**
     * Gets all the enabled filters.
     *
     * @return SQLFilter[] The enabled filters.
     * @phpstan-return array<string, SQLFilter>
     */
    public function getEnabledFilters()
    {
        return $this->enabledFilters;
    }

    /**
     * Gets all the suspended filters.
     *
     * @return SQLFilter[] The suspended filters.
     * @phpstan-return array<string, SQLFilter>
     */
    public function getSuspendedFilters(): array
    {
        return $this->suspendedFilters;
    }

    /**
     * Enables a filter from the collection.
     *
     * @param string $name Name of the filter.
     *
     * @return SQLFilter The enabled filter.
     *
     * @throws InvalidArgumentException If the filter does not exist.
     */
    public function enable($name)
    {
        if (! $this->has($name)) {
            throw new InvalidArgumentException("Filter '" . $name . "' does not exist.");
        }

        if (! $this->isEnabled($name)) {
            $filterClass = $this->config->getFilterClassName($name);

            assert($filterClass !== null);

            $this->enabledFilters[$name] = new $filterClass($this->em);

            // In case a suspended filter with the same name was forgotten
            unset($this->suspendedFilters[$name]);

            // Keep the enabled filters sorted for the hash
            ksort($this->enabledFilters);

            $this->setFiltersStateDirty();
        }

        return $this->enabledFilters[$name];
    }

    /**
     * Disables a filter.
     *
     * @param string $name Name of the filter.
     *
     * @return SQLFilter The disabled filter.
     *
     * @throws InvalidArgumentException If the filter does not exist.
     */
    public function disable($name)
    {
        // Get the filter to return it
        $filter = $this->getFilter($name);

        unset($this->enabledFilters[$name]);

        $this->setFiltersStateDirty();

        return $filter;
    }

    /**
     * Suspend a filter.
     *
     * @param string $name Name of the filter.
     *
     * @return SQLFilter The suspended filter.
     *
     * @throws InvalidArgumentException If the filter does not exist.
     */
    public function suspend(string $name): SQLFilter
    {
        // Get the filter to return it
        $filter = $this->getFilter($name);

        $this->suspendedFilters[$name] = $filter;
        unset($this->enabledFilters[$name]);

        $this->setFiltersStateDirty();

        return $filter;
    }

    /**
     * Restore a disabled filter from the collection.
     *
     * @param string $name Name of the filter.
     *
     * @return SQLFilter The restored filter.
     *
     * @throws InvalidArgumentException If the filter does not exist.
     */
    public function restore(string $name): SQLFilter
    {
        if (! $this->isSuspended($name)) {
            throw new InvalidArgumentException("Filter '" . $name . "' is not suspended.");
        }

        $this->enabledFilters[$name] = $this->suspendedFilters[$name];
        unset($this->suspendedFilters[$name]);

        // Keep the enabled filters sorted for the hash
        ksort($this->enabledFilters);

        $this->setFiltersStateDirty();

        return $this->enabledFilters[$name];
    }

    /**
     * Gets an enabled filter from the collection.
     *
     * @param string $name Name of the filter.
     *
     * @return SQLFilter The filter.
     *
     * @throws InvalidArgumentException If the filter is not enabled.
     */
    public function getFilter($name)
    {
        if (! $this->isEnabled($name)) {
            throw new InvalidArgumentException("Filter '" . $name . "' is not enabled.");
        }

        return $this->enabledFilters[$name];
    }

    /**
     * Checks whether filter with given name is defined.
     *
     * @param string $name Name of the filter.
     *
     * @return bool true if the filter exists, false if not.
     */
    public function has($name)
    {
        return $this->config->getFilterClassName($name) !== null;
    }

    /**
     * Checks if a filter is enabled.
     *
     * @param string $name Name of the filter.
     *
     * @return bool True if the filter is enabled, false otherwise.
     */
    public function isEnabled($name)
    {
        return isset($this->enabledFilters[$name]);
    }

    /**
     * Checks if a filter is suspended.
     *
     * @param string $name Name of the filter.
     *
     * @return bool True if the filter is suspended, false otherwise.
     */
    public function isSuspended(string $name): bool
    {
        return isset($this->suspendedFilters[$name]);
    }

    /**
     * Checks if the filter collection is clean.
     *
     * @return bool
     */
    public function isClean()
    {
        return $this->filtersState === self::FILTERS_STATE_CLEAN;
    }

    /**
     * Generates a string of currently enabled filters to use for the cache id.
     *
     * @return string
     */
    public function getHash()
    {
        // If there are only clean filters, the previous hash can be returned
        if ($this->filtersState === self::FILTERS_STATE_CLEAN) {
            return $this->filterHash;
        }

        $filterHash = '';

        foreach ($this->enabledFilters as $name => $filter) {
            $filterHash .= $name . $filter;
        }

        $this->filterHash   = $filterHash;
        $this->filtersState = self::FILTERS_STATE_CLEAN;

        return $filterHash;
    }

    /**
     * Sets the filter state to dirty.
     *
     * @return void
     */
    public function setFiltersStateDirty()
    {
        $this->filtersState = self::FILTERS_STATE_DIRTY;
    }
}
