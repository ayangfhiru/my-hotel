<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<!-- Main Content -->
<div class="main-content" x-data="{checkIn:null, checkOut:null}">
    <section class="section">
        <div class="section-header">
            <div class="d-flex align-items-center">
                <a href="<?= site_url("hotel") ?>" class="mr-3">
                    <i class="fa-solid fa-arrow-left fa-2xl"></i>
                </a>
                <h1>List Kamar</h1>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Layout</a></div>
                <div class="breadcrumb-item">Default Layout</div>
            </div>
        </div>

        <div class="section-body">
            <div class="d-flex mb-5">
                <?= form_open(site_url("hotel/$hotelId/room/search")); ?>
                <div class="flex items-end">
                    <div class="col">
                        <?= form_label('Check In', 'check_in', ['class' => 'form-label']); ?>
                        <?= form_input([
                            'name' => 'check_in',
                            'id' => 'check_in',
                            'type' => 'date',
                            'value' => set_value('check_in'),
                            'class' => 'form-control'
                        ]); ?>
                        <?= form_error('check_in', '<span class="text-danger ml-2">', '</span>') ?>
                    </div>
                    <div class="col">
                        <?= form_label('Check Out', 'check_out', ['class' => 'form-label']); ?>
                        <?= form_input([
                            'name' => 'check_out',
                            'id' => 'check_out',
                            'type' => 'date',
                            'value' => set_value('check_out'),
                            'class' => 'form-control'
                        ]); ?>
                        <?= form_error('check_out', '<span class="text-danger ml-2">', '</span>') ?>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success">Search Room</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
            <div class="grid grid-cols-4 gap-10">
                <?php foreach ($rooms as $room): ?>
                    <a href="<?= site_url("hotel/$hotelId/room/$room->room_id/reservation") ?>?check_in=<?= set_value('check_in') ?>&check_out=<?= set_value('check_out') ?>" class="no-underline">
                        <div class="w-full max-w-sm p-4 bg-gray-100 border border-gray-200 rounded-lg sm:p-8 cursor-pointer hover:shadow-lg">
                            <h5 class="mb-3 text-xl font-medium text-gray-500 no-underline"><?= $room->room_type; ?></h5>
                            <div class="flex flex-col mb-2">
                                <span><i class="fa-solid fa-user"></i> <?= $room->capacity; ?></span>
                                <span><i class="fa-solid fa-bed"></i> <?= $room->bed_type; ?></span>
                            </div>
                            <div class="flex items-baseline text-gray-900">
                                <span class="text-lg font-semibold mr-1">IDR</span>
                                <span class="text-xl font-extrabold tracking-tight"><?= number_format($room->price); ?></span>
                            </div>
                            <ul role="list" class="space-y-5 my-7">
                                <?php foreach ($facilities as $facility): ?>
                                    <?php if ($facility->room_id === $room->room_id): ?>
                                        <li class="flex items-center">
                                            <svg class="flex-shrink-0 w-4 h-4 text-blue-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                            </svg>
                                            <span class="text-base font-normal leading-tight text-gray-500 ms-3"><?= $facility->facility_name; ?></span>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('admin/_partials/footer'); ?>
