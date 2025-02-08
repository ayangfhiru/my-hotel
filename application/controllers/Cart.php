<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('cart_model');
        $this->load->library('user_agent');
        is_login();
    }

    public function show()
    {
        $userId = $this->session->userdata('user_id');
        $carts = $this->cart_model->find($userId);
        $data = [
            'title' => 'Keranjang',
            'carts' => $carts
        ];
        $this->load->view('cart', $data);
    }

    public function store()
    {
        guard('guest');
        $roomId = $this->input->post('room_id');
        $checkIn = $this->input->post('check_in');
        $checkOut = $this->input->post('check_out');
        $userId = $this->session->userdata('user_id');

        if (isset($roomId) && isset($checkIn) && isset($checkOut)) {
            $data = [
                'user_id' => $userId,
                'room_id' => $roomId,
                'check_in' => $checkIn,
                'check_out' => $checkOut
            ];
            $add = $this->cart_model->create($data);
            if ($add === TRUE) {
                $this->session->set_flashdata('success', 'Berhasil dimasukan keranjang');
            } else {
                $this->session->set_flashdata('failed', 'Gagal dimasukan keranjang');
            }
        } else {
            $this->session->set_flashdata('failed', 'Gagal dimasukan keranjang');
        }
    }

    public function destroy($userId, $roomId)
    {
        $remove = $this->cart_model->delete($userId, $roomId);
        if ($remove === TRUE) {
            $this->session->set_flashdata('success', '');
        } else {
            $this->session->set_flashdata('failed', '');
        }
        redirect('guest/cart');
    }
}
