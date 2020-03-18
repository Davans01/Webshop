<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductsRepository")
 */
class Products
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vat;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ReceiptLines", mappedBy="product")
     */
    private $receiptLines;

    public function __construct()
    {
        $this->receiptLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getVat(): ?string
    {
        return $this->vat;
    }

    public function setVat(string $vat): self
    {
        $this->vat = $vat;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|ReceiptLines[]
     */
    public function getReceiptLines(): Collection
    {
        return $this->receiptLines;
    }

    public function addReceiptLine(ReceiptLines $receiptLine): self
    {
        if (!$this->receiptLines->contains($receiptLine)) {
            $this->receiptLines[] = $receiptLine;
            $receiptLine->setProduct($this);
        }

        return $this;
    }

    public function removeReceiptLine(ReceiptLines $receiptLine): self
    {
        if ($this->receiptLines->contains($receiptLine)) {
            $this->receiptLines->removeElement($receiptLine);
            // set the owning side to null (unless already changed)
            if ($receiptLine->getProduct() === $this) {
                $receiptLine->setProduct(null);
            }
        }

        return $this;
    }
}
