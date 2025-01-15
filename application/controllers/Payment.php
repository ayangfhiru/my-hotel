<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payment_model');
        $this->load->library('user_agent');
        is_login();
    }

    public function index($hotelId)
    {
        guard('admin');
        $payments = $this->payment_model->all($hotelId);
        $data = [
            'title' => 'Payment',
            'hotelId' => $hotelId,
            'payments' => $payments
        ];
        return $this->load->view('admin/payment/index', $data);
    }

    public function cancel($paymentId, $reservationId)
    {
        guard('admin');
        $this->form_validation->set_rules('note', 'Note', 'trim|required');
        $previous_url = $this->agent->referrer();
        if (!$previous_url) {
            $previous_url = base_url();
        }
        if ($this->form_validation->run() === FALSE) {
            redirect($previous_url);
        } else {
            $dataNote = [
                'reservation_id' => $reservationId,
                'note' => $this->input->post('note')
            ];
            $cancel = $this->payment_model->multiple_cancel($paymentId, $reservationId, $dataNote);
            if ($cancel === TRUE) {
                $this->session->set_flashdata('success', 'Pembatalan sukses');
            } else {
                $this->session->set_flashdata('failed', 'Pembatalan gagal');
            }
            redirect($previous_url);
        }
    }

    public function create() {}

    public function store() {}

    public function edit() {}

    public function update() {}

    public function destroy() {}

    public function confirm_status_payment($hotelId, $reservationId, $paymentId)
    {
        guard('admin');
        $update = $this->payment_model->multiple_confirm_status($reservationId, $paymentId);
        if ($update === TRUE) {
            $this->session->set_flashdata('success', 'Konfirmasi sukses');
        } else {
            $this->session->set_flashdata('failed', 'Konfirmasi gagal');
        }
        redirect("hotel/$hotelId/reservation/calendar");
    }

    public function cancel_status_payment($hotelId, $reservationId, $paymentId)
    {
        guard('admin');
        $this->form_validation->set_rules('note', 'Catatan', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('failed', 'Catatan tidak boleh kosong');
            redirect("hotel/$hotelId/reservation/calendar");
        } else {
            $note = $this->input->post('note');
        }
    }

    public function guest_transfer($paymentId)
    {
        $expire_time = $this->payment_model->find($paymentId)->expire_time;
        $dateNow = date('Y-m-d H:i:s');
        if ($dateNow > $expire_time) {
            $this->session->set_flashdata('failed', 'Upload ditolak karena melewati batas waktu');
            redirect('guest/order');
        }

        if (!empty($_FILES["transfer"]['name'])) {
            $upload = image($_FILES["transfer"], "transfer", "transfer");
            if (!empty($upload)) {
                $fileName = $upload;
                $data = [
                    'payment_img' => $fileName,
                    'payment_time' => $dateNow
                ];
                $update = $this->payment_model->update($paymentId, $data);
                if ($update === TRUE) {
                    $this->session->set_flashdata('success', 'Upload Sukses');
                } else {
                    $this->session->set_flashdata('failed', 'Upload Gagal');
                }
                redirect('guest/order');
            }
        } else {
            $this->session->set_flashdata('failed', 'Upload Gagal');
            redirect('guest/order');
        }
    }
}
