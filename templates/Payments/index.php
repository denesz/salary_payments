<style>
    body {
        background: #f4f6f8;
        font-family: Arial, sans-serif;
    }

    .payments-container {
        max-width: 1000px;
        margin: 60px auto;
        padding: 30px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .payments-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .payments-header h1 {
        margin: 0;
        font-size: 28px;
    }

    .payments-header p {
        margin-top: 6px;
        color: #777;
    }

    .download-button {
        padding: 10px 18px;
        border-radius: 8px;
        text-decoration: none;
        background: #222;
        color: white;
        font-weight: 600;
    }

    .payments-table {
        width: 100%;
        border-collapse: collapse;
        overflow: hidden;
        border-radius: 8px;
    }

    .payments-table th {
        background: #f0f2f5;
        padding: 14px;
        text-align: left;
    }

    .payments-table td {
        padding: 14px;
        border-bottom: 1px solid #eee;
    }

    .payments-table tbody tr:nth-child(even) {
        background: #fafafa;
    }

    .payments-table tbody tr:hover {
        background: #f3f3f3;
    }
</style>

<div class="payments-container">
    <div class="payments-header">
    <div>
        <h1>Salary Payments</h1>
        <p>Payment schedule for the next 12 months.</p>
    </div>

    <a href="/payments/export" class="download-button">Download CSV</a>
</div>

    <table class="payments-table">
        <thead>
            <tr>
                <th>Month</th>
                <th>Base Payment Date</th>
                <th>Bonus Payment Date</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($payments as $payment): ?>
                <tr>
                    <td>
                        <?php echo $payment['month']->format('F Y'); ?>
                    </td>

                    <td>
                        <?php echo $payment['basePaymentDate']->format('d-m-Y'); ?>
                    </td>

                    <td>
                        <?php echo $payment['bonusPaymentDate']->format('d-m-Y'); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>