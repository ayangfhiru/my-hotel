<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ManagementBooking extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('booking/booking_detail_model');
        is_login();
    }

    public function manageStatus($bookingDetailId)
    {
        guard('admin');
        $action = $this->input->post('action');
        if ($action) {
            $updateBookingDetail = $this->booking_detail_model->update($bookingDetailId, ['booking_status' => $action]);
            if ($updateBookingDetail) {
                echo "success";
            } else {
                echo "failed";
            }
        } else {
            echo "No action received";
        }
    }

    public function cancelBooking($hotelId, $bookingDetailId)
    {
        $this->load->library('form_validation');
        guard('admin');
        $this->form_validation->set_rules('note', 'Catatan pembatalan', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            redirect("hotel/$hotelId/booking/calendar");
        } else {
            $note = $this->input->post('note');
            $dataBookingCancel = [
                'booking_detail_id' => $bookingDetailId,
                'cancel_note' => $note
            ];
            $cancel = $this->booking_detail_model->cancelBookingAndCreateRecord($bookingDetailId, $dataBookingCancel);
            if ($cancel === TRUE) {
                $this->session->set_flashdata('success', 'Reservasi Berhasil');
            } else {
                $this->session->set_flashdata('failed', 'Reservasi Gagal');
            }
        }
    }
}
