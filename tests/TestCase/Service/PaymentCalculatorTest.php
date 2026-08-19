<?php

declare(strict_types=1);

namespace App\Test\TestCase\Service;

use App\Service\PaymentCalculator;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class PaymentCalculatorTest extends TestCase
{
    public function testBasePaymentDateOnWeekday(): void
    {
        $calculator = new PaymentCalculator();
        $month = new DateTimeImmutable('2026-08-15');
        $result = $calculator->calculateBasePaymentDate($month);
        $this->assertSame('2026-08-31', $result->format('Y-m-d'));
    }

    public function testBasePaymentDateWhenMonthEndsOnSaturday(): void
    {
        $calculator = new PaymentCalculator();
        $month = new DateTimeImmutable('2026-01-15');
        $result = $calculator->calculateBasePaymentDate($month);
        $this->assertSame('2026-01-30', $result->format('Y-m-d'));
    }

    public function testBonusPaymentDateWhenTenthIsWeekend(): void
    {
        $calculator = new PaymentCalculator();
        $month = new DateTimeImmutable('2026-09-15');
        $result = $calculator->calculateBonusPaymentDate($month);
        $this->assertSame('2026-10-13', $result->format('Y-m-d'));
    }

    public function testCalculateNext12MonthsReturnsTwelvePayments(): void
    {
        $calculator = new PaymentCalculator();
        $startMonth = new DateTimeImmutable('2026-08-01');
        $payments = $calculator->calculateNext12Months($startMonth);
        $this->assertCount(12, $payments);
    }
}