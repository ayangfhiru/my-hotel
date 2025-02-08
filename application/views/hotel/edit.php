<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/top-layout-admin');
?>

<div
    class="rounded-lg bg-white px-6 py-8 dark:bg-darkblack-600">
    <div class="justify-between gap-12 2xl:flex">
        <!-- Form -->
        <?= form_open("hotel/$hotel->hotel_id/update", [
            'id' => 'hotel-form-edit'
        ]) ?>
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <?= form_label('Hotel Name', 'hotel_name', [
                    'class' => 'text-basse mb-2 block font-medium text-bgray-600 dark:text-bgray-50'
                ]); ?>
                <?= form_input('name', set_value('name', $hotel->name), [
                    'id' => 'hotel_name',
                    'class' => 'w-full rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white'
                ]); ?>
            </div>
            <div>
                <?= form_label('City', 'city', [
                    'class' => 'text-basse mb-2 block font-medium text-bgray-600 dark:text-bgray-50'
                ]); ?>
                <?= form_input('city', set_value('city', $hotel->city), [
                    'id' => 'city',
                    'class' => 'w-full rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white'
                ]); ?>
            </div>
            <div>
                <?= form_label('Address', 'address', [
                    'class' => 'text-basse mb-2 block font-medium text-bgray-600 dark:text-bgray-50'
                ]); ?>
                <?= form_input('address', set_value('address', $hotel->address), [
                    'id' => 'address',
                    'class' => 'w-full rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white'
                ]); ?>
            </div>
            <div>
                <?= form_label('Telepone', 'telepone', [
                    'class' => 'text-basse mb-2 block font-medium text-bgray-600 dark:text-bgray-50'
                ]); ?>
                <?= form_input('telepon', set_value('telepon', $hotel->telepon), [
                    'id' => 'telepon',
                    'class' => 'w-full rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white'
                ]); ?>
            </div>
        </div>
        <div class="mb-6 mt-6">
            <div>
                <?= form_label('Upload Thumbnail', "thumbnail", [
                    'class' => 'text-basse mb-2 block font-medium text-bgray-600 dark:text-bgray-50'
                ]); ?>
                <?= form_upload("thumbnail", '', [
                    'id' => "thumbnail",
                    'class' => 'block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400'
                ]); ?>
            </div>
        </div>
        <div class="custom-quill mb-6 mt-10">
            <label for="editor"
                class="mb-2 block text-base font-semibold text-white dark:text-white">Description</label>
            <div class="h-60 rounded-b-lg" id="editor">
                <p>
                    <?= $hotel->description; ?>
                </p>
            </div>
            <input type="hidden" name="description" id="data-description">
        </div>
        <div class="flex justify-end">
            <button type="button" id="submit-button"
                class="rounded-lg bg-success-300 px-12 py-3.5 font-semibold text-white transition-all hover:bg-success-400">
                Update Hotel
            </button>
        </div>
        <?= form_close(); ?>
    </div>
</div>

<?php $this->load->view('templates/bottom-layout-admin'); ?>
