<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<!-- Main Content -->
<div class="main-content" x-data="{hotelId:null, hotelName:null}">
    <section class="section">
        <div class="section-header">
            <h1>List Hotel</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Layout</a></div>
                <div class="breadcrumb-item">Default Layout</div>
            </div>
        </div>

        <div class="section-body table-responsive">
            <a href="<?= site_url('hotel/create') ?>" type="button" class="btn btn-primary mb-3">Tambah Hotel</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-left">Nama Hotel</th>
                        <th scope="col" class="text-left">Lokasi</th>
                        <th scope="col" class="text-left">Deskripsi</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $index = 1;
                    foreach ($hotels as $hotel) {
                    ?>
                        <tr class="">
                            <th scope="row" class="text-center"><?= $index++; ?></th>
                            <td><?= $hotel->name ?></td>
                            <td><?= $hotel->address ?></td>
                            <td>
                                <span class="d-inline-block text-truncate" style="max-width: 390px;">
                                    <?= $hotel->description ?>
                                </span>
                            </td>
                            <td class="d-flex justify-content-center align-items-center">
                                <!-- Add Room -->
                                <a href="<?= site_url("hotel/$hotel->hotel_id/room") ?>" type="button" title="Tambah Kamar" class="d-flex btn btn-primary mx-1 justify-content-center align-items-center" style="max-width: 150px; height: 50px">
                                    <i class="fas fa-solid fa-bed"></i>
                                </a>
                                <!-- Update Hotel -->
                                <a href="<?= site_url("hotel/$hotel->hotel_id/edit") ?>" type="button" title="Edit Hotel" class="d-flex btn btn-warning mx-1 justify-content-center align-items-center" style="max-width: 150px; height: 50px">
                                    <i class="fas fa-solid fa-pen"></i>
                                </a>
                                <!-- Delete Hotel -->
                                <button type="button"
                                    @click="hotelId='<?= $hotel->hotel_id ?>', hotelName='<?= $hotel->name ?>'"
                                    class="d-flex btn btn-danger mx-1 justify-content-center align-items-center"
                                    style="max-width: 150px; height: 50px"
                                    data-toggle="modal"
                                    data-target="#modalHotelDelete">
                                    <i class="fas fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Modal Delete -->
    <?php $this->load->view('admin/hotel/modal_delete'); ?>

</div>
<?php $this->load->view('admin/_partials/footer'); ?>
