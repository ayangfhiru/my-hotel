<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<!-- Main Content -->
<div class="main-content"
    x-data="{
hotelId:null,
roomCodeId:null,
reservationId: null,
paymentId: null,
fullName:null,
email:null,
phoneNum:null,
checkIn: null,
checkOut: null,
identity: null,
identityNum: null,
resStatus: null,
invoice: null,
payMethod: null,
amount: null,
payStatus: null,
roomCode:null
}">
    <section class="section">
        <div class="section-header">
            <div class="d-flex align-items-center">
                <a href="<?= site_url("/hotel/$hotelId/room") ?>" class="mr-3">
                    <i class="fa-solid fa-arrow-left fa-2xl"></i>
                </a>
                <h1>List Reservation</h1>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Layout</a></div>
                <div class="breadcrumb-item">Default Layout</div>
            </div>
        </div>

        <div class="section-body table-hover table-responsive">
            <div class="d-flex mb-3">
            </div>

            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-left">Full Name</th>
                        <th scope="col" class="text-center">Check In</th>
                        <th scope="col" class="text-center">Check Out</th>
                        <th scope="col" class="text-center">Room Code</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $index = 1;
                    foreach ($reservations as $res):
                    ?>
                        <tr class="">
                            <th scope="row" class="text-center"><?= $index++; ?></th>
                            <td class="text-left"><?= $res->full_name ?></td>
                            <td class="text-center"><?= $res->check_in ?></td>
                            <td class="text-center"><?= $res->check_out ?></td>
                            <td class="text-center"><?= $res->room_code ?></td>
                            <td class="text-center"><?= $res->room_status ?></td>
                            <td class="d-flex justify-content-center align-items-center">
                                <!-- Chek In -->
                                <button type="button"
                                    @click="
                                    hotelId = '<?= $hotelId ?>';
                                    roomCodeId = '<?= $res->room_code_id ?>'
                                    reservationId = '<?= $res->reservation_id ?>'
                                    paymentId = '<?= $res->payment_id ?>';
                                    fullName = '<?= $res->full_name ?>';
                                    email = '<?= $res->email ?>';
                                    phoneNum = '<?= $res->phone_number ?>';
                                    checkIn = '<?= $res->check_in ?>';
                                    checkOut = '<?= $res->check_out ?>',
                                    identity = '<?= $res->identity ?>';
                                    identityNum = '<?= $res->identity_number ?>';
                                    resStatus = '<?= $res->reservation_status ?>';
                                    invoice = '<?= $res->invoice ?>';
                                    payMethod = '<?= $res->payment_method ?>';
                                    amount = '<?= number_format($res->amount, 2) ?>';
                                    payStatus = '<?= $res->payment_status ?>'
                                    roomCode = '<?= $res->room_code ?>'
                                    "
                                    class="d-flex btn btn-info mx-1 justify-content-center align-items-center" data-toggle="modal" data-target="#modalReservationDetail" style="max-width: 150px; height: 50px">
                                    <i class="fa-solid fa-circle-info"></i>
                                </button>
                                <!-- Set Status -->
                                <button type="button"
                                    @click="
                                    hotelId = '<?= $hotelId ?>';
                                    roomCodeId = '<?= $res->room_code_id ?>'
                                    reservationId = '<?= $res->reservation_id ?>'
                                    paymentId = '<?= $res->payment_id ?>';
                                    fullName = '<?= $res->full_name ?>';
                                    email = '<?= $res->full_name ?>';
                                    phoneNum = '<?= $res->phone_number ?>';
                                    checkIn = '<?= $res->check_in ?>';
                                    checkOut = '<?= $res->check_out ?>',
                                    identity = '<?= $res->identity ?>';
                                    identityNum = '<?= $res->identity_number ?>';
                                    resStatus = '<?= $res->reservation_status ?>';
                                    invoice = '<?= $res->invoice ?>';
                                    payMethod = '<?= $res->payment_method ?>';
                                    amount = '<?= $res->amount ?>';
                                    payStatus = '<?= $res->payment_status ?>'
                                    roomCode = '<?= $res->room_code ?>'
                                    "
                                    class="d-flex btn mx-1 justify-content-center align-items-center
                                    <?= ($res->payment_status === 'completed') || ($res->payment_status == 'failed') ? 'bg-gray text-dark' : 'bg-success' ?>" data-toggle="modal" data-target="#modalReservationSetStatus" style="max-width: 150px; height: 50px" <?= ($res->payment_status === 'completed') || ($res->payment_status === 'failed') ? 'disabled' : '' ?>>
                                    <i class="fa-solid fa-dollar-sign fa-xl"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Modal Detail -->
    <?php $this->load->view('admin/reservation/modal_detail'); ?>

    <!-- Modal Status -->
    <?php $this->load->view('admin/reservation/modal_set_status'); ?>

</div>

<?php $this->load->view('admin/_partials/footer'); ?>
