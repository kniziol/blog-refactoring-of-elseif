<?php

declare(strict_types=1);

namespace App;

use App\Contract\DiscountProviderInterface;
use App\Contract\OrderInterface;

class DiscountProvider implements DiscountProviderInterface
{
    public function provide(OrderInterface $order): int
    {
        if ($order->getItemsCount() < 2) {
            return 0;
        } elseif ($order->getTotal() >= 50 && $order->getTotal() < 100) {
            return 5;
        } elseif ($order->getTotal() >= 100 && $order->getTotal() < 1000) {
            return 10;
        } elseif ($order->getTotal() >= 1000 && $order->getTotal() < 5000) {
            return 15;
        } elseif ($order->getTotal() >= 5000) {
            return 20;
        }

        return 0;
    }
}
