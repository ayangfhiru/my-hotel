<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="d-flex align-items-center">
                <a href="<?= site_url("") ?>" class="mr-3">
                    <i class="fa-solid fa-arrow-left fa-2xl"></i>
                </a>
                <h1>Chek In</h1>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Layout</a></div>
                <div class="breadcrumb-item">Default Layout</div>
            </div>
        </div>
        <div class="section-body">
            <div class="container mt-10 pb-20">
                <div class="flex flex-col border-b-2 px-5 pb-3">
                    <h1 class="font-semibold text-xl">Tamu</h1>
                    <div class="mt-3">
                        <h3 class="font-medium text-sm"><?= $detail->full_name; ?></h3>
                        <p class="font-medium text-sm"><?= $detail->phone_number; ?></p>
                        <p class="font-medium text-sm capitalize">Status <?= $detail->reservation_status; ?></p>
                        <p class="font-medium text-sm capitalize">Days <?= $detail->total_days; ?></p>
                    </div>
                </div>

                <!-- Reservasi -->
                <div class="mt-5">
                    <h1 class="pl-3 text-sm font-semibold"><?= $detail->hotel_name; ?></h1>
                    <div class="pt-2 px-3 flex justify-between items-center">
                        <div class="flex gap-x-4">
                            <img src="<?= base_url("assets/thumbnail/default.jpg") ?>" alt="My Hotel" class="w-20 rounded-md">
                            <div class="flex flex-col justify-between">
                                <h1 class="text-2xl font-semibold"><?= $detail->room_type; ?></h1>
                                <div class="grid grid-cols-2 grid-rows-2">
                                    <p class="font-semibold">Check In</p>
                                    <p class="text-lg font-semibold"><?= date('d M Y', strtotime($detail->check_in)); ?></p>
                                    <p class="font-semibold">Check Out</p>
                                    <p class="text-lg font-semibold"><?= date('d M Y', strtotime($detail->check_out)); ?></p>
                                </div>
                            </div>
                        </div>
                        <h1 class="text-xl font-semibold">IDR <?= number_format($detail->price); ?></h1>
                    </div>
                    <div class="mt-8 grid grid-cols-2 gap-x-5">
                        <div class="border-r-2 pr-5">
                            <div class="flex justify-between">
                                <label class="block mb-2 text-lg font-semibold text-gray-900">Request</label>
                                <div class="mr-3 flex gap-x-3">
                                    <span class="flex gap-x-1">
                                        <p>Status</p>
                                        <p>Pending</p>
                                    </span>
                                    <span class="hidden gap-x-1">
                                        <p>Biaya tambahan</p>
                                        <p>-</p>
                                    </span>
                                </div>
                            </div>
                            <textarea class="block h-fit p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" disabled><?= $detail->request; ?></textarea>
                        </div>
                        <div class="">
                            <label class="block mb-2 text-lg font-semibold text-gray-900">Catatan</label>
                            <textarea class="block h-fit p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" disabled><?= $detail->note; ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- Table Services -->
                <div class="relative pt-5 mt-5 border-t-2">
                    <table class="w-full text-left text-gray-500">
                        <thead class="text-xs text-gray-700 capitalize bg-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Services name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Qty
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total Price
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $serviceQty = 0;
                            $servicePrice = 0;
                            ?>
                            <?php foreach ($services as $service): ?>
                                <?php
                                $serviceQty += $service->service_quantity;
                                $servicePrice += $service->total_price;
                                ?>
                                <tr class="bg-white">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <?= $service->service_name; ?>
                                    </th>
                                    <td class="px-6 py-4">
                                        <?= number_format($service->service_price); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?= $service->service_quantity; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?= number_format($service->total_price); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="font-semibold text-gray-900">
                                <th scope="row" colspan="2" class="px-6 py-3 text-base text-right">Total</th>
                                <td class="px-6 py-3"><?= $serviceQty; ?></td>
                                <td class="px-6 py-3"><?= number_format($servicePrice); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Tabel Total Payment -->
                <div class="mt-5 pt-5">
                    <div class="grid grid-cols-6 border-y border-gray-300">
                        <span class="col-span-4 p-2 border-r border-gray-300 text-right capitalize">Subtotal Room</span>
                        <span class="p-2 col-start-5 col-end-7 text-right">IDR <?= number_format($detail->price); ?></span>
                    </div>
                    <div class="grid grid-cols-6 border-b border-gray-300">
                        <span class="col-span-4 p-2 border-r border-gray-300 text-right">
                            Request
                            <i class="fa-sharp fa-light fa-circle-info ml-3 cursor-pointer fa-xl" title="Pembayaran dilakukan saat check in"></i>
                        </span>
                        <span class="p-2 col-start-5 col-end-7 text-right">IDR -</span>
                    </div>
                    <div class="grid grid-cols-6 border-b border-gray-300">
                        <span class="col-span-4 p-2 border-r border-gray-300 text-right">Extra Services</span>
                        <span class="p-2 col-start-5 col-end-7 text-right">IDR <?= number_format($servicePrice); ?></span>
                    </div>
                    <div class="grid grid-cols-6 border-b items-center border-gray-300">
                        <span class="col-span-4 p-2 border-r border-gray-300 text-right">Total Pesanan</span>
                        <span class="p-2 col-start-5 col-end-7 text-right text-xl">IDR <?= number_format($detail->amount); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('admin/_partials/footer'); ?>
