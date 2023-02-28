<?php

declare(strict_types=1);

namespace App\Discount;

use App\Contract\DiscountProviderInterface;
use App\Contract\DiscountRuleInterface;
use App\Contract\OrderInterface;

class DiscountProvider implements DiscountProviderInterface
{
    /** @var DiscountRuleInterface[] */
    private array $rules;

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    public function provide(OrderInterface $order): int
    {
        if (empty($this->rules)) {
            return 0;
        }

        foreach ($this->rules as $rule) {
            if (!$rule->isQualified($order)) {
                continue;
            }

            return $rule->getDiscount();
        }

        return 0;
    }
}
