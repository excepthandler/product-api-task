<?php

namespace App\Tests\Application\Product;

use App\Application\Product\ProductService;
use App\Domain\Product\Product;
use App\Domain\Product\ProductRepositoryInterface;
use App\Domain\Product\ValueObject\Price;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ProductServiceTest extends TestCase
{
    private ProductService $productService;
    private MockObject $productRepositoryMock;

    protected function setUp(): void
    {
        $this->productRepositoryMock = $this->createMock(ProductRepositoryInterface::class);
        $this->productService = new ProductService($this->productRepositoryMock);
    }

    /**
     * @throws Exception
     */
    public function testGetProductsAppliesCategoryFilter(): void
    {
        $product1 = new Product('000001', 'BV Lean leather ankle boots', 'boots', new Price(89000));

        $this->productRepositoryMock
            ->method('findByCategory')
            ->with('boots')
            ->willReturn([$product1]);

        $result = $this->productService->getProducts('boots');

        $this->assertCount(1, $result);
        $this->assertSame('000001', $result[0]->getSku());
    }
}