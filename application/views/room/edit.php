<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/top-layout-admin');
?>

<div class="flex grid-cols-12 flex-col-reverse gap-5 lg:grid">
    <!-- Left column -->
    <div class="col-span-8 2xl:col-span-9">
        <div class="rounded-lg bg-white px-6 py-8 dark:bg-darkblack-600">
            <div class="justify-between gap-12 2xl:flex">
                <!-- Form -->
                <?= form_open_multipart(site_url("hotel/$hotelId/room/$room->room_id/update")); ?>
                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <?= form_label('Room Type', 'room_type', [
                            'class' => 'text-basse mb-2 block font-medium text-bgray-600 dark:text-bgray-50'
                        ]); ?>
                        <?= form_input('room_type', set_value('room_type', $room->room_type), [
                            'id' => 'room_type',
                            'class' => 'w-full rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white',
                            'placeholder' => 'Enter room type'
                        ]); ?>
                    </div>
                    <div>
                        <?= form_label('Capacity', 'capacity', [
                            'class' => 'text-basse mb-2 block font-medium text-bgray-600 dark:text-bgray-50'
                        ]); ?>
                        <?= form_input('capacity', set_value('capacity', $room->capacity), [
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
                            'type' => 'text',
                            'value' => set_value('price', round($room->price)),
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
                                        class="switch-btn relative inline-flex h-5 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent text-center transition-colors duration-200 ease-in-out focus:outline-none <?= !empty($facility->room_id) ? 'active' : '' ?>"
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
                                    <?= form_checkbox(
                                        'facility_ids[]',
                                        $facility->facility_id,
                                        !empty($facility->room_id),
                                        [
                                            'class' => 'facility-checkbox',
                                            'data-facility-id' => $facility->facility_id,
                                            'style' => 'display:none',
                                        ]
                                    ); ?>
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
                <div class="relative mt-8 flex justify-center">
                    <button type="submit" class="modal-open rounded-lg bg-success-300 px-7 py-3 font-medium text-white transition duration-300 ease-in-out cursor-pointer hover:bg-success-400">
                        Save
                    </button>
                    <button type="button"
                        data-modal-target="modalDeleteRoom"
                        data-modal-toggle="modalDeleteRoom"
                        class="absolute right-0 modal-open rounded-lg bg-red-600 px-7 py-3 font-medium text-white transition duration-300 ease-in-out cursor-pointer hover:bg-red-800">
                        Delete
                    </button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>

    <!-- Right column -->
    <div class="col-span-4 w-full space-y-10 2xl:col-span-3">
        <div
            class="divide-y divide-bgray-300 rounded-lg bg-white p-8 dark:divide-darkblack-400 dark:border-darkblack-400 dark:bg-darkblack-600">
            <!-- Contact Info -->
            <div class="py-6">
                <div class="mb-4 flex items-center justify-between">
                    <h4
                        class="text-base font-bold text-bgray-900 dark:text-white">
                        List Room Code
                    </h4>
                    <button
                        type="button"
                        data-modal-target="modalAddRoomCode"
                        data-modal-toggle="modalAddRoomCode"
                        class="flex h-[36px] w-[36px] items-center justify-center rounded-full bg-bgray-200">
                        <svg
                            width="14"
                            height="14"
                            viewBox="0 0 14 14"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M7.75 1C7.75 0.585786 7.41421 0.25 7 0.25C6.58579 0.25 6.25 0.585786 6.25 1V6.25H1C0.585786 6.25 0.25 6.58579 0.25 7C0.25 7.41421 0.585786 7.75 1 7.75H6.25V13C6.25 13.4142 6.58579 13.75 7 13.75C7.41421 13.75 7.75 13.4142 7.75 13V7.75H13C13.4142 7.75 13.75 7.41421 13.75 7C13.75 6.58579 13.4142 6.25 13 6.25H7.75V1Z"
                                fill="#718096" />
                        </svg>
                    </button>
                </div>
                <div class="flex flex-col py-2.5">
                    <?php foreach ($roomCodes as $code):; ?>
                        <h4 class="text-lg font-bold text-bgray-900 dark:text-white">
                            <?= $code->room_code; ?> | <?= $code->room_status; ?>
                        </h4>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->load->view('room/modal-add-room-code');
$this->load->view('room/modal-delete');
$this->load->view('templates/bottom-layout-admin');
?>
