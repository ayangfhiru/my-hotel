<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/header');
?>

<?= form_open(site_url("guest/hotel/$hotelId/room/$roomId/reservation/store")); ?>
<?= form_hidden('check_in', $checkIn); ?>
<?= form_hidden('check_out', $checkOut); ?>
<div class="py-7 grid sm:grid-cols-2">
    <div class="w-full px-3 py-5">
        <h2 class="text-base/7 font-semibold text-gray-900">Personal Information</h2>
        <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
            <div class="sm:col-span-full">
                <?= form_label('Full Name', 'full_name', ['class' => 'block text-sm/6 font-medium text-gray-900']); ?>
                <div class="mt-2">
                    <?= form_input('full_name', '', [
                        'id' => 'full_name',
                        'class' => 'block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6'
                    ]); ?>
                </div>
            </div>

            <div class="sm:col-span-3">
                <?= form_label('Email', 'email', ['class' => 'block text-sm/6 font-medium text-gray-900']); ?>
                <div class="mt-2">
                    <?= form_input([
                        'name' => 'email',
                        'id' => 'email',
                        'type' => 'email',
                        'value' => set_value('email'),
                        'class' => 'block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6'
                    ]); ?>
                </div>
            </div>

            <div class="sm:col-span-3">
                <?= form_label('Phone Number', 'phone_number', ['class' => 'block text-sm/6 font-medium text-gray-900']); ?>
                <div class="mt-2">
                    <?= form_input([
                        'name' => 'phone_number',
                        'id' => 'phone_number',
                        'type' => 'number',
                        'value' => set_value('phone_number'),
                        'class' => 'block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6'
                    ]); ?>
                </div>
            </div>

            <div class="sm:col-span-3">
                <?= form_label('Identity Type', 'identity_type', ['class' => 'block text-sm/6 font-medium text-gray-900']); ?>
                <div class="mt-2 grid grid-cols-1">
                    <?= form_dropdown('identity_type', [
                        'ktp' => 'KTP',
                        'sim' => 'SIM',
                        'paspor' => 'Paspor'
                    ], set_value('identity_type'), [
                        'id' => 'identity_type',
                        'class' => 'col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pl-3 pr-8 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6'
                    ]) ?>
                    <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                        <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>

            <div class="sm:col-span-3">
                <?= form_label('Identity Number', 'identity_number', ['class' => 'block text-sm/6 font-medium text-gray-900']); ?>
                <div class="mt-2">
                    <?= form_input([
                        'name' => 'identity_number',
                        'id' => 'identity_number',
                        'type' => 'number',
                        'value' => set_value('identity_number'),
                        'class' => 'block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6'
                    ]); ?>
                </div>
            </div>

            <div class="col-span-full grid grid-cols-2 gap-x-5">
                <div class="flex items-center ps-4 border border-gray-300 rounded">
                    <input id="cash" type="radio" value="transfer" name="payment_method" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                    <label for="cash" class="w-full py-4 ms-2 text-sm font-medium text-gray-900">Transfer</label>
                </div>
                <div class="flex items-center ps-4 border border-gray-300 rounded">
                    <input checked id="transfer" type="radio" value="transfer" name="payment_method" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                    <label for="transfer" class="w-full py-4 ms-2 text-sm font-medium text-gray-900">Transfer</label>
                </div>
            </div>

            <div class="border-b border-slate-200 col-span-full">
                <button onclick="toggleAccordion(1)" class="w-full flex justify-between items-center py-5 text-slate-800">
                    <span>Tambah Services</span>
                    <span id="icon-1" class="text-slate-800 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                            <path d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
                        </svg>
                    </span>
                </button>
                <div id="content-1" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                    <div class="text-sm text-slate-500">
                        <ul class="text-sm font-medium text-gray-900 bg-white rounded-lg px-2">
                            <?php foreach ($services as $ser): ?>
                                <?php
                                $serviceId = $ser->service_id;
                                $serviceName = $ser->service_name;
                                $servicePrice = number_format($ser->service_price);
                                ?>
                                <li id="<?= "li-{$serviceId}" ?>" class="w-full rounded-lg mb-3">
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center">
                                            <?= form_checkbox([
                                                'name' => 'services[]',
                                                'id' => "service-{$serviceId}",
                                                'value' => $serviceId,
                                                'checked' => set_value('services[]') ? true : false,
                                                'data-service-price' => $ser->service_price,
                                                'class' => 'w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-0'
                                            ]) ?>
                                            <span class="flex gap-x-2 items-center">
                                                <?= form_label($serviceName, "service-{$serviceId}", ['class' => 'text-sm font-medium text-gray-900 ms-3 cursor-pointer']) ?>
                                                <p class="text-sm text-red-500"><?= $ser->description; ?></p>
                                            </span>
                                        </div>
                                        <div class="flex gap-x-3 items-center">
                                            <span>
                                                IDR <?= $servicePrice ?>
                                            </span>
                                            <?= form_input([
                                                'id' => "quantity-$serviceId",
                                                'type' => 'number',
                                                'name' => 'quantity[]',
                                                'min' => 1,
                                                'class' => 'w-14 border px-1 py-1 border-gray-300 rounded text-xs text-center',
                                                'disabled' => 'disabled'
                                            ]) ?>
                                        </div>
                                    </div>
                                    <?= form_input('note[]', '', [
                                        'id' => "note-$serviceId",
                                        'class' => 'block w-full p-2 text-gray-900 border border-gray-300 rounded text-xs',
                                        'placeholder' => "Note $serviceName",
                                        'disabled' => 'disabled'
                                    ]) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-span-full">
                <?= form_label('Request', 'request', ['class' => 'block mb-2 text-sm font-medium text-gray-900']); ?>
                <?= form_textarea([
                    'name' => 'request',
                    'id' => 'request',
                    'value' => set_value('request'),
                    'rows' => 2,
                    'placeholder' => 'Write here...',
                    'class' => 'block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600'
                ]); ?>
            </div>
        </div>
    </div>
    <div class="flex flex-col gap-y-3">
        <div class="w-full h-40 bg-gray-200 rounded-md overflow-hidden flex gap-x-5">
            <img src="<?= site_url('assets/thumbnail/default.jpg') ?>" alt="X" class="h-40 w-32 inline-block">
            <div class="py-3">
                <h1 class="text-3xl font-semibold"><?= $room->room_type; ?></h1>
                <div class="grid grid-cols-2 grid-rows-2">
                    <p class="font-semibold">Check In</p>
                    <p class="text-lg font-semibold"><?= date('d M Y', strtotime($checkIn)); ?></p>
                    <p class="font-semibold">Check Out</p>
                    <p class="text-lg font-semibold"><?= date('d M Y', strtotime($checkOut)); ?></p>
                </div>
                <h3 class="mt-5 text-xl font-semibold">IDR <?= number_format($room->price); ?> / <span class="text-sm">Malam</span></h3>
            </div>
        </div>
        <div class="mt-10 flex items-center justify-between px-5">
            <h1 class="">Subtotal</h1>
            <?= form_input('amount', number_format($amount), [
                'id' => 'amount',
                'data-amount' => $amount,
                'class' => 'inline-block w-auto bg-transparent border-none text-lg focus:outline-none text-right',
                'readonly' => ''
            ]); ?>
        </div>
        <button class="bg-blue-400 py-2 text-white rounded shadow">Bayar</button>
    </div>
</div>
<?= form_close(); ?>

<?php $this->load->view('templates/footer'); ?>
