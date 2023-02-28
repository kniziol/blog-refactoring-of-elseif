<?php

declare(strict_types=1);

namespace App\Contract;

interface DiscountProviderInterface
{
    public function provide(OrderInterface $order): int;
}
