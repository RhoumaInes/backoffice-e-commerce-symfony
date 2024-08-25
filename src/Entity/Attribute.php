<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\Timestampable;
use App\Repository\AttributeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Enum\AttributeType;

#[ORM\Entity(repositoryClass: AttributeRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Attribute
{
    use Timestampable;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, enumType: AttributeType::class)]
    private ?AttributeType $type = null;

    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'attributes')]
    private Collection $product;

    #[ORM\OneToMany(mappedBy: 'Attribute', targetEntity: AttributeValue::class, orphanRemoval: true)]
    private Collection $attributeValues;

    public function __construct()
    {
        $this->product = new ArrayCollection();
        $this->attributeValues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?AttributeType
    {
        return $this->type;
    }

    public function setType(AttributeType $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->product->contains($product)) {
            $this->product->add($product);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        $this->product->removeElement($product);

        return $this;
    }

    /**
     * @return Collection<int, AttributeValue>
     */
    public function getAttributeValues(): Collection
    {
        return $this->attributeValues;
    }

    public function addAttributeValue(AttributeValue $attributeValue): static
    {
        if (!$this->attributeValues->contains($attributeValue)) {
            $this->attributeValues->add($attributeValue);
            $attributeValue->setAttribute($this);
        }

        return $this;
    }

    public function removeAttributeValue(AttributeValue $attributeValue): static
    {
        if ($this->attributeValues->removeElement($attributeValue)) {
            // set the owning side to null (unless already changed)
            if ($attributeValue->getAttribute() === $this) {
                $attributeValue->setAttribute(null);
            }
        }

        return $this;
    }
}
