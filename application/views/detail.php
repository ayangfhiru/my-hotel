<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/header');
?>

<div class="container">
    <!-- Image gallery -->
    <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:gap-x-8 lg:px-8 overflow-hidden">
        <img src="<?= site_url("assets/thumbnail/" . ($hotel->thumbnail ?? 'default.jpg')) ?>" alt="<?= $hotel->name ?>" class="w-full rounded-lg object-cover lg:block">
        <div class="flex flex-col gap-y-6 justify-between">
            <img src="<?= site_url("assets/pictures/" . ($pictures[0]->picture ?? 'default.jpg')) ?>" alt="<?= $hotel->name ?>" class="aspect-[3/1] w-full rounded-lg object-cover">
            <img src="<?= site_url("assets/pictures/" . ($pictures[1]->picture ?? 'default.jpg')) ?>" alt="<?= $hotel->name ?>" class="aspect-[3/2] w-full rounded-lg object-cover">
            <img src="<?= site_url("assets/pictures/" . ($pictures[3]->picture ?? 'default.jpg')) ?>" alt="<?= $hotel->name ?>" class="aspect-[3/1] w-full rounded-lg object-cover">
        </div>
        <div class="flex flex-col gap-y-6">
            <img src="<?= site_url("assets/pictures/" . ($pictures[2]->picture ?? 'default.jpg')) ?>" alt="<?= $hotel->name ?>" class="aspect-[3/3] w-full rounded-lg object-cover">
            <img src="<?= site_url("assets/pictures/" . ($pictures[3]->picture ?? 'default.jpg')) ?>" alt="<?= $hotel->name ?>" class="aspect-[4/2] w-full rounded-lg object-cover">
        </div>
    </div>

    <!-- Product info -->
    <div class="mx-auto max-w-2xl px-4 pb-16 pt-10 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto_auto_1fr] lg:gap-x-8 lg:px-8 lg:pb-24 lg:pt-16">
        <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
            <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl"><?= $hotel->name; ?></h1>
        </div>

        <!-- Options -->
        <div class="mt-4 lg:row-span-3 lg:mt-0">
            <h2 class="sr-only">Hotel information</h2>
            <div class="mt-6">
                <h3 class="sr-only">Reviews</h3>
                <div class="flex items-center">
                    <div class="flex items-center">
                        <!-- Active: "text-gray-900", Default: "text-gray-200" -->
                        <svg class="size-5 shrink-0 text-gray-900" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z" clip-rule="evenodd" />
                        </svg>
                        <svg class="size-5 shrink-0 text-gray-900" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z" clip-rule="evenodd" />
                        </svg>
                        <svg class="size-5 shrink-0 text-gray-900" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z" clip-rule="evenodd" />
                        </svg>
                        <svg class="size-5 shrink-0 text-gray-900" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z" clip-rule="evenodd" />
                        </svg>
                        <svg class="size-5 shrink-0 text-gray-200" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <p class="sr-only">4 out of 5 stars
                    </p>
                    <a href="#" class="ml-3 text-sm font-medium text-indigo-600 hover:text-indigo-500">117 reviews</a>
                </div>
            </div>

            <!-- Sizes -->
            <div class="mt-10">
                <h3 class="text-lg font-medium text-gray-900">Fasilitas</h3>
                <div class="grid grid-cols-3 mt-4 gap-x-2 gap-y-5">
                    <?php
                    $displayedFacilities = [];
                    foreach ($facilities as $facility):
                        if (!in_array($facility->facility_name, $displayedFacilities)):
                            $displayedFacilities[] = $facility->facility_name;
                    ?>
                            <div class="flex gap-x-1 items-center">
                                <i class="<?= $facility->icon ?> fa-lg"></i>
                                <p class="text-sm"><?= $facility->facility_name; ?></p>
                            </div>
                    <?php endif;
                    endforeach; ?>
                </div>
            </div>
        </div>

        <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pb-16 lg:pr-8 lg:pt-6">
            <div>
                <h3 class="sr-only">Description</h3>

                <div class="space-y-6">
                    <p class="text-base text-gray-900"><?= $hotel->description; ?></p>
                </div>
            </div>
            <div class="mt-10">
                <h3 class="text-lg font-medium text-gray-900">Room</h3>
                <div class="mt-4 flex flex-col gap-y-5">
                    <?php foreach ($rooms as $room): ?>
                        <a href="<?= site_url("guest/hotel/$hotelId/room/$room->room_id/reservation?check_in=$checkIn&check_out=$checkOut") ?>" class="relative block">
                            <div class="w-full h-48 p-4 rounded-lg shadow bg-gray-200 cursor-pointer text-gray-700">
                                <h1 class="text-2xl font-semibold"><?= $room->room_type; ?></h1>
                                <div class="flex gap-x-10">
                                    <div class="flex flex-col gap-y-3">
                                        <span class="flex gap-x-2 items-center">
                                            <i class="fa-solid fa-bed fa-lg"></i>
                                            <p class="text-lg"><?= $room->bed_name; ?></p>
                                        </span>
                                        <span class="flex gap-x-2 items-center">
                                            <i class="fa-solid fa-user fa-lg"></i>
                                            <p class="text-lg"><?= $room->capacity; ?></p>
                                        </span>
                                    </div>
                                    <ul class="grid grid-cols-4 items-start gap-x-4 gap-y-3">
                                        <?php
                                        foreach ($facilities as $facility):
                                            if ($room->room_id === $facility->room_id):
                                        ?>
                                                <li class="flex gap-x-2 items-center">
                                                    <i class="<?= $facility->icon ?> fa-lg"></i>
                                                    <p class="text-sm"><?= $facility->facility_name; ?></p>
                                                </li>
                                        <?php endif;
                                        endforeach; ?>
                                    </ul>
                                </div>
                                <div class="flex mt-5 justify-between items-center bg-orange-300">
                                    <h2 class="text-lg">IDR <?= number_format($room->price); ?></h2>
                                    <a href="<?= site_url("guest/cart/room/$room->room_id/add?check_in=$checkIn&check_out=$checkOut") ?>" class="px-4 py-2 bg-blue-400 rounded-md text-white">Tambah Keranjang</a>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>
