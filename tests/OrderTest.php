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

    public function testConstructUsingZeros(): void
    {
        $order = new Order(0, 0);

        self::assertSame(0, $order->getItemsCount());
        self::assertSame(0.0, $order->getTotal());
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
