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
                <h1>Chek In</h1>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Layout</a></div>
                <div class="breadcrumb-item">Default Layout</div>
            </div>
        </div>

        <div class="section-body">
            <?= form_open(site_url("hotel/$hotelId/room/$roomId/reservation/store")); ?>
            <div class="mb-3">
                <?= form_label('User Account', 'user_account'); ?>
                <select class="form-control" id="user_account" name="user_account">
                    <option value="" selected></option>
                    <?php foreach ($users as $user):; ?>
                        <option value="<?= $user->user_id ?>"><?= $user->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <?= form_label('Full Name', 'full_name', ['class' => 'form-label']); ?>
                <?= form_input('full_name', set_value('full_name'), [
                    'id' => 'full_name',
                    'class' => 'form-control'
                ]); ?>
                <?= form_error('full_name', '<span class="text-danger ml-2">', '</span>') ?>
            </div>
            <div class="mb-3">
                <label for="room_code_id">Room Code</label>
                <select class="form-control" id="room_code_id" name="room_code_id">
                    <?php foreach ($room_code as $code):; ?>
                        <option value="<?= $code->room_code_id ?>"><?= $code->room_code; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3 row">
                <div class="col">
                    <?= form_label('Email', 'email', ['class' => 'form-label']); ?>
                    <?= form_input([
                        'name' => 'email',
                        'id' => 'email',
                        'value' => set_value('email'),
                        'type' => 'email',
                        'class' => 'form-control'
                    ]); ?>
                    <?= form_error('email', '<span class="text-danger ml-2">', '</span>') ?>
                </div>
                <div class="col">
                    <?= form_label('Phone Number', 'phone_number', ['class' => 'form-label']); ?>
                    <?= form_input([
                        'name' => 'phone_number',
                        'id' => 'phone_number',
                        'value' => set_value('phone_number'),
                        'type' => 'number',
                        'class' => 'form-control'
                    ]); ?>
                    <?= form_error('phone_number', '<span class="text-danger ml-2">', '</span>') ?>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col">
                    <?= form_label('Identity Type', 'identity_type', ['class' => 'form-label']); ?>
                    <?= form_dropdown('identity_type', [
                        'ktp' => 'KTP',
                        'sim' => 'SIM',
                        'paspor' => 'Paspor'
                    ], set_value('identity_type', 'ktp'), ['class' => 'form-control', 'id' => 'identity_type']); ?>
                </div>
                <div class="col">
                    <?= form_label('Identity Number', 'identity_number', ['class' => 'form-label']); ?>
                    <?= form_input([
                        'name' => 'identity_number',
                        'id' => 'identity_number',
                        'value' => set_value('identity_number'),
                        'type' => 'number',
                        'class' => 'form-control'
                    ]); ?>
                    <?= form_error('identity_number', '<span class="text-danger ml-2">', '</span>') ?>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col">
                    <?= form_label('Check In', 'check_in', ['class' => 'form-label']); ?>
                    <?= form_input([
                        'name' => 'check_in',
                        'id' => 'check_in',
                        'value' => set_value('check_in', $checkIn),
                        'type' => 'date',
                        'class' => 'form-control',
                        'readonly' => 'readonly'
                    ]); ?>
                </div>
                <div class="col">
                    <?= form_label('Check Out', 'check_out', ['class' => 'form-label']); ?>
                    <?= form_input([
                        'name' => 'check_out',
                        'id' => 'check_out',
                        'value' => set_value('check_out', $checkOut),
                        'type' => 'date',
                        'class' => 'form-control',
                        'readonly' => 'readonly'
                    ]); ?>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col">
                    <?= form_label('Payment Method', 'payment_method', ['class' => 'form-label']); ?>
                    <?= form_dropdown('payment_method', [
                        'cash' => 'Cash',
                        'transfer' => 'Transfer',
                        'credit card' => 'Credit Card'
                    ], set_value('payment_method', 'cash'), ['class' => 'form-control', 'id' => 'payment_method']); ?>
                </div>
                <div class="col">
                    <?= form_label('Price', 'price', ['class' => 'form-label']); ?>
                    <?= form_input([
                        'name' => 'price',
                        'id' => 'price',
                        'value' => set_value('price', $price),
                        'class' => 'form-control',
                        'readonly' => 'readonly'
                    ]); ?>
                </div>
                <div class="col">
                    <?= form_label('Amount', 'amount', ['class' => 'form-label']); ?>
                    <?= form_input([
                        'name' => 'amount',
                        'id' => 'amount',
                        'value' => set_value('amount', $amount),
                        'class' => 'form-control',
                        'readonly' => 'readonly'
                    ]); ?>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary mb-3">Tambah Chek In</button>
            </div>
            <?= form_close(); ?>
        </div>
    </section>
</div>
<?php $this->load->view('admin/_partials/footer'); ?>
