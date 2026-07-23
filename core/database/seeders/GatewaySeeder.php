<?php

namespace Database\Seeders;

use App\Models\Gateway;
use Illuminate\Database\Seeder;

class GatewaySeeder extends Seeder
{
    public function run(): void
    {
        $gateways = [
            ['code' => 1,  'name' => 'PayPal',           'alias' => 'paypal',            'status' => 1, 'crypto' => 0, 'supported_currencies' => ['USD']],
            ['code' => 2,  'name' => 'Stripe',           'alias' => 'stripe',            'status' => 1, 'crypto' => 0, 'supported_currencies' => ['USD', 'EUR', 'GBP']],
            ['code' => 3,  'name' => 'Razorpay',         'alias' => 'razorpay',          'status' => 1, 'crypto' => 0, 'supported_currencies' => ['INR']],
            ['code' => 4,  'name' => 'Mollie',           'alias' => 'mollie',            'status' => 0, 'crypto' => 0, 'supported_currencies' => ['EUR']],
            ['code' => 5,  'name' => 'Authorize.Net',    'alias' => 'authorizenet',       'status' => 0, 'crypto' => 0, 'supported_currencies' => ['USD']],
            ['code' => 6,  'name' => 'CoinGate',         'alias' => 'coingate',          'status' => 0, 'crypto' => 1, 'supported_currencies' => ['USD']],
            ['code' => 7,  'name' => 'BTCPay',           'alias' => 'btcpay',            'status' => 0, 'crypto' => 1, 'supported_currencies' => ['USD']],
            ['code' => 8,  'name' => 'Flutterwave',      'alias' => 'flutterwave',       'status' => 0, 'crypto' => 0, 'supported_currencies' => ['USD', 'NGN']],
            ['code' => 9,  'name' => 'Paystack',         'alias' => 'paystack',          'status' => 0, 'crypto' => 0, 'supported_currencies' => ['NGN', 'USD', 'GHS']],
            ['code' => 10, 'name' => 'BKash',            'alias' => 'bkash',             'status' => 0, 'crypto' => 0, 'supported_currencies' => ['BDT']],
            ['code' => 11, 'name' => 'Nagad',            'alias' => 'nagad',             'status' => 0, 'crypto' => 0, 'supported_currencies' => ['BDT']],
            ['code' => 12, 'name' => 'VoguePay',         'alias' => 'voguepay',          'status' => 0, 'crypto' => 0, 'supported_currencies' => ['USD', 'NGN']],
            ['code' => 13, 'name' => 'Payhere',          'alias' => 'payhere',           'status' => 0, 'crypto' => 0, 'supported_currencies' => ['LKR']],
            ['code' => 14, 'name' => 'Midtrans',         'alias' => 'midtrans',          'status' => 0, 'crypto' => 0, 'supported_currencies' => ['IDR']],
            ['code' => 15, 'name' => 'Xendit',           'alias' => 'xendit',            'status' => 0, 'crypto' => 0, 'supported_currencies' => ['IDR']],
            ['code' => 16, 'name' => 'CashBucks',        'alias' => 'cashbucks',         'status' => 0, 'crypto' => 0, 'supported_currencies' => ['BDT']],
            ['code' => 17, 'name' => 'SslCommerz',       'alias' => 'sslcommerz',        'status' => 0, 'crypto' => 0, 'supported_currencies' => ['BDT']],
            ['code' => 18, 'name' => 'Aamarpay',         'alias' => 'aamarpay',          'status' => 0, 'crypto' => 0, 'supported_currencies' => ['BDT']],
            ['code' => 19, 'name' => 'Coinbase',         'alias' => 'coinbase',          'status' => 0, 'crypto' => 1, 'supported_currencies' => ['USD']],
            ['code' => 20, 'name' => 'BlockBee',         'alias' => 'blockbee',          'status' => 0, 'crypto' => 1, 'supported_currencies' => ['USD']],
            ['code' => 21, 'name' => 'Binance',          'alias' => 'binance',           'status' => 0, 'crypto' => 1, 'supported_currencies' => ['USD']],
            ['code' => 22, 'name' => 'Moneris',          'alias' => 'moneris',           'status' => 0, 'crypto' => 0, 'supported_currencies' => ['CAD']],
            ['code' => 23, 'name' => 'Fatora',           'alias' => 'fatora',            'status' => 0, 'crypto' => 0, 'supported_currencies' => ['USD']],
            ['code' => 24, 'name' => 'XoloPay',          'alias' => 'xolopay',           'status' => 0, 'crypto' => 0, 'supported_currencies' => ['USD']],
            ['code' => 25, 'name' => 'Khalti',           'alias' => 'khalti',            'status' => 0, 'crypto' => 0, 'supported_currencies' => ['NPR']],
            ['code' => 26, 'name' => 'Esewa',            'alias' => 'esewa',             'status' => 0, 'crypto' => 0, 'supported_currencies' => ['NPR']],
            ['code' => 27, 'name' => 'Ipay',             'alias' => 'ipay',              'status' => 0, 'crypto' => 0, 'supported_currencies' => ['NGN']],
            ['code' => 28, 'name' => 'PayGate',          'alias' => 'paygate',           'status' => 0, 'crypto' => 0, 'supported_currencies' => ['ZAR']],
            ['code' => 29, 'name' => 'YooMoney',         'alias' => 'yoomoney',          'status' => 0, 'crypto' => 0, 'supported_currencies' => ['RUB']],
            ['code' => 30, 'name' => 'Qpay',             'alias' => 'qpay',              'status' => 0, 'crypto' => 0, 'supported_currencies' => ['IQD']],
            ['code' => 31, 'name' => 'Fawry',            'alias' => 'fawry',             'status' => 0, 'crypto' => 0, 'supported_currencies' => ['EGP']],
            ['code' => 32, 'name' => 'Knet',             'alias' => 'knet',              'status' => 0, 'crypto' => 0, 'supported_currencies' => ['KWD']],
            ['code' => 33, 'name' => 'Tabby',            'alias' => 'tabby',             'status' => 0, 'crypto' => 0, 'supported_currencies' => ['AED']],
            ['code' => 34, 'name' => 'Apple Pay',        'alias' => 'applepay',          'status' => 0, 'crypto' => 0, 'supported_currencies' => ['USD']],
            ['code' => 35, 'name' => 'Google Pay',       'alias' => 'googlepay',         'status' => 0, 'crypto' => 0, 'supported_currencies' => ['USD']],
            ['code' => 36, 'name' => 'Esewafy',          'alias' => 'esewafy',           'status' => 0, 'crypto' => 0, 'supported_currencies' => ['USD']],
        ];

        foreach ($gateways as $gateway) {
            Gateway::updateOrCreate(
                ['code' => $gateway['code']],
                [
                    'name'                  => $gateway['name'],
                    'alias'                 => $gateway['alias'],
                    'status'                => $gateway['status'],
                    'crypto'                => $gateway['crypto'],
                    'supported_currencies'  => $gateway['supported_currencies'],
                    'gateway_parameters'    => json_encode([]),
                    'form_id'               => null,
                ]
            );
        }
    }
}
