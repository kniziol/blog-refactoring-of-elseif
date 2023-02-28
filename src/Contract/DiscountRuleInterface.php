<?php

declare(strict_types=1);

namespace App\Contract;

interface DiscountRuleInterface
{
    public function getDiscount(): int;

    public function isQualified(OrderInterface $order): bool;
}
