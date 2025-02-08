<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/head');
?>

<nav class="bg-gray-800 fixed top-0 left-0 right-0 z-40" x-data="{ isOpen: false, isOpenNav: false }">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button @click="isOpenNav = !isOpenNav" type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!--
            Icon when menu is closed.

            Menu open: "hidden", Menu closed: "block"
          -->
                    <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!--
            Icon when menu is open.

            Menu open: "block", Menu closed: "hidden"
          -->
                    <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex shrink-0 items-center">
                    <a href="<?= site_url("guest") ?>">
                        <img class="h-8 w-auto" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                    </a>
                </div>
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <?= form_open(site_url('guest/hotel/search'), [
                            'class' => 'flex items-center justify-center gap-x-6'
                        ]); ?>
                        <?= form_input([
                            'name' => 'check_in',
                            'id' => 'check_in',
                            'type' => 'date',
                            'class' => 'px-2 py-2 rounded w-60',
                            'required' => ''
                        ]); ?>
                        <h1 class="text-white">TO</h1>
                        <?= form_input([
                            'name' => 'check_out',
                            'id' => 'check_out',
                            'type' => 'date',
                            'class' => 'px-2 py-2 rounded w-60',
                            'required' => ''
                        ]); ?>
                        <button type="submit" class="px-3 py-2 bg-blue-400 rounded text-white">Search</button>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center gap-x-5 pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <a href="<?= site_url("guest/cart") ?>" type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">View notifications</span>
                    <i class="fa-solid fa-cart-shopping fa-lg px-0.5 py-3 inline-block"></i>
                </a>
                <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">View notifications</span>
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>
                </button>
                <!-- Profile dropdown -->
                <div class="relative ml-3">
                    <div>
                        <button @click="isOpen = !isOpen" type="button" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">Open user menu</span>
                            <img class="size-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        </button>
                    </div>

                    <!--
            Dropdown menu, show/hide based on menu state.

            Entering: "transition ease-out duration-100"
              From: "transform opacity-0 scale-95"
              To: "transform opacity-100 scale-100"
            Leaving: "transition ease-in duration-75"
              From: "transform opacity-100 scale-100"
              To: "transform opacity-0 scale-95"
          -->
                    <div
                        x-show="isOpen"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        @click.outside="isOpen = false"
                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <!-- Active: "bg-gray-100 outline-none", Not Active: "" -->
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 space-x-2" role="menuitem" tabindex="-1" id="user-menu-item-0">
                            <i class="fa-solid fa-user"></i>
                            <span>Your Profile</span>
                        </a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 space-x-2" role="menuitem" tabindex="-1" id="user-menu-item-1">
                            <i class="fa-solid fa-gear"></i>
                            <span>Settings</span>
                        </a>
                        <?php
                        $isLogin = $this->session->userdata('is_login');
                        if ($isLogin):
                        ?>
                            <a href="<?= site_url('guest/order') ?>" class="block px-4 py-2 text-sm text-gray-700 space-x-2" role="menuitem" tabindex="-1" id="user-menu-item-1">
                                <i class="fa-solid fa-bag-shopping"></i>
                                <span>Order</span>
                            </a>
                            <a href="<?= site_url('logout') ?>" class="block px-4 py-2 text-sm text-red-700 space-x-2" role="menuitem" tabindex="-1" id="user-menu-item-2">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                <span>Sign out</span>
                            </a>
                        <?php else: ?>
                            <a href="<?= site_url('user') ?>" class="block px-4 py-2 text-sm text-green-700" role="menuitem" tabindex="-1" id="user-menu-item-2">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                <span>Sign In</span>
                            </a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu" x-show="isOpenNav">
        <div class="space-y-1 px-2 pb-3 pt-2">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="#" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page">Dashboard</a>
            <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Team</a>
            <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Projects</a>
            <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Calendar</a>
        </div>
    </div>
</nav>
