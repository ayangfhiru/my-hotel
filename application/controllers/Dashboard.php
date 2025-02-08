<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('hotel_model');
    }

    public function index()
    {
        $userRole = $this->session->userdata('role');
        if ($userRole === 'SUPER_ADMIN') {
            $this->load->view('user/index');
        } else if ($userRole === 'FRONT_OFFICE') {
            $this->load->view('user/index');
        } else {
            $checkIn = date('Y-m-d');
            $checkOut = date('Y-m-d', strtotime('+1 day'));
            $data['hotels'] = $this->hotel_model->findAvailableHotels($checkIn, $checkOut);
            $this->load->view('home', $data);
        }
    }
}
