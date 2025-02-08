<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MultipleBooking extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('room/room_model');
        $this->load->model('booking/booking_model');
        $this->load->model('extra_service_model');
        $this->load->model('user_model');
        $this->load->helper('date');
        $this->load->helper('url');
        $this->load->library('Midtrans_lib');
        is_login();
    }

    private function getRoomPost()
    {
        return [
            'room_id' => $this->input->post('room_id'),
            'room_price' => $this->input->post('room_price'),
            'check_in' => $this->input->post('check_in'),
            'check_out' => $this->input->post('check_out'),
            'full_name' => $this->input->post('full_name'),
            'email' => $this->input->post('email'),
            'phone_number' => $this->input->post('phone_number'),
            'identity_type' => $this->input->post('identity_type'),
            'identity_number' => $this->input->post('identity_number'),
            'request' => $this->input->post('request'),
            'services' => $this->input->post('services'),
            'service_name' => $this->input->post('service_name'),
            'quantity' => $this->input->post('service_quantity'),
            'service_price' => $this->input->post('service_price'),
            'note' => $this->input->post('note')
        ];
    }

    private function processRoomData($roomId, $checkIn, $checkOut)
    {
        $room = $this->booking_model->findAvailableRoomCodes($roomId, $checkIn, $checkOut);

        if (empty($room)) {
            return;
        }

        // acak room_code
        $roomArray = is_array($room) ? $room : (array)$room;
        shuffle($roomArray);

        $randomRoom = reset($roomArray);
        $roomCodeId = $randomRoom->room_code_id;

        return $roomCodeId;
    }

    public function showBookRooms()
    {
        $this->load->model('cart_model');
        $userId = $this->session->userdata('user_id');
        $selectedRoom = $this->input->post('selected_room');
        $rooms = $this->cart_model->findRoomsByCart($userId, $selectedRoom);
        $services = $this->extra_service_model->all();
        $data = [
            'title' => 'Check Out',
            'rooms' => $rooms,
            'services' => $services
        ];
        $this->load->view('bo-multiple', $data);
    }

    public function storeBookRooms()
    {
        $postData = (object) $this->getRoomPost();
        $userId = $this->session->userdata('user_id');
        $user = $this->user_model->find($userId);
        $bookingCode = strtoupper(uniqid());

        $customerDetails = [
            'first_name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone_number,
        ];

        $dataBooking = [
            'booking_code' => $bookingCode,
            'user_id' => $userId
        ];

        $totalAmount = 0;
        $dataDeleteCart = [];
        $itemDetails = [];
        foreach ($postData->room_id as $index => $roomId) {
            // $room = $this->room_model->find($roomId);
            // $itemDetails[] = [
            //     'id' => $room->room_id,
            //     'price' => $room->price,
            //     'quantity' => 1,
            //     'name' => $room->room_type,
            // ];

            // $hotelId, $roomId, $checkIn, $checkOut
            $roomCodeId = $this->processRoomData($postData->room_id[$index], $postData->check_in[$index], $postData->check_out[$index]);

            // Detail Booking per kamar
            $dataBoDetail = [
                'room_code_id' => $roomCodeId,
                'check_in' => $postData->check_in[$index],
                'check_out' => $postData->check_out[$index],
                'full_name' => $postData->full_name[$index],
                'email' => $postData->email[$index],
                'phone_number' => $postData->phone_number[$index],
                'identity_type' => $postData->identity_type[$index],
                'identity_number' => $postData->identity_number[$index],
                'room_price' => $postData->room_price[$index],
            ];

            // Menambahkan request ke dalam data booking jika ada
            $dataBoReq = !empty($postData->request[$index]) ? $postData->request[$index] : null;

            // Inisialisasi array untuk layanan per kamar
            $dataBoExService = [];

            // Jika ada layanan untuk kamar ini
            $totalAmountServiceRoom = 0;
            if (!empty($postData->services[$index]) && is_array($postData->services[$index])) {

                // Loop melalui layanan yang dipilih untuk setiap kamar
                $serviceTotalPrice = 0;
                foreach ($postData->services[$index] as $key => $serviceId) {
                    $servicePrice = $postData->service_price[$index][$key];
                    $serviceQuantity = $postData->quantity[$index][$key];
                    $serviceTotalPrice = $servicePrice * $serviceQuantity;
                    $totalAmountServiceRoom += $serviceTotalPrice;

                    // Menyimpan data layanan yang dipilih per kamar
                    $dataBoExService[] = [
                        'service_id' => $serviceId,
                        'quantity' => $serviceQuantity,
                        'price' => $servicePrice,
                        'total_price' => $serviceTotalPrice,
                        'note' => $postData->note[$index][$key]
                    ];

                    // $itemDetails[] = [
                    //     'id' => $serviceId,
                    //     'price' => $servicePrice,
                    //     'quantity' => $serviceTotalPrice,
                    //     'name' => $postData->service_name[$index][$key],
                    // ];
                }
            }

            // Format data sesuai dengan kebutuhan: booking_detail + services
            $dataDetailBooking[] = [
                'booking_detail' => $dataBoDetail,
                'services' => $dataBoExService,
                'total_amount_service' => $totalAmountServiceRoom,
                'payment_detail' => [
                    'detail_amount' => $totalAmountServiceRoom + $postData->room_price[$index],
                ],
                'booking_request' => [
                    'request' => $dataBoReq,
                ]
            ];

            // Tambahkan total harga kamar dan total harga layanan untuk kamar ini
            $dataBoDetail['total_price'] = $postData->room_price[$index] + $totalAmountServiceRoom;
            $totalAmount += $dataBoDetail['total_price']; // Tambahkan ke total keseluruhan booking

            // data delete cart
            $dataDeleteCart[] = [
                'user_id' => $userId,
                'room_id' => $postData->room_id[$index],
                'chek_in' => $postData->check_in[$index],
                'check_out' => $postData->check_out[$index]
            ];
        }

        // Data pembayaran
        $dataPayment = [
            'order_id' => $bookingCode,
            'invoice' => "INV/$bookingCode",
            'payment_status' => 'pending',
            'amount' => (int)$totalAmount,
        ];

        $transaction = $this->midtrans_lib->createTransaction($bookingCode, $dataPayment['amount'], $customerDetails, $itemDetails);

        $dataPayment['snap_token'] = $transaction;

        $booking = $this->booking_model->createMultiBookingWithDetails($dataBooking, $dataPayment, $dataDetailBooking);

        if ($booking === TRUE) {
            $dataDeleteCart = [
                'user_id' => $userId,
                'room_id' => $postData->room_id,
                'chek_in' => $postData->check_in,
                'check_out' => $postData->check_out
            ];
            $this->session->set_flashdata('success', 'Booking Berhasil');
        } else {
            $this->session->set_flashdata('failed', 'Booking Gagal');
        }
        redirect('');
    }
}
