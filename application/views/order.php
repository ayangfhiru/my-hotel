<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/header');
?>

<div class="px-20 space-y-3 py-10">
    <?php foreach ($reservations as $reservation): ?>
        <div class="w-full h-fit py-3 border border-gray-300 rounded-lg">
            <div class="relative px-10 pb-2 flex items-center gap-x-5">
                <a href="<?= site_url("reservation/$reservation->reservation_id/invoice") ?>" class="">
                    <i class="fa-solid fa-print fa-xl"></i>
                </a>
                <p class="text-sm"><?= date('d M Y', strtotime($reservation->created_at)); ?></p>
                <p class="text-sm"><?= $reservation->invoice; ?></p>
                <p class="text-sm capitalize
                <?= match ($reservation->payment_status) {
                    'pending' => 'text-orange-500',
                    'completed' => 'text-green-500',
                    'failed' => 'text-red-500',
                    default => ''
                } ?>"> <?= $reservation->payment_status; ?></p>
            </div>
            <span class="py-0.5 block w-full bg-gray-300"></span>
            <div class="px-10 pt-2 grid grid-cols-2">
                <a href="<?= site_url("guest/order/$reservation->reservation_id/detail") ?>" class="">
                    <h1 class="ml-1.5 text-sm font-semibold"><?= $reservation->name; ?></h1>
                    <div class="flex gap-x-4 mt-2">
                        <img src="<?= base_url("assets/thumbnail/default.jpg") ?>" alt="My Hotel" class="w-20 rounded-md">
                        <div class="flex flex-col justify-between">
                            <h1 class="text-2xl font-semibold"><?= $reservation->room_type; ?></h1>
                            <div class="grid grid-cols-2 grid-rows-2">
                                <p class="font-semibold">Check In</p>
                                <p class="text-lg font-semibold"><?= date('d M Y', strtotime($reservation->check_in)); ?></p>
                                <p class="font-semibold">Check Out</p>
                                <p class="text-lg font-semibold"><?= date('d M Y', strtotime($reservation->check_out)); ?></p>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="flex flex-col gap-y-2 relative border-l-4 px-2">
                    <h1 class="font-semibold text-lg">IDR <?= number_format($reservation->amount, 2); ?></h1>
                    <div class="flex gap-x-5" id="countdown-<?= $reservation->payment_id ?>">
                        <p class="font-semibold">Batas Pembayaran</p>
                        <p id="timer-<?= $reservation->payment_id ?>" data-upload-img="<?= $reservation->payment_img ?>" data-expire-time="<?= $reservation->expire_time ?>" class="countdown-timer text-lg text-red-500 font-semibold"></p>
                    </div>
                    <?php
                    $is_disabled = isset($reservation->payment_time) || date('Y-m-d H:i:s') > $reservation->expire_time;
                    ?>
                    <?= form_open_multipart(site_url("guest/payment/$reservation->payment_id/transfer"), [
                        'class' => 'mt-2 space-y-1'
                    ]); ?>
                    <div class="flex items-center space-x-6">
                        <label class="block">
                            <span class="sr-only">Choose profile photo</span>
                            <input type="file" name="transfer" id="transfer" class="block w-full text-sm text-slate-500 cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100
                                <?= $is_disabled ? 'cursor-not-allowed' : '' ?>
                                " <?= $is_disabled ? 'disabled' : '' ?> />
                        </label>
                    </div>
                    <button type="submit"
                        class="text-sm text-white py-2 px-4 w-full rounded-full border-0 font-semibold bg-green-700 hover:bg-green-500
                        <?= $is_disabled ? 'cursor-not-allowed' : '' ?>"
                        <?= $is_disabled ? 'disabled' : '' ?>>
                        Upload
                    </button>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php $this->load->view('templates/footer'); ?>
