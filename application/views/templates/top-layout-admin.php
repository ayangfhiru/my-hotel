<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('templates/head'); ?>

<body>
    <!-- layout start -->
    <div class="layout-wrapper active w-full">
        <div class="relative flex w-full">
            <?php
            $userRole = $this->session->userdata('role');
            if ($userRole === 'SUPER_ADMIN') {
                $this->load->view('templates/sidebar-lg-super');
            } else if ($userRole === 'FRONT_OFFICE') {
                $this->load->view('templates/sidebar-lg-fo');
            }
            ?>

            <div
                style="z-index: 25"
                class="aside-overlay fixed left-0 top-0 block h-full w-full bg-black bg-opacity-30 sm:hidden"></div>

            <?php
            if ($userRole === 'SUPER_ADMIN') {
                $this->load->view('templates/sidebar-sm-super');
            } else if ($userRole === 'FRONT_OFFICE') {
                $this->load->view('templates/sidebar-sm-fo');
            }
            ?>

            <div
                class="body-wrapper flex-1 overflow-x-hidden dark:bg-darkblack-500">

                <?php
                $this->load->view('templates/header-lg');
                $this->load->view('templates/header-sm');
                ?>

                <main
                    class="relative w-full px-6 pb-6 pt-[100px] sm:pt-[156px] xl:px-12 xl:pb-12">
                    <!-- write your code here-->
                    <?php $this->load->view('toast'); ?>
                    <div class="2xl:flex 2xl:space-x-[48px]">
