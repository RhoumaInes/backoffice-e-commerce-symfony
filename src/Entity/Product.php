<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\Timestampable;
use App\Repository\ProductRepository;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Product
{
    use Timestampable;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $summary = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $totalQuantity = null;

    #[ORM\Column]
    private ?float $minimumQuantityForSale = null;

    #[ORM\Column(length: 255)]
    private ?string $unit = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: Provider::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?Provider $provider = null;

    #[ORM\ManyToMany(targetEntity: Attribute::class, mappedBy: 'product')]
    private Collection $attributes;

    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'products')]
    private Collection $categories;

    #[ORM\OneToMany(mappedBy: 'Product', targetEntity: Imagesproduct::class, orphanRemoval: true)]
    private Collection $imagesproducts;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?TaxRules $taxRules = null;

    #[ORM\Column(nullable: true)]
    private ?float $prixAchat = null;

    #[ORM\Column(nullable: true)]
    private ?float $prixVenteHt = null;

    #[ORM\Column(nullable: true)]
    private ?float $prixVenteTtc = null;

    public function __construct()
    {
        $this->attributes = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->imagesproducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): static
    {
        $this->summary = $summary;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getTotalQuantity(): ?float
    {
        return $this->totalQuantity;
    }

    public function setTotalQuantity(float $totalQuantity): static
    {
        $this->totalQuantity = $totalQuantity;

        return $this;
    }

    public function getMinimumQuantityForSale(): ?float
    {
        return $this->minimumQuantityForSale;
    }

    public function setMinimumQuantityForSale(float $minimumQuantityForSale): static
    {
        $this->minimumQuantityForSale = $minimumQuantityForSale;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): static
    {
        $this->unit = $unit;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getProvider(): ?Provider
    {
        return $this->provider;
    }

    public function setProvider(?Provider $provider): static
    {
        $this->provider = $provider;

        return $this;
    }


    /**
     * @return Collection<int, Attribute>
     */
    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    public function addAttribute(Attribute $attribute): static
    {
        if (!$this->attributes->contains($attribute)) {
            $this->attributes->add($attribute);
            $attribute->addProduct($this);
        }

        return $this;
    }

    public function removeAttribute(Attribute $attribute): static
    {
        if ($this->attributes->removeElement($attribute)) {
            $attribute->removeProduct($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): static
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @return Collection<int, Imagesproduct>
     */
    public function getImagesproducts(): Collection
    {
        return $this->imagesproducts;
    }

    public function addImagesproduct(Imagesproduct $imagesproduct): static
    {
        if (!$this->imagesproducts->contains($imagesproduct)) {
            $this->imagesproducts->add($imagesproduct);
            $imagesproduct->setProduct($this);
        }

        return $this;
    }

    public function removeImagesproduct(Imagesproduct $imagesproduct): static
    {
        if ($this->imagesproducts->removeElement($imagesproduct)) {
            // set the owning side to null (unless already changed)
            if ($imagesproduct->getProduct() === $this) {
                $imagesproduct->setProduct(null);
            }
        }

        return $this;
    }

    public function getTaxRules(): ?TaxRules
    {
        return $this->taxRules;
    }

    public function setTaxRules(?TaxRules $taxRules): static
    {
        $this->taxRules = $taxRules;

        return $this;
    }

    public function getPrixAchat(): ?float
    {
        return $this->prixAchat;
    }

    public function setPrixAchat(?float $prixAchat): static
    {
        $this->prixAchat = $prixAchat;

        return $this;
    }

    public function getPrixVenteHt(): ?float
    {
        return $this->prixVenteHt;
    }

    public function setPrixVenteHt(?float $prixVenteHt): static
    {
        $this->prixVenteHt = $prixVenteHt;

        return $this;
    }

    public function getPrixVenteTtc(): ?float
    {
        return $this->prixVenteTtc;
    }

    public function setPrixVenteTtc(?float $prixVenteTtc): static
    {
        $this->prixVenteTtc = $prixVenteTtc;

        return $this;
    }

    public function updatePrixVenteTtc(): void
    {
        if ($this->prixVenteHt !== null && $this->taxRules !== null) {
            $this->prixVenteTtc = $this->prixVenteHt * (1 + $this->taxRules->getRate() / 100);
        }
    }
}
