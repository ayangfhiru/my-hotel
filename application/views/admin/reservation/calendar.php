<?php
defined('BASEPATH') or exit('No direct script access allowed');

$reservationStatuses = [
    'pending' => 'bg-orange-300',
    'confirmed' => 'bg-green-300',
    'checked_in' => 'bg-blue-300',
    'in_house' => 'bg-blue-500',
    'checked_out' => 'bg-lime-300',
    'cancelled' => 'bg-red-300',
];

$reservationData = [];
foreach ($reservations as $reservation) {
    foreach ($dates as $date) {
        if ($date >= $reservation->check_in && $date <= $reservation->check_out && $reservation->room_code == $reservation->room_code) {
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
                <h1>List Reservation <?= $hotelId; ?></h1>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Layout</a></div>
                <div class="breadcrumb-item">Default Layout</div>
            </div>
        </div>


        <form action="" class="flex items-center mb-3">
            <div class="relative">
                <input name="start" type="date" value="<?= $startDate ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Select date end">
            </div>
            <span class="mx-4 text-gray-500">TO</span>
            <div class="relative">
                <input name="end" type="date" value="<?= $endDate ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Select date end">
            </div>
            <button type="submit" class="ml-4 px-3 py-2.5 bg-green-400 rounded-lg text-slate-100">Search</button>
        </form>

        <!-- <div class="relative flex">
            <div class="sticky bg-gray-100 top-0 left-0 grid grid-flow-row max-w-fit w-full z-10">
                <div class="px-2 py-2 border border-black">
                    <p class="text-transparent">-</p>
                </div>
                <?php foreach ($room_code as $code): ?>
                    <div class="px-2 py-2 border border-black flex gap-x-7">
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
                            <div class="px-2 py-2 border border-black cursor-pointer text-gray-800
                        <?php
                            $reservationFound = false;
                            foreach ($reservations as $reservation):
                                if ($date >= $reservation->check_in && $date <= $reservation->check_out && $reservation->room_code == $code->room_code):
                                    $reservationFound = true;

                                    switch ($reservation->reservation_status) {
                                        case 'pending':
                                            echo "bg-orange-300";
                                            break;
                                        case 'confirmed':
                                            echo "bg-green-300";
                                            break;
                                        case 'cancelled':
                                            echo "bg-red-300";
                                            break;
                                        case 'in_house':
                                            echo "bg-blue-300";
                                            break;
                                        case 'out_house':
                                            echo "bg-lime-300";
                                            break;
                                        default:
                                            echo "bg-white";
                                            break;
                                    }
                                    break;
                                endif;
                            endforeach;
                        ?>
                    " title="<?= $reservation->reservation_status ?>">
                                <?php if ($reservationFound): ?>
                                    <p class="text-center text-capitalize"><?= $reservation->full_name; ?></p>
                                <?php else: ?>
                                    <p class="text-transparent">-</p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div> -->

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
                            $tooltipText = $reservation ? "Room Code: $code->room_code\nCheckIn: $reservation->check_in\nCheckOut: $reservation->check_out\nStatus: $reservation->reservation_status" : '';
                            $reservationDataForClick = $reservation ? [
                                'hotelId' => $hotelId,
                                'roomCodeId' => $reservation->room_code_id,
                                'reservationId' => $reservation->reservation_id,
                                'paymentId' => $reservation->payment_id,
                                'fullName' => $reservation->full_name,
                                'email' => $reservation->email,
                                'phoneNum' => $reservation->phone_number,
                                'checkIn' => $reservation->check_in,
                                'checkOut' => $reservation->check_out,
                                'identity' => $reservation->identity,
                                'identityNum' => $reservation->identity_number,
                                'resStatus' => $reservation->reservation_status,
                                'invoice' => $reservation->invoice,
                                'payMethod' => $reservation->payment_method,
                                'amount' => number_format($reservation->amount, 2),
                                'payStatus' => $reservation->payment_status,
                                'roomCode' => $reservation->room_code
                            ] : [];
                            ?>
                            <div data-toggle="modal" data-target="<?= $reservation ? '#modalReservationDetail' : ''; ?>" class="px-2 py-2 border border-black cursor-pointer text-gray-800 <?= $statusClass ?>"
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

    <!-- Modal Detail -->
    <?php $this->load->view('admin/reservation/modal_detail'); ?>

    <!-- Modal cancelled -->
    <?php $this->load->view('admin/reservation/modal_cancelled'); ?>

    <!-- Modal Status -->
    <?php $this->load->view('admin/reservation/modal_room_status'); ?>

</div>

<?php $this->load->view('admin/_partials/footer'); ?>
