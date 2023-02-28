<?php

declare(strict_types=1);

namespace App;

use App\Contract\OrderInterface;
use RuntimeException;

class Order implements OrderInterface
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

    public function getItemsCount(): int
    {
        return $this->itemsCount;
    }

    public function getTotal(): float
    {
        return $this->total;
    }
}
