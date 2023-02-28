<?php

declare(strict_types=1);

namespace App\Tests\Discount;

use App\Discount\DiscountProvider;
use App\Discount\Rule\LargeDiscountRule;
use App\Discount\Rule\MediumDiscountRule;
use App\Discount\Rule\MiniDiscountRule;
use App\Discount\Rule\NoDiscountRule;
use App\Discount\Rule\RegularDiscountRule;
use App\Order;
use Generator;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Discount\DiscountProvider
 * @uses   \App\Order
 * @covers \App\Discount\Rule\NoDiscountRule
 * @covers \App\Discount\Rule\MiniDiscountRule
 * @covers \App\Discount\Rule\RegularDiscountRule
 * @covers \App\Discount\Rule\MediumDiscountRule
 * @covers \App\Discount\Rule\LargeDiscountRule
 */
class DiscountProviderTest extends TestCase
{
    public static function provideOrderData(): Generator
    {
        yield 'no items' => [
            0,
            0,
            0,
        ];

        yield 'no discount 1' => [
            1,
            2,
            0,
        ];

        yield 'no discount 2' => [
            2,
            2,
            0,
        ];

        yield '5 percent' => [
            2,
            50,
            5,
        ];

        yield '10 percent' => [
            2,
            100,
            10,
        ];

        yield '15 percent 1' => [
            2,
            1000,
            15,
        ];

        yield '15 percent 2' => [
            2,
            4999,
            15,
        ];

        yield '20 percent' => [
            2,
            5000,
            20,
        ];
    }

    /**
     * @dataProvider provideOrderData
     */
    public function testProvide(int $itemsCount, float $total, int $expected): void
    {
        $rules = [
            new NoDiscountRule(),
            new MiniDiscountRule(),
            new RegularDiscountRule(),
            new MediumDiscountRule(),
            new LargeDiscountRule(),
        ];

        $order = new Order($itemsCount, $total);
        $calculator = new DiscountProvider($rules);

        self::assertSame($expected, $calculator->provide($order));
    }

    /**
     * @dataProvider provideOrderData
     */
    public function testProvideWithoutRules(int $itemsCount, float $total): void
    {
        $order = new Order($itemsCount, $total);
        $calculator = new DiscountProvider([]);

        self::assertSame(0, $calculator->provide($order));
    }
}
