<?php

declare(strict_types=1);

namespace App\Discount\Rule;

use App\Contract\DiscountRuleInterface;
use App\Contract\OrderInterface;

class MediumDiscountRule implements DiscountRuleInterface
{
    public function getDiscount(): int
    {
        return 15;
    }

    public function isQualified(OrderInterface $order): bool
    {
        return $order->getTotal() >= 1000 && $order->getTotal() < 5000;
    }
}
