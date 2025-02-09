<!-- Main modal -->
<div id="modalEditRequest" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Request
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modalEditRequest">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <?= form_open(site_url(), [
                    'class' => 'space-y-4',
                    'x-bind:action' => "baseUrl +'booking/BookingRequest/update/' + reqId"
                ]); ?>
                <div>
                    <?= form_label('Status Request', 'status', [
                        'class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white'
                    ]);; ?>
                    <?= form_dropdown('status', [
                        'confirm' => 'Confirm',
                        'reject' => 'Reject'
                    ], '', [
                        'id' => 'status',
                        'class' => 'text-bgray-800 text-base border border-bgray-300 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white h-14 w-full focus:border-success-300 focus:ring-0 focus:outline-none rounded-lg px-4 py-3.5 placeholder:text-bgray-500'
                    ]);; ?>
                </div>
                <div>
                    <?= form_label('Cost', 'cost', [
                        'class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white'
                    ]); ?>
                    <?= form_input([
                        'type' => 'number',
                        'name' => 'cost',
                        'id' => 'cost',
                        'class' => 'text-bgray-800 text-base border border-bgray-300 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white h-14 w-full focus:border-success-300 focus:ring-0 focus:outline-none rounded-lg px-4 py-3.5 placeholder:text-bgray-500',
                        'required' => 'required'
                    ]);
                    ?>
                </div>
                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
