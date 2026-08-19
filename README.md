# Salary Payments

A CakePHP application that calculates salary and bonus payment dates for the next 12 months and allows the payment schedule to be exported as a CSV file.

## Business Rules

* Basic monthly salary is paid on the last working day of the month, Monday to Friday.
* If the last day of the month falls on a Saturday or Sunday, the payment date is moved to the previous Friday.
* Bonuses are paid on the 10th of the following month.
* If the 10th falls on a Saturday or Sunday, the bonus is paid on the first Tuesday after the 10th.

## Technologies

* PHP 8.2+
* CakePHP 5
* Composer
* PHPUnit
* Git

## Installation

Clone the repository:

```bash
git clone https://github.com/denesz/salary_payments.git
```

Enter the project directory:

```bash
cd salary_payments
```

Install the project dependencies:

```bash
composer install
```

Create the local environment file.

On Windows PowerShell:

```powershell
Copy-Item config\.env.example config\.env
```

On Linux/macOS:

```bash
cp config/.env.example config/.env
```

Generate a security salt:

```bash
php -r "echo bin2hex(random_bytes(32)), PHP_EOL;"
```

Open `config/.env` and replace the default `SECURITY_SALT` value with the generated value.

## Running the Application

Start the CakePHP development server.

On Windows:

```powershell
bin\cake server
```

On Linux/macOS:

```bash
bin/cake server
```

Then open:

```text
http://localhost:8765/
```

The application displays the salary and bonus payment schedule for the next 12 months.

## CSV Export

The payment schedule can be exported using the **Download CSV** button on the main page.

The generated CSV contains the following columns:

* Month
* Base Payment Date
* Bonus Payment Date

Example:

```csv
Month,"Base Payment Date","Bonus Payment Date"
"August 2026",31-08-2026,10-09-2026
"September 2026",30-09-2026,13-10-2026
```

## Running Tests

The application includes unit tests for the payment calculation logic.

On Windows:

```powershell
vendor\bin\phpunit
```

On Linux/macOS:

```bash
vendor/bin/phpunit
```

## Project Structure

The main application files are:

```text
src/
├── Controller/
│   └── PaymentsController.php
└── Service/
    ├── PaymentCalculator.php
    └── CsvExporter.php

templates/
└── Payments/
    └── index.php

tests/
└── TestCase/
    └── Service/
        └── PaymentCalculatorTest.php
```

### PaymentCalculator

Contains the business logic used to:

* calculate the base salary payment date;
* calculate the bonus payment date;
* generate the payment schedule for the next 12 months.

### CsvExporter

Receives the generated payment schedule and converts it into CSV format.

### PaymentsController

Handles the web requests, calls the required services and sends the calculated data to the view.

It also handles the CSV download response.

### Payments View

Displays the generated payment schedule in an HTML table and provides the CSV download option.

### Unit Tests

`PaymentCalculatorTest` verifies the salary and bonus calculation logic, including weekend cases and the generation of a 12-month schedule.

## Architecture

The application separates its responsibilities into different components:

* **Controller** — handles HTTP requests and coordinates the application flow.
* **PaymentCalculator Service** — contains the salary and bonus business logic.
* **CsvExporter Service** — handles CSV generation.
* **View** — displays the payment schedule to the user.
* **Tests** — verify that the calculation logic behaves as expected.

This separation keeps the business logic independent from the web interface and CSV generation, making the code easier to test and maintain.