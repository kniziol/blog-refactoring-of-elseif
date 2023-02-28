<?php

declare(strict_types=1);

namespace App\Contract;

interface OrderInterface
{
    public function getItemsCount(): int;

    public function getTotal(): float;
}
