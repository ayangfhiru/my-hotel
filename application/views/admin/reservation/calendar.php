<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="d-flex align-items-center">
                <h1>List Reservation</h1>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Layout</a></div>
                <div class="breadcrumb-item">Default Layout</div>
            </div>
        </div>

        <!-- <div class="relative flex">
            <div class="sticky bg-gray-100 top-0 left-0 grid grid-flow-row max-w-fit w-full z-10">
                <div class="px-2 py-2 border border-black">
                    <p>31-12-2024</p>
                </div>
                <?php foreach ($room_code as $code): ?>
                    <div class="px-2 py-2 border border-black flex gap-x-7">
                        <p><?= $code->room_code; ?></p>
                        <p><?= $code->room_status; ?></p>
                    </div>
                <?php endforeach ?>
            </div>

            <div class="grid grid-flow-col overflow-x-scroll no-scrollbar">
                <?php foreach ($dates as $date): ?>
                    <div class="grid grid-flow-row sticky top-0 auto-cols-[10rem]">
                        <div class="px-2 py-2 border border-black text-center">
                            <p><?= $date ?></p>
                        </div>
                        <?php $x = 1;
                        foreach ($reservations as $reservation): ?>
                            <div class="px-2 py-2 border border-black">
                                <?php if ($date >= $reservation->check_in && $date <= $reservation->check_out): ?>
                                    <p><?= $reservation->full_name; ?></p>
                                <?php else: ?>
                                    <p><?= $x; ?></p>
                                <?php endif; ?>
                            </div>
                        <?php $x++;
                        endforeach ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div> -->

        <div class="relative flex">
            <!-- Bagian Room Code -->
            <div class="sticky bg-gray-100 top-0 left-0 grid grid-flow-row max-w-fit w-full z-10">
                <div class="px-2 py-2 border border-black">
                    <p>31-12-2024</p> <!-- Tanggal yang ditampilkan di atas -->
                </div>
                <?php foreach ($room_code as $code): ?>
                    <div class="px-2 py-2 border border-black flex gap-x-7">
                        <p><?= $code->room_code; ?></p>
                        <p><?= $code->room_status; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Bagian Tanggal dan Reservasi -->
            <div class="grid grid-flow-col overflow-x-scroll no-scrollbar">
                <?php foreach ($dates as $date): ?>
                    <div class="grid grid-flow-row sticky top-0 auto-cols-[10rem]">
                        <!-- Tanggal pada Header -->
                        <div class="px-2 py-2 border bg-gray-100 border-black text-center">
                            <p><?= $date ?></p>
                        </div>

                        <!-- Looping untuk setiap Room Code -->
                        <?php foreach ($room_code as $code): ?>
                            <div class="px-2 py-2 border border-black">
                                <?php
                                // Menentukan apakah ada reservasi untuk tanggal dan room_code yang relevan
                                $reservationFound = false;
                                foreach ($reservations as $reservation):
                                    if ($date >= $reservation->check_in && $date <= $reservation->check_out && $reservation->room_code == $code->room_code):
                                        $reservationFound = true;
                                ?>
                                        <p class="text-green-500"><?= $reservation->full_name; ?></p> <!-- Menampilkan nama pemesan -->
                                    <?php endif;
                                endforeach;

                                // Jika tidak ada reservasi ditemukan untuk tanggal dan room_code, tampilkan nomor atau kosongkan
                                if (!$reservationFound): ?>
                                    <p>-</p> <!-- Tampilkan status seperti "Available" jika tidak ada reservasi -->
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>


    </section>

    <!-- Modal Detail -->
    <?php $this->load->view('admin/reservation/modal_detail'); ?>

    <!-- Modal Status -->
    <?php $this->load->view('admin/reservation/modal_set_status'); ?>

</div>

<?php $this->load->view('admin/_partials/footer'); ?>
