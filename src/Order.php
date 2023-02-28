<?php

declare(strict_types=1);

namespace App;

use RuntimeException;

class Order
{
    private int $itemsCount;
    private float $total;

    public function __construct(int $itemsCount, float $total)
    {
        if ($itemsCount < 0) {
            throw new RuntimeException('Amount of items cannot be negative');
        }

        if ($total < 0) {
            throw new RuntimeException('Total value cannot be negative');
        }

        $this->itemsCount = $itemsCount;
        $this->total = $total;
    }

    public function getDiscount(): int
    {
        if ($this->itemsCount < 2) {
            return 0;
        } elseif ($this->itemsCount >= 2 && $this->total >= 50 && $this->total < 100) {
            return 5;
        } elseif ($this->itemsCount >= 2 && $this->total >= 100 && $this->total < 1000) {
            return 10;
        } elseif ($this->itemsCount >= 2 && $this->total >= 1000 && $this->total < 5000) {
            return 15;
        } elseif ($this->itemsCount >= 2 && $this->total >= 5000) {
            return 20;
        }

        return 0;
    }

    public function getItemsCount(): int
    {
        return $this->itemsCount;
    }

    public function getTotal(): float
    {
        return $this->total;
    }
}
