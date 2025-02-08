<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="col-span-full">
    <?= form_label('Extra Service', "", ['class' => 'mb-2 block text-sm font-medium text-gray-900 dark:text-white']); ?>
    <div class="block w-full rounded-lg border border-gray-300 bg-gray-50 px-2.5 text-sm text-darkblack-700 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
        <button type="button" onclick="toggleAccordion(event, <?= $index ?>)" class="w-full flex justify-between items-center py-2.5 text-slate-800">
            <span class="text-darkblack-700 dark:text-white">Tambah Services</span>
            <span id="icon-<?= $index ?>" class="text-slate-800 dark:text-white transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                    <path d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
                </svg>
            </span>
        </button>
        <div id="content-<?= $index ?>" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
            <div class="text-sm text-slate-500">
                <ul class="text-sm font-medium bg-gray-50 text-darkblack-700 dark:bg-gray-700 dark:text-white rounded-lg px-2">
                    <?php foreach ($services as $ser): ?>
                        <li id="<?= "li-$index-{$ser->service_id}" ?>" class="w-full rounded-lg mb-3">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center btnExtraService">
                                    <?= form_checkbox([
                                        'name' => "services[$index][]",
                                        'id' => "service-$index-{$ser->service_id}",
                                        'checked' => set_value('services[]') ? true : false,
                                        'data-service-name' => $ser->service_name,
                                        'data-service-price' => $ser->service_price,
                                        'value' => $ser->service_id,
                                        'class' => "w-4 h-4 text-blue-600 rounded focus:ring-blue-500 focus:ring-0 border border-gray-300 bg-gray-50 px-2.5 text-sm dark:border-gray-600 dark:bg-gray-700"
                                    ]) ?>
                                    <span class="flex gap-x-2 items-center">
                                        <?= form_label($ser->service_name, "service-$index-{$ser->service_id}", ['class' => "text-sm font-medium ms-3 cursor-pointer text-darkblack-700 dark:text-white"]) ?>
                                        <p class="text-sm text-red-500"><?= $ser->description; ?></p>
                                    </span>
                                </div>
                                <div class="flex gap-x-3 items-center">
                                    <span>IDR <?= number_format($ser->service_price) ?></span>
                                    <div class="flex items-center">
                                        <button type="button"
                                            id="decrement-button"
                                            data-decrement="<?= $index ?>-<?= $ser->service_id ?>"
                                            data-input-counter-decrement="service-quantity-<?= $index ?>-<?= $ser->service_id ?>"
                                            class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                            <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                            </svg>
                                        </button>
                                        <div id="view-quantity-<?= $index ?>-<?= $ser->service_id ?>" class="block w-10 text-center text-sm bg-transparent font-medium text-gray-900 dark:text-white">0</div>
                                        <button type="button"
                                            id="increment-button"
                                            data-increment="<?= $index ?>-<?= $ser->service_id ?>"
                                            data-input-counter-increment="service-quantity-<?= $index ?>-<?= $ser->service_id ?>"
                                            class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                            <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?= form_input([
                                'name' => "note[$index][]",
                                'id' => "note-$index-{$ser->service_id}",
                                'class' => 'block w-full p-2 mt-1 border rounded text-xs border border-gray-300 bg-gray-50 px-2.5 text-sm dark:border-gray-600 dark:bg-gray-700',
                                'placeholder' => "Note {$ser->service_name}",
                                'disabled' => 'disabled'
                            ]) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
