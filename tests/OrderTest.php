<?php

declare(strict_types=1);

namespace App\Tests;

use App\Order;
use Generator;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * @covers \App\Order
 */
class OrderTest extends TestCase
{
    public static function provideDiscount(): Generator
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

    public static function provideException(): Generator
    {
        yield 'negative items count' => [
            -1,
            1,
            'Amount of items cannot be negative',
        ];

        yield 'negative total value' => [
            1,
            -1,
            'Total value cannot be negative',
        ];
    }

    /**
     * @dataProvider provideException
     */
    public function testConstruct(int $itemsCount, float $total, string $exception): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage($exception);

        new Order($itemsCount, $total);
    }

    /**
     * @dataProvider provideDiscount
     */
    public function testGetDiscount(int $itemsCount, float $total, int $expected): void
    {
        $order = new Order($itemsCount, $total);
        self::assertSame($expected, $order->getDiscount());
    }

    public function testGetItemsCount(): void
    {
        $order = new Order(1, 2);
        self::assertSame(1, $order->getItemsCount());
    }

    public function testGetTotal(): void
    {
        $order = new Order(1, 2);
        self::assertSame(2.0, $order->getTotal());
    }
}
