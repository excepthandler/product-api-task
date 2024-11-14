<?php

namespace App\Application\Product;

use App\Domain\Product\Product;
use App\Domain\Product\ProductRepositoryInterface;
use Exception;

class ProductService
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository
    ) {}

    /**
     * @throws Exception
     * @return Product[]
     */
    public function getProducts(?string $category = null): array
    {
        return empty($category) ? $this->productRepository->findAll() : $this->productRepository->findByCategory($category);
    }
}