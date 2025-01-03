<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('hotel_model');
    }

    public function index()
    {
        $data['title'] = 'Hotel';
        $role = $this->session->userdata('role');
        $data['hotels'] = $this->hotel_model->all();

        switch ($role) {
            case 'admin':
                guard('admin');
                $this->load->view('admin/hotel/index', $data);
                break;

            case 'tamu':
                $this->load->view('home', $data);
                break;

            default:
                $this->load->view('home', $data);
                break;
        }
    }
}
