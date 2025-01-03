<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Update Hotel</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Layout</a></div>
                <div class="breadcrumb-item">Default Layout</div>
            </div>
        </div>

        <div class="section-body">
            <form action="<?= site_url("hotel/$hotel->hotel_id/update") ?>" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Hotel</label>
                    <input type="text" id="name" name="name" value="<?= $hotel->name ?>" class="form-control">
                    <?= form_error('name', '<span class="text-danger ml-2">', '</span>') ?>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <input type="text" id="address" name="address" value="<?= $hotel->address ?>" class="form-control">
                    <?= form_error('address', '<span class="text-danger ml-2">', '</span>') ?>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="info_check_in" class="form-label">Check In</label>
                        <input type="time" id="info_check_in" name="info_check_in" value="<?= $hotel->info_check_in ?>" class="form-control">
                    </div>
                    <div class="col">
                        <label for="info_check_out" class="form-label">Check Out</label>
                        <input type="time" id="info_check_out" name="info_check_out" value="<?= $hotel->info_check_out ?>" class="form-control">
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Deskripsi Hotel" style="height: 100px"><?= $hotel->description ?></textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-warning mb-3">Update Hotel</button>
                </div>
            </form>
        </div>
    </section>
</div>
<?php $this->load->view('admin/_partials/footer'); ?>
