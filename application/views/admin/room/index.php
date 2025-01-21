<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<!-- Main Content -->
<div class="main-content" x-data="{hotelId:null, roomId: null, roomType: null}">
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

        <div class="row">
            <div class="col-12 col-md-3 col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Total Reservasi</h4>
                    </div>
                    <div class="card-body text-center">
                        <h1>0</h1>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3 col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Sudah Berlalu</h4>
                    </div>
                    <div class="card-body text-center">
                        <h1>0</h1>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3 col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Menunggu</h4>
                    </div>
                    <div class="card-body text-center">
                        <h1>0</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body table-hover table-responsive">
            <div class="d-flex">
                <a href="<?= site_url("hotel/$hotelId/room/create") ?>" type="button" class="btn btn-primary mb-3 mx-2">Kamar</a>
                <button type="button"
                    class="btn btn-primary mb-3 mx-2"
                    data-toggle="modal"
                    data-target="#modalDateReservation">
                    Reservasi
                </button>
                <a href="<?= site_url("hotel/$hotelId/reservation/calendar") ?>" type="button" title="Info Code Room" class="btn btn-primary mb-3 mx-2">
                    Kalender
                </a>
                <a href="<?= site_url("hotel/$hotelId/payment") ?>" type="button" title="Info Code Room" class="btn btn-primary mb-3 mx-2">
                    Pembayaran
                </a>
            </div>
            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Room Type</th>
                        <th scope="col" class="text-center">Bed Type</th>
                        <th scope="col" class="text-center">Capacity</th>
                        <th scope="col" class="text-center">Price</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $index = 1;
                    foreach ($rooms as $room):
                    ?>
                        <tr id="room-<?= $room->room_id ?>">
                            <th scope="row" class="text-center"><?= $index++; ?></th>
                            <td class="text-center"><?= $room->room_type ?></td>
                            <td class="text-center"><?= $room->bed_type ?></td>
                            <td class="text-center"><?= $room->capacity ?></td>
                            <td class="text-center"><?= number_format($room->price) ?></td>
                            <td class="d-flex justify-content-center align-items-center">
                                <a href="<?= site_url("hotel/$hotelId/room/$room->room_id/room-code") ?>" type="button" title="Info Code Room" class="d-flex btn btn-primary mx-1 justify-content-center align-items-center px-3" style="max-width: 150px; height: 50px">
                                    <i class="fas fa-solid fa-info"></i>
                                </a>
                                <a href="<?= site_url("hotel/$hotelId/room/$room->room_id/edit") ?>" type="button" class="d-flex btn btn-warning mx-1 justify-content-center align-items-center" style="max-width: 150px; height: 50px">
                                    <i class="fas fa-solid fa-pen-nib"></i>
                                </a>
                                <!-- Button trigger modal -->
                                <button type="button"
                                    @click="hotelId = '<?= $hotelId ?>'; roomId = '<?= $room->room_id ?>'; roomType = '<?= $room->room_type ?>'"
                                    class="d-flex btn btn-danger mx-1 justify-content-center align-items-center" data-toggle="modal" data-target="#modalRoomDelete" style="max-width: 150px; height: 50px">
                                    <i class="fas fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Modal Reservation -->
    <?php $this->load->view('admin/reservation/modal_date_reservation'); ?>

    <!-- Modal delete -->
    <?php $this->load->view('admin/room/modal_delete'); ?>

</div>

<?php $this->load->view('admin/_partials/footer'); ?>
