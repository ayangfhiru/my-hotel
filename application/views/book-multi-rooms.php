<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/top-layout');
?>

<div class="py-7">
    <div class="tabs">
        <ul id="tab-btn" class="flex flex-wrap text-sm font-medium text-center text-gray-500">
            <?php foreach ($rooms as $index => $room): ?>
                <li id="btn-tab-<?= strtolower($room['room_type']) ?>"
                    onclick="openTab('tab-<?= strtolower($room['room_type']) ?>')"
                    class="me-2 inline-block px-4 py-3 rounded-lg cursor-pointer <?= $index == 0 ? 'text-white bg-blue-700' : 'text-gray-700 bg-gray-300' ?>">
                    <?= $room['room_type']; ?>
                </li>
            <?php endforeach; ?>
            <li id="btn-tab-payment"
                onclick="openTab('tab-payment')"
                class="me-2 inline-block px-4 py-3 text-gray-700 bg-gray-300 rounded-lg active cursor-pointer">
                Payment
            </li>
        </ul>

        <?= form_open('booking/multiple/store'); ?>
        <div class="mt-5 flex items-center gap-x-2">
            <input id="identical" name="identical" value="true" class="peer/published" type="radio" />
            <button onclick="identicalData(event)" class="peer-checked/published:text-sky-500">Data diri sama</button>
        </div>

        <div id="tab-content">
            <?php foreach ($rooms as $index => $room): ?>
                <?php
                $roomType = strtolower($room['room_type']);
                echo form_hidden("room_id[$roomType]", $room['room_id']);
                echo form_hidden("check_in[$roomType]", $room['check_in']);
                echo form_hidden("check_out[$roomType]", $room['check_out']);
                echo form_hidden("room_price[$roomType]", $room['price']);
                ?>
                <div id="tab-<?= $roomType ?>" class="tabOpen py-3 gap-x-10 sm:grid-cols-2 <?= $index == 0 ? 'grid' : 'hidden' ?>">
                    <div class="w-full px-3">
                        <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                            <?php
                            $inputs = [
                                'full_name' => 'Full Name',
                                'email' => 'Email',
                                'phone_number' => 'Phone Number',
                                'identity_number' => 'Identity Number',
                            ];
                            foreach ($inputs as $name => $label): ?>
                                <div class="<?= $name === 'full_name' ?
                                                'sm:col-span-full' :
                                                'sm:col-span-3 ' ?>">
                                    <?= form_label($label, "{$name}-{$index}", ['class' => 'block text-sm font-medium text-gray-900']); ?>
                                    <div class="mt-2">
                                        <?= form_input([
                                            'name' => "{$name}[$roomType]",
                                            'id' => "{$name}-{$index}",
                                            'type' => $name === 'email' ? 'email' : 'text',
                                            'value' => set_value("{$name}[$roomType]"),
                                            'class' => 'block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm'
                                        ]); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <!-- Identity Type Dropdown -->
                            <div class="sm:col-span-3">
                                <?= form_label('Identity Type', "identity_type-{$index}", ['class' => 'block text-sm font-medium text-gray-900']); ?>
                                <div class="mt-2 grid grid-cols-1">
                                    <?= form_dropdown("identity_type[$roomType]", [
                                        'ktp' => 'KTP',
                                        'sim' => 'SIM',
                                        'paspor' => 'Paspor'
                                    ], set_value('identity_type'), [
                                        'id' => "identity_type-{$index}",
                                        'class' => 'w-full rounded-md bg-white py-1.5 pl-3 pr-8 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm'
                                    ]) ?>
                                </div>
                            </div>

                            <!-- Extra Service -->
                            <?php $this->load->view('extra-service', [
                                'index' => $index,
                                'services' => $services,
                                'roomType' => $roomType
                            ]); ?>

                            <!-- Request -->
                            <div class="col-span-full">
                                <?= form_label('Request', "request-{$index}", ['class' => 'block mb-2 text-sm font-medium text-gray-900']); ?>
                                <?= form_textarea([
                                    'name' => "request[$roomType]",
                                    'id' => "request-{$index}",
                                    'value' => set_value('request'),
                                    'rows' => 2,
                                    'placeholder' => 'Write here...',
                                    'class' => 'block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600'
                                ]); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Hotel Details -->
                    <?php $this->load->view('hotel-detail', [
                        'room' => $room,
                        'roomType' => $roomType
                    ]); ?>
                </div>
            <?php endforeach; ?>

            <!-- Payment -->
            <div id="tab-payment" class="hidden">
                <div class="grid mt-5 gap-x-10 sm:grid-cols-2">
                    <div class="h-screen overflow-y-auto no-scrollbar">
                        <div class="flex flex-col gap-y-5">
                            <?php foreach ($rooms as $index => $room): ?>
                                <div class="w-full h-40 bg-gray-200 rounded-md overflow-hidden flex gap-x-5">
                                    <img src="<?= site_url("assets/images/thumbnail/default.jpg") ?>" class="h-40 w-32 inline-block">
                                    <div class="py-3">
                                        <h1 class="text-3xl font-semibold"><?= $room['room_type'] ?></h1>
                                        <div class="grid grid-cols-2 grid-rows-2">
                                            <p class="font-semibold">Check In</p>
                                            <p class="text-lg font-semibold"><?= date('d M Y', strtotime($room['check_in'])); ?></p>
                                            <p class="font-semibold">Check Out</p>
                                            <p class="text-lg font-semibold"><?= date('d M Y', strtotime($room['check_out'])); ?></p>
                                        </div>
                                        <h3 class="mt-5 text-xl font-semibold">IDR <?= number_format(1000000); ?> / <span class="text-sm">Malam</span></h3>
                                    </div>
                                </div>
                            <?php endforeach; ?>
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
                                <input type="radio" name="payment_method" id="payment" value="cash">Cash
                            </label>
                        </div>
                        <button type="submit" class="mt-5 py-3 bg-blue-600 text-white font-semibold text-lg rounded-md">
                            Bayar
                        </button>
                    </div>
                </div>
            </div>
            <!-- Payment -->
        </div>
        <?= form_close(); ?>
    </div>
</div>

<?php $this->load->view('templates/bottom-layout'); ?>
