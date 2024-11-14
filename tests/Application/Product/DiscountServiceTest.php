<?php

namespace App\Tests\Application\Product;

use App\Application\Product\DiscountService;
use App\Domain\Product\Product;
use App\Domain\Product\ValueObject\Price;
use Exception;
use PHPUnit\Framework\TestCase;

class DiscountServiceTest extends TestCase
{
    private DiscountService $discountService;

    protected function setUp(): void
    {
        $this->discountService = new DiscountService();
    }

    /**
     * @throws Exception
     */
    public function testApplyDiscountForBootsCategory(): void
    {
        $product = new Product('000001', 'BV Lean leather ankle boots', 'boots', new Price(89000));
        $this->discountService->applyBestDiscount($product);
        $this->assertEquals(62300, $product->getPrice()->getFinal());
    }

    /**
     * @throws Exception
     */
    public function testApplyBestDiscountSkuBased(): void
    {
        $product = new Product('000003', 'Ashlington leather ankle boots', 'boots', new Price(71000));
        $this->discountService->applyBestDiscount($product);
        $this->assertEquals(49700, $product->getPrice()->getFinal());
    }
}
