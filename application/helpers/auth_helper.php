<?php
defined('BASEPATH') or exit('No direct script access allowed');

function is_login()
{
    $CI = &get_instance();
    if (!$CI->session->userdata('is_login')) {
        redirect('user');
    }
}

function guard($allowed_roles)
{
    $CI = &get_instance();
    $user_role = $CI->session->userdata('role');
    if ($user_role !== $allowed_roles) {
        show_error('You do not have permission to access this page.', 403);
    }
}
