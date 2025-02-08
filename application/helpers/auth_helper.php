<?php
defined('BASEPATH') or exit('No direct script access allowed');

function is_login()
{
    $CI = &get_instance();
    if (!$CI->session->userdata('is_login')) {
        redirect('login');
    }
}

function guard($allowed_roles)
{
    $roles_map = [
        'super' => 'SUPER_ADMIN',
        'fo'    => 'FRONT_OFFICE',
        'guest' => 'GUEST'
    ];

    if (is_array($allowed_roles)) {
        foreach ($allowed_roles as $role) {
            if (!array_key_exists($role, $roles_map)) {
                show_error('Invalid role specified.', 403);
                return;
            }
        }
    } else {
        if (!array_key_exists($allowed_roles, $roles_map)) {
            show_error('Invalid role specified.', 403);
            return;
        }
    }

    $CI = &get_instance();
    $user_role = $CI->session->userdata('role');

    $allowed_roles = is_array($allowed_roles) ? $allowed_roles : [$allowed_roles];

    if (!in_array($user_role, array_values(array_intersect_key($roles_map, array_flip($allowed_roles))))) {
        show_error('You do not have permission to access this page.', 403);
    }
}
