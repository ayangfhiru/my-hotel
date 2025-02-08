<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once dirname(__FILE__) . '/../Midtrans-PHP/Midtrans.php';

class Midtrans_lib
{
    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->config('midtrans');

        \Midtrans\Config::$serverKey = $this->CI->config->item('midtrans_server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = $this->CI->config->item('midtrans_is_production');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = $this->CI->config->item('midtrans_is_sanitized');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = $this->CI->config->item('midtrans_is_3ds');
    }

    public function createTransaction($orderId, $grossAmount, $customerDetails = [], $itemDetails = [])
    {
        // Required
        $transaction_details = [
            'order_id' => $orderId,
            'gross_amount' => $grossAmount, // no decimal allowed for creditcard
        ];

        $transactionData = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customerDetails
        ];

        try {
            $snapToken = Midtrans\Snap::getSnapToken($transactionData);
            return $snapToken;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
