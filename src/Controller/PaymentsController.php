<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\PaymentCalculator;
use DateTimeImmutable;
use App\Service\CsvExporter;

class PaymentsController extends AppController
{
    public function index()
    {
    $calculator = new PaymentCalculator();
    $startMonth = new DateTimeImmutable('now');

    $payments = $calculator->calculateNext12Months($startMonth);
    $this->set('payments', $payments);
    }

    public function export()
    {
    $calculator = new PaymentCalculator();
    $csvExporter = new CsvExporter();

    $startMonth = new DateTimeImmutable('now');

    $payments = $calculator->calculateNext12Months($startMonth);

    $csv = $csvExporter->generate($payments);

    return $this->response
        ->withType('csv')
        ->withDownload('salary_payments.csv')
        ->withStringBody($csv);
    }
}