<div class="flex flex-col gap-y-3">
    <h2 class="font-semibold text-sm">Detail Hotel</h2>
    <div class="w-full h-36 bg-gray-600 text-white rounded-md overflow-hidden flex gap-x-5 mb-5">
        <img src="<?= site_url('assets/images/thumbnail/default.jpg') ?>" alt="<?= $room['room_type']; ?>" class="object-cover">
        <div class="py-3 w-full pr-5">
            <h1 class="text-3xl font-semibold"><?= $room['room_type']; ?></h1>
            <ul>
                <li class="flex w-48 justify-between">
                    <p class="font-semibold">Check In</p>
                    <p class="text-lg font-semibold"><?= date('d M Y', strtotime($room['check_in'])); ?></p>
                </li>
                <li class="flex w-48 justify-between">
                    <p class="font-semibold">Check Out</p>
                    <p class="text-lg font-semibold"><?= date('d M Y', strtotime($room['check_out'])); ?></p>
                </li>
            </ul>
            <h3 class="mt-2 text-end w-full text-xl font-semibold">IDR <?= number_format($room['price']); ?> / <span class="text-sm">Malam</span></h3>
        </div>
    </div>

    <h2 class="font-semibold text-sm">Detail Pembayaran</h2>
    <ul class="w-full bg-gray-600 text-white border p-5 rounded-md">
        <li class="flex justify-between items-center w-full border-b border-gray-400">
            <h4 class="font-semibold text-sm"><?= $room['room_type']; ?></h4>
            <h1 class="font-semibold text-lg"><?= number_format($room['price']); ?></h1>
        </li>
        <li id="detail-total-<?= $roomType ?>" class="flex justify-between items-center w-full mt-3 border-gray-400 hidden">
            <h4 class="font-semibold text-lg">Total</h4>
            <h1 class="font-semibold text-xl"><?= number_format($room['price']) ?></h1>
        </li>
    </ul>
</div>
