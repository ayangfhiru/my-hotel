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
            <form action="<?= site_url("hotel/$hotelId/room/$roomId/update") ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3 form-row">
                    <div class="col">
                        <label for="room_type" class="form-label">Tipe Kamar</label>
                        <input type="text" id="room_type" name="room_type" value="<?= $room->room_type ?>" class="form-control">
                        <?= form_error('room_type', '<span class="text-danger ml-2">', '</span>') ?>
                    </div>
                    <div class="col">
                        <label for="bed_id" class="form-label">Pilih Tipe Kasur</label>
                        <select name="bed_id" id="bed_id" class="form-control">
                            <option value="" selected>Tipe Kasur</option>
                            <?php foreach ($beds as $bed):; ?>
                                <option
                                    value="<?= $bed->bed_id ?>"
                                    <?= ($room->bed_id == $bed->bed_id) ? 'selected' : '' ?>>
                                    <?= $bed->bed_name ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('bed_id', '<span class="text-danger ml-2">', '</span>') ?>
                    </div>
                </div>
                <div class="mb-3 form-row">
                    <div class="col">
                        <label for="capacity" class="form-label">Kapasitas</label>
                        <input type="number" id="capacity" name="capacity" value="<?= $room->capacity ?>" class="form-control">
                        <?= form_error('capacity', '<span class="text-danger ml-2">', '</span>') ?>
                    </div>
                    <div class="col">
                        <label for="price" class="form-label">Harga Kamar</label>
                        <input type="number" id="price" name="price" value="<?= $room->price ?>" class="form-control">
                        <?= form_error('price', '<span class="text-danger ml-2">', '</span>') ?>
                    </div>
                </div>
                <div class="mb-3">
                    <h1>Fasilitas Kamar</h1>
                    <div class="row ml-3">
                        <?php foreach ($facility as $fac) { ?>
                            <div class="col-3 form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="<?= $fac->facility_name ?>"
                                    name="facility_ids[]"
                                    value="<?= $fac->facility_id ?>"
                                    <?= !empty($fac->room_id) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="<?= $fac->facility_name ?>">
                                    <?= $fac->facility_name ?>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="mb-3">
                    <h1>Tambah Foto</h1>
                    <div class="row ml-3 gap-0">
                        <?php for ($i = 1; $i <= 4; $i++): ?>
                            <div class="col-5 custom-file ml-3 mt-1">
                                <input type="file" class="custom-file-input" id="customFile" name="<?= "picture-$i" ?>">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary mb-3">Update Hotel</button>
                </div>
            </form>
        </div>
    </section>
</div>
<?php $this->load->view('admin/_partials/footer'); ?>
