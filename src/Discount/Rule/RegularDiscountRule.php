<?php

declare(strict_types=1);

namespace App\Discount\Rule;

use App\Contract\DiscountRuleInterface;
use App\Contract\OrderInterface;

class RegularDiscountRule implements DiscountRuleInterface
{
    public function getDiscount(): int
    {
        return 10;
    }

    public function isQualified(OrderInterface $order): bool
    {
        return $order->getTotal() >= 100 && $order->getTotal() < 1000;
    }
}
