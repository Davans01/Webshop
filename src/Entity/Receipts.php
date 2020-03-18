<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReceiptsRepository")
 */
class Receipts
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customers", inversedBy="receipts")
     */
    private $customer;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $expiration_date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $on_assignment;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sale;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ReceiptLines", mappedBy="receipt")
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

    public function getCustomer(): ?Customers
    {
        return $this->customer;
    }

    public function setCustomer(?Customers $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->expiration_date;
    }

    public function setExpirationDate(\DateTimeInterface $expiration_date): self
    {
        $this->expiration_date = $expiration_date;

        return $this;
    }

    public function getOnAssignment(): ?string
    {
        return $this->on_assignment;
    }

    public function setOnAssignment(string $on_assignment): self
    {
        $this->on_assignment = $on_assignment;

        return $this;
    }

    public function getSale(): ?string
    {
        return $this->sale;
    }

    public function setSale(string $sale): self
    {
        $this->sale = $sale;

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
            $receiptLine->setReceipt($this);
        }

        return $this;
    }

    public function removeReceiptLine(ReceiptLines $receiptLine): self
    {
        if ($this->receiptLines->contains($receiptLine)) {
            $this->receiptLines->removeElement($receiptLine);
            // set the owning side to null (unless already changed)
            if ($receiptLine->getReceipt() === $this) {
                $receiptLine->setReceipt(null);
            }
        }

        return $this;
    }
}
