<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('room/room_model');
        $this->load->model('booking/booking_model');
        is_login();
        guard('fo');
    }

    public function index()
    {
        guard('fo');
        $hotelId = $this->session->userdata('hotel_id');

        $startDate = date('Y-m-01');
        $endDate = date('Y-m-t');

        $roomCode = $this->room_model->getRoomCodesByHotel($hotelId);
        $bookings = $this->booking_model->getBookingByDateRange($hotelId, $startDate, $endDate);
        $dates = $this->generateDateRange($startDate, $endDate);
        $data = [
            'title' => 'Kalender',
            // 'hotelId' => $hotelId,
            'bookings' => $bookings
        ];

        return $this->load->view('schedule/index', $data);
    }

    public function findBooking()
    {
        $hotelId = $this->session->userdata('hotel_id');

        $startDate = $this->input->post('start_date');
        $endDate = $this->input->post('end_date');
        $bookings = $this->booking_model->getBookingByDateRange($hotelId, $startDate, $endDate);

        echo json_encode($bookings);
    }

    public function store() {}

    public function edit() {}

    public function update() {}

    public function destroy() {}

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
}
