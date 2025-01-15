<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/header');
?>

<div class="py-20">
    <h1 class="text-3xl font-semibold">Keranjang</h1>
    <div class="grid grid-cols-6 grid-flow-col gap-x-5 mt-5">
        <div class="col-span-4 w-full overflow-y-scroll no-scrollbar flex flex-col gap-y-5">
            <?php foreach ($carts as $cart): ?>
                <div class="w-full bg-gray-200 px-5 py-2 rounded-md <?= $cart->check_in < date('Y-m-d') ? 'text-gray-400' : 'text-gray-800' ?>">
                    <h1 class="font-semibold"><?= $cart->name; ?></h1>
                    <div class="mt-3 flex gap-x-5">
                        <img src="<?= base_url("assets/thumbnail/default.jpg") ?>" alt="" class="w-20 rounded">
                        <div class="w-full flex justify-between items-end">
                            <div class="">
                                <h1 class="text-2xl font-semibold mb-6"><?= $cart->room_type; ?></h1>
                                <div class="grid grid-cols-2 grid-rows-2">
                                    <p class="font-semibold">Check In</p>
                                    <p class="text-lg font-semibold"><?= date('d M Y', strtotime($cart->check_in)); ?></p>
                                    <p class="font-semibold">Check Out</p>
                                    <p class="text-lg font-semibold"><?= date('d M Y', strtotime($cart->check_out)); ?></p>
                                </div>
                            </div>
                            <h1 class="text-2xl font-semibold">IDR <?= number_format($cart->price); ?></h1>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col-span-4 w-full">
            Check Out
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>
