<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/top-layout-admin');
?>

<div class="flex flex-col space-y-20 2xl:flex-row 2xl:space-x-11">
    <aside
        class="w-full rounded-lg bg-white px-12 pb-7 dark:bg-darkblack-600 2xl:w-[382px]">
        <header
            class="-mt-8 flex flex-col items-center pb-7 text-center">
            <img
                src="<?= base_url('assets/images/avatar/user-1.png') ?>"
                class="rounded-lg w-16 h-16"
                alt="" />
            <h3
                class="mt-4 text-xl font-bold text-bgray-700 dark:text-white">
                <?= $hotel->name; ?>
            </h3>
            <p
                class="text-base font-medium text-bgray-500 dark:text-white">
                <?= $hotel->address; ?> • <?= $hotel->city; ?>, Indonesia • 2 days ago
            </p>
            <div class="mt-6 flex gap-4">
                <a href="<?= site_url("hotel/$hotel->hotel_id/edit") ?>"
                    class="group inline-flex h-10 w-10 items-center justify-center rounded-full border border-gray-500 bg-transparent hover:border-transparent hover:bg-success-300">
                    <i class="fa-light fa-pen-to-square fa-xl text-[#A0AEC0] group-hover:text-white"></i>
                </a>
                <button
                    class="group inline-flex h-10 w-10 items-center justify-center rounded-full border border-gray-500 bg-transparent hover:border-transparent hover:bg-success-300">
                    <svg
                        class="stroke-bgray-500 group-hover:stroke-white"
                        width="20"
                        height="21"
                        viewBox="0 0 20 21"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4 13.5659C5.65685 13.5659 7 12.2228 7 10.5659C7 8.90906 5.65685 7.56592 4 7.56592C2.34315 7.56592 1 8.90906 1 10.5659C1 12.2228 2.34315 13.5659 4 13.5659Z"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M16 7.56592C17.6569 7.56592 19 6.22277 19 4.56592C19 2.90906 17.6569 1.56592 16 1.56592C14.3431 1.56592 13 2.90906 13 4.56592C13 6.22277 14.3431 7.56592 16 7.56592Z"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M16 19.5659C17.6569 19.5659 19 18.2228 19 16.5659C19 14.9091 17.6569 13.5659 16 13.5659C14.3431 13.5659 13 14.9091 13 16.5659C13 18.2228 14.3431 19.5659 16 19.5659Z"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M6.69995 9.26572L13.3 5.86572"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M6.69995 11.8657L13.3 15.2657"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </header>
        <div
            class="space-y-6 border-b border-t border-gray-200 py-7 dark:border-darkblack-400">
            <h2 class="text-base font-bold text-bgray-900 dark:text-white xl:text-2xl">
                Description
            </h2>
            <ul class="space-y-2.5">
                <div class="text-gray-500 dark:text-white">
                    <?= $hotel->description ?>
                </div>
            </ul>
        </div>
        <div class="pt-6">
            <div class="flex-1 block">
                <div
                    class="h-full w-full rounded-lg bg-white px-5 py-6 dark:bg-darkblack-600">
                    <div class="mb-8 flex items-center justify-between">
                        <h2
                            class="text-base font-bold text-bgray-900 dark:text-white xl:text-2xl">
                            List Rooms
                        </h2>
                        <span>
                            <svg
                                width="14"
                                height="4"
                                viewBox="0 0 14 4"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.33317 2.66659C2.70136 2.66659 2.99984 2.36811 2.99984 1.99992C2.99984 1.63173 2.70136 1.33325 2.33317 1.33325C1.96498 1.33325 1.6665 1.63173 1.6665 1.99992C1.6665 2.36811 1.96498 2.66659 2.33317 2.66659Z"
                                    stroke="#64748B"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M6.99967 2.66659C7.36786 2.66659 7.66634 2.36811 7.66634 1.99992C7.66634 1.63173 7.36786 1.33325 6.99967 1.33325C6.63148 1.33325 6.33301 1.63173 6.33301 1.99992C6.33301 2.36811 6.63148 2.66659 6.99967 2.66659Z"
                                    stroke="#64748B"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M11.6667 2.66659C12.0349 2.66659 12.3333 2.36811 12.3333 1.99992C12.3333 1.63173 12.0349 1.33325 11.6667 1.33325C11.2985 1.33325 11 1.63173 11 1.99992C11 2.36811 11.2985 2.66659 11.6667 2.66659Z"
                                    stroke="#64748B"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                    <div class="mb-10 grid grid-cols-2 xl:grid-cols-4 gap-x-3 gap-y-3">
                        <?php foreach ($rooms as $room):; ?>
                            <div
                                class="relative flex h-[128px] w-full items-center justify-center rounded-md bg-success-300 cursor-pointer">
                                <a href="<?= site_url("hotel/$hotel->hotel_id/room/$room->room_id/edit") ?>" class="block p-1 absolute top-0 right-0">
                                    <i class="fa-light fa-pen-to-square fa-lg text-bgray-900 dark:text-white"></i>
                                </a>
                                <div>
                                    <div class="mb-3 flex justify-center">
                                        <span>
                                            <svg
                                                width="40"
                                                height="40"
                                                viewBox="0 0 40 40"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <circle
                                                    opacity="0.5"
                                                    cx="20"
                                                    cy="20"
                                                    r="19.5"
                                                    class="stroke-white dark:stroke-bgray-900" />
                                                <path
                                                    opacity="0.4"
                                                    d="M21 16.86L21 14.3567C21 13.2506 20.1046 12.354 19 12.354L17.6667 12.354C17.2339 12.354 16.8129 12.2135 16.4667 11.9535L15.5333 11.2526C15.1871 10.9926 14.7661 10.8521 14.3333 10.8521L13 10.8521C11.8954 10.8521 11 11.7487 11 12.8547L11 16.86C11 17.966 11.8954 18.8626 13 18.8626L19 18.8626C20.1046 18.8626 21 17.966 21 16.86Z"
                                                    class="fill-white dark:fill-bgray-900" />
                                                <path
                                                    opacity="0.4"
                                                    d="M29 28.8758L29 26.3725C29 25.2665 28.1046 24.3699 27 24.3699L25.6667 24.3699C25.2339 24.3699 24.8129 24.2294 24.4667 23.9694L23.5333 23.2684C23.1871 23.0085 22.7661 22.8679 22.3333 22.8679L21 22.8679C19.8954 22.8679 19 23.7645 19 24.8706L19 28.8758C19 29.9819 19.8954 30.8785 21 30.8785L27 30.8785C28.1046 30.8785 29 29.9819 29 28.8758Z"
                                                    class="fill-white dark:fill-bgray-900" />
                                                <path
                                                    fill-rule="evenodd"
                                                    clip-rule="evenodd"
                                                    d="M22.25 14.8572C22.25 14.4424 22.5858 14.1062 23 14.1062L25 14.1062C26.5188 14.1062 27.75 15.339 27.75 16.8598L27.75 22.3671C27.75 22.7819 27.4142 23.1181 27 23.1181C26.5858 23.1181 26.25 22.7819 26.25 22.3671L26.25 16.8598C26.25 16.1686 25.6904 15.6082 25 15.6082L23 15.6082C22.5858 15.6082 22.25 15.272 22.25 14.8572ZM13 20.1141C13.4142 20.1141 13.75 20.4504 13.75 20.8651L13.75 24.8704C13.75 25.5617 14.3096 26.1221 15 26.1221L17 26.1221C17.4142 26.1221 17.75 26.4583 17.75 26.873C17.75 27.2878 17.4142 27.624 17 27.624L15 27.624C13.4812 27.624 12.25 26.3912 12.25 24.8704L12.25 20.8651C12.25 20.4504 12.5858 20.1141 13 20.1141Z"
                                                    class="fill-white dark:fill-bgray-900" />
                                            </svg>
                                        </span>
                                    </div>
                                    <p
                                        class="text-center text-2xl text-bgray-900 dark:text-white">
                                        <?= $room->room_type; ?>
                                    </p>
                                    <p
                                        class="text-center text-base font-bold text-bgray-900 dark:text-white">Rp
                                        <?= number_format($room->price); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-8 flex justify-center">
            <a href="<?= site_url("hotel/$hotel->hotel_id/room/create") ?>"
                class="modal-open rounded-lg bg-success-300 px-7 py-3 font-medium text-white transition duration-300 ease-in-out cursor-pointer hover:bg-success-400">
                Add Room
            </a>
        </div>
    </aside>
</div>

<?php $this->load->view('templates/bottom-layout-admin'); ?>
