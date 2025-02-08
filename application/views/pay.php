<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/header');
?>

<div id="tab-payment" class="py-7 hidden">
    <!-- Payment -->
    <div id="tab-payment" class="grid mt-5 gap-x-10 sm:grid-cols-2">
        <div class="h-screen overflow-y-auto no-scrollbar">
            <div class="flex flex-col gap-y-5">
                <?php for ($i = 0; $i < 6; $i++): ?>
                    <div class="w-full h-40 bg-gray-200 rounded-md overflow-hidden flex gap-x-5">
                        <img src="<?= site_url('assets/thumbnail/default.jpg') ?>" alt="X" class="h-40 w-32 inline-block">
                        <div class="py-3">
                            <h1 class="text-3xl font-semibold">Delux</h1>
                            <div class="grid grid-cols-2 grid-rows-2">
                                <p class="font-semibold">Check In</p>
                                <p class="text-lg font-semibold"><?= date('d M Y'); ?></p>
                                <p class="font-semibold">Check Out</p>
                                <p class="text-lg font-semibold"><?= date('d M Y', strtotime('+1 days')); ?></p>
                            </div>
                            <h3 class="mt-5 text-xl font-semibold">IDR <?= number_format(1000000); ?> / <span class="text-sm">Malam</span></h3>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
        <div class="flex flex-col">
            <h2 class="font-semibold text-sm mb-3">Detail Pembayaran</h2>
            <ul class="w-full bg-gray-200 border p-5 rounded-md">
                <?php for ($i = 0; $i < 3; $i++): ?>
                    <li class="flex justify-between items-center w-full border-b border-gray-400">
                        <h4 class="font-semibold text-sm">Delux</h4>
                        <h1 class="font-semibold text-lg">1.000.000</h1>
                    </li>
                <?php endfor; ?>
                <li class="flex justify-between items-center w-full mt-3 border-gray-400">
                    <h4 class="font-semibold text-lg">Total</h4>
                    <h1 class="font-semibold text-xl">1.000.000</h1>
                </li>
            </ul>
            <div class="mt-5">
                <h2 class="font-semibold text-sm mb-3">Metode Pembayaran</h2>
                <label class="w-full flex items-center gap-x-5 border bg-gray-200 p-5 rounded-md cursor-pointer">
                    <input type="radio" name="payment-method" id="payment" value="ABC">
                    <p>QRIS</p>
                </label>
            </div>
            <button class="mt-5 py-3 bg-blue-600 text-white font-semibold text-lg rounded-md">
                Bayar
            </button>
        </div>
    </div>
    <!-- Payment -->
</div>

<?php $this->load->view('templates/footer'); ?>
