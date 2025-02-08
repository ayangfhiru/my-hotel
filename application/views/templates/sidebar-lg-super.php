<aside
    class="sidebar-wrapper fixed top-0 z-30 block h-full w-[308px] bg-white dark:bg-darkblack-600 sm:hidden xl:block">
    <div
        class="sidebar-header relative z-30 flex h-[108px] w-full items-center border-b border-r border-b-[#F7F7F7] border-r-[#F7F7F7] pl-[50px] dark:border-darkblack-400">
        <a href="index.html">
            <img
                src="<?= base_url() ?>assets/images/logo/logo-color.svg"
                class="block dark:hidden"
                alt="logo" />
            <img
                src="<?= base_url() ?>assets/images/logo/logo-white.svg"
                class="hidden dark:block"
                alt="logo" />
        </a>
        <button
            type="button"
            class="drawer-btn absolute right-0 top-auto"
            title="Ctrl+b">
            <span>
                <svg
                    width="16"
                    height="40"
                    viewBox="0 0 16 40"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0 10C0 4.47715 4.47715 0 10 0H16V40H10C4.47715 40 0 35.5228 0 30V10Z"
                        fill="#22C55E" />
                    <path
                        d="M10 15L6 20.0049L10 25.0098"
                        stroke="#ffffff"
                        stroke-width="1.2"
                        stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </span>
        </button>
    </div>
    <div
        class="sidebar-body overflow-style-none relative z-30 h-screen w-full overflow-y-scroll pb-[200px] pl-[48px] pt-[14px]">
        <div class="nav-wrapper mb-[36px] pr-[50px]">
            <div class="item-wrapper mb-5">
                <h4
                    class="border-b border-bgray-200 text-sm font-medium leading-7 text-bgray-700 dark:border-darkblack-400 dark:text-bgray-50">
                    Menu
                </h4>
                <ul class="mt-2.5">
                    <!-- Dashboards -->
                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2.5">
                                    <span class="item-ico">
                                        <svg
                                            width="18"
                                            height="21"
                                            viewBox="0 0 18 21"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                class="path-1"
                                                d="M0 8.84719C0 7.99027 0.366443 7.17426 1.00691 6.60496L6.34255 1.86217C7.85809 0.515019 10.1419 0.515019 11.6575 1.86217L16.9931 6.60496C17.6336 7.17426 18 7.99027 18 8.84719V17C18 19.2091 16.2091 21 14 21H4C1.79086 21 0 19.2091 0 17V8.84719Z"
                                                fill="#1A202C" />
                                            <path
                                                class="path-2"
                                                d="M5 17C5 14.7909 6.79086 13 9 13C11.2091 13 13 14.7909 13 17V21H5V17Z"
                                                fill="#22C55E" />
                                        </svg>
                                    </span>
                                    <span
                                        class="item-text text-lg font-medium leading-none">Dashboards</span>
                                </div>
                                <span>
                                    <svg
                                        width="6"
                                        height="12"
                                        viewBox="0 0 6 12"
                                        fill="none"
                                        class="fill-current"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            fill="currentColor"
                                            d="M0.531506 0.414376C0.20806 0.673133 0.155619 1.1451 0.414376 1.46855L4.03956 6.00003L0.414376 10.5315C0.155618 10.855 0.208059 11.3269 0.531506 11.5857C0.854952 11.8444 1.32692 11.792 1.58568 11.4685L5.58568 6.46855C5.80481 6.19464 5.80481 5.80542 5.58568 5.53151L1.58568 0.531506C1.32692 0.20806 0.854953 0.155619 0.531506 0.414376Z" />
                                    </svg>
                                </span>
                            </div>
                        </a>
                        <ul
                            class="sub-menu ml-2.5 mt-[22px] border-l border-success-100 pl-5">
                            <li>
                                <a
                                    href="index.html"
                                    class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Dashboard Default</a>
                            </li>
                            <li>
                                <a
                                    href="index-2.html"
                                    class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Dashboard Two</a>
                            </li>
                            <li>
                                <a
                                    href="statistics.html"
                                    class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Statistics</a>
                            </li>
                            <li>
                                <a
                                    href="analytics.html"
                                    class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Analytics</a>
                            </li>
                            <li>
                                <a
                                    href="home.html"
                                    class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Home</a>
                            </li>
                        </ul>
                    </li>

                    <!-- User -->
                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2.5">
                                    <span class="item-ico">
                                        <svg
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <ellipse
                                                cx="11.7778"
                                                cy="17.5555"
                                                rx="7.77778"
                                                ry="4.44444"
                                                class="path-1"
                                                fill="#1A202C" />
                                            <circle
                                                class="path-2"
                                                cx="11.7778"
                                                cy="6.44444"
                                                r="4.44444"
                                                fill="#22C55E" />
                                        </svg>
                                    </span>
                                    <span
                                        class="item-text text-lg font-medium leading-none">Users</span>
                                </div>
                                <span>
                                    <svg
                                        width="6"
                                        height="12"
                                        viewBox="0 0 6 12"
                                        fill="none"
                                        class="fill-current"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            fill="currentColor"
                                            d="M0.531506 0.414376C0.20806 0.673133 0.155619 1.1451 0.414376 1.46855L4.03956 6.00003L0.414376 10.5315C0.155618 10.855 0.208059 11.3269 0.531506 11.5857C0.854952 11.8444 1.32692 11.792 1.58568 11.4685L5.58568 6.46855C5.80481 6.19464 5.80481 5.80542 5.58568 5.53151L1.58568 0.531506C1.32692 0.20806 0.854953 0.155619 0.531506 0.414376Z" />
                                    </svg>
                                </span>
                            </div>
                        </a>
                        <ul
                            class="sub-menu ml-2.5 mt-[22px] border-l border-success-100 pl-5">
                            <li>
                                <a
                                    href="<?= site_url('users') ?>"
                                    class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">List User</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Assets -->
                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2.5">
                                    <span class="item-ico">
                                        <svg
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1.57666 3.61499C1.57666 2.51042 2.47209 1.61499 3.57666 1.61499H8.5C9.60456 1.61499 10.5 2.51042 10.5 3.61499V8.53833C10.5 9.64289 9.60456 10.5383 8.49999 10.5383H3.57666C2.47209 10.5383 1.57666 9.64289 1.57666 8.53832V3.61499Z"
                                                fill="#1A202C"
                                                class="path-1" />
                                            <path
                                                d="M13.5 15.5383C13.5 14.4338 14.3954 13.5383 15.5 13.5383H20.4233C21.5279 13.5383 22.4233 14.4338 22.4233 15.5383V20.4617C22.4233 21.5662 21.5279 22.4617 20.4233 22.4617H15.5C14.3954 22.4617 13.5 21.5662 13.5 20.4617V15.5383Z"
                                                fill="#1A202C"
                                                class="path-1" />
                                            <circle
                                                cx="6.03832"
                                                cy="18"
                                                r="4.46166"
                                                fill="#1A202C"
                                                class="path-1" />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M18 2C18.4142 2 18.75 2.33579 18.75 2.75V5.25H21.25C21.6642 5.25 22 5.58579 22 6C22 6.41421 21.6642 6.75 21.25 6.75H18.75V9.25C18.75 9.66421 18.4142 10 18 10C17.5858 10 17.25 9.66421 17.25 9.25V6.75H14.75C14.3358 6.75 14 6.41421 14 6C14 5.58579 14.3358 5.25 14.75 5.25H17.25V2.75C17.25 2.33579 17.5858 2 18 2Z"
                                                fill="#22C55E"
                                                class="path-2" />
                                        </svg>
                                    </span>
                                    <span
                                        class="item-text text-lg font-medium leading-none">Assets</span>
                                </div>
                                <span>
                                    <svg
                                        width="6"
                                        height="12"
                                        viewBox="0 0 6 12"
                                        fill="none"
                                        class="fill-current"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            fill="currentColor"
                                            d="M0.531506 0.414376C0.20806 0.673133 0.155619 1.1451 0.414376 1.46855L4.03956 6.00003L0.414376 10.5315C0.155618 10.855 0.208059 11.3269 0.531506 11.5857C0.854952 11.8444 1.32692 11.792 1.58568 11.4685L5.58568 6.46855C5.80481 6.19464 5.80481 5.80542 5.58568 5.53151L1.58568 0.531506C1.32692 0.20806 0.854953 0.155619 0.531506 0.414376Z" />
                                    </svg>
                                </span>
                            </div>
                        </a>
                        <ul
                            class="sub-menu ml-2.5 mt-[22px] border-l border-success-100 pl-5">
                            <li>
                                <a
                                    href="<?= site_url('beds') ?>"
                                    class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Beds</a>
                            </li>
                            <li>
                                <a
                                    href="<?= site_url('facilities') ?>"
                                    class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Facilities</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Hotel -->
                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="<?= site_url('hotel') ?>">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2.5">
                                    <span class="item-ico">
                                        <svg
                                            width="18"
                                            height="21"
                                            viewBox="0 0 18 21"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                class="path-1"
                                                d="M0 8.84719C0 7.99027 0.366443 7.17426 1.00691 6.60496L6.34255 1.86217C7.85809 0.515019 10.1419 0.515019 11.6575 1.86217L16.9931 6.60496C17.6336 7.17426 18 7.99027 18 8.84719V17C18 19.2091 16.2091 21 14 21H4C1.79086 21 0 19.2091 0 17V8.84719Z"
                                                fill="#1A202C" />
                                            <path
                                                class="path-2"
                                                d="M5 17C5 14.7909 6.79086 13 9 13C11.2091 13 13 14.7909 13 17V21H5V17Z"
                                                fill="#22C55E" />
                                        </svg>
                                    </span>
                                    <span
                                        class="item-text text-lg font-medium leading-none">Hotel</span>
                                </div>
                            </div>
                        </a>
                    </li>

                    <!-- Schedule -->
                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="<?= site_url('schedule') ?>">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2.5">
                                    <span class="item-ico">
                                        <svg
                                            width="18"
                                            height="20"
                                            viewBox="0 0 18 20"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M18 16V6C18 3.79086 16.2091 2 14 2H4C1.79086 2 0 3.79086 0 6V16C0 18.2091 1.79086 20 4 20H14C16.2091 20 18 18.2091 18 16Z"
                                                fill="#1A202C"
                                                class="path-1" />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M4.25 8C4.25 7.58579 4.58579 7.25 5 7.25H13C13.4142 7.25 13.75 7.58579 13.75 8C13.75 8.41421 13.4142 8.75 13 8.75H5C4.58579 8.75 4.25 8.41421 4.25 8Z"
                                                fill="#22C55E"
                                                class="path-2" />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M4.25 12C4.25 11.5858 4.58579 11.25 5 11.25H13C13.4142 11.25 13.75 11.5858 13.75 12C13.75 12.4142 13.4142 12.75 13 12.75H5C4.58579 12.75 4.25 12.4142 4.25 12Z"
                                                fill="#22C55E"
                                                class="path-2" />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M4.25 16C4.25 15.5858 4.58579 15.25 5 15.25H9C9.41421 15.25 9.75 15.5858 9.75 16C9.75 16.4142 9.41421 16.75 9 16.75H5C4.58579 16.75 4.25 16.4142 4.25 16Z"
                                                fill="#22C55E"
                                                class="path-2" />
                                            <path
                                                d="M11 0H7C5.89543 0 5 0.895431 5 2C5 3.10457 5.89543 4 7 4H11C12.1046 4 13 3.10457 13 2C13 0.895431 12.1046 0 11 0Z"
                                                fill="#22C55E"
                                                class="path-2" />
                                        </svg>
                                    </span>
                                    <span
                                        class="item-text text-lg font-medium leading-none">Schedule</span>
                                </div>
                            </div>
                        </a>
                    </li>

                    <!-- Statistic -->
                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="statistics.html">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2.5">
                                    <span class="item-ico">
                                        <svg
                                            width="20"
                                            height="20"
                                            viewBox="0 0 20 20"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M18 11C18 15.9706 13.9706 20 9 20C4.02944 20 0 15.9706 0 11C0 6.02944 4.02944 2 9 2C13.9706 2 18 6.02944 18 11Z"
                                                fill="#1A202C"
                                                class="path-1" />
                                            <path
                                                d="M19.8025 8.01277C19.0104 4.08419 15.9158 0.989557 11.9872 0.197453C10.9045 -0.0208635 10 0.89543 10 2V8C10 9.10457 10.8954 10 12 10H18C19.1046 10 20.0209 9.09555 19.8025 8.01277Z"
                                                fill="#22C55E"
                                                class="path-2" />
                                        </svg>
                                    </span>
                                    <span
                                        class="item-text text-lg font-medium leading-none">Statistics</span>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="<?= site_url('payments') ?>">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2.5">
                                    <span class="item-ico">
                                        <svg
                                            width="20"
                                            height="20"
                                            viewBox="0 0 20 20"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M0 4C0 1.79086 1.79086 0 4 0H16C18.2091 0 20 1.79086 20 4V16C20 18.2091 18.2091 20 16 20H4C1.79086 20 0 18.2091 0 16V4Z"
                                                fill="#1A202C"
                                                class="path-1" />
                                            <path
                                                d="M14 9C12.8954 9 12 9.89543 12 11L12 13C12 14.1046 12.8954 15 14 15C15.1046 15 16 14.1046 16 13V11C16 9.89543 15.1046 9 14 9Z"
                                                fill="#22C55E"
                                                class="path-2" />
                                            <path
                                                d="M6 5C4.89543 5 4 5.89543 4 7L4 13C4 14.1046 4.89543 15 6 15C7.10457 15 8 14.1046 8 13L8 7C8 5.89543 7.10457 5 6 5Z"
                                                fill="#22C55E"
                                                class="path-2" />
                                        </svg>
                                    </span>
                                    <span
                                        class="item-text text-lg font-medium leading-none">Payments</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="my-wallet.html">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2.5">
                                    <span class="item-ico">
                                        <svg
                                            width="20"
                                            height="18"
                                            viewBox="0 0 20 18"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M20 4C20 1.79086 18.2091 0 16 0H4C1.79086 0 0 1.79086 0 4V14C0 16.2091 1.79086 18 4 18H16C18.2091 18 20 16.2091 20 14V4Z"
                                                fill="#1A202C"
                                                class="path-1" />
                                            <path
                                                d="M6 9C6 7.34315 4.65685 6 3 6H0V12H3C4.65685 12 6 10.6569 6 9Z"
                                                fill="#22C55E"
                                                class="path-2" />
                                        </svg>
                                    </span>
                                    <span
                                        class="item-text text-lg font-medium leading-none">My Wallet</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="messages.html">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2.5">
                                    <span class="item-ico">
                                        <svg
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.8889 22C13.4278 22 14.737 21.0724 15.2222 19.7778H8.55554C9.04075 21.0724 10.35 22 11.8889 22Z"
                                                fill="#22C55E"
                                                class="path-2" />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M13.7662 2.83781C13.3045 2.32351 12.6345 2 11.8889 2C10.4959 2 9.36673 3.12921 9.36673 4.52216V4.6374C6.98629 5.45244 5.224 7.38959 4.95607 9.75021L4.4592 14.1281C4.36971 14.9165 4.03716 15.6684 3.49754 16.3024C2.27862 17.7343 3.43826 19.7778 5.46979 19.7778H18.308C20.3395 19.7778 21.4992 17.7343 20.2802 16.3024C19.7406 15.6684 19.4081 14.9165 19.3186 14.1281L18.8217 9.75021C18.8148 9.68916 18.8068 9.6284 18.7979 9.56793C18.3712 9.70421 17.9164 9.77778 17.4444 9.77778C14.9898 9.77778 13 7.78793 13 5.33333C13 4.40827 13.2826 3.54922 13.7662 2.83781Z"
                                                fill="#1A202C"
                                                class="path-1" />
                                            <circle
                                                cx="17.4444"
                                                cy="5.33333"
                                                r="3.33333"
                                                fill="#22C55E"
                                                class="path-2" />
                                        </svg>
                                    </span>
                                    <span
                                        class="item-text text-lg font-medium leading-none">Inbox</span>
                                </div>
                                <div class="flex items-center space-x-2.5">
                                    <!--edit-->
                                    <span>
                                        <svg
                                            width="10"
                                            height="11"
                                            viewBox="0 0 10 11"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M0.879751 10.0038L3.16823 9.67657C3.49833 9.62937 3.80424 9.47626 4.04003 9.24024L8.45886 4.81709C8.45886 4.81709 7.36911 4.81709 6.27936 3.72628C5.18961 2.63546 5.18961 1.54465 5.18961 1.54465L0.770776 5.9678C0.534986 6.20382 0.382033 6.51002 0.334876 6.84045L0.00795056 9.13116C-0.0646994 9.64021 0.371201 10.0765 0.879751 10.0038Z"
                                                fill="#1A202C" />
                                            <path
                                                opacity="0.4"
                                                d="M9.5487 1.5446L8.45895 0.453784C7.8571 -0.148657 6.8813 -0.148657 6.27945 0.453784L5.1897 1.5446C5.1897 1.5446 5.1897 2.63542 6.27945 3.72623C7.3692 4.81705 8.45895 4.81705 8.45895 4.81705L9.5487 3.72623C10.1506 3.12379 10.1506 2.14704 9.5487 1.5446Z"
                                                fill="#1A202C" />
                                        </svg>
                                    </span>
                                    <!--edit-->
                                    <div>
                                        <img
                                            src="<?= base_url() ?>assets/images/avatar/profile-xs.png"
                                            alt="profile" />
                                    </div>
                                    <!--counter-->
                                    <div
                                        class="flex h-5 w-5 items-center justify-center rounded-full bg-success-300">
                                        <span class="text-[10px] font-semibold text-white">5</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="integrations.html">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2.5">
                                    <span class="item-ico">
                                        <svg
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1.57666 3.61499C1.57666 2.51042 2.47209 1.61499 3.57666 1.61499H8.5C9.60456 1.61499 10.5 2.51042 10.5 3.61499V8.53833C10.5 9.64289 9.60456 10.5383 8.49999 10.5383H3.57666C2.47209 10.5383 1.57666 9.64289 1.57666 8.53832V3.61499Z"
                                                fill="#1A202C"
                                                class="path-1" />
                                            <path
                                                d="M13.5 15.5383C13.5 14.4338 14.3954 13.5383 15.5 13.5383H20.4233C21.5279 13.5383 22.4233 14.4338 22.4233 15.5383V20.4617C22.4233 21.5662 21.5279 22.4617 20.4233 22.4617H15.5C14.3954 22.4617 13.5 21.5662 13.5 20.4617V15.5383Z"
                                                fill="#1A202C"
                                                class="path-1" />
                                            <circle
                                                cx="6.03832"
                                                cy="18"
                                                r="4.46166"
                                                fill="#1A202C"
                                                class="path-1" />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M18 2C18.4142 2 18.75 2.33579 18.75 2.75V5.25H21.25C21.6642 5.25 22 5.58579 22 6C22 6.41421 21.6642 6.75 21.25 6.75H18.75V9.25C18.75 9.66421 18.4142 10 18 10C17.5858 10 17.25 9.66421 17.25 9.25V6.75H14.75C14.3358 6.75 14 6.41421 14 6C14 5.58579 14.3358 5.25 14.75 5.25H17.25V2.75C17.25 2.33579 17.5858 2 18 2Z"
                                                fill="#22C55E"
                                                class="path-2" />
                                        </svg>
                                    </span>
                                    <span
                                        class="item-text text-lg font-medium leading-none">Integrations</span>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2.5">
                                    <span class="item-ico">
                                        <svg
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <ellipse
                                                cx="11.7778"
                                                cy="17.5555"
                                                rx="7.77778"
                                                ry="4.44444"
                                                class="path-1"
                                                fill="#1A202C" />
                                            <circle
                                                class="path-2"
                                                cx="11.7778"
                                                cy="6.44444"
                                                r="4.44444"
                                                fill="#22C55E" />
                                        </svg>
                                    </span>
                                    <span
                                        class="item-text text-lg font-medium leading-none">User</span>
                                </div>
                                <span>
                                    <svg
                                        width="6"
                                        height="12"
                                        viewBox="0 0 6 12"
                                        fill="none"
                                        class="fill-current"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            fill="currentColor"
                                            d="M0.531506 0.414376C0.20806 0.673133 0.155619 1.1451 0.414376 1.46855L4.03956 6.00003L0.414376 10.5315C0.155618 10.855 0.208059 11.3269 0.531506 11.5857C0.854952 11.8444 1.32692 11.792 1.58568 11.4685L5.58568 6.46855C5.80481 6.19464 5.80481 5.80542 5.58568 5.53151L1.58568 0.531506C1.32692 0.20806 0.854953 0.155619 0.531506 0.414376Z" />
                                    </svg>
                                </span>
                            </div>
                        </a>
                    </li>

                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="calender.html">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2.5">
                                    <span class="item-ico">
                                        <svg
                                            width="18"
                                            height="21"
                                            viewBox="0 0 18 21"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M0 6.5C0 4.29086 1.79086 2.5 4 2.5H14C16.2091 2.5 18 4.29086 18 6.5V8V17C18 19.2091 16.2091 21 14 21H4C1.79086 21 0 19.2091 0 17V8V6.5Z"
                                                fill="#1A202C"
                                                class="path-1" />
                                            <path
                                                d="M14 2.5H4C1.79086 2.5 0 4.29086 0 6.5V8H18V6.5C18 4.29086 16.2091 2.5 14 2.5Z"
                                                fill="#22C55E"
                                                class="path-2" />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M5 0.25C5.41421 0.25 5.75 0.585786 5.75 1V4C5.75 4.41421 5.41421 4.75 5 4.75C4.58579 4.75 4.25 4.41421 4.25 4V1C4.25 0.585786 4.58579 0.25 5 0.25ZM13 0.25C13.4142 0.25 13.75 0.585786 13.75 1V4C13.75 4.41421 13.4142 4.75 13 4.75C12.5858 4.75 12.25 4.41421 12.25 4V1C12.25 0.585786 12.5858 0.25 13 0.25Z"
                                                fill="#1A202C"
                                                class="path-2" />
                                            <circle cx="9" cy="14" r="1" fill="#22C55E" />
                                            <circle
                                                cx="13"
                                                cy="14"
                                                r="1"
                                                fill="#22C55E"
                                                class="path-2" />
                                            <circle
                                                cx="5"
                                                cy="14"
                                                r="1"
                                                fill="#22C55E"
                                                class="path-2" />
                                        </svg>
                                    </span>
                                    <span
                                        class="item-text text-lg font-medium leading-none">Calender</span>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li class="item py-[11px] text-bgray-900 dark:text-white">
                        <a href="history.html">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2.5">
                                    <span class="item-ico">
                                        <svg
                                            width="18"
                                            height="21"
                                            viewBox="0 0 18 21"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.5 12.5C17.5 17.1944 13.6944 21 9 21C4.30558 21 0.5 17.1944 0.5 12.5C0.5 7.80558 4.30558 4 9 4C13.6944 4 17.5 7.80558 17.5 12.5Z"
                                                fill="#1A202C"
                                                class="path-1" />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M8.99995 1.75C8.02962 1.75 7.09197 1.88462 6.20407 2.13575C5.80549 2.24849 5.39099 2.01676 5.27826 1.61818C5.16553 1.21961 5.39725 0.805108 5.79583 0.692376C6.81525 0.404046 7.89023 0.25 8.99995 0.25C10.1097 0.25 11.1846 0.404046 12.2041 0.692376C12.6026 0.805108 12.8344 1.21961 12.7216 1.61818C12.6089 2.01676 12.1944 2.24849 11.7958 2.13575C10.9079 1.88462 9.97028 1.75 8.99995 1.75Z"
                                                fill="#22C55E"
                                                class="path-2" />
                                            <path
                                                d="M11 13C11 14.1046 10.1046 15 9 15C7.89543 15 7 14.1046 7 13C7 11.8954 7.89543 11 9 11C10.1046 11 11 11.8954 11 13Z"
                                                fill="#22C55E"
                                                class="path-2" />
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M9 7.25C9.41421 7.25 9.75 7.58579 9.75 8V12C9.75 12.4142 9.41421 12.75 9 12.75C8.58579 12.75 8.25 12.4142 8.25 12V8C8.25 7.58579 8.58579 7.25 9 7.25Z"
                                                fill="#22C55E"
                                                class="path-2" />
                                        </svg>
                                    </span>
                                    <span
                                        class="item-text text-lg font-medium leading-none">History</span>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <?php $this->load->view('templates/sidebar-other'); ?>
        </div>
        <div class="upgrade-wrapper mb-[26px] h-[172px] w-full pr-[24px]">
            <div
                class="upgrade-banner relative h-full w-full rounded-lg"
                style="background-image: url(./assets/images/bg/upgrade-bg.png)">
                <div
                    style="left: calc(50% - 20px); top: -20px"
                    class="absolute flex h-10 w-10 items-center justify-center rounded-full border border-white bg-success-300">
                    <span>
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14 12.75C14 11.7835 13.1046 11 12 11C10.8954 11 10 11.7835 10 12.75C10 13.7165 10.8954 14.5 12 14.5C13.1046 14.5 14 15.2835 14 16.25C14 17.2165 13.1046 18 12 18C10.8954 18 10 17.2165 10 16.25"
                                stroke="white"
                                stroke-width="1.5"
                                stroke-linecap="round" />
                            <path
                                d="M12 9.5V11"
                                stroke="white"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M12 18V19.5"
                                stroke="white"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M5.63246 11.1026C6.44914 8.65258 8.74197 7 11.3246 7H12.6754C15.258 7 17.5509 8.65258 18.3675 11.1026L19.3675 14.1026C20.6626 17.9878 17.7708 22 13.6754 22H10.3246C6.22921 22 3.33739 17.9878 4.63246 14.1026L5.63246 11.1026Z"
                                stroke="white"
                                stroke-width="1.5"
                                stroke-linejoin="round" />
                            <path
                                d="M14.0859 7L9.91411 7L8.51303 5.39296C7.13959 3.81763 8.74185 1.46298 10.7471 2.10985L11.6748 2.40914C11.8861 2.47728 12.1139 2.47728 12.3252 2.40914L13.2529 2.10985C15.2582 1.46298 16.8604 3.81763 15.487 5.39296L14.0859 7Z"
                                stroke="white"
                                stroke-width="1.5"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                </div>
                <h1 class="mb-2 pt-8 text-center text-xl font-bold text-white">
                    Unlimited Cashback
                </h1>
                <p
                    class="mb-2 px-7 text-center text-sm leading-5 text-white opacity-[0.5]">
                    Instant 2% back on all your spend to your account.
                </p>
                <div class="flex justify-center">
                    <a href="#">
                        <div
                            class="flex h-[36px] w-[134px] justify-center rounded-lg bg-success-300 transition duration-300 ease-in-out hover:bg-success-400">
                            <div class="flex items-center space-x-1.5">
                                <span class="text-sm font-semibold text-white">Upgrade Now</span>
                                <span>
                                    <svg
                                        width="12"
                                        height="8"
                                        viewBox="0 0 12 8"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M1.33301 4H10.6663"
                                            stroke="white"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M8 6.66667L10.6667 4"
                                            stroke="white"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M8 1.33325L10.6667 3.99992"
                                            stroke="white"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="copy-write-text">
            <p class="text-sm text-[#969BA0]">© 2023 All Rights Reserved</p>
            <p class="text-sm font-medium text-bgray-700">
                Made with ❤️ by
                <a
                    href="#"
                    target="_blank"
                    class="border-b font-semibold hover:text-blue-600">QuomodoTheme</a>
            </p>
        </div>
    </div>
</aside>
