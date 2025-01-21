<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<!-- Main Content -->
<div class="main-content" x-data="{ serId: null, serName: null, serPrice:null, serDesc: null }">
    <section class="section">
        <div class="section-header">
            <h1>List Extra Service</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Layout</a></div>
                <div class="breadcrumb-item">Default Layout</div>
            </div>
        </div>

        <div class="section-body">
            <button type="button" class="mb-3 btn btn-primary" data-toggle="modal" data-target="#modalServiceCreate">
                Tambah Serivce <span x-show="name"></span>
            </button>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-left">Service</th>
                        <th scope="col" class="text-left">Price</th>
                        <th scope="col" class="text-center">Description</th>
                        <th scope="col" class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $index = 1;
                    foreach ($services as $service) {
                    ?>
                        <tr id="service-<?= $service->service_id ?>">
                            <th scope="row" class="text-center"><?= $index++ ?></th>
                            <td class="text-left"><?= $service->service_name; ?></td>
                            <td class="text-left"><?= number_format($service->service_price); ?></td>
                            <td class="text-left"><?= $service->description; ?></td>
                            <td class="text-center">
                                <button type="button"
                                    @click="serId='<?= $service->service_id ?>',
                                    serName='<?= $service->service_name ?>',
                                    serPrice='<?= $service->service_price ?>',
                                    serDesc='<?= $service->description ?>'"
                                    class="btn btn-link"
                                    data-toggle="modal"
                                    data-target="#modalServiceUpdate">
                                    <i class="fas fa-solid fa-pen-nib"></i>
                                </button>
                                <button type="button"
                                    @click="serId='<?= $service->service_id ?>', serName='<?= $service->service_name ?>'"
                                    class="btn btn-link"
                                    data-toggle="modal"
                                    data-target="#modalServiceDelete">
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
    <?php $this->load->view('admin/service/modal_create'); ?>

    <!-- Modal Update -->
    <?php $this->load->view('admin/service/modal_update'); ?>

    <!-- Modal Delete -->
    <?php $this->load->view('admin/service/modal_delete'); ?>
</div>

<?php $this->load->view('admin/_partials/footer'); ?>
