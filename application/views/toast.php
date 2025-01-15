<?php
$toast_type = '';
$toast_message = '';

if ($this->session->flashdata('success')) {
    $toast_type = 'success';
    $toast_message = $this->session->flashdata('success');
} elseif ($this->session->flashdata('failed')) {
    $toast_type = 'failed';
    $toast_message = $this->session->flashdata('failed');
}

if ($toast_type): // Jika ada pesan, tampilkan toast
?>
    <div id="toast" class="fixed right-10 top-20 ?> flex items-center w-full max-w-xs py-3 px-4 text-gray-800 rounded-lg shadow z-50
    <?= $toast_type == 'success' ? 'bg-green-300 text-green-800' : 'bg-red-300 text-red-800' ?>" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 <?= $toast_type == 'success' ? 'bg-green-900 text-green-300' : 'bg-red-900 text-red-300' ?> rounded-lg">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
            <span class="sr-only"><?= $toast_type == 'success' ? 'Success icon' : 'Error icon' ?></span>
        </div>
        <div class="ms-3 text-sm font-normal"><?= $toast_message ?></div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 <?= $toast_type == 'success' ? 'bg-green-500 text-green-200 hover:text-green-700 focus:ring-green-300 hover:bg-green-400' : 'bg-red-500 text-red-200 hover:text-red-700 focus:ring-red-300 hover:bg-red-400' ?> rounded-lg p-1.5 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#toast" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
<?php endif; ?>
