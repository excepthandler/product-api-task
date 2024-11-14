<?php

namespace App\Domain\Product;

interface ProductRepositoryInterface
{
    /**
     * @return Product[]
     */
    public function findAll(): array;

    /**
     * @return Product[]
     */
    public function findByCategory(string $category): array;
}