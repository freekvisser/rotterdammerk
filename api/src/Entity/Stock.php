<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockRepository::class)]
class Stock
{
    #[ORM\Id]
    #[ORM\Column(type: "string", length: 36)]
    private ?string $product_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $amount = null;


    public function getProductId(): ?string
    {
        return $this->product_id;
    }

    public function setProductId(?string $product_id): static
    {
        $this->product_id = $product_id;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(?int $amount): static
    {
        $this->amount = $amount;

        return $this;
    }
}
