<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InvoiceItemRepository")
 */
class InvoiceItem
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
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $currency;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="integer")
     */
    private $total;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Invoice", inversedBy="invoiceItems")
     * @ORM\JoinColumn(nullable=true)
     */
    private $idInvoice;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BudgetCode")
     */
    private $budgetCode;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProjectName")
     */
    private $projectCode;

    public function getId()
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getIdInvoice(): ?Invoice
    {
        return $this->idInvoice;
    }

    public function setIdInvoice(?Invoice $idInvoice): self
    {
        $this->idInvoice = $idInvoice;

        return $this;
    }

    public function getBudgetCode(): ?BudgetCode
    {
        return $this->budgetCode;
    }

    public function setBudgetCode(?BudgetCode $budgetCode): self
    {
        $this->budgetCode = $budgetCode;

        return $this;
    }

    public function getProjectCode(): ?ProjectName
    {
        return $this->projectCode;
    }

    public function setProjectCode(?ProjectName $projectCode): self
    {
        $this->projectCode = $projectCode;

        return $this;
    }

    public function addIdInvoice()
    {

    }
}
