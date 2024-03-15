# Stripe Test

## Overview
This project is a demonstration of integrating Stripe payment processing into a web application. It utilizes Codeigniter 3.11 framework with PHP Version 7.4.23.

## Environment Setup
- **Framework:** Codeigniter 3.11
- **PHP Version:** 7.4.23

## Stripe SDK Location
The Stripe SDK is located at `application/libraries/stripe-php`.

## Important Notes
- Ensure to update your Stripe secret key in `application/controllers/Home.php` and public key in `application/view/index.php` before using this project.

## Question
```php
$data['intent'] = \Stripe\PaymentIntent::create([
    ....
    .... existing code

    'transfer_data' => [
        'amount' => round($toTransfer),
        'destination' => $connected_account_id,
    ],
     ....
    .... existing code
]); 

 Why must I pass an integer in the 'amount' key? What should I do if I want to pass a fractional value?


