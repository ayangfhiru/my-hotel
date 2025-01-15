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
            <form action="<?= site_url("hotel/$hotelId/room/$roomId/reservation/store") ?>" method="POST">
                <div class="mb-3">
                    <label for="user_account">User Account</label>
                    <select class="form-control" id="user_account" name="user_account">
                        <option value="" selected></option>
                        <?php foreach ($users as $user):; ?>
                            <option value="<?= $user->user_id ?>"><?= $user->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" id="full_name" name="full_name" value="<?= set_value('full_name') ?>" class="form-control">
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
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" value="<?= set_value('email') ?>" class="form-control">
                        <?= form_error('email', '<span class="text-danger ml-2">', '</span>') ?>
                    </div>
                    <div class="col">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="number" id="phone_number" name="phone_number" value="<?= set_value('phone_number') ?>" class="form-control">
                        <?= form_error('phone_number', '<span class="text-danger ml-2">', '</span>') ?>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="identity_type" class="form-label">Identity Type</label>
                        <select name="identity_type" id="identity_type" class="form-control">
                            <option value="ktp" selected>KTP</option>
                            <option value="sim">SIM</option>
                            <option value="paspor">Paspor</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="identity_number" class="form-label">Identity Number</label>
                        <input type="number" id="identity_number" name="identity_number" value="<?= set_value('identity_number') ?>" class="form-control">
                        <?= form_error('identity_number', '<span class="text-danger ml-2">', '</span>') ?>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="check_in" class="form-label">Check In</label>
                        <input type="date" id="check_in" name="check_in" value="<?= $checkIn ?>" class="form-control" readonly>
                    </div>
                    <div class="col">
                        <label for="check_out" class="form-label">Check Out</label>
                        <input type="date" id="check_out" name="check_out" value="<?= $checkOut ?>" class="form-control" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select name="payment_method" id="payment_method" class="form-control">
                            <option value="cash" selected>Cash</option>
                            <option value="transfer">Transfer</option>
                            <option value="credit card">Credit Card</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" id="price" name="price" value="<?= $price ?>" class="form-control" readonly>
                    </div>
                    <div class="col">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="text" id="amount" name="amount" value="<?= $amount ?>" class="form-control" readonly>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary mb-3">Tambah Chek In</button>
                </div>
            </form>
        </div>
    </section>
</div>
<?php $this->load->view('admin/_partials/footer'); ?>
