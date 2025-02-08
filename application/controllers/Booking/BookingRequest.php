<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BookingRequest extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('booking/booking_request_model');
        is_login();
    }

    public function index()
    {
        guard('fo');
        $hotelId = $this->session->userdata('hotel_id');
        $requests = $this->booking_request_model->getRequest($hotelId);
        $data = [
            'title' => 'Booking Requests',
            'requests' => $requests
        ];
        return $this->load->view('bookingRequest/index', $data);
    }

    public function update($id)
    {
        guard('fo');
        $status = $this->input->post('status');
        $cost = $this->input->post('cost');
        $data = [
            'status' => $status,
            'cost' => $cost
        ];
        $update = $this->booking_request_model->update($id, $data);
        if ($update === TRUE) {
            $this->session->set_flashdata('success', 'Reservasi Berhasil');
        } else {
            $this->session->set_flashdata('failed', 'Reservasi Gagal');
        }
        redirect('bookings/requests');
    }
}
