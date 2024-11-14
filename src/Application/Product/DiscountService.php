<?php

namespace App\Application\Product;

use App\Application\Product\DiscountStrategy\CategoryDiscountStrategy;
use App\Application\Product\DiscountStrategy\SKUDiscountStrategy;
use App\Domain\Product\Product;
use Exception;

class DiscountService
{
    /**
     * @throws Exception
     */
    public function applyBestDiscount(Product $product): void
    {
        $strategies = [
            new CategoryDiscountStrategy('boots', 30),  // Products in the boots category have a 30% discount.
            new SKUDiscountStrategy('000003', 15)  // The product with sku = 000003 has a 15% discount.
        ];

        $context = new DiscountContext($strategies);
        $context->applyBestDiscount($product);
    }
}