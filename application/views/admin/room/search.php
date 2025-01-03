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
            <div class="d-flex">
                <form action="<?= site_url("hotel/$hotelId/room/search") ?>" method="POST">
                    <div class="mb-3 form-row">
                        <div class="col">
                            <label for="check_in" class="form-label">Check In</label>
                            <input type="date" id="check_in" name="check_in" value="<?= set_value('check_in') ?>" class="form-control">
                            <?= form_error('check_in', '<span class="text-danger ml-2">', '</span>') ?>
                        </div>
                        <div class="col">
                            <label for="check_out" class="form-label">Check Out</label>
                            <input type="date" id="check_out" name="check_out" value="<?= set_value('check_out') ?>" class="form-control">
                            <?= form_error('check_out', '<span class="text-danger ml-2">', '</span>') ?>
                        </div>
                        <button type="submit" class="btn btn-success">Search Room</button>
                    </div>
                </form>
            </div>
            <div class="row">
                <?php foreach ($rooms as $room):; ?>
                    <div class="col-12 col-md-3 col-lg-3">
                        <a href="<?= site_url("hotel/$hotelId/room/$room->room_id/reservation") ?>?check_in=<?= set_value('check_in') ?>&check_out=<?= set_value('check_out') ?>">
                            <div class="card bg-secondary text-dark">
                                <div class="card-header">
                                    <h4><?= $room->room_type; ?></h4>
                                </div>
                                <div class="card-body text-center">
                                    <h1><?= $room->total; ?></h1>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Modal Reservation -->
    <?php $this->load->view('admin/room/modal_date_reservation'); ?>

    <!-- Modal delete -->
    <?php $this->load->view('admin/room/modal_delete'); ?>

</div>

<?php $this->load->view('admin/_partials/footer'); ?>
