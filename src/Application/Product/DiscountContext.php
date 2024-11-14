<?php

namespace App\Application\Product;

use App\Application\Product\DiscountStrategy\DiscountStrategyInterface;
use App\Domain\Product\Product;
use App\Domain\Product\ValueObject\Discount;
use Exception;

class DiscountContext
{
    public function __construct(
        /**
         * @var DiscountStrategyInterface[]
         */
        private readonly array $strategies
    ) {}

    /**
     * @throws Exception
     */
    public function applyBestDiscount(Product $product): void
    {
        $bestDiscount = 0;

        foreach ($this->strategies as $strategy) {
            $bestDiscount = max($bestDiscount, $strategy->getDiscount($product));
        }

        if ($bestDiscount > 0) {
            $product->getPrice()->applyDiscount(new Discount($bestDiscount));
        }
    }
}