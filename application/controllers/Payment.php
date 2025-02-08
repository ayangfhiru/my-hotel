<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payment/payment_model');
        $this->load->library('user_agent');
        // is_login();
    }

    public function index()
    {
        guard(['super', 'fo']);
        $userRole = $this->session->userdata('role');
        if ($userRole === 'SUPER_ADMIN') {
            $payments = $this->payment_model->all();
        } else {
            $hotelId = $this->session->userdata('hotel_id');
            $payments = $this->payment_model->getWithHotel($hotelId);
        }
        $data = [
            'title' => 'Payment',
            'payments' => $payments
        ];
        return $this->load->view('payment/index', $data);
    }

    public function process($paymentId, $reservationId)
    {
        guard('admin');
        $previous_url = $this->agent->referrer();
        $action = $this->input->post('payment');
        if ($action === 'confirm') {
            $confirm = $this->payment_model->update($paymentId, ['payment_status' => 'completed']);
            if ($confirm === TRUE) {
                $this->session->set_flashdata('success', 'Konfirmasi sukses');
            } else {
                $this->session->set_flashdata('failed', 'Konfirmasi gagal');
            }
        } else if ($action === 'cancel') {
            $this->form_validation->set_rules('cancel_note', 'Note', 'trim|required');
            if (!$previous_url) {
                $previous_url = base_url();
            }
            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('failed', 'Masukan pesan');
                redirect($previous_url);
            } else {
                $dataNote = [
                    'reservation_id' => $reservationId,
                    'cancel_note' => $this->input->post('cancel_note')
                ];
                $cancel = $this->payment_model->multiple_cancel($paymentId, $reservationId, $dataNote);
                if ($cancel === TRUE) {
                    $this->session->set_flashdata('success', 'Pembatalan sukses');
                } else {
                    $this->session->set_flashdata('failed', 'Pembatalan gagal');
                }
            }
        }
        redirect($previous_url);
    }

    public function detailPayment($paymentId)
    {
        $this->load->model('payment/payment_detail_model');
        $paymentDetail = $this->payment_detail_model->paymentDetail($paymentId);
        print_r($paymentDetail);
        // return $this->load->view('payment/detail');
    }

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

    public function payNow($snapToken)
    {
        $urlPay = "https://app.sandbox.midtrans.com/snap/v2/vtweb/$snapToken";
        redirect($urlPay);
    }

    public function handleNotification()
    {
        $notification = file_get_contents('php://input');
        $notif = json_decode($notification);
        $orderId = $notif->order_id;

        $data = [
            'transaction_status' => $notif->transaction_status,
            'transaction_id' => $notif->transaction_id,
            'transaction_time' => $notif->transaction_time,
            'signature_key' => $notif->signature_key,
            'payment_type' => $notif->payment_type,
            // 'va_number' => $notif->va_numbers[0]->va_number,
            // 'bank' => $notif->va_numbers[0]->bank,
        ];

        if ($notif->transaction_status == 'capture' && $notif->payment_type == 'credit_card') {
            if ($notif->fraud_status == 'challenge') {
                // Menangani status challenge
                // $this->handle_challenge($notif);
            } else if ($notif->fraud_status == 'accept') {
                // Menangani pembayaran sukses
                // $this->handle_success($notif);
            }
        } else if ($notif->transaction_status == 'settlement') {
            // Menangani status settlement
            $data['payment_status'] = 'paid';
        } else if ($notif->transaction_status == 'pending') {
            // Menangani status pending
            $data['payment_status'] = 'pending';
        } else if ($notif->transaction_status == 'failed') {
            // Menangani transaksi gagal
            $data['payment_status'] = 'failed';
        } else if ($notif->transaction_status == 'cancel') {
            // Menangani transaksi yang dibatalkan
            $data['payment_status'] = 'cancel';
        }

        $this->payment_model->updateByOrderId($orderId, $data);
        print_r($data);
    }
}
