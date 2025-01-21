<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="d-flex align-items-center">
                <a href="<?= site_url("hotel/$hotel->hotel_id/update") ?>" class="mr-3">
                    <i class="fa-solid fa-arrow-left fa-2xl"></i>
                </a>
                <h1>Update Hotel</h1>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Layout</a></div>
                <div class="breadcrumb-item">Default Layout</div>
            </div>
        </div>

        <div class="section-body">
            <?= form_open_multipart(site_url("hotel/$hotel->hotel_id/update")); ?>
            <div class="mb-3 row">
                <div class="col">
                    <?= form_label('Nama Hotel', 'name', ['class' => 'form-label']); ?>
                    <?= form_input('name', set_value('name', $hotel->name), [
                        'id' => 'name',
                        'class' => 'form-control'
                    ]); ?>
                    <?= form_error('name', '<span class="text-danger ml-2">', '</span>') ?>
                </div>
                <div class="col">
                    <?= form_label('Kota', 'city', ['class' => 'form-label']); ?>
                    <?= form_input('city', set_value('city', $hotel->city), [
                        'id' => 'city',
                        'class' => 'form-control'
                    ]); ?>
                    <?= form_error('city', '<span class="text-danger ml-2">', '</span>') ?>
                </div>
            </div>
            <div class="mb-3">
                <?= form_label('Alamat', 'address', ['class' => 'form-label']); ?>
                <?= form_input('address', set_value('address', $hotel->address), [
                    'id' => 'address',
                    'class' => 'form-control'
                ]); ?>
                <?= form_error('address', '<span class="text-danger ml-2">', '</span>') ?>
            </div>
            <div class="form-floating mb-3">
                <?= form_label('Deskripsi', 'description'); ?>
                <?= form_textarea([
                    'name' => 'description',
                    'id' => 'description',
                    'class' => 'form-control',
                    'rows' => '7',
                    'value' => set_value('description', $hotel->description)
                ]); ?>
            </div>
            <div class="col-5 custom-file mb-3">
                <?= form_label('Pilih Thumbnail', 'thumbnail', ['class' => 'custom-file-label']); ?>
                <?= form_upload('thumbnail', '', ['class' => 'custom-file-input', 'id' => 'thumbnail']); ?>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary mb-3">Update Hotel</button>
            </div>
            <?= form_close(); ?>
        </div>
    </section>
</div>
<?php $this->load->view('admin/_partials/footer'); ?>
