<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/top-layout-admin');
?>

<div class="w-full 2xl:flex-1">
    <!-- Search -->
    <div
        class="mb-8 flex items-center rounded-lg bg-white p-4 dark:bg-darkblack-600">
        <div
            class="flex flex-1 items-center border-bgray-400 pl-4 dark:border-darkblack-400 xl:border-r">
            <span class="">
                <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                        stroke="#94A3B8"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path
                        d="M21 21L17 17"
                        stroke="#94A3B8"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </span>
            <input
                type="text"
                class="w-full border-0 focus:border-none focus:outline-none focus:ring-0 dark:bg-darkblack-600 dark:text-white"
                placeholder="Job Title, Company, or Keywords " />
        </div>
        <div class="relative">
            <div
                onclick="dateFilterAction('#locationSelect')"
                class="hidden items-center border-r border-bgray-400 pl-9 dark:border-darkblack-400 xl:flex">
                <span><svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M19.9092 10.448C19.9092 16.4935 11.9092 21.6753 11.9092 21.6753C11.9092 21.6753 3.90918 16.4935 3.90918 10.448C3.90918 8.38656 4.75203 6.40954 6.25233 4.95187C7.75262 3.4942 9.78745 2.67529 11.9092 2.67529C14.0309 2.67529 16.0657 3.4942 17.566 4.95187C19.0663 6.40954 19.9092 8.38656 19.9092 10.448Z"
                            stroke="#94A3B8"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M12 12.6753C13.3807 12.6753 14.5 11.556 14.5 10.1753C14.5 8.79458 13.3807 7.67529 12 7.67529C10.6193 7.67529 9.5 8.79458 9.5 10.1753C9.5 11.556 10.6193 12.6753 12 12.6753Z"
                            stroke="#94A3B8"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </span>
                <input
                    type="text"
                    class="border-0 focus:border-none focus:outline-none focus:ring-0 dark:bg-darkblack-600"
                    placeholder="Select Location " />
                <span class="pr-10"><svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6 9L12 15L18 9"
                            stroke="#94A3B8"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </span>
            </div>
            <div
                id="locationSelect"
                class="absolute right-0 top-full z-10 hidden w-full overflow-hidden rounded-lg bg-white shadow-lg dark:bg-darkblack-500">
                <ul>
                    <li
                        onclick="dateFilterAction('#locationSelect')"
                        class="cursor-pointer px-5 py-2 text-sm font-semibold text-bgray-900 hover:bg-bgray-100 dark:text-bgray-50 hover:dark:bg-darkblack-600">
                        Bangladesh
                    </li>
                    <li
                        onclick="dateFilterAction('#locationSelect')"
                        class="cursor-pointer px-5 py-2 text-sm font-semibold text-bgray-900 hover:bg-bgray-100 dark:text-bgray-50 hover:dark:bg-darkblack-600">
                        America
                    </li>
                    <li
                        onclick="dateFilterAction('#locationSelect')"
                        class="cursor-pointer px-5 py-2 text-sm font-semibold text-bgray-900 hover:bg-bgray-100 dark:text-bgray-50 hover:dark:bg-darkblack-600">
                        Thailand
                    </li>
                </ul>
            </div>
        </div>

        <div class="hidden pl-8 md:block">
            <button>
                <svg
                    width="16"
                    height="16"
                    viewBox="0 0 16 16"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M1.49999 1H14.5C14.644 1.05051 14.7745 1.13331 14.8816 1.24206C14.9887 1.35082 15.0695 1.48264 15.1177 1.62742C15.166 1.77221 15.1805 1.92612 15.1601 2.07737C15.1396 2.22861 15.0849 2.37318 15 2.5L9.99998 8V15L5.99999 12V8L0.999985 2.5C0.915076 2.37318 0.860321 2.22861 0.839913 2.07737C0.819506 1.92612 0.833987 1.77221 0.882249 1.62742C0.930511 1.48264 1.01127 1.35082 1.11835 1.24206C1.22542 1.13331 1.35597 1.05051 1.49999 1Z"
                        stroke="#94A3B8"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>
        <div class="hidden pl-10 md:block">
            <button
                class="rounded-lg bg-bgray-600 px-10 py-3 text-sm font-medium text-white dark:bg-darkblack-500">
                Search
            </button>
        </div>
    </div>

    <!-- List Hotel -->
    <div class="w-full overflow-x-scroll no-scrollbar">
        <table class="w-full">
            <tbody>
                <?php foreach ($hotels as $index => $hotel):; ?>
                    <tr class="<?= $index % 2 === 0 ? 'bg-white dark:bg-darkblack-600' : '' ?>">
                        <td
                            class="whitespace-nowrap rounded-l-lg p-4 text-sm font-medium">
                            <span>
                                <svg
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.0001 17.75L5.82808 20.995L7.00708 14.122L2.00708 9.25495L8.90708 8.25495L11.9931 2.00195L15.0791 8.25495L21.9791 9.25495L16.9791 14.122L18.1581 20.995L12.0001 17.75Z"
                                        fill="#F6A723"
                                        stroke="#F6A723"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                        </td>
                        <td
                            class="w-[400px] whitespace-nowrap py-4 text-sm text-gray-500 lg:w-auto">
                            <div class="flex items-center gap-5">
                                <div class="h-[64px] w-[64px]">
                                    <img
                                        class="h-full w-full rounded-lg object-cover"
                                        src="<?=
                                                $hotel->thumbnail === ''
                                                    ? base_url('assets/images/avatar/user-1.png')
                                                    : base_url('assets/images/avatar/user-1.png') ?>"
                                        alt="" />
                                </div>
                                <div class="flex-1">
                                    <h4
                                        class="text-lg font-bold text-bgray-900 dark:text-white">
                                        <?= $hotel->name; ?>
                                    </h4>
                                    <div>
                                        <span
                                            class="text-base font-medium text-bgray-700 dark:text-bgray-50"><?= $hotel->address; ?> • </span><span class="text-gray-500"><?= $hotel->city ?> • </span>
                                        <span class="text-gray-500">2 days ago</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td
                            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            <span
                                class="rounded-lg bg-success-50 px-3 py-1 text-sm font-medium text-success-300 dark:bg-darkblack-500">Full Time</span>
                        </td>
                        <td
                            class="whitespace-nowrap px-2 py-4 text-sm text-gray-500">
                            <span
                                class="text-am rounded-lg bg-bamber-50 px-3 py-1 text-sm font-medium text-bamber-500 dark:bg-darkblack-500">Senior Level</span>
                        </td>
                        <td
                            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            <a
                                href="<?= site_url("hotel/$hotel->hotel_id/show") ?>"
                                class="ml-6 flex items-center justify-center rounded-xl bg-success-300 px-11 py-3 font-semibold text-white transition duration-300 ease-in-out hover:bg-success-400">
                                Detail
                            </a>
                        </td>
                        <td
                            class="whitespace-nowrap rounded-r-lg py-4 pr-3 text-sm text-gray-500">
                            <button class="">
                                <svg
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12C4 12.5523 4.44772 13 5 13Z"
                                        stroke="#94A3B8"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z"
                                        stroke="#94A3B8"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12C18 12.5523 18.4477 13 19 13Z"
                                        stroke="#94A3B8"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $this->load->view('templates/bottom-layout-admin'); ?>
