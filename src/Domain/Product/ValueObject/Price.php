<?php

namespace App\Domain\Product\ValueObject;

use Exception;

class Price
{
    /**
     * @throws Exception
     */
    public function __construct(
        private readonly int $original,
        private ?int $final = null,
        private ?string $discountPercentage = null,
        private readonly string $currency = 'EUR'
    ) {
        if ($this->original < 0) {
            throw new Exception('Original price must be greater than 0.');
        }

        $this->final = $original;
    }

    public function applyDiscount(Discount $discount): void
    {
        if($discount->getPercentage() === 0) {
            return;
        }

        $discountAmount = (int) ($this->original * $discount->getPercentage() / 100);
        $this->final = $this->original - $discountAmount;
        $this->discountPercentage = "{$discount->getPercentage()}%";
    }

    public function getOriginal(): int
    {
        return $this->original;
    }

    public function getFinal(): int
    {
        return $this->final;
    }

    public function getDiscountPercentage(): ?string
    {
        return $this->discountPercentage;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}
