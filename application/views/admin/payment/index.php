<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
$completed = 0;
?>
<!-- Main Content -->
<div class="main-content" x-data="{
payId:null,
payInvoice: null,
payAmount: null,
payImg: null,
payStatus: null,
payNote: null,
resId: null}">
    <section class="section">
        <div class="section-header">
            <div class="d-flex align-items-center">
                <a href="<?= site_url("hotel") ?>" class="mr-3">
                    <i class="fa-solid fa-arrow-left fa-2xl"></i>
                </a>
                <h1>List Pembayaran</h1>
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
                        <h1><?= $completed; ?></h1>
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
            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-left">Nama</th>
                        <th scope="col" class="text-left">Invoice</th>
                        <th scope="col" class="text-center">Method</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-left">Amount</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $index = 1;
                    foreach ($payments as $pay):
                    ?>
                        <tr class="<?= $pay->payment_status === 'completed' ? 'table-success' : ($pay->payment_status === 'failed' ? 'table-danger' : '') ?>">
                            <th scope="row" class="text-center"><?= $index++; ?></th>
                            <td class="text-left"><?= $pay->full_name ?></td>
                            <td class="text-left"><?= $pay->invoice ?></td>
                            <td class="text-center text-capitalize"><?= $pay->payment_method ?></td>
                            <td class="text-center text-capitalize"><?= $pay->payment_status ?></td>
                            <td class="text-left"><?= number_format($pay->amount) ?></td>
                            <td class="d-flex justify-content-center align-items-center">
                                <button type="button"
                                    @click="
                                    payId='<?= $pay->payment_id ?>',
                                    payInvoice='<?= $pay->invoice ?>',
                                    payAmount='<?= $pay->amount ?>',
                                    payImg='<?= $pay->payment_img ?>',
                                    payStatus='<?= $pay->payment_status ?>',
                                    payNote='<?= $pay->note ?>'
                                    resId='<?= $pay->reservation_id ?>'"
                                    class="d-flex btn btn-info justify-content-center align-items-center" data-toggle="modal" data-target="#modalPaymentDetail" style="max-width: 150px; height: 50px">
                                    <i class="fa-solid fa-info"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    </section>

    <!-- Modal Reservation -->
    <?php $this->load->view('admin/payment/modal_detail'); ?>

    <!-- Modal delete -->
    <?php //$this->load->view('admin/payment/modal_delete');
    ?>

</div>

<?php $this->load->view('admin/_partials/footer'); ?>
