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

    public function validation()
    {
        $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required');
        $this->form_validation->set_rules('identity_type', 'Identitiy', 'trim|required');
        $this->form_validation->set_rules('identity_number', 'Identity Number', 'trim|required');
        $this->form_validation->set_rules('payment_method', 'Payment Method', 'trim|required');
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

    public function index($hotelId)
    {
        $reservations = $this->reservation_model->get_reservation_hotel($hotelId);
        $data = [
            'title' => 'Reservation',
            'hotelId' => $hotelId,
            'reservations' => $reservations
        ];
        $this->load->view('admin/reservation/index', $data);
    }

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

        $this->load->view('admin/reservation/create', $data);
    }

    public function store($hotelId, $roomId)
    {
        $this->load->model('room_code_model');
        $this->load->model('payment_model');
        $this->validation();
        if ($this->form_validation->run() === FALSE) {
            redirect("hotel/$hotelId/room/$roomId/reservation");
        } else {
            $userId = $this->input->post('user_account');
            $fullName = $this->input->post('full_name');
            $roomCodeId = $this->input->post('room_code');
            $email = $this->input->post('email');
            $phoneNumber = $this->input->post('phone_number');
            $identityType = $this->input->post('identity_type');
            $identityNumber = $this->input->post('identity_number');
            $chcekIn = $this->input->post('check_in');
            $chcekOut = $this->input->post('check_out');
            $paymentMethod = $this->input->post('payment_method');
            $amount = $this->input->post('amount');

            $in = new DateTime($chcekIn);
            $out = new DateTime($chcekOut);
            $day = $in->diff($out)->days;

            $dataReservation = [
                'room_code_id' => $roomCodeId,
                'full_name' => $fullName,
                'email' => $email,
                'phone_number' => $phoneNumber,
                'check_in' => $chcekIn,
                'check_out' => $chcekOut,
                'total_days' => $day,
                'identity' => $identityType,
                'identity_number' => $identityNumber
            ];

            if ($userId == '') {
                $dataReservation['user_id'] = null;
            } else {
                $dataReservation['user_id'] = $userId;
            }

            $dataPayment = [
                'invoice' => '',
                'payment_method' => $paymentMethod,
                'payment_deadline' => '-',
                'amount' => $amount
            ];

            // generate invoice
            $date = $this->date();
            $roomCode = $this->room_code_model->find($roomCodeId)->room_code;
            $invoice = $this->payment_model->generateInvoice($hotelId, $roomCode, $date);
            $dataPayment['invoice'] = $invoice;

            // deadline
            $epocTomorrow = strtotime('+1 day');
            $tomorrow = date('Y-m-d H:m:s', $epocTomorrow);
            $dataPayment['payment_deadline'] = $tomorrow;

            $store = $this->reservation_model->insert_multiple_tables($dataReservation, $dataPayment);
            if ($store === TRUE) {
                $this->session->set_flashdata('success', '');
            } else {
                $this->session->set_flashdata('failed', '');
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

    public function guest_in($hotelId, $roomCodeId, $reservationId)
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

    public function guest_out($hotelId, $roomCodeId, $reservationId)
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

    public function guest_cancel($hotelId, $roomCodeId, $reservationId)
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
        $this->load->model('room_model');
        $roomCode = $this->room_model->get_room_code($hotelId);
        $reservations = $this->reservation_model->get_reservation($hotelId);

        $data = [
            'title' => 'Kalender',
            'dates' => $this->generateDateRange(),
            'room_code' => $roomCode,
            'reservations' => $reservations
        ];
        $this->load->view("admin/reservation/calendar", $data);
    }

    private function generateDateRange($startDate = "2024-12-25", $endDate = "2024-12-31")
    {
        $startDate = $startDate ?: date('Y-m-d');
        $endDate = $endDate ?: date('Y-m-d', strtotime('+30 days'));

        $dateRange = [];
        $currentDate = strtotime($startDate);
        $endDate = strtotime($endDate);

        while ($currentDate <= $endDate) {
            $dateRange[] = date('Y-m-d', $currentDate);
            $currentDate = strtotime('+1 day', $currentDate);
        }

        return $dateRange;
    }
}
