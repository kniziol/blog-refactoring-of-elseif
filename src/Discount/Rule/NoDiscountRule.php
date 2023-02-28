<?php

declare(strict_types=1);

namespace App\Discount\Rule;

use App\Contract\DiscountRuleInterface;
use App\Contract\OrderInterface;

class NoDiscountRule implements DiscountRuleInterface
{
    public function getDiscount(): int
    {
        return 0;
    }

    public function isQualified(OrderInterface $order): bool
    {
        return $order->getItemsCount() < 2;
    }
}
