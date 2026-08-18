<?php

declare(strict_types=1);

namespace App\Service;

use DateTimeImmutable;

class PaymentCalculator
{
    public function calculateBasePaymentDate(DateTimeImmutable $month): DateTimeImmutable
    {
        $lastDay = $month->modify('last day of this month');
        $dayOfWeek = (int)$lastDay->format('N');
        if($dayOfWeek >= 1 && $dayOfWeek <= 5)
            return $lastDay;
        while($dayOfWeek > 5)
            {
                $lastDay = $lastDay->modify('-1 day');
                $dayOfWeek = (int)$lastDay->format('N');
            }
        return $lastDay;
    }

    public function calculateBonusPaymentDate(DateTimeImmutable $month): DateTimeImmutable
    {
        $nextMonth = $month->modify('+1 month');
        $bonusDay = $nextMonth->setDate((int)$nextMonth->format('Y'), (int)$nextMonth->format('m'), 10);
        $dayOfWeek = (int)$bonusDay->format('N');
        if($dayOfWeek >= 1 && $dayOfWeek <=5)
            return $bonusDay;
        while($dayOfWeek !== 2)
            {
                $bonusDay = $bonusDay->modify('+1 day');
                $dayOfWeek = (int)$bonusDay->format('N');
            }
        return $bonusDay;
    }

    public function calculateNext12Months(DateTimeImmutable $startMonth): array
    {
        $payments = [];
        $currentMonth = $startMonth;
        $counter = 0;
        while ($counter < 12)
            {
                $basePayment = $this->calculateBasePaymentDate($currentMonth);
                $bonusPayment = $this->calculateBonusPaymentDate($currentMonth);
                $payments[] = [
                    'month' => $currentMonth,
                    'basePaymentDate' => $basePayment,
                    'bonusPaymentDate' => $bonusPayment,
                ];
                $counter++;
                $currentMonth = $currentMonth->modify('+1 month');
            }
        return $payments;
    }
}