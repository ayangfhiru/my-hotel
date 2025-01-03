<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);

        * {
            margin: 0;
            box-sizing: border-box;

        }

        body {
            background: #E0E0E0;
            font-family: 'Roboto', sans-serif;
        }

        h1 {
            font-size: 1.5em;
            color: #222;
        }

        h2 {
            font-size: .9em;
        }

        h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        p {
            font-size: .7em;
            color: #666;
            line-height: 1.2em;
        }

        .content {
            width: 100%;
            height: 100%;
            padding: 10px;
        }

        .navbar {
            position: relative;
            margin: 0 auto;
            width: 90%;
            background: #FFF;
        }

        .header {
            min-height: 120px;
            padding: 30px;
            display: flex;
            justify-content: space-between;
        }

        .invoice-bot {
            min-height: 250px;
            border-bottom: 1px solid #EEE;
            padding: 30px;
        }

        .user {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        .logo {
            display: inline-block;
            padding: 0;
            height: 60px;
            width: 60px;
        }

        .info-user {
            display: block;
            float: left;
            margin-left: 20px;
        }

        .title {
            float: right;
            text-align: right;
        }

        .detail-product {
            text-align: right
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 5px 0 5px 15px;
            border: 1px solid #EEE
        }

        .table-detail {
            width: auto;
            float: right;
            font-size: .7em;
            color: #666;
        }

        .table-detail td {
            padding: 1.5px;
        }

        .table-title {
            padding: 5px;
            background: #EEE;
        }

        .service {
            border: 1px solid #EEE;
        }

        .center {
            text-align: center;
        }

        .item-text {
            font-size: .9em;
        }

        .total {
            text-align: right;
        }

        .price {
            text-align: right;
            padding-right: 50px;
        }

        .capitalize {
            text-transform: capitalize;
        }

        .green {
            color: green
        }

        .orange {
            color: orangered;
        }

        .red {
            color: red
        }
    </style>
    <title>Invoice</title>
</head>

<body>
    <div class="content">
        <div class="navbar">
            <div class="header">
                <div class="user">
                    <img src="<?= base_url("assets/img/avatar.png") ?>" alt="<?= $invoice->hotel_name ?>" class="logo">
                    <div class="info-user">
                        <h2><?= $invoice->hotel_name; ?></h2>
                        <span>
                            <p><?= $invoice->telepon; ?></p>
                            <p><?= $invoice->city; ?></p>
                            <p><?= $invoice->address; ?></p>
                        </span>
                    </div>
                </div>
                <div class="title">
                    <h1><?= $invoice->invoice; ?></h1>
                    <p><?= date('d F Y'); ?></p>
                </div>
            </div>
            <div class="header">
                <div class="user">
                    <img src="<?= base_url("assets/img/user.png") ?>" alt="Tamu" class="logo">
                    <div class="info-user">
                        <h2><?= $invoice->full_name; ?></h2>
                        <p class=""><?= $invoice->phone_number; ?></p>
                        <p class=""><?= $invoice->email; ?></p>
                    </div>
                </div>

                <div class="detail-product">
                    <h2>Status Pembayaran</h2>
                    <?php if ($invoice->payment_status === 'completed'): ?>
                        <h1 class="capitalize green">
                            <?= $invoice->payment_status; ?>
                        </h1>
                    <?php elseif ($invoice->payment_status === 'pending'): ?>
                        <h1 class="capitalize orange">
                            <?= $invoice->payment_status; ?>
                        </h1>
                    <?php else: ?>
                        <h1 class="capitalize red">
                            <?= $invoice->payment_status; ?>
                        </h1>
                    <?php endif; ?>
                </div>

            </div>

            <div class="invoice-bot">
                <div id="table">
                    <table>
                        <tr class="table-title">
                            <td class="item center">
                                <h2>#</h2>
                            </td>
                            <td class="item center">
                                <h2>Room Type</h2>
                            </td>
                            <td class="item center">
                                <h2>Room Code</h2>
                            </td>
                            <td class="item center">
                                <h2>Bed</h2>
                            </td>
                            <td class="item center">
                                <h2>Check In</h2>
                            </td>
                            <td class="item center">
                                <h2>Check Out</h2>
                            </td>
                            <td class="item center">
                                <h2>Total Hari</h2>
                            </td>
                            <td class="item center">
                                <h2>Price</h2>
                            </td>
                            <td class="item center">
                                <h2>Total</h2>
                            </td>
                        </tr>
                        <tr class="service">
                            <td class="center">
                                <p class="item-text">1</p>
                            </td>
                            <td class="center">
                                <p class="item-text"><?= $invoice->room_type; ?></p>
                            </td>
                            <td class="center">
                                <p class="item-text"><?= $invoice->room_code; ?></p>
                            </td>
                            <td class="center">
                                <p class="item-text"><?= $invoice->bed_name; ?></p>
                            </td>
                            <td class="center">
                                <p class="item-text">
                                    <?= $invoice->check_in; ?>
                                </p>
                            </td>
                            <td class="center">
                                <p class="item-text"><?= $invoice->check_out; ?></p>
                            </td>
                            <td class="center">
                                <p class="item-text"><?= $invoice->total_days; ?></p>
                            </td>
                            <td class="center">
                                <p class="item-text"><?= number_format($invoice->price, 2); ?></p>
                            </td>
                            <td class="center">
                                <p class="item-text"><?= number_format($invoice->price * $invoice->total_days, 2); ?></p>
                            </td>
                        </tr>

                        <tr class="table-title text-center">
                            <td class="total" colspan="8">
                                <h2 style="margin-right: 10px;">Total Harga</h2>
                            </td>
                            <td class="center">
                                <h2 class="item-text" style="text-align: center"><?= number_format($invoice->amount, 2); ?></h2>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
