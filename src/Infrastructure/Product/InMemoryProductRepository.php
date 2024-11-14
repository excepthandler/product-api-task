<?php

namespace App\Infrastructure\Product;

use App\Domain\Product\Product;
use App\Domain\Product\ProductRepositoryInterface;
use App\Domain\Product\ValueObject\Price;
use Exception;

class InMemoryProductRepository implements ProductRepositoryInterface
{
    /**
     * @var Product[]
     */
    private array $products;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->products = [
            new Product('000001', 'BV Lean leather ankle boots', 'boots', new Price(89000)),
            new Product('000002', 'BV Lean leather ankle boots', 'boots', new Price(99000)),
            new Product('000003', 'Ashlington leather ankle boots', 'boots', new Price(71000)),
            new Product('000004', 'Naima embellished suede sandals', 'sandals', new Price(79500)),
            new Product('000005', 'Nathane leather sneakers', 'sneakers', new Price(59000)),
        ];
    }

    /**
     * @return Product[]
     */
    public function findAll(): array
    {
        return $this->products;
    }

    /**
     * @param string $category
     * @return Product[]
     */
    public function findByCategory(string $category): array
    {
        $filteredProducts = [];

        foreach ($this->products as $product) {
            if ($product->getCategory() === $category) {
                $filteredProducts[] = $product;
            }
        }

        return $filteredProducts;
    }
}
