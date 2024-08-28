<?php 
namespace App\EventListener;

use Doctrine\ORM\Event\PostUpdateEventArgs;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\PostRemoveEventArgs;

class TaxRulesListener
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function postUpdate(PostUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        // Check if the updated entity is an instance of TaxRules
        if (!$entity instanceof \App\Entity\TaxRules) {
            return;
        }

        $taxRule = $entity;
        $newRate = $taxRule->getRate();

        // Retrieve all products associated with this TaxRules entity
        $products = $taxRule->getProducts();

        foreach ($products as $product) {
            $prixVenteHt = $product->getPrixVenteHt();

            if ($prixVenteHt !== null) {
                // Calculate the new TTC price
                $prixVenteTtc = $prixVenteHt * (1 + $newRate / 100);
                $product->setPrixVenteTtc($prixVenteTtc);

                // Persist the updated product price
                $this->entityManager->persist($product);
            }
        }

        // Flush the changes to the database
        $this->entityManager->flush();
    }

    public function postRemove(PostRemoveEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof \App\Entity\TaxRules) {
            return;
        }

        $products = $entity->getProducts();

        foreach ($products as $product) {
            $product->setTaxRules(null);  // Remove the association with the deleted tax rule

            $prixVenteHt = $product->getPrixVenteHt();
            if ($prixVenteHt !== null) {
                // Optionally reset the TTC price, or calculate it differently
                $product->setPrixVenteTtc($prixVenteHt); // Assuming no tax is applied now
            }

            $this->entityManager->persist($product);
        }

        $this->entityManager->flush();
    }
}

