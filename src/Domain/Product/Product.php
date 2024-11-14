<?php

namespace App\Domain\Product;

use App\Domain\Product\ValueObject\Price;

class Product
{
    public function __construct(
        private readonly string $sku,
        private readonly string $name,
        private readonly string $category,
        private readonly Price $price
    ) {}

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }
}
