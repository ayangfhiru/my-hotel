<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        // guard('tamu');
    }

    public function listBookings()
    {
        $this->load->model('order_model');
        $this->load->model('booking/booking_model');
        $this->load->model('booking/booking_detail_model');
        $this->load->model('payment/payment_model');
        $userId = $this->session->userdata('user_id');

        $boDetail = $this->booking_detail_model->findDetailBookingByUserId($userId);
        // $boDetail = $this->order_model->findBookingDetailByUser($userId);
        $data = [
            'title' => 'Detail Pemesanan',
            'bookings' => $boDetail,
        ];
        return $this->load->view('order', $data);
    }

    public function list_order()
    {
        $userId = $this->session->userdata('user_id');
        $reservations = $this->order_model->list($userId);
        $data = [
            'title' => 'Detail Order',
            'reservations' => $reservations
        ];
        $this->load->view('order', $data);
    }

    public function detail_order($reservationId)
    {
        $this->load->model('order_model');
        $detail = $this->order_model->detail($reservationId);
        $services = $this->services($detail);

        // Menghapus detail
        unset($detail->service_name);
        unset($detail->service_price);
        unset($detail->service_quantity);
        unset($detail->total_price);

        $data = [
            'title' => 'Detail Order',
            'detail' => $detail,
            'services' => json_decode(json_encode($services))
        ];

        $role = $this->session->userdata('role');
        if ($role === 'admin') {
            $this->load->view('admin/reservation/detail-order', $data);
        } else if ($role === 'tamu') {
            $this->load->view('detail-order', $data);
        }
    }

    private function services($data)
    {
        $services = [];
        $service_name = explode(',', $data->service_name);
        $service_price = explode(',', $data->service_price);
        $service_quantity = explode(',', $data->service_quantity);
        $total_price = explode(',', $data->total_price);
        $note = explode(',', $data->note);

        foreach ($service_name as $index => $name) {
            $newData = [
                'service_name' => $name,
                'service_price' => $service_price[$index],
                'service_quantity' => $service_quantity[$index],
                'total_price' => $total_price[$index],
                'note' => $note[$index]
            ];
            array_push($services, $newData);
        }
        return $services;
    }
}
