<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/top-layout-admin');
?>

<div class="w-full rounded-lg bg-white px-[24px] py-[20px] dark:bg-darkblack-600"
    x-data="{ baseUrl: null, reqId: null }">
    <div class="flex flex-col space-y-5">
        <div class="flex h-[56px] w-full space-x-4">
            <div
                class="hidden h-full rounded-lg border border-transparent bg-bgray-100 px-[18px] focus-within:border-success-300 dark:bg-darkblack-500 sm:block sm:w-70">
                <div
                    class="flex h-full w-full items-center space-x-[15px]">
                    <span>
                        <svg
                            class="stroke-bgray-900 dark:stroke-white"
                            width="21"
                            height="22"
                            viewBox="0 0 21 22"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle
                                cx="9.80204"
                                cy="10.6761"
                                r="8.98856"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M16.0537 17.3945L19.5777 20.9094"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                    <label for="listSearch" class="w-full">
                        <input
                            type="text"
                            id="listSearch"
                            placeholder="Search by name, email, or others..."
                            class="search-input w-full border-none bg-bgray-100 px-0 text-sm tracking-wide text-bgray-600 placeholder:text-sm placeholder:font-medium placeholder:text-bgray-500 focus:outline-none focus:ring-0 dark:bg-darkblack-500" />
                    </label>
                </div>
            </div>
            <div class="relative h-full flex-1">
                <button
                    onclick="dateFilterAction('#table-filter')"
                    type="button"
                    class="flex h-full w-full items-center justify-center rounded-lg border border-bgray-300 bg-bgray-100 dark:border-darkblack-500 dark:bg-darkblack-500">
                    <div class="flex items-center space-x-3">
                        <span>
                            <svg
                                class="stroke-bgray-900 dark:stroke-success-400"
                                width="18"
                                height="17"
                                viewBox="0 0 18 17"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.55169 13.5022H1.25098"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M10.3623 3.80984H16.663"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M5.94797 3.75568C5.94797 2.46002 4.88981 1.40942 3.58482 1.40942C2.27984 1.40942 1.22168 2.46002 1.22168 3.75568C1.22168 5.05133 2.27984 6.10193 3.58482 6.10193C4.88981 6.10193 5.94797 5.05133 5.94797 3.75568Z"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M17.2214 13.4632C17.2214 12.1675 16.1641 11.1169 14.8591 11.1169C13.5533 11.1169 12.4951 12.1675 12.4951 13.4632C12.4951 14.7589 13.5533 15.8095 14.8591 15.8095C16.1641 15.8095 17.2214 14.7589 17.2214 13.4632Z"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                        <span class="text-base font-medium text-success-300">Filters</span>
                    </div>
                </button>
                <div
                    id="table-filter"
                    class="absolute right-0 top-[60px] z-10 hidden w-full overflow-hidden rounded-lg bg-white shadow-lg">
                    <ul>
                        <li
                            onclick="dateFilterAction('#table-filter')"
                            class="text-bgray-90 cursor-pointer px-5 py-2 text-sm font-semibold hover:bg-bgray-100">
                            January
                        </li>
                        <li
                            onclick="dateFilterAction('#table-filter')"
                            class="cursor-pointer px-5 py-2 text-sm font-semibold text-bgray-900 hover:bg-bgray-100">
                            February
                        </li>

                        <li
                            onclick="dateFilterAction('#table-filter')"
                            class="cursor-pointer px-5 py-2 text-sm font-semibold text-bgray-900 hover:bg-bgray-100">
                            March
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="filter-content w-full">
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-4">
                <div class="w-full">
                    <p
                        class="mb-2 text-base font-bold leading-[24px] text-bgray-900 dark:text-white">
                        Location
                    </p>
                    <div class="relative h-[56px] w-full">
                        <button
                            onclick="dateFilterAction('#province-filter')"
                            type="button"
                            class="relative flex h-full w-full items-center justify-between rounded-lg bg-bgray-100 px-4 dark:bg-darkblack-500">
                            <span class="text-base text-bgray-500">State or province</span>
                            <span>
                                <svg
                                    width="21"
                                    height="21"
                                    viewBox="0 0 21 21"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.58203 8.3186L10.582 13.3186L15.582 8.3186"
                                        stroke="#A0AEC0"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                        </button>
                        <div
                            id="province-filter"
                            class="absolute right-0 top-14 z-10 hidden w-full overflow-hidden rounded-lg bg-white shadow-lg dark:bg-darkblack-500">
                            <ul>
                                <li
                                    onclick="dateFilterAction('#province-filter')"
                                    class="text-bgray-90 cursor-pointer px-5 py-2 text-sm font-semibold hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                    January
                                </li>
                                <li
                                    onclick="dateFilterAction('#province-filter')"
                                    class="cursor-pointer px-5 py-2 text-sm font-semibold text-bgray-900 hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                    February
                                </li>

                                <li
                                    onclick="dateFilterAction('#province-filter')"
                                    class="cursor-pointer px-5 py-2 text-sm font-semibold text-bgray-900 hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                    March
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <p
                        class="mb-2 text-base font-bold leading-[24px] text-bgray-900 dark:text-white">
                        Amount Spent
                    </p>
                    <div class="relative h-[56px] w-full">
                        <button
                            onclick="dateFilterAction('#amount-filter')"
                            type="button"
                            class="relative flex h-full w-full items-center justify-between rounded-lg bg-bgray-100 px-4 dark:bg-darkblack-500">
                            <span class="text-base text-bgray-500">State or province</span>
                            <span>
                                <svg
                                    width="21"
                                    height="21"
                                    viewBox="0 0 21 21"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.58203 8.3186L10.582 13.3186L15.582 8.3186"
                                        stroke="#A0AEC0"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                        </button>
                        <div
                            id="amount-filter"
                            class="absolute right-0 top-14 z-10 hidden w-full overflow-hidden rounded-lg bg-white shadow-lg dark:bg-darkblack-500">
                            <ul>
                                <li
                                    onclick="dateFilterAction('#amount-filter')"
                                    class="text-bgray-90 cursor-pointer px-5 py-2 text-sm font-semibold hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                    January
                                </li>
                                <li
                                    onclick="dateFilterAction('#amount-filter')"
                                    class="cursor-pointer px-5 py-2 text-sm font-semibold text-bgray-900 hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                    February
                                </li>

                                <li
                                    onclick="dateFilterAction('#amount-filter')"
                                    class="cursor-pointer px-5 py-2 text-sm font-semibold text-bgray-900 hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                    March
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <p
                        class="mb-2 text-base font-bold leading-[24px] text-bgray-900 dark:text-white">
                        Transaction list Date
                    </p>
                    <div class="relative h-[56px] w-full">
                        <button
                            onclick="dateFilterAction('#date-filter-table')"
                            type="button"
                            class="relative flex h-full w-full items-center justify-between rounded-lg bg-bgray-100 px-4 dark:bg-darkblack-500">
                            <span class="text-base text-bgray-500">State or province</span>
                            <span>
                                <svg
                                    class="stroke-bgray-500 dark:stroke-white"
                                    width="25"
                                    height="25"
                                    viewBox="0 0 25 25"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M18.6758 5.8186H6.67578C5.57121 5.8186 4.67578 6.71403 4.67578 7.8186V19.8186C4.67578 20.9232 5.57121 21.8186 6.67578 21.8186H18.6758C19.7804 21.8186 20.6758 20.9232 20.6758 19.8186V7.8186C20.6758 6.71403 19.7804 5.8186 18.6758 5.8186Z"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M16.6758 3.8186V7.8186"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M8.67578 3.8186V7.8186"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M4.67578 11.8186H20.6758"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M11.6758 15.8186H12.6758"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M12.6758 15.8186V18.8186"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                        </button>
                        <div
                            id="date-filter-table"
                            class="absolute right-0 top-14 z-10 hidden w-full overflow-hidden rounded-lg bg-white shadow-lg dark:bg-darkblack-500">
                            <ul>
                                <li
                                    onclick="dateFilterAction('#amount-filter')"
                                    class="text-bgray-90 cursor-pointer px-5 py-2 text-sm font-semibold hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                    January
                                </li>
                                <li
                                    onclick="dateFilterAction('#amount-filter')"
                                    class="cursor-pointer px-5 py-2 text-sm font-semibold text-bgray-900 hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                    February
                                </li>

                                <li
                                    onclick="dateFilterAction('#amount-filter')"
                                    class="cursor-pointer px-5 py-2 text-sm font-semibold text-bgray-900 hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                    March
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <p
                        class="mb-2 text-base font-bold leading-[24px] text-bgray-900 dark:text-white">
                        Type of transaction
                    </p>
                    <div class="relative h-[56px] w-full">
                        <button
                            onclick="dateFilterAction('#trans-filter-tb')"
                            type="button"
                            class="relative flex h-full w-full items-center justify-between rounded-lg bg-bgray-100 px-4 dark:bg-darkblack-500">
                            <span class="text-base text-bgray-500">State or province</span>
                            <span>
                                <svg
                                    width="21"
                                    height="21"
                                    viewBox="0 0 21 21"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.58203 8.3186L10.582 13.3186L15.582 8.3186"
                                        stroke="#A0AEC0"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                        </button>
                        <div
                            id="trans-filter-tb"
                            class="absolute right-0 top-14 z-10 hidden w-full overflow-hidden rounded-lg bg-white shadow-lg dark:bg-darkblack-500">
                            <ul>
                                <li
                                    onclick="dateFilterAction('#trans-filter-tb')"
                                    class="text-bgray-90 cursor-pointer px-5 py-2 text-sm font-semibold hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                    January
                                </li>
                                <li
                                    onclick="dateFilterAction('#trans-filter-tb')"
                                    class="cursor-pointer px-5 py-2 text-sm font-semibold text-bgray-900 hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                    February
                                </li>

                                <li
                                    onclick="dateFilterAction('#trans-filter-tb')"
                                    class="cursor-pointer px-5 py-2 text-sm font-semibold text-bgray-900 hover:bg-bgray-100 dark:text-white hover:dark:bg-darkblack-600">
                                    March
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table Content -->
        <div class="table-content w-full overflow-x-auto">
            <table class="w-full">
                <tr
                    class="border-b border-bgray-300 dark:border-darkblack-400">
                    <td
                        class="inline-block w-[250px] px-6 py-5 lg:w-auto xl:px-0">
                        <div class="flex w-full items-center space-x-2.5">
                            <span
                                class="text-base font-medium text-bgray-600 dark:text-bgray-50">
                                Customer name</span>
                            <span>
                                <svg
                                    width="14"
                                    height="15"
                                    viewBox="0 0 14 15"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.332 1.31567V13.3157"
                                        stroke="#718096"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M5.66602 11.3157L3.66602 13.3157L1.66602 11.3157"
                                        stroke="#718096"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M3.66602 13.3157V1.31567"
                                        stroke="#718096"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M12.332 3.31567L10.332 1.31567L8.33203 3.31567"
                                        stroke="#718096"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                        </div>
                    </td>
                    <td class="px-6 py-5 xl:px-0">
                        <div class="flex w-full items-center space-x-2.5">
                            <span
                                class="text-base font-medium text-bgray-600 dark:text-bgray-50">Request</span>
                            <span>
                                <svg
                                    width="14"
                                    height="15"
                                    viewBox="0 0 14 15"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.332 1.31567V13.3157"
                                        stroke="#718096"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M5.66602 11.3157L3.66602 13.3157L1.66602 11.3157"
                                        stroke="#718096"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M3.66602 13.3157V1.31567"
                                        stroke="#718096"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M12.332 3.31567L10.332 1.31567L8.33203 3.31567"
                                        stroke="#718096"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                        </div>
                    </td>
                    <td class="px-6 py-5 xl:px-0">
                        <div class="flex items-center space-x-2.5">
                            <span
                                class="text-base font-medium text-bgray-600 dark:text-bgray-50">
                                Status</span>
                            <span>
                                <svg
                                    width="14"
                                    height="15"
                                    viewBox="0 0 14 15"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.332 1.31567V13.3157"
                                        stroke="#718096"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M5.66602 11.3157L3.66602 13.3157L1.66602 11.3157"
                                        stroke="#718096"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M3.66602 13.3157V1.31567"
                                        stroke="#718096"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M12.332 3.31567L10.332 1.31567L8.33203 3.31567"
                                        stroke="#718096"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                        </div>
                    </td>
                    <td class="px-6 py-5 xl:px-0">
                        <div class="flex w-full items-center space-x-2.5">
                            <span
                                class="text-base font-medium text-bgray-600 dark:text-bgray-50">Cost</span>
                            <span>
                                <svg
                                    width="14"
                                    height="15"
                                    viewBox="0 0 14 15"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.332 1.31567V13.3157"
                                        stroke="#718096"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M5.66602 11.3157L3.66602 13.3157L1.66602 11.3157"
                                        stroke="#718096"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M3.66602 13.3157V1.31567"
                                        stroke="#718096"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M12.332 3.31567L10.332 1.31567L8.33203 3.31567"
                                        stroke="#718096"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                        </div>
                    </td>
                    <td class="px-6 py-5 xl:px-0"></td>
                </tr>
                <?php foreach ($requests as $req):; ?>
                    <?php
                    $statusColor = [
                        'confirm' => 'text-success-400',
                        'pending' => 'text-warning-300',
                        'reject' => 'text-[#FF4747]'
                    ];
                    $colorClass = isset($statusColor[$req->status]) ? $statusColor[$req->status] : '';
                    ?>
                    <tr
                        class="border-b border-bgray-300 dark:border-darkblack-400">
                        <td class="px-6 py-5 xl:px-0">
                            <div class="flex w-full items-center space-x-2.5">
                                <div
                                    class="h-10 w-10 overflow-hidden rounded-full">
                                    <img
                                        src="<?= base_url() ?>assets/images/avatar/user-40x40.png"
                                        alt="avatar"
                                        class="h-full w-full object-cover" />
                                </div>
                                <p
                                    class="text-base font-semibold text-bgray-900 dark:text-white">
                                    <?= $req->full_name; ?>
                                </p>
                            </div>
                        </td>
                        <td class="w-96 px-6 py-5 xl:px-0">
                            <div
                                class="text-base font-medium text-bgray-900 dark:text-white">
                                <?= $req->request; ?>
                            </div>
                        </td>
                        <td class="px-6 py-5 mx-3 xl:px-0">
                            <span class="block rounded-md w-fit bg-success-50 px-2 py-1.5 text-sm font-semibold leading-[22px] <?= $colorClass ?> capitalize dark:bg-darkblack-500">
                                <?= $req->status; ?>
                            </span>
                        </td>
                        <td class="px-6 py-5 mx-3 xl:px-0">
                            <p
                                class="text-base font-semibold text-bgray-900 dark:text-white">
                                Rp <?= number_format($req->cost); ?>
                            </p>
                        </td>
                        <td class="px-6 py-5 xl:px-0">
                            <div class="flex justify-center">
                                <button type="button"
                                    data-modal-target="modalEditRequest" data-modal-toggle="modalEditRequest"
                                    @click="
                                    baseUrl='<?= site_url() ?>'
                                    reqId='<?= $req->booking_detail_id ?>'
                                    ">
                                    <svg
                                        width="18"
                                        height="4"
                                        viewBox="0 0 18 4"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8 2.00024C8 2.55253 8.44772 3.00024 9 3.00024C9.55228 3.00024 10 2.55253 10 2.00024C10 1.44796 9.55228 1.00024 9 1.00024C8.44772 1.00024 8 1.44796 8 2.00024Z"
                                            stroke="#A0AEC0"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M1 2.00024C1 2.55253 1.44772 3.00024 2 3.00024C2.55228 3.00024 3 2.55253 3 2.00024C3 1.44796 2.55228 1.00024 2 1.00024C1.44772 1.00024 1 1.44796 1 2.00024Z"
                                            stroke="#A0AEC0"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M15 2.00024C15 2.55253 15.4477 3.00024 16 3.00024C16.5523 3.00024 17 2.55253 17 2.00024C17 1.44796 16.5523 1.00024 16 1.00024C15.4477 1.00024 15 1.44796 15 2.00024Z"
                                            stroke="#A0AEC0"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="pagination-content w-full">
            <div
                class="flex w-full items-center justify-center lg:justify-between">
                <div class="hidden items-center space-x-4 lg:flex">
                    <span
                        class="text-sm font-semibold text-bgray-600 dark:text-bgray-50">Show result:</span>
                    <div class="relative">
                        <button
                            onclick="dateFilterAction('#result-filter')"
                            type="button"
                            class="flex items-center space-x-6 rounded-lg border border-bgray-300 px-2.5 py-[14px] dark:border-darkblack-400">
                            <span
                                class="text-sm font-semibold text-bgray-900 dark:text-bgray-50">3</span>
                            <span>
                                <svg
                                    width="17"
                                    height="17"
                                    viewBox="0 0 17 17"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.03516 6.03271L8.03516 10.0327L12.0352 6.03271"
                                        stroke="#A0AEC0"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                        </button>
                        <div
                            id="result-filter"
                            class="absolute right-0 top-14 z-10 hidden w-full overflow-hidden rounded-lg bg-white shadow-lg">
                            <ul>
                                <li
                                    onclick="dateFilterAction('#result-filter')"
                                    class="text-bgray-90 cursor-pointer px-5 py-2 text-sm font-medium hover:bg-bgray-100">
                                    1
                                </li>
                                <li
                                    onclick="dateFilterAction('#result-filter')"
                                    class="cursor-pointer px-5 py-2 text-sm font-medium text-bgray-900 hover:bg-bgray-100">
                                    2
                                </li>

                                <li
                                    onclick="dateFilterAction('#result-filter')"
                                    class="cursor-pointer px-5 py-2 text-sm font-medium text-bgray-900 hover:bg-bgray-100">
                                    3
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div
                    class="flex items-center space-x-5 sm:space-x-[35px]">
                    <button type="button">
                        <span>
                            <svg
                                width="21"
                                height="21"
                                viewBox="0 0 21 21"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12.7217 5.03271L7.72168 10.0327L12.7217 15.0327"
                                    stroke="#A0AEC0"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                    </button>
                    <div class="flex items-center">
                        <button
                            type="button"
                            class="rounded-lg bg-success-50 px-4 py-1.5 text-xs font-bold text-success-300 dark:bg-darkblack-500 dark:text-bgray-50 lg:px-6 lg:py-2.5 lg:text-sm">
                            1
                        </button>
                        <button
                            type="button"
                            class="rounded-lg px-4 py-1.5 text-xs font-bold text-bgray-500 transition duration-300 ease-in-out hover:bg-success-50 hover:text-success-300 dark:hover:bg-darkblack-500 lg:px-6 lg:py-2.5 lg:text-sm">
                            2
                        </button>

                        <span class="text-sm text-bgray-500">. . . .</span>
                        <button
                            type="button"
                            class="rounded-lg px-4 py-1.5 text-xs font-bold text-bgray-500 transition duration-300 ease-in-out hover:bg-success-50 hover:text-success-300 dark:hover:bg-darkblack-500 lg:px-6 lg:py-2.5 lg:text-sm">
                            20
                        </button>
                    </div>
                    <button type="button">
                        <span>
                            <svg
                                width="21"
                                height="21"
                                viewBox="0 0 21 21"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.72168 5.03271L12.7217 10.0327L7.72168 15.0327"
                                    stroke="#A0AEC0"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('bookingRequest/modal-edit'); ?>
</div>

<?php $this->load->view('templates/bottom-layout-admin'); ?>
