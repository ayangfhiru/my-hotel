<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/top-layout-admin');
?>

<div
    class="rounded-lg bg-white px-6 py-8 dark:bg-darkblack-600">
    <div class="justify-between gap-12 2xl:flex">
        <!-- Form -->
        <?= form_open("booking/booking/storeBooking"); ?>
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <?= form_label('Booking Code', 'booking_code', ['class' => 'text-basse mb-2 block font-medium text-bgray-600 dark:text-bgray-50']) ?>
                <?= form_input('booking_code', $bookingCode, ['class' => 'w-full rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white read', 'readonly' => '']) ?>
            </div>
            <div>
                <?= form_label('Full Name', 'full_name', ['class' => 'text-basse mb-2 block font-medium text-bgray-600 dark:text-bgray-50']) ?>
                <?= form_input('full_name', set_value('full_name'), ['class' => 'w-full rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white']) ?>
            </div>
            <div>
                <?= form_label('Email', 'email', ['class' => 'text-basse mb-2 block font-medium text-bgray-600 dark:text-bgray-50']) ?>
                <?= form_input('email', set_value('email'), ['class' => 'w-full rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white']) ?>
            </div>
            <div>
                <?= form_label('Phone Number (Optional)', 'phone_number', ['class' => 'text-basse mb-2 block font-medium text-bgray-600 dark:text-bgray-50']) ?>
                <?= form_input('phone_number', set_value('phone_number'), ['class' => 'w-full rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white']) ?>
            </div>
            <div>
                <?= form_label('Check In', 'check_in', ['class' => 'text-basse mb-2 block font-medium text-bgray-600 dark:text-bgray-50']) ?>
                <?= form_input([
                    'name' => 'check_in',
                    'id' => 'check_in',
                    'value' => set_value('check_in'),
                    'type' => 'date',
                    'class' => 'w-full rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white'
                ]) ?>
            </div>
            <div>
                <?= form_label('Check Out', 'check_out', ['class' => 'text-basse mb-2 block font-medium text-bgray-600 dark:text-bgray-50']) ?>
                <?= form_input([
                    'name' => 'check_out',
                    'id' => 'check_out',
                    'value' => set_value('check_out'),
                    'type' => 'date',
                    'class' => 'w-full rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white'
                ]) ?>
            </div>
            <div>
                <?= form_label('Identity Type', 'identity_type', ['class' => 'text-basse mb-2 block font-medium text-bgray-600 dark:text-bgray-50']) ?>
                <?= form_dropdown(
                    'identity_type',
                    ['' => '', 'ktp' => 'KTP', 'sim' => 'SIM', 'kartu_pelajar' => 'Kartu Pelajar'],
                    set_value('identity_type'),
                    ['id' => 'identity_type', 'class' => 'w-full rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white']
                ) ?>
            </div>
            <div>
                <?= form_label('Identity Number', 'identity_number', ['class' => 'text-basse mb-2 block font-medium text-bgray-600 dark:text-bgray-50']) ?>
                <?= form_input('identity_number', set_value('identity_number'), ['type' => 'number', 'id' => 'identity_number', 'class' => 'w-full rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white']) ?>
            </div>
            <div class="col-span-full">
                <?= form_label('Room Code', 'room_code', ['class' => 'mb-2 block text-base font-semibold dark:text-white']) ?>
                <?= form_dropdown('room_code', [], set_value('room_code'), ['id' => 'room_code', 'class' => 'w-full rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white']) ?>
            </div>
        </div>
        <div class="custom-quill mb-6 mt-6">
            <label for=""
                class="mb-2 block text-base font-semibold dark:text-white">Request</label>
            <div class="h-32 rounded-b-lg" id="editor"></div>
            <input type="hidden" name="request" id="data-description">
        </div>
        <div class="flex justify-end">
            <button id="submit-button"
                class="rounded-lg bg-success-300 px-12 py-3.5 font-semibold text-white transition-all hover:bg-success-400">
                Booking
            </button>
        </div>
        <?= form_close(); ?>
    </div>
</div>

<?php
$this->load->view('templates/bottom-layout-admin');
?>
