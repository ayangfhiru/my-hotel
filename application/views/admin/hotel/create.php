<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Hotel</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Layout</a></div>
                <div class="breadcrumb-item">Default Layout</div>
            </div>
        </div>

        <div class="section-body">
            <form action="<?= site_url('hotel/store') ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3 row">
                    <div class="col">
                        <label for="name" class="form-label">Nama Hotel</label>
                        <input type="text" id="name" name="name" value="<?= set_value('name') ?>" class="form-control">
                        <?= form_error('name', '<span class="text-danger ml-2">', '</span>') ?>
                    </div>
                    <div class="col">
                        <label for="city" class="form-label">Kota</label>
                        <input type="text" id="city" name="city" value="<?= set_value('city') ?>" class="form-control">
                        <?= form_error('city', '<span class="text-danger ml-2">', '</span>') ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <input type="text" id="address" name="address" value="<?= set_value('address') ?>" class="form-control">
                    <?= form_error('address', '<span class="text-danger ml-2">', '</span>') ?>
                </div>
                <div class="form-floating mb-3">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Deskripsi Hotel" style="height: 100px"></textarea>
                </div>
                <div class="col-5 custom-file mb-3">
                    <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
                    <label class="custom-file-label" for="thumbnail" id="label_picture1">Choose file</label>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary mb-3">Tambah Hotel</button>
                </div>
            </form>
        </div>
    </section>
</div>
<?php $this->load->view('admin/_partials/footer'); ?>
