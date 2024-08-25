<?php

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use App\Repository\AttributeValueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AttributeValueRepository::class)]
#[ORM\HasLifecycleCallbacks]
class AttributeValue
{
    use Timestampable;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $value = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $color = null;

    #[ORM\ManyToOne(inversedBy: 'attributeValues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Attribute $Attribute = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getAttribute(): ?Attribute
    {
        return $this->Attribute;
    }

    public function setAttribute(?Attribute $Attribute): static
    {
        $this->Attribute = $Attribute;

        return $this;
    }
}
