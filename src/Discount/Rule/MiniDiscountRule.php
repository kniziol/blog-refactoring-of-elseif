<?php

declare(strict_types=1);

namespace App\Discount\Rule;

use App\Contract\DiscountRuleInterface;
use App\Contract\OrderInterface;

class MiniDiscountRule implements DiscountRuleInterface
{
    public function getDiscount(): int
    {
        return 5;
    }

    public function isQualified(OrderInterface $order): bool
    {
        return $order->getTotal() >= 50 && $order->getTotal() < 100;
    }
}
