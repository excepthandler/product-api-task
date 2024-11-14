<?php

namespace App\Domain\Product\ValueObject;

use Exception;

class Discount
{
    /**
     * @throws Exception
     */
    public function __construct(private readonly int $percentage)
    {
        if ($this->percentage < 0) {
            throw new Exception('Percentage must be greater than 0.');
        }
    }

    public function getPercentage(): int
    {
        return $this->percentage;
    }
}
