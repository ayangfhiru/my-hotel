<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/top-layout');
?>

<div class="container text-stockColor">
    <!-- Hero -->
    <div class="relative isolate px-6 lg:px-8">
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
        <div class="mx-auto max-w-2xl py-32">
            <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                <div class="relative rounded-full px-3 py-1 text-sm/6 text-gray-200 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                    Announcing our next round of funding. <a href="#" class="font-semibold text-indigo-600"><span class="absolute inset-0" aria-hidden="true"></span>Read more <span aria-hidden="true">&rarr;</span></a>
                </div>
            </div>
            <div class="text-center">
                <h1 class="text-balance text-5xl font-semibold tracking-tight text-gray-200 sm:text-7xl">Data to enrich your online business</h1>
                <p class="mt-8 text-pretty text-lg font-medium text-gray-100 sm:text-xl/8">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat.</p>
            </div>
        </div>
        <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
            <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
    </div>
    <!-- Content -->
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            <?php foreach ($hotels as $hotel): ?>
                <div class="group relative">
                    <img src="<?= $hotel->thumbnail ? site_url("assets/images/thumbnail/$hotel->thumbnail") : site_url('assets/images/thumbnail/default.jpg') ?>" alt="<?= $hotel->name ?>" class="aspect-square w-full rounded-md bg-gray-700 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80">
                    <div class="mt-4 flex justify-between">
                        <div>
                            <h3 class="text-sm text-gray-700">
                                <?= form_open(site_url('guest/hotel/set')); ?>
                                <input type="hidden" name="hotel_id" value="<?= $hotel->hotel_id ?>">
                                <?php if (isset($checkIn)): ?>
                                    <input type="hidden" name="check_in" value="<?= $checkIn ?>">
                                <?php endif; ?>
                                <?php if (isset($checkOut)): ?>
                                    <input type="hidden" name="check_out" value="<?= $checkOut ?>">
                                <?php endif; ?>
                                <button type="submit" class="text-sm text-gray-200">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    <?= $hotel->name; ?>
                                </button>
                                <?= form_close(); ?>
                            </h3>
                            <p class="mt-1 text-sm">
                                <i class="fa-solid fa-location-dot"></i>
                                <?= $hotel->address; ?>
                            </p>
                        </div>
                        <p class="text-sm font-medium text-gray-200"><?= $hotel->city ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php $this->load->view('templates/bottom-layout'); ?>
