<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guest extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('cart_model');
        $this->load->library('user_agent');
        is_login();
    }

    public function cart()
    {
        $userId = $this->session->userdata('user_id');
        $carts = $this->cart_model->find($userId);
        $data = [
            'title' => 'Keranjang',
            'carts' => $carts
        ];
        $this->load->view('cart', $data);
    }

    public function add_cart($roomId)
    {
        $checkIn = $this->input->get('check_in');
        $checkOut = $this->input->get('check_out');
        $userId = $this->session->userdata('user_id');
        $data = [
            'user_id' => $userId,
            'room_id' => $roomId,
            'check_in' => $checkIn,
            'check_out' => $checkOut
        ];
        $add = $this->cart_model->create($data);
        if ($add === TRUE) {
            $this->session->set_flashdata('success', '');
        } else {
            $this->session->set_flashdata('failed', '');
        }
        $back_url = $this->agent->referrer();
        $back_url = !empty($back_url) ? $back_url : site_url('');
        redirect($back_url);
    }
}
