<?php
defined('BASEPATH') or exit('No direct script access allowed');

$statusColor = [
    'pending' => 'bg-yellow-400',
    'confirmed' => 'bg-blue-500',
    'checked_in' => 'bg-green-500',
    'in_house' => 'bg-teal-500',
    'checked_out' => 'bg-gray-400',
    'cancelled' => 'bg-red-500',
    'no_show' => 'bg-orange-500',
    'waitlisted' => 'bg-yellow-300',
    'refunded' => 'bg-indigo-500',
];

// Menentukan bulan dan tahun
$month = date('m');
$year = date('Y');

// Menentukan hari pertama bulan ini (misalnya, apakah tanggal 1 adalah hari apa)
$firstDayOfMonth = date('N', strtotime("$year-$month-01")); // Hari pertama dalam seminggu (1 = Senin, 7 = Minggu)

// Menentukan jumlah hari dalam bulan tersebut
$daysInMonth = date('t', strtotime("$year-$month-01"));

$daysOfWeek = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

// Menghitung jumlah hari yang kosong pada awal bulan sebelum tanggal 1
$emptyDays = $firstDayOfMonth - 1;

// Menyiapkan array untuk menampung tanggal-tanggal bulan ini
$dates = array_fill(0, $emptyDays, '');
for ($day = 1; $day <= $daysInMonth; $day++) {
    $dates[] = $day;
}

$this->load->view('templates/top-layout-admin');
?>

<section class="relative bg-stone-50">
    <div class="bg-sky-400 w-full sm:w-40 h-40 rounded-full absolute top-1 opacity-20 max-sm:right-0 sm:left-56 z-0"></div>
    <div class="bg-emerald-500 w-full sm:w-40 h-24 absolute top-0 -left-0 opacity-20 z-0"></div>
    <div class="bg-purple-600 w-full sm:w-40 h-24 absolute top-40 -left-0 opacity-20 z-0"></div>
    <div class="w-full py-10 relative z-10 backdrop-blur-3xl">
        <div class="w-full max-w-7xl mx-auto px-2 lg:px-8">
            <div class="flex justify-between">
                <div>
                    <h2 class="font-manrope text-3xl leading-tight text-gray-900 mb-1.5">Booking Schedule</h2>
                    <p class="text-lg font-normal text-gray-600 mb-8">Don’t miss schedule</p>
                </div>
                <div class="grid grid-cols-4 gap-x-5">
                    <?php foreach ($statusColor as $status => $color):; ?>
                        <div class="flex items-center gap-x-3">
                            <span class="w-5 h-5 inline-block rounded-full <?= $color ?>"></span>
                            <p><?= ucfirst($status) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-8 max-w-4xl mx-auto xl:max-w-full h-screen">
                <div class="col-span-12 xl:col-span-5 overflow-y-scroll no-scrollbar">
                    <div class="flex gap-5 flex-col">
                        <?php foreach ($bookings as $booking):; ?>
                            <?php
                            $colorClass = isset($statusColor[$booking->booking_status]) ? $statusColor[$booking->booking_status] : 'bg-gray-200';
                            ?>
                            <div class="p-6 rounded-xl bg-white shadow-lg">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-2.5">
                                        <span class="w-3 h-3 rounded-full <?= $colorClass ?>"></span>
                                        <p class="text-sm font-medium text-gray-900">
                                            <?= date('d M Y', strtotime($booking->check_in)); ?>
                                            <span class="text-base font-semibold">To</span>
                                            <?= date('j M Y', strtotime($booking->check_out)); ?>
                                        </p>
                                    </div>
                                    <div class="dropdown relative inline-flex">
                                        <button type="button" data-target="dropdown-default" class="dropdown-toggle inline-flex justify-center py-2.5 px-1 items-center gap-2 text-sm text-black rounded-full cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 hover:text-purple-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="4" viewBox="0 0 12 4" fill="none">
                                                <path d="M1.85624 2.00085H1.81458M6.0343 2.00085H5.99263M10.2124 2.00085H10.1707" stroke="currentcolor" stroke-width="2.5" stroke-linecap="round"></path>
                                            </svg>
                                        </button>
                                        <div id="dropdown-default" class="dropdown-menu rounded-xl shadow-lg bg-white absolute top-full -left-10 w-max mt-2 hidden" aria-labelledby="dropdown-default">
                                            <ul class="py-2">
                                                <li>
                                                    <a class="block px-6 py-2 text-xs hover:bg-gray-100 text-gray-600 font-medium" href="javascript:;">
                                                        Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="block px-6 py-2 text-xs hover:bg-gray-100 text-gray-600 font-medium" href="javascript:;">
                                                        Remove
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="text-xl leading-8 font-semibold text-black mb-1"><?= $booking->full_name; ?></h6>
                                <p class="text-base font-normal text-gray-600"><?= $booking->room_code; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-span-12 xl:col-span-7 px-2.5 py-5 sm:p-8 bg-gradient-to-b from-white/25 to-white xl:bg-white rounded-2xl max-xl:row-start-1">
                    <div class="flex flex-col md:flex-row gap-4 items-center justify-between mb-5">
                        <div class="flex items-center gap-4">
                            <h5 class="text-xl leading-8 font-semibold text-gray-900">
                                <?= date('M Y'); ?>
                            </h5>
                            <div class="flex items-center">
                                <button class="text-indigo-600 p-1 rounded transition-all duration-300 hover:text-white hover:bg-indigo-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M10.0002 11.9999L6 7.99971L10.0025 3.99719" stroke="currentcolor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                                <button class="text-indigo-600 p-1 rounded transition-all duration-300 hover:text-white hover:bg-indigo-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M6.00236 3.99707L10.0025 7.99723L6 11.9998" stroke="currentcolor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center rounded-md p-1 bg-indigo-50 gap-px">
                            <button class="py-2.5 px-5 rounded-lg bg-indigo-50 text-indigo-600 text-sm font-medium transition-all duration-300 hover:bg-indigo-600 hover:text-white">Day</button>
                            <button class="py-2.5 px-5 rounded-lg bg-indigo-600 text-white text-sm font-medium transition-all duration-300 hover:bg-indigo-600 hover:text-white">Week</button>
                            <button class="py-2.5 px-5 rounded-lg bg-indigo-50 text-indigo-600 text-sm font-medium transition-all duration-300 hover:bg-indigo-600 hover:text-white">Month</button>
                        </div>
                    </div>
                    <div class="border border-indigo-200 rounded-xl">
                        <div class="grid grid-cols-7 rounded-t-3xl border-b border-indigo-200">
                            <?php foreach ($daysOfWeek as $index => $day): ?>
                                <div class="py-3.5 border-r border-indigo-200 bg-indigo-50 flex items-center justify-center text-sm font-medium text-indigo-600 <?php if ($index === 0): ?> rounded-tl-xl <?php endif; ?> <?php if ($index === 6): ?> rounded-tr-xl <?php endif; ?>">
                                    <?= $day; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="grid grid-cols-7 rounded-b-xl overflow-hidden">
                            <?php
                            foreach ($dates as $index => $date):
                                $isToday = $date == date('j') && $month == date('m') && $year == date('Y');
                                $dayClass = $isToday ? 'bg-indigo-200' : 'bg-gray-50';
                            ?>
                                <div data-date="<?= date('Y-m-' . sprintf('%02d', $date)); ?>"
                                    class="flex xl:aspect-square max-xl:min-h-[60px] p-3.5 <?= $dayClass ?> border-r border-b border-indigo-200 transition-all duration-300 hover:bg-indigo-50 cursor-pointer <?= !empty($date) ? 'dateSchedule' : '' ?>">
                                    <?php if ($date): ?>
                                        <span class="text-xs font-semibold <?= $isToday ? 'text-indigo-600' : 'text-gray-900' ?>">
                                            <?= $date; ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$this->load->view('room/modal-add-room-code');
$this->load->view('room/modal-delete');
$this->load->view('templates/bottom-layout-admin');
?>
