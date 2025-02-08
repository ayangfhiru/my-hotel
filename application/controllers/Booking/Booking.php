<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('booking/booking_model');
        $this->load->model('room/room_code_model');
        $this->load->model('payment/payment_model');
        $this->load->library('form_validation');
        $this->load->helper('date');
        is_login();
    }

    private function validationBooking()
    {
        $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|numeric');
        $this->form_validation->set_rules('identity_number', 'Identity Number', 'trim|numeric');
        $this->form_validation->set_rules('room_code', 'Room Code', 'trim|required|numeric');
        $this->form_validation->set_rules('request', 'Request', 'trim');
    }

    private function getDataBooking()
    {
        return [
            'booking' => [
                'booking_code' => $this->input->post('booking_code'),
            ],
            'booking_detail' => [
                'room_code_id' => $this->input->post('room_code'),
                'full_name' => $this->input->post('full_name'),
                'email' => $this->input->post('email'),
                'phone_number' => $this->input->post('phone_number'),
                'check_in' => $this->input->post('check_in'),
                'check_out' => $this->input->post('check_out'),
                'identity_type' => $this->input->post('identity_type'),
                'identity_number' => $this->input->post('identity_number'),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            'booking_request' => [
                'request' => $this->input->post('request'),
            ]
        ];
    }

    public function addBooking()
    {
        $this->load->model('booking_model');
        $hotelId = $this->session->userdata('hotel_id');
        $data = [
            'hotelId' => $hotelId,
            'bookingCode' => strtoupper(uniqid()),
        ];
        return $this->load->view('booking/create', $data);
    }

    public function storeBooking()
    {
        $this->validationBooking();
        if ($this->form_validation->run() === FALSE) {
            redirect('bookings/room');
        } else {
            $data = $this->getDataBooking();
            $dataBo = $data['booking'];
            $dataBoDetail = $data['booking_detail'];
            $dataBoReq = $data['booking_request'];

            $booking = $this->booking_model->foCreateBookingWithDetail($dataBo, $dataBoDetail, $dataBoReq);
            if ($booking === TRUE) {
                $this->session->set_flashdata('success', 'Reservasi Berhasil');
                redirect('bookings/schedules');
            } else {
                $this->session->set_flashdata('failed', 'Reservasi Gagal');
                redirect('bookings/room');
            }
        }
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

    public function show($hotelId, $bookingId)
    {
        guard('admin');
        $data = [
            'title' => 'Detail Booking'
        ];
        $this->load->view('admin/booking/detail', $data);
    }

    public function create($hotelId, $roomId)
    {
        $checkIn =  $this->input->get('check_in');
        $checkOut = $this->input->get('check_out');
        $roomCode = $this->room_code_model->findAvailableRoomCodes($hotelId, $roomId, $checkIn, $checkOut);

        $in = new DateTime($checkIn);
        $out = new DateTime($checkOut);
        $totalDate = $in->diff($out)->d;
        $price =  number_format($roomCode[0]->price, 0, '', '');
        $amount = $totalDate * $price;

        $data = [
            'title' => 'Booking',
            'hotelId' => $hotelId,
            'roomId' => $roomId,
            'room_code' => $roomCode,
            'checkIn' => $checkIn,
            'checkOut' => $checkOut,
            'price' => $price,
            'amount' => $amount
        ];

        if ($this->session->userdata('role') === 'admin') {
            $this->load->view('admin/booking/create', $data);
        } else {
            $this->load->view('booking', $data);
        }
    }

    public function store($hotelId, $roomId)
    {
        guard('admin');
        $this->validation();
        if ($this->form_validation->run() === FALSE) {
            redirect("hotel/$hotelId/room/$roomId/booking");
        } else {
            $data = $this->get_data_input();
            $dataBooking = $data['data_booking'];
            $dataBooking = 'confirmed';
            $payment = $data['payment'];

            if ($payment['payment_method'] === 'cash') {
                $payment['payment_status'] = 'completed';
            }

            // generate invoice
            $date = date_range();
            $roomCode = $this->room_code_model->find($dataBooking['room_code_id'])->room_code;
            $invoice = $this->payment_model->generateInvoice($hotelId, $roomCode, $date);
            $payment['invoice'] = $invoice;

            $reservationRequest['request'] = '';
            $services = '';

            $store = $this->booking_model->createBookingWithDetails($dataBooking, $payment, $reservationRequest, $services);
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

    public function calendar($hotelId)
    {
        guard('admin');
        $this->load->model('room/room_model');

        $startDate = $this->input->get('start');
        $endDate = $this->input->get('end');

        if (empty($startDate) || empty($endDate) || $startDate > $endDate) {
            $startDate = date('Y-m-d', strtotime('-1 days'));
            $endDate = date('Y-m-d', strtotime('+30 days'));
        };

        $roomCode = $this->room_model->getRoomCodesByHotel($hotelId);
        $bookings = $this->booking_model->getBookingByDateRange($hotelId, $startDate, $endDate);
        $dates = $this->generateDateRange($startDate, $endDate);
        $data = [
            'title' => 'Kalender',
            'hotelId' => $hotelId,
            'dates' => $dates,
            'room_code' => $roomCode,
            'bookings' => $bookings,
            'startDate' => current($dates),
            'endDate' => end($dates)
        ];

        $this->load->view("admin/booking/calendar", $data);
    }

    public function showBooking($hotelId, $roomId, $checkIn, $checkOut)
    {
        $this->load->model('room/room_model');
        $this->load->model('extra_service_model');
        $this->load->helper('date');

        $room = $this->room_model->find($roomId);
        $checkIn = date('Y-m-d', $checkIn);
        $checkOut = date('Y-m-d', $checkOut);
        $totalDate = interval($checkIn, $checkOut);
        $price =  number_format($room->price, 0, '', '');
        $amount = $totalDate * $price;
        $services = $this->extra_service_model->all();
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
        $this->load->view('booking', $data);
    }

    public function guest_store($hotelId, $roomId)
    {
        $this->load->model('reservation_model');
        $this->load->model('room_code_model');
        $this->load->model('payment_model');
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
            $date = date_range();
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
            'data_booking' => [
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
            'booking_request' => [
                'request' => $request,
            ],
            'services' => $servicesSelect
        ];
    }
}
