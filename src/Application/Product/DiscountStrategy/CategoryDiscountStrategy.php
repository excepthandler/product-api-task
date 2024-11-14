<?php

namespace App\Application\Product\DiscountStrategy;

use App\Domain\Product\Product;

class CategoryDiscountStrategy implements DiscountStrategyInterface
{
    public function __construct(
        private readonly string $category,
        private readonly int $discountPercentage
    ) {}

    public function getDiscount(Product $product): int
    {
        return $product->getCategory() === $this->category ? $this->discountPercentage : 0;
    }
}
