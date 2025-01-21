<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<!-- Main Content -->
<div class="main-content" x-data="{facilityId:null, facilityName:null}">
    <section class="section">
        <div class="section-header">
            <h1>List Fasilitas</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Layout</a></div>
                <div class="breadcrumb-item">Default Layout</div>
            </div>
        </div>

        <div class="section-body position-relative">
            <!-- Button Trigger Modal -->
            <button type="button" class="mb-3 btn btn-primary" data-toggle="modal" data-target="#modalFacilityCreate">
                Tambah Fasilitas
            </button>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-left">Fasilitas</th>
                        <th scope="col" class="text-center">Icon</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $index = 1;
                    foreach ($facilities as $facility) {
                    ?>
                        <tr id="facility-<?= $facility->facility_id ?>">
                            <th scope="row" class="text-center"><?= $index++ ?></th>
                            <td class="text-left"><?= $facility->facility_name; ?></td>
                            <td class="text-center">
                                <i class="<?= $facility->icon ?> fa-xl"></i>
                            </td>
                            <td class="text-center">
                                <button type="button"
                                    @click="facilityId='<?= $facility->facility_id ?>', facilityName='<?= $facility->facility_name ?>'"
                                    class="btn btn-link"
                                    data-toggle="modal"
                                    data-target="#modalFacilityUpdate">
                                    <i class="fas fa-solid fa-pen-nib"></i>
                                </button>
                                <button type="button"
                                    @click="facilityId='<?= $facility->facility_id ?>', facilityName='<?= $facility->facility_name ?>'"
                                    class="btn btn-link"
                                    data-toggle="modal"
                                    data-target="#modalFacilityDelete">
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
    <?php $this->load->view('admin/facility/modal_create'); ?>

    <!-- Modal Update -->
    <?php $this->load->view('admin/facility/modal_update'); ?>

    <!-- Modal Delete -->
    <?php $this->load->view('admin/facility/modal_delete'); ?>

</div>
<?php $this->load->view('admin/_partials/footer'); ?>
