<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="d-flex align-items-center">
                <a href="<?= site_url("hotel/$hotelId/room") ?>" class="mr-3">
                    <i class="fa-solid fa-arrow-left fa-2xl"></i>
                </a>
                <h1>Update Kamar</h1>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Layout</a></div>
                <div class="breadcrumb-item">Default Layout</div>
            </div>
        </div>

        <div class="section-body">
            <?= form_open_multipart(site_url("hotel/$hotelId/room/$roomId/update")); ?>
            <div class="mb-3 form-row">
                <div class="col">
                    <?= form_label('Tipe Kamar', 'room_type', ['class' => 'form-label']); ?>
                    <?= form_input('room_type', $room->room_type, [
                        'id' => 'room_type',
                        'class' => 'form-control'
                    ]); ?>
                    <?= form_error('room_type', '<span class="text-danger ml-2">', '</span>') ?>
                </div>
                <div class="col">
                    <?= form_label('Pilih Tipe Kasur', 'bed_id', ['class' => 'form-label']); ?>
                    <?= form_dropdown(
                        'bed_id',
                        array_column($beds, 'bed_type', 'bed_id'),
                        $room->bed_id,
                        ['class' => 'form-control']
                    ); ?>
                    <?= form_error('bed_id', '<span class="text-danger ml-2">', '</span>') ?>
                </div>
            </div>
            <div class="mb-3 form-row">
                <div class="col">
                    <?= form_label('Kapasitas', 'capacity', ['class' => 'form-label']); ?>
                    <?= form_input('capacity', $room->capacity, [
                        'id' => 'capacity',
                        'class' => 'form-control'
                    ]); ?>
                    <?= form_error('capacity', '<span class="text-danger ml-2">', '</span>') ?>
                </div>
                <div class="col">
                    <?= form_label('Harga Kamar', 'capacity', ['class' => 'form-label']); ?>
                    <?= form_input([
                        'name' => 'price',
                        'id' => 'price',
                        'value' => $room->price,
                        'type' => 'number',
                        'class' => 'form-control'
                    ]); ?>
                    <?= form_error('price', '<span class="text-danger ml-2">', '</span>') ?>
                </div>
            </div>
            <div class="mb-3">
                <h1>Fasilitas Kamar</h1>
                <div class="row ml-3">
                    <?php foreach ($facility as $fac) { ?>
                        <div class="col-3 form-check">
                            <?= form_checkbox('facility_ids[]', $fac->facility_id, !empty($fac->room_id), [
                                'id' => $fac->facility_name,
                                'class' => 'form-check-input'
                            ]); ?>
                            <?= form_label($fac->facility_name, $fac->facility_name, ['class' => 'form-check-label']); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="mb-3">
                <h1>Tambah Foto</h1>
                <div class="row ml-3 gap-0">
                    <?php for ($i = 1; $i <= 4; $i++): ?>
                        <div class="col-5 custom-file ml-3 mt-1">
                            <?= form_upload("picture-$i", '', [
                                'id' => 'customFile',
                                'class' => 'custom-file-input'
                            ]); ?>
                            <?= form_label('Choose file', 'customFile', ['class' => 'custom-file-label']); ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary mb-3">Update Hotel</button>
            </div>
            <?= form_close(); ?>
        </div>
    </section>
</div>
<?php $this->load->view('admin/_partials/footer'); ?>
