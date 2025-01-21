<?php
defined('BASEPATH') or exit('No direct script access allowed');

$reservationStatuses = [
    'pending' => 'bg-orange-300 cursor-pointer',
    'confirmed' => 'bg-green-300 cursor-pointer',
    'checked_in' => 'bg-blue-300 cursor-pointer',
    'in_house' => 'bg-blue-500 cursor-pointer',
    'checked_out' => 'bg-lime-300 cursor-pointer',
    'cancelled' => 'bg-red-300 cursor-pointer',
];

$reservationData = [];
foreach ($reservations as $reservation) {
    foreach ($dates as $date) {
        if ($date >= $reservation->check_in && $date <= date('Y-m-d', strtotime("$reservation->check_out -1 day")) && $reservation->room_code == $reservation->room_code) {
            $reservationData[$reservation->room_code][$date] = $reservation;
        }
    }
}

$this->load->view('admin/_partials/header');
?>
<!-- Main Content -->
<div class="main-content"
    x-data="{
hotelId:null,
roomCodeId:null,
reservationId: null,
fullName: null,
checkIn: null,
checkOut: null,
resStatus: null,
payStatus: null,
roomCode:null,
note:null
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

        <div class="flex">
            <?= form_open('', ['class' => 'flex items-center mb-3']); ?>
            <div class="relative">
                <?= form_input([
                    'name' => 'start',
                    'id' => 'start',
                    'type' => 'date',
                    'value' => $startDate,
                    'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5'
                ]); ?>
            </div>
            <span class="mx-4 text-gray-500">TO</span>
            <div class="relative">
                <?= form_input([
                    'name' => 'end',
                    'id' => 'end',
                    'type' => 'date',
                    'value' => $endDate,
                    'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5'
                ]); ?>
            </div>
            <button type="submit" class="ml-4 px-3 py-2.5 bg-green-400 rounded-lg text-slate-100">Search</button>
            <?= form_close(); ?>
            <div>
                <button type="button"
                    class="ml-4 px-3 py-2.5 bg-blue-400 rounded-lg text-slate-100"
                    data-toggle="modal"
                    data-target="#modalDateReservation">
                    Reservasi
                </button>
            </div>
        </div>

        <div class="relative flex">
            <div class="sticky bg-gray-100 top-0 left-0 grid grid-flow-row max-w-fit w-full z-10">
                <div class="px-2 py-2 border border-black">
                    <p class="text-transparent">Reservasi</p>
                </div>
                <?php foreach ($room_code as $code): ?>
                    <div class="px-2 py-2 border border-black flex gap-x-7 cursor-pointer" data-toggle="modal" data-target="#modalRoomStatus" @click="
                    hotelId = '<?= $hotelId ?>';
                    roomCodeId = '<?= $code->room_code_id ?>';
                    roomCode = '<?= $code->room_code ?>';
                    ">
                        <p><?= $code->room_code; ?></p>
                        <p><?= $code->room_status; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="grid grid-flow-col overflow-x-scroll no-scrollbar">
                <?php foreach ($dates as $date): ?>
                    <div class="grid grid-flow-row sticky top-0 auto-cols-[10rem]">
                        <div class="px-2 py-2 border bg-gray-100 border-black text-center">
                            <?php $newDate = new DateTime($date); ?>
                            <p><?= $newDate->format('j M Y') ?></p>
                        </div>

                        <?php foreach ($room_code as $code): ?>
                            <?php
                            $reservation = $reservationData[$code->room_code][$date] ?? null;
                            $statusClass = $reservation ? ($reservationStatuses[$reservation->reservation_status] ?? 'bg-white') : 'bg-white';
                            $tooltipText = $reservation ? "Room Code: $code->room_code\nCheckIn: $reservation->check_in\nCheckOut: $reservation->check_out\nStatus: $reservation->reservation_status\nPayment: $reservation->payment_status" : '';
                            $reservationDataForClick = $reservation ? [
                                'hotelId' => $hotelId,
                                'roomCodeId' => $reservation->room_code_id,
                                'reservationId' => $reservation->reservation_id,
                                'fullName' => $reservation->full_name,
                                'checkIn' => date('d M Y', strtotime($reservation->check_in)),
                                'checkOut' => date('d M Y', strtotime($reservation->check_out)),
                                'resStatus' => $reservation->reservation_status,
                                'payStatus' => $reservation->payment_status,
                                'roomCode' => $reservation->room_code,
                                'note' => $reservation->note ?? ''
                            ] : [];
                            ?>
                            <div data-toggle="modal" data-target="<?= $reservation ? '#modalReservationDetail' : ''; ?>" class="px-2 py-2 border border-black text-gray-800 <?= $statusClass ?>"
                                title="<?= $tooltipText ?>"
                                @click="<?php foreach ($reservationDataForClick as $key => $value): ?>
                                    <?= $key; ?> = '<?= addslashes($value); ?>';
                                    <?php endforeach; ?>">

                                <p class="text-center text-capitalize <?= !$reservation ? 'text-transparent' : ''; ?>"><?= $reservation ? $reservation->full_name : '-'; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Modal Date Reservasi -->
    <?php $this->load->view('admin/reservation/modal_date_reservation'); ?>

    <!-- Modal Status Room -->
    <?php $this->load->view('admin/reservation/modal_room_status'); ?>

    <!-- Modal Detail Reservation -->
    <?php $this->load->view('admin/reservation/modal_detail'); ?>

    <!-- Modal Cancel Reservation -->
    <?php $this->load->view('admin/reservation/modal_cancel_res'); ?>

</div>

<?php $this->load->view('admin/_partials/footer'); ?>
