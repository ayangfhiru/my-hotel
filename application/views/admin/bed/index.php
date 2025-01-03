<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<!-- Main Content -->
<div class="main-content" x-data="{ bedId: null, bedName: null }">
    <section class="section">
        <div class="section-header">
            <h1>List Tempat Tidur</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Layout</a></div>
                <div class="breadcrumb-item">Default Layout</div>
            </div>
        </div>

        <div class="section-body">
            <button type="button" class="mb-3 btn btn-primary" data-toggle="modal" data-target="#modalBedCreate">
                Tambah Tempat Tidur <span x-show="name"></span>
            </button>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-left">Bed</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $index = 1;
                    foreach ($beds as $bed) {
                    ?>
                        <tr>
                            <th scope="row" class="text-center"><?= $index++ ?></th>
                            <td class="text-left"><?= $bed->bed_name; ?></td>
                            <td class="text-center">
                                <button type="button"
                                    @click="bedId='<?= $bed->bed_id ?>', bedName='<?= $bed->bed_name ?>'"
                                    class="btn btn-link"
                                    data-toggle="modal"
                                    data-target="#modalBedUpdate">
                                    <i class="fas fa-solid fa-pen-nib"></i>
                                </button>
                                <button type="button"
                                    @click="bedId='<?= $bed->bed_id ?>', bedName='<?= $bed->bed_name ?>'"
                                    class="btn btn-link"
                                    data-toggle="modal"
                                    data-target="#modalBedDelete">
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
    <?php $this->load->view('admin/bed/modal_create'); ?>

    <!-- Modal Update -->
    <?php $this->load->view('admin/bed/modal_update'); ?>

    <!-- Modal Delete -->
    <?php $this->load->view('admin/bed/modal_delete'); ?>
</div>
<?php $this->load->view('admin/_partials/footer'); ?>
