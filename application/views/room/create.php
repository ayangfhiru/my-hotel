<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/top-layout-admin');
?>

<div
    class="rounded-lg bg-white px-6 py-8 dark:bg-darkblack-600">
    <div class="justify-between gap-12 2xl:flex">
        <!-- Form -->
        <?= form_open_multipart(site_url("hotel/$hotelId/room/store")); ?>
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <?= form_label('Room Type', 'room_type', [
                    'class' => 'text-basse mb-2 block font-medium text-bgray-600 dark:text-bgray-50'
                ]); ?>
                <?= form_input('room_type', set_value('room_type'), [
                    'id' => 'room_type',
                    'class' => 'w-full rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white',
                    'placeholder' => 'Enter room type'
                ]); ?>

            </div>
            <div>
                <?= form_label('Capacity', 'capacity', [
                    'class' => 'text-basse mb-2 block font-medium text-bgray-600 dark:text-bgray-50'
                ]); ?>
                <?= form_input('capacity', set_value('capacity'), [
                    'id' => 'capacity',
                    'class' => 'w-full rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white',
                    'placeholder' => 'Enter capacity'
                ]); ?>
            </div>
            <div>
                <?= form_label('Bed Type', 'bed_type', [
                    'class' => 'text-basse mb-2 block font-medium text-bgray-600 dark:text-bgray-50'
                ]); ?>
                <select name="bed_type" id="bed_type" class="w-full rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white">
                    <?php foreach ($beds as $bed):; ?>
                        <option value="<?= $bed->bed_id ?>">
                            <?= $bed->bed_type; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <?= form_label('Price', 'price', [
                    'class' => 'text-basse mb-2 block font-medium text-bgray-600 dark:text-bgray-50'
                ]); ?>
                <?= form_input([
                    'name' => 'price',
                    'id' => 'price',
                    'type' => 'number',
                    'value' => set_value('price'),
                    'class' => 'w-full rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white',
                    'placeholder' => 'Enter price'
                ]); ?>

            </div>
        </div>
        <div class="mb-6 mt-10">
            <div>
                <h3
                    class="mb-5 text-2xl font-bold text-bgray-900 dark:text-white">
                    Room Facility
                </h3>
                <div class="grid grid-cols-3 gap-x-5 gap-y-5">
                    <?php foreach ($facilities as $facility):; ?>
                        <div
                            class="flex flex-col items-end justify-between border-b border-bgray-300 pb-5 dark:border-darkblack-400 sm:flex-row sm:items-center">
                            <div class="flex items-center gap-x-4">
                                <span class="w-16 h-16 rounded-full bg-[#22C55E] flex items-center justify-center">
                                    <i class="<?= $facility->icon ?> fa-2xl text-bgray-900 dark:text-white"></i>
                                </span>
                                <div class="flex-1">
                                    <h4
                                        class="text-lg font-bold text-bgray-900 dark:text-white"
                                        id="availability-label">
                                        <?= $facility->facility_name; ?>
                                    </h4>
                                </div>
                            </div>

                            <!-- Enabled: "bg-success-300", Not Enabled: "bg-[#9AA2B1]" -->
                            <button
                                type="button"
                                class="switch-btn relative inline-flex h-5 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent text-center transition-colors duration-200 ease-in-out focus:outline-none"
                                role="switch"
                                aria-checked="false"
                                aria-labelledby="availability-label"
                                aria-describedby="availability-description"
                                data-facility-id="<?= $facility->facility_id ?>">
                                <!-- Enabled: " translate-x-5", Not Enabled: "translate-x-0" -->
                                <span
                                    aria-hidden="true"
                                    class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-gray-800 shadow ring-0 transition duration-200 ease-in-out"></span>
                            </button>
                            <input type="checkbox"
                                value="<?= $facility->facility_id ?>"
                                name="facility_ids[]" class="facility-checkbox"
                                data-facility-id="<?= $facility->facility_id ?>"
                                style="display:none">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="mt-8">
                <h3
                    class="mb-5 text-2xl font-bold text-bgray-900 dark:text-white">
                    Room Pictures
                </h3>
                <div class="grid grid-cols-3 gap-x-5 gap-y-5">
                    <?php for ($i = 1; $i <= 4; $i++): ?>
                        <div>
                            <?= form_label('Upload file', "picture-$i", [
                                'class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white'
                            ]); ?>
                            <?= form_upload("picture-$i", '', [
                                'id' => "picture-$i",
                                'class' => 'block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400'
                            ]); ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
        <div class="mt-8 flex justify-center">
            <button type="submit" class="modal-open rounded-lg bg-success-300 px-7 py-3 font-medium text-white transition duration-300 ease-in-out cursor-pointer hover:bg-success-400">
                Save
            </button>
        </div>
        <?= form_close(); ?>
    </div>
</div>

<?php $this->load->view('templates/bottom-layout-admin'); ?>
