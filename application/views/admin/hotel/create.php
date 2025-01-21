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
            <?= form_open_multipart(site_url('hotel/store')); ?>
            <div class="mb-3 row">
                <div class="col">
                    <?= form_label('Nama Hotel', 'name', ['class' => 'form-label']); ?>
                    <?= form_input('name', set_value('name'), [
                        'id' => 'name',
                        'class' => 'form-control'
                    ]); ?>
                    <?= form_error('name', '<span class="text-danger ml-2">', '</span>') ?>
                </div>
                <div class="col">
                    <?= form_label('Kota', 'city', ['class' => 'form-label']); ?>
                    <?= form_input('city', set_value('city'), [
                        'id' => 'city',
                        'class' => 'form-control'
                    ]); ?>
                    <?= form_error('city', '<span class="text-danger ml-2">', '</span>') ?>
                </div>
            </div>
            <div class="mb-3">
                <?= form_label('Alamat', 'address', ['class' => 'form-label']); ?>
                <?= form_input('address', set_value('address'), [
                    'id' => 'address',
                    'class' => 'form-control'
                ]); ?>
                <?= form_error('address', '<span class="text-danger ml-2">', '</span>') ?>
            </div>
            <div class="form-floating mb-3">
                <?= form_label('Deskripsi', 'description', ['class' => 'form-label']); ?>
                <?= form_textarea('description', '', [
                    'id' => 'description',
                    'class' => 'form-control'
                ]); ?>
            </div>
            <div class="col-5 custom-file mb-3">
                <?= form_label('Pilih Thumbnail', 'thumbnail', ['class' => 'custom-file-label']); ?>
                <?= form_upload('thumbnail', '', [
                    'id' => 'thumbnail',
                    'class' => 'custom-file-input'
                ]) ?>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary mb-3">Tambah Hotel</button>
            </div>
            <?= form_close(); ?>
        </div>
    </section>
</div>
<?php $this->load->view('admin/_partials/footer'); ?>
