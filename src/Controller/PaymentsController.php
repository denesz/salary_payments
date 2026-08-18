<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\PaymentCalculator;
use DateTimeImmutable;

class PaymentsController extends AppController
{
    public function index()
    {
    $calculator = new PaymentCalculator();
    $startMonth = new DateTimeImmutable('now');
    $payments = $calculator->calculateNext12Months($startMonth);
    $this->set('payments', $payments);
    }
}