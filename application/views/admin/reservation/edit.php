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
            <?= form_open(site_url("hotel/{$hotel->hotel_id}/update"), ['method' => 'POST']); ?>
            <div class="mb-3">
                <?= form_label('Nama Hotel', 'name', ['class' => 'form-label']); ?>
                <?= form_input('name', set_value('name', $hotel->name), [
                    'id' => 'name',
                    'class' => 'form-control'
                ]); ?>
                <?= form_error('name', '<span class="text-danger ml-2">', '</span>') ?>
            </div>
            <div class="mb-3">
                <?= form_label('Alamat', 'address', ['class' => 'form-label']); ?>
                <?= form_input('address', set_value('address', $hotel->address), [
                    'id' => 'address',
                    'class' => 'form-control'
                ]); ?>
                <?= form_error('address', '<span class="text-danger ml-2">', '</span>') ?>
            </div>
            <div class="mb-3 row">
                <div class="col">
                    <?= form_label('Check In', 'info_check_in', ['class' => 'form-label']); ?>
                    <?= form_input('info_check_in', set_value('info_check_in', $hotel->info_check_in), [
                        'id' => 'info_check_in',
                        'type' => 'time',
                        'class' => 'form-control'
                    ]); ?>
                </div>
                <div class="col">
                    <?= form_label('Check Out', 'info_check_out', ['class' => 'form-label']); ?>
                    <?= form_input('info_check_out', set_value('info_check_out', $hotel->info_check_out), [
                        'id' => 'info_check_out',
                        'type' => 'time',
                        'class' => 'form-control'
                    ]); ?>
                </div>
            </div>
            <div class="form-floating mb-3">
                <?= form_label('Deskripsi', 'description', ['class' => 'form-label']); ?>
                <?= form_textarea([
                    'name' => 'description',
                    'id' => 'description',
                    'value' => set_value('description', $hotel->description),
                    'class' => 'form-control',
                    'placeholder' => 'Deskripsi Hotel',
                    'style' => 'height: 100px'
                ]); ?>
            </div>
            <div class="mb-3">
                <?= form_submit('submit', 'Update Hotel', ['class' => 'btn btn-warning mb-3']); ?>
            </div>
            <?= form_close(); ?>
        </div>
    </section>
</div>
<?php $this->load->view('admin/_partials/footer'); ?>
