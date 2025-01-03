<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration extends CI_Controller
{
    public function index()
    {
        $this->load->library('migration');
        if ($this->migration->current() === FALSE) {
            echo $this->migration->error_string();
        } else {
            echo "Table Migrate Successfully";
        }
    }
}
