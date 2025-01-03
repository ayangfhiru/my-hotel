<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<!-- Main Content -->
<div class="main-content" x-data="{ hotelId: <?= $hotelId ?>,
roomId: <?= $roomId ?>,
roomCodeId: null,
roomCode: null,
roomStatus: null }">
    <section class="section">
        <div class="section-header">
            <div class="d-flex align-items-center">
                <a href="<?= site_url("hotel/$hotelId/room/") ?>" class="mr-3">
                    <i class="fa-solid fa-arrow-left fa-2xl"></i>
                </a>
                <h1>List Room Code <?= $room->room_type ?></h1>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Layout</a></div>
                <div class="breadcrumb-item">Default Layout</div>
            </div>
        </div>

        <div class="section-body table-hover table-responsive">
            <div class="d-flex mb-3">
                <!-- Button Trigger Modal -->
                <button type="button" class="btn btn-primary mx-1" data-toggle="modal" data-target="#modalRoomCodeCreate">
                    Tambah Room Code
                </button>
            </div>

            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Room Code</th>
                        <th scope="col" class="text-center">Status Room</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $index = 1;
                    foreach ($room_code as $code) {
                    ?>
                        <tr class="">
                            <th scope="row" class="text-center"><?= $index++; ?></th>
                            <td class="text-center"><?= $code->room_code ?></td>
                            <td class="text-center"><?= $code->room_status ?></td>
                            <td class="d-flex justify-content-center align-items-center">
                                <!-- Button trigger modal update -->
                                <button
                                    type="button"
                                    @click="roomCodeId = '<?= $code->room_code_id ?>';
                                    roomCode = '<?= $code->room_code ?>';
                                    roomStatus = '<?= $code->room_status ?>'"
                                    class="d-flex btn btn-warning mx-1 justify-content-center align-items-center"
                                    data-toggle="modal"
                                    data-target="#modalRoomCodeUpdate"
                                    style="max-width: 150px; height: 50px">
                                    <i class="fas fa-solid fa-pen-nib"></i>
                                </button>
                                <!-- Button trigger modal delete -->
                                <button
                                    type="button"
                                    @click="roomCodeId = '<?= $code->room_code_id ?>';
                                    code = '<?= $code->room_code ?>'"
                                    class="d-flex btn btn-danger mx-1 justify-content-center align-items-center"
                                    data-toggle="modal"
                                    data-target="#modalRoomCodeDelete"
                                    style="max-width: 150px; height: 50px">
                                    <i class="fas fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Modal Create -->
    <?php $this->load->view('admin/room-code/modal_create'); ?>

    <!-- Modal Update -->
    <?php $this->load->view('admin/room-code/modal_update'); ?>

    <!-- Modal Delete -->
    <?php $this->load->view('admin/room-code/modal_delete'); ?>

</div>

<?php $this->load->view('admin/_partials/footer'); ?>
