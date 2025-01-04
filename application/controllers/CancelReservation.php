<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CancelReservation extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('cancel_reservation_model');
        $this->load->library('form_validation');
        is_login();
        guard('admin');
    }

    public function index() {}

    public function create() {}

    public function store($hotelId, $reservationId)
    {
        $this->form_validation->set_rules('note', 'Catatan', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            redirect("hotel/$hotelId/reservation/calendar");
        } else {
            $data = [
                'reservation_id' => $reservationId,
                'note' => $this->input->post('note')
            ];
            $add =  $this->cancel_reservation_model->create_multiple_tables($data, $reservationId);
            if ($add === TRUE) {
                $this->session->set_flashdata('success', 'Pembatalan Reservasi Berhasil!');
            } else {
                $this->session->set_flashdata('failed', 'Pembatalan Reservasi Gagal!');
            }
            redirect("hotel/$hotelId/reservation/calendar");
        }
    }

    public function update($id)
    {
        $this->form_validation->set_rules('bed_name', 'Facility Name', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $this->create();
        } else {
            $data = [
                'bed_name' => $this->input->post('bed_name')
            ];
            $this->bed_model->update($id, $data);
            redirect('bed');
        }
    }

    public function destroy($id)
    {
        $this->bed_model->delete($id);
        redirect('bed');
    }
}
