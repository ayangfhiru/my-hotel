<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/header');
?>

<div class="py-20">
    <h1 class="text-3xl font-semibold">Keranjang</h1>
    <div class="grid grid-cols-6 grid-flow-col gap-x-5 mt-5">
        <div class="col-span-4 w-full overflow-y-scroll no-scrollbar flex flex-col gap-y-5">
            <?php foreach ($carts as $cart): ?>
                <label id="cart-<?= $cart->room_id ?>" for="cart-<?= $cart->room_id ?>">
                    <div class="w-full h-40 bg-gray-200 rounded-md overflow-hidden flex justify-between cursor-pointer">
                        <div class="flex gap-x-5 pl-5">
                            <input type="checkbox" name="selected_room[]" id="cart-<?= $cart->room_id ?>" value="<?= $cart->room_id ?>">
                            <img src="<?= site_url('assets/thumbnail/default.jpg') ?>" alt="<?= $cart->room_type ?>" class="h-40 w-28 inline-block rounded object-cover">
                            <div class="py-3">
                                <h1 class="text-3xl font-semibold"><?= $cart->room_type; ?></h1>
                                <table>
                                    <tr>
                                        <td>Check In</td>
                                        <td class="ml-5 inline-block">
                                            <input type="text" name="check_in[]" value="<?= date('d M Y', strtotime($cart->check_in)) ?>" class="text-lg font-semibold text-gray-700 bg-transparent border-none inline-block w-auto focus:outline-none" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Check Out</td>
                                        <td class="ml-5 inline-block">
                                            <input type="text" name="check_in[]" value="<?= date('d M Y', strtotime($cart->check_in)) ?>" class="text-lg font-semibold text-gray-700 bg-transparent border-none inline-block w-auto focus:outline-none" readonly>
                                        </td>
                                    </tr>
                                </table>
                                <h3 class="mt-5 text-xl font-semibold">IDR <?= number_format($cart->price); ?> / <span class="text-sm">Malam</span></h3>
                            </div>
                        </div>
                        <div class="flex items-end px-7 pb-5">
                            <button data-url="<?= site_url() ?>"
                                data-room-id="<?= $cart->room_id ?>"
                                data-user-id="<?= $this->session->userdata('user_id') ?>"
                                class="removeCart flex items-center gap-x-1 hover:text-red-600">
                                <i class="fa-solid fa-trash"></i>
                                Hapus
                            </button>
                        </div>
                    </div>
                </label>
            <?php endforeach; ?>
        </div>
        <div class="col-span-4 w-full">
            <h1 id="total-price"></h1>
            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm py-2.5 text-center">Check Out</button>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>
