<?php

namespace App\Application\Product\DiscountStrategy;

use App\Domain\Product\Product;

interface DiscountStrategyInterface
{
    public function getDiscount(Product $product): int;
}