<?php

namespace App\Application\Product\DiscountStrategy;

use App\Domain\Product\Product;

class SKUDiscountStrategy implements DiscountStrategyInterface
{
    public function __construct(
        private readonly string $sku,
        private readonly int $discountPercentage
    ) {}

    public function getDiscount(Product $product): int
    {
        return $product->getSku() === $this->sku ? $this->discountPercentage : 0;
    }
}