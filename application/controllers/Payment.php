<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payment_model');
    }

    public function index() {}

    public function show() {}

    public function create() {}

    public function store() {}

    public function edit() {}

    public function update() {}

    public function destroy() {}

    public function update_status_payment($hotelId, $reservationId, $paymentId)
    {
        $this->load->model('reservation_model');
        guard('admin');
        $status = $this->input->post('set_status');
        $update = $this->payment_model->update_status($paymentId, $status);
        $this->reservation_model->update($reservationId, ['reservation_status' => 'confirmed']);
        if ($update === TRUE) {
            $this->session->set_flashdata('success', '');
        } else {
            $this->session->set_flashdata('failed', '');
        }
        redirect("hotel/$hotelId/reservation");
    }
}
