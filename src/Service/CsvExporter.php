<?php

declare(strict_types=1);

namespace App\Service;

class CsvExporter
{
    public function generate(array $payments): string
{
    $stream = fopen('php://temp', 'r+');

    fputcsv($stream, [
        'Month',
        'Base Payment Date',
        'Bonus Payment Date',
    ]);

    foreach ($payments as $payment) {
        fputcsv($stream, [
            $payment['month']->format('F Y'),
            $payment['basePaymentDate']->format('d-m-Y'),
            $payment['bonusPaymentDate']->format('d-m-Y'),
        ]);
    }

    rewind($stream);

    $csv = stream_get_contents($stream);

    fclose($stream);

    return $csv;
}
}