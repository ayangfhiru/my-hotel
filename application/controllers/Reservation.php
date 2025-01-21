<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reservation extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('reservation_model');
        $this->load->library('form_validation');
        is_login();
    }

    public function date()
    {
        $year = date('Y');
        $month = date('m');
        $lastDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $first = "$year-$month-01";
        $last = "$year-$month-$lastDay";
        return [
            'first' => $first,
            'last' => $last
        ];
    }

    public function index() {}

    public function show($hotelId, $reservationId)
    {
        guard('admin');
        $data = [
            'title' => 'Detail Reservation'
        ];
        $this->load->view('admin/reservation/detail', $data);
    }

    public function create($hotelId, $roomId)
    {
        $this->load->model('room_code_model');
        $checkIn =  $this->input->get('check_in');
        $checkOut = $this->input->get('check_out');
        $roomCode = $this->room_code_model->search_room_code($hotelId, $roomId, $checkIn, $checkOut);

        $in = new DateTime($checkIn);
        $out = new DateTime($checkOut);
        $totalDate = $in->diff($out)->d;
        $price =  number_format($roomCode[0]->price, 0, '', '');
        $amount = $totalDate * $price;

        $data = [
            'title' => 'Reservation',
            'hotelId' => $hotelId,
            'roomId' => $roomId,
            'room_code' => $roomCode,
            'checkIn' => $checkIn,
            'checkOut' => $checkOut,
            'price' => $price,
            'amount' => $amount
        ];

        if ($this->session->userdata('role') === 'admin') {
            $this->load->view('admin/reservation/create', $data);
        } else {
            $this->load->view('reservation', $data);
        }
    }

    public function store($hotelId, $roomId)
    {
        $this->load->model('room_code_model');
        $this->load->model('payment_model');
        $this->validation();
        if ($this->form_validation->run() === FALSE) {
            redirect("hotel/$hotelId/room/$roomId/reservation");
        } else {
            $data = $this->get_data_input();
            $reservation = $data['reservation'];
            $payment = $data['payment'];

            if ($payment['payment_method'] === 'cash') {
                $payment['payment_status'] = 'completed';
            }

            // generate invoice
            $date = $this->date();
            $roomCode = $this->room_code_model->find($reservation['room_code_id'])->room_code;
            $invoice = $this->payment_model->generateInvoice($hotelId, $roomCode, $date);
            $payment['invoice'] = $invoice;

            $store = $this->reservation_model->insert_multiple_tables($reservation, $payment);
            if ($store === TRUE) {
                $this->session->set_flashdata('success', 'Reservasi Berhasil');
            } else {
                $this->session->set_flashdata('failed', 'Reservasi Gagal');
            }
            redirect("hotel/$hotelId/room");
        }
    }

    public function edit() {}

    public function update() {}

    public function destroy() {}

    public function set_status()
    {
        guard('admin');
    }

    public function check_in($hotelId, $roomCodeId, $reservationId)
    {
        guard('admin');
        $check_in = $this->reservation_model->update($reservationId, ['reservation_status' => 'in_house']);
        if ($check_in === TRUE) {
            $this->session->set_flashdata('success', '');
        } else {
            $this->session->set_flashdata('failed', '');
        }
        redirect("hotel/$hotelId/reservation");
    }

    public function check_out($hotelId, $roomCodeId, $reservationId)
    {
        guard('admin');
        $check_out = $this->reservation_model->update($reservationId, ['reservation_status' => 'out_house']);
        if ($check_out === TRUE) {
            $this->session->set_flashdata('success', '');
        } else {
            $this->session->set_flashdata('failed', '');
        }
        redirect("hotel/$hotelId/reservation");
    }

    public function reservation_cancel($hotelId, $roomCodeId, $reservationId)
    {
        $this->load->model('payment_model');
        guard('admin');
        $cancel = $this->reservation_model->update($reservationId, ['reservation_status' => 'cancelled']);
        $payment = $this->payment_model->update_status_where_reservation($reservationId, ['payment_status' => 'failed']);
        if ($cancel === TRUE) {
            $this->session->set_flashdata('success', '');
        } else {
            $this->session->set_flashdata('failed', '');
        }
        redirect("hotel/$hotelId/reservation");
    }

    public function calendar($hotelId)
    {
        guard('admin');
        $this->load->model('room_model');

        $startDate = $this->input->get('start');
        $endDate = $this->input->get('end');

        if (empty($startDate) || empty($endDate) || $startDate > $endDate) {
            $startDate = date('Y-m-d', strtotime('-1 days'));
            $endDate = date('Y-m-d', strtotime('+30 days'));
        };

        $roomCode = $this->room_model->get_room_code($hotelId);
        $reservations = $this->reservation_model->get_reservation($hotelId, $startDate, $endDate);
        $dates = $this->generateDateRange($startDate, $endDate);

        $data = [
            'title' => 'Kalender',
            'hotelId' => $hotelId,
            'dates' => $dates,
            'room_code' => $roomCode,
            'reservations' => $reservations,
            'startDate' => current($dates),
            'endDate' => end($dates)
        ];

        $this->load->view("admin/reservation/calendar", $data);
    }

    public function guest_reservation($hotelId, $roomId)
    {
        $this->load->model('room_model');
        $this->load->model('service_model');

        $room = $this->room_model->find($roomId);
        $checkIn = $this->input->get('check_in');
        $checkOut = $this->input->get('check_out');
        $in = new DateTime($checkIn);
        $out = new DateTime($checkOut);
        $totalDate = $in->diff($out)->d;
        $price =  number_format($room->price, 0, '', '');
        $amount = $totalDate * $price;
        $services = $this->service_model->all();
        $data = [
            'title' => 'Reservasi',
            'hotelId' => $hotelId,
            'roomId' => $roomId,
            'room' => $room,
            'checkIn' => $checkIn,
            'checkOut' => $checkOut,
            'amount' => $amount,
            'services' => $services
        ];
        $this->load->view('reservation', $data);
    }

    public function guest_store($hotelId, $roomId)
    {
        $this->load->model('reservation_model');
        $this->load->model('room_code_model');
        $this->load->model('payment_model');
        $this->get_data_input();
        $this->validation();
        if ($this->form_validation->run() === FALSE) {
            $in = $this->input->post('check_in');
            $out = $this->input->post('check_out');
            redirect("guest/hotel/$hotelId/room/$roomId/reservation?check_in=$in&check_out=$out");
        } else {
            $data = $this->get_data_input();
            $room = $this->reservation_model->get_reservation_room($roomId);
            shuffle($room);
            $randomRoom = reset($room);
            $userId = $this->session->userdata('user_id');

            $reservation = $data['reservation'];
            $payment = $data['payment'];
            $reservation['room_code_id'] = $randomRoom->room_code_id;
            $reservation['user_id'] = $userId;

            // generate invoice
            $date = $this->date();
            $roomCode = $this->room_code_model->find($reservation['room_code_id'])->room_code;
            $invoice = $this->payment_model->generateInvoice($hotelId, $roomCode, $date);
            $payment['invoice'] = $invoice;

            $reservationRequest = $data['reservation_request'];
            $services = $data['services'];

            $store = $this->reservation_model->insert_multiple_tables($reservation, $payment, $reservationRequest, $services);
            if ($store === TRUE) {
                $this->session->set_flashdata('success', 'Reservasi Berhasil');
            } else {
                $this->session->set_flashdata('failed', 'Reservasi Gagal');
            }
            redirect("guest/order");
        }
    }

    private function generateDateRange($startDate, $endDate)
    {
        $dateRange = [];
        $currentDate = strtotime($startDate);
        $endDate = strtotime($endDate);

        while ($currentDate <= $endDate) {
            $dateRange[] = date('Y-m-d', $currentDate);
            $currentDate = strtotime('+1 day', $currentDate);
        }

        return $dateRange;
    }

    public function validation()
    {
        $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required');
        $this->form_validation->set_rules('identity_type', 'Identitiy', 'trim|required');
        $this->form_validation->set_rules('identity_number', 'Identity Number', 'trim|required');
        $this->form_validation->set_rules('payment_method', 'Payment Method', 'trim|required');
        $this->form_validation->set_rules('request', 'Request', 'trim');
    }

    private function get_data_input()
    {
        $servicesSelect = [];
        $fullName = $this->input->post('full_name');
        $roomCodeId = $this->input->post('room_code_id');
        $email = $this->input->post('email');
        $phoneNumber = $this->input->post('phone_number');
        $identityType = $this->input->post('identity_type');
        $identityNumber = $this->input->post('identity_number');
        $checkIn = $this->input->post('check_in');
        $checkOut = $this->input->post('check_out');

        $paymentMethod = $this->input->post('payment_method');
        $amount = $this->input->post('amount');

        $request = $this->input->post('request');
        $note = $this->input->post('note');

        $in = new DateTime($checkIn);
        $out = new DateTime($checkOut);
        $day = $in->diff($out)->days;

        $services = $this->input->post('services');
        $quantity = $this->input->post('quantity');
        $note = $this->input->post('note');
        $service_price = $this->input->post('service_price');

        if (isset($services) && isset($quantity) && isset($service_price)) {
            foreach ($services as $index => $serviceId) {
                $data = [
                    'service_id' => $serviceId,
                    'quantity' => $quantity[$index],
                    'total_price' => $service_price[$index],
                    'note' => isset($note[$index]) ? $note[$index] : '',
                ];
                array_push($servicesSelect, $data);
            }
        }

        return [
            'reservation' => [
                'room_code_id' => $roomCodeId,
                'full_name' => $fullName,
                'email' => $email,
                'phone_number' => $phoneNumber,
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'total_days' => $day,
                'identity' => $identityType,
                'identity_number' => $identityNumber,
                'created_at' => date('Y-m-d H:i:s')
            ],
            'payment' => [
                'payment_method' => $paymentMethod,
                'amount' => str_replace('.', '', $amount),
                'booking_time' => date('Y-m-d H:i:s'),
                'expire_time' => date('Y-m-d H:i:s', strtotime('+1 day'))
            ],
            'reservation_request' => [
                'request' => $request,
            ],
            'services' => $servicesSelect
        ];
    }
}
