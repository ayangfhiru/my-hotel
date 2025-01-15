<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReservationStatus extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('reservation_model');
        $this->load->model('cancel_reservation_model');
        $this->load->library('form_validation');
        is_login();
        guard('admin');
    }

    public function update_status($hotelId, $reservationId, $status, $note = null)
    {
        $statusMessages = [
            'confirmed' => 'Konfirmasi Reservasi Berhasil!',
            'checked_in' => 'Check In Berhasil!',
            'in_house' => 'In House Reservasi Berhasil!',
            'checked_out' => 'Check Out Berhasil!',
            'cancelled' => 'Pembatalan Reservasi Berhasil!',
        ];

        $data = ['reservation_status' => $status];
        if ($status === 'cancelled') {
            $this->form_validation->set_rules('note', 'Catatan', 'trim|required');
            if ($this->form_validation->run() === FALSE) {
                redirect("hotel/$hotelId/reservation/calendar");
            } else {
                $dataCandeled = [
                    'reservation_id' => $reservationId,
                    'note' => $note
                ];
                $add = $this->reservation_model->cancel_reservation($reservationId, $dataCandeled);
            }
        } else {
            $add = $this->reservation_model->update($reservationId, $data);
        }

        if ($add === TRUE) {
            $this->session->set_flashdata('success', $statusMessages[$status]);
        } else {
            $this->session->set_flashdata('failed', ucfirst($status) . ' Gagal!');
        }
        redirect("hotel/$hotelId/reservation/calendar");
    }

    public function confirmed($hotelId, $reservationId)
    {
        $this->update_status($hotelId, $reservationId, 'confirmed');
    }

    public function checked_in($hotelId, $reservationId)
    {
        $this->update_status($hotelId, $reservationId, 'checked_in');
    }

    public function in_house($hotelId, $reservationId)
    {
        $this->update_status($hotelId, $reservationId, 'in_house');
    }

    public function checked_out($hotelId, $reservationId)
    {
        $this->update_status($hotelId, $reservationId, 'checked_out');
    }

    public function cancelled($hotelId, $reservationId)
    {
        $note = $this->input->post('note');
        $this->update_status($hotelId, $reservationId, 'cancelled', $note);
    }
}
