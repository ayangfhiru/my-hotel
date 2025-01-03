<?php
defined('BASEPATH') or exit('No direct script access allowed');

function image($file, $name, $path)
{
    $CI = &get_instance();
    $config['upload_path'] = "./assets/$path/";
    $config['allowed_types'] = 'jpg|jpeg|png';
    $CI->load->library('upload', $config);
    if (!empty($file['name'])) {
        $newFileName = time() . "-" . $file['name'];
        $config['file_name'] = $newFileName;
        $CI->upload->initialize($config);
        if ($CI->upload->do_upload($name)) {
            $data = $CI->upload->data();
            return $data['file_name'];
        } else {
            $CI->upload->display_errors();
        }
    }
}
