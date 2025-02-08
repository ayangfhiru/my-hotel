<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/top-layout');
?>

<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16 mx-auto max-w-screen-xl px-4 2xl:px-0">
    <div class="tabs">
        <div class="flex items-center gap-x-2 px-10 text-darkblack-700 dark:text-white">
            <input id="identical" name="identical" value="true" class="peer/published text-blue-400" type="radio" />
            <button onclick="identicalData(event)" class="peer-checked/published:text-sky-500">Data diri sama</button>
        </div>
        <ol id="tab-btn" class="items-center flex w-full max-w-auto text-center text-sm font-medium text-gray-500 dark:text-gray-400 sm:text-base mt-5">
            <?php foreach ($rooms as $index => $room): ?>
                <li id="btn-tab-<?= $index ?>"
                    onclick="openTab('tab-<?= $index ?>')" class="after:border-1 flex items-center text-primary-700 after:mx-6 after:hidden after:h-1 after:w-full after:border-b after:border-gray-200 dark:text-primary-500 dark:after:border-gray-700 sm:after:inline-block sm:after:content-[''] md:w-full xl:after:mx-10 cursor-pointer">
                    <span class="flex items-center after:mx-2 after:text-gray-200 after:content-['/'] dark:after:text-gray-500 sm:after:hidden">
                        <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <?= $room->room_type; ?>
                    </span>
                </li>
            <?php endforeach; ?>

            <li id="btn-tab-payment" class="flex shrink-0 items-center cursor-pointer"
                onclick="openTab('tab-payment')">
                <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Order summary
            </li>
        </ol>

        <?= form_open('booking/multiple/store'); ?>
        <div id="tab-content">
            <?php foreach ($rooms as $index => $room): ?>
                <?php
                echo form_hidden("room_id[$index]", $room->room_id);
                echo form_hidden("check_in[$index]", $room->check_in);
                echo form_hidden("check_out[$index]", $room->check_out);
                echo form_hidden("room_price[$index]", $room->price);
                ?>
                <div id="tab-<?= $index ?>" class="tabOpen mt-6 sm:mt-8 lg:items-start lg:gap-10 sm:grid-cols-2 lg:grid-cols-3 <?= $index == 0 ? 'grid' : 'hidden' ?>">
                    <div class="min-w-0 flex-1 space-y-8 col-span-1 lg:col-span-2">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <!-- Full Name -->
                            <div class="col-span-full">
                                <?= form_label('Full Name', "full_name-{$index}", ['class' => 'mb-2 block text-sm font-medium text-gray-900 dark:text-white']); ?>
                                <div class="mt-2">
                                    <?= form_input(
                                        "full_name[$index]",
                                        set_value("full_name[$index]"),
                                        [
                                            'id' => "full_name-{$index}",
                                            'class' => 'block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500'
                                        ]
                                    ); ?>
                                </div>
                            </div>

                            <!-- Email -->
                            <div>
                                <?= form_label('Email', "email-{$index}", ['class' => 'mb-2 block text-sm font-medium text-gray-900 dark:text-white']); ?>
                                <div class="mt-2">
                                    <?= form_input(
                                        "email[$index]",
                                        set_value("email[$index]"),
                                        [
                                            'id' => "email-{$index}",
                                            'class' => 'block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500'
                                        ]
                                    ); ?>
                                </div>
                            </div>

                            <!-- Phone Number -->
                            <div>
                                <?= form_label('Phone Number', "phone_number-{$index}", ['class' => 'mb-2 block text-sm font-medium text-gray-900 dark:text-white']); ?>
                                <div class="mt-2">
                                    <?= form_input(
                                        "phone_number[$index]",
                                        set_value("phone_number[$index]"),
                                        [
                                            'id' => "phone_number-{$index}",
                                            'class' => 'block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500'
                                        ]
                                    ); ?>
                                </div>
                            </div>

                            <!-- Identity Type -->
                            <div>
                                <div class="mb-2 flex items-center gap-2">
                                    <?= form_label('Identity Type', "identity_type-{$index}", ['class' => 'block text-sm font-medium text-gray-900 dark:text-white']); ?>
                                </div>
                                <?= form_dropdown("identity_type[$index]", [
                                    'ktp' => 'KTP',
                                    'sim' => 'SIM',
                                    'paspor' => 'Paspor'
                                ], set_value('identity_type'), [
                                    'id' => "identity_type-{$index}",
                                    'class' => 'block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500'
                                ]) ?>
                            </div>

                            <!-- Identity Number -->
                            <div>
                                <?= form_label('Identity Number', "identity_number-{$index}", ['class' => 'mb-2 block text-sm font-medium text-gray-900 dark:text-white']); ?>
                                <div class="mt-2">
                                    <?= form_input(
                                        "identity_number[$index]",
                                        set_value("identity_number[$index]"),
                                        [
                                            'id' => "identity_number-{$index}",
                                            'class' => 'block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500'
                                        ]
                                    ); ?>
                                </div>
                            </div>

                            <!-- Extra Service -->
                            <?php $this->load->view('extra-service', [
                                'index' => $index,
                                'services' => $services
                            ]); ?>

                            <!-- Request -->
                            <div class="col-span-full">
                                <?= form_label('Request', "request-{$index}", ['class' => 'block mb-2 text-sm font-medium text-darkblack-700 dark:text-white']); ?>
                                <?= form_textarea([
                                    'name' => "request[$index]",
                                    'id' => "request-{$index}",
                                    'value' => set_value('request'),
                                    'rows' => 2,
                                    'placeholder' => 'Write here...',
                                    'class' => "block p-2.5 w-full text-sm rounded-lg border border-gray-300 bg-gray-50  text-sm dark:border-gray-600 dark:bg-gray-700 focus:outline focus:outline-2 focus:-outline-offset-2 text-darkblack-700 dark:text-white"
                                ]); ?>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 space-y-6 sm:mt-8 lg:mt-0 w-full">
                        <div class="flow-root">
                            <div class="-my-3 divide-y divide-gray-200 dark:divide-gray-800">
                                <dl class="flex items-center justify-between gap-4 py-3">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Room Type</dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white capitalize"><?= $room->room_type; ?></dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4 py-3">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Quantity Room</dt>
                                    <dd class="text-base font-medium text-green-500"><?= $room->quantity; ?></dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4 py-3">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Price / Night</dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">Rp <?= number_format($room->price) ?></dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4 py-3">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Room Price</dt>
                                    <dd id="room-price-<?= $index ?>"
                                        data-room-price="<?= $room->quantity * $room->price ?>" class="text-base font-medium text-gray-900 dark:text-white">
                                        Rp <?= number_format($room->quantity * $room->price) ?>
                                    </dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4 py-3">
                                    <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                                    <dd id="total-price-<?= $index ?>" class="text-base font-bold text-green-500"></dd>
                                </dl>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <button type="submit" class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Proceed to Payment</button>

                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">One or more items in your cart require an account. <a href="#" title="" class="font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">Sign in or create an account now.</a>.</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Payment -->
            <div id="tab-payment" class="hidden">
                <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                    <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                        <div class="space-y-6">
                            <?php foreach ($rooms as $room):; ?>
                                <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                                    <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                        <div class="flex items-center justify-between gap-x-10 md:order-3 md:justify-end">
                                            <div class="flex items-center">
                                                <p class="w-10 shrink-0 border rounded bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white">
                                                    <?= $room->quantity; ?>
                                                </p>
                                            </div>
                                            <div class="text-end md:order-4 md:w-fit">
                                                <p class="text-base font-bold text-gray-900 dark:text-white">Rp <?= number_format($room->price); ?> / Night</p>
                                            </div>
                                        </div>

                                        <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                            <h4 class="text-base font-medium text-gray-900 dark:text-white"><?= $room->room_type; ?></h4>

                                            <div class="flex items-center gap-4 text-darkblack-700 dark:text-white">
                                                <p><?= date('d M Y', strtotime($room->check_in)); ?></p>
                                                <p>To</p>
                                                <p><?= date('d M Y', strtotime($room->check_out)); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="mt-6 w-full space-y-6 sm:mt-8 lg:mt-0 lg:max-w-xs xl:max-w-md">
                        <div class="flow-root">
                            <div class="-my-3 divide-y divide-gray-200 dark:divide-gray-800">
                                <dl class="flex items-center justify-between gap-4 py-3">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Room Type</dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white capitalize"><?= $room->room_type; ?></dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4 py-3">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Quantity Room</dt>
                                    <dd class="text-base font-medium text-green-500"><?= $room->quantity; ?></dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4 py-3">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Price / Night</dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">Rp <?= number_format($room->price) ?></dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4 py-3">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Total Room Price</dt>
                                    <dd id="total_room_price-<?= $index ?>" class="text-base font-medium text-gray-900 dark:text-white">
                                        Rp <?= number_format($room->quantity * $room->price) ?></dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4 py-3">
                                    <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                                    <dd class="text-base font-bold text-gray-900 dark:text-white">$8,392.00</dd>
                                </dl>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <button type="submit" class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Proceed to Payment</button>

                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">One or more items in your cart require an account. <a href="#" title="" class="font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">Sign in or create an account now.</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</section>

<?php $this->load->view('templates/bottom-layout'); ?>
