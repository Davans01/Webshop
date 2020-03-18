<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReceiptLinesRepository")
 */
class ReceiptLines
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Receipts", inversedBy="receiptLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $receipt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Products", inversedBy="receiptLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $amount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReceipt(): ?Receipts
    {
        return $this->receipt;
    }

    public function setReceipt(?Receipts $receipt): self
    {
        $this->receipt = $receipt;

        return $this;
    }

    public function getProduct(): ?Products
    {
        return $this->product;
    }

    public function setProduct(?Products $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
