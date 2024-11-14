<?php

namespace App\Application\Product\DTO;

use App\Domain\Product\Product;

class ProductDTO
{
    public string $sku;

    public string $name;

    public string $category;

    /**
     * @var array<string, int|string|null>
     */
    public array $price;

    public function __construct(Product $product)
    {
        $productPrice = $product->getPrice();
        $this->sku = $product->getSku();
        $this->name = $product->getName();
        $this->category = $product->getCategory();
        $this->price = [
            'original' => $productPrice->getOriginal(),
            'final' => $productPrice->getFinal(),
            'discount_percentage' => $productPrice->getDiscountPercentage(),
            'currency' => $productPrice->getCurrency()
        ];
    }
}
