<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Room extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('room/room_model');
        $this->load->library('form_validation');
        is_login();
    }

    public function validation()
    {
        $this->form_validation->set_rules('room_type', 'Room Type', 'required');
        $this->form_validation->set_rules('bed_type', 'Bed Type', 'required');
        $this->form_validation->set_rules('capacity', 'Capacity', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
    }

    public function getData()
    {
        return [
            'room_type' => $this->input->post('room_type'),
            'bed_id' => $this->input->post('bed_type'),
            'capacity' => $this->input->post('capacity'),
            'price' => $this->input->post('price')
        ];
    }

    public function index($hotelId)
    {
        $rooms = $this->room_model->findRoomWithBed(['hotel_id' => $hotelId]);
        $data = [
            'title' => 'Room',
            'hotelId' => $hotelId,
            'rooms' => $rooms
        ];
        $this->load->view('admin/room/index', $data);
    }

    public function create($hotelId)
    {
        guard('super');
        $this->load->model('facility_model');
        $this->load->model('bed_model');
        $beds = $this->bed_model->all();
        $facilities = $this->facility_model->all();
        $data = [
            'title' => 'Tambah Kamar',
            'hotelId' => $hotelId,
            'beds' => $beds,
            'facilities' => $facilities
        ];

        $this->load->view('room/create', $data);
    }

    public function store($hotelId)
    {
        guard('super');
        $this->validation();
        if ($this->form_validation->run() === FALSE) {
            redirect("hotel/$hotelId/room/create");
        } else {
            $pictures = [];
            $selectedFacility = $this->input->post('facility_ids');
            $dataRoom = $this->getData();
            $dataRoom['hotel_id'] = $hotelId;

            for ($i = 1; $i <= 5; $i++) {
                if (!empty($_FILES["picture-$i"]['name'])) {
                    $upload = image($_FILES["picture-$i"], "picture-$i", "pictures");
                    if (!empty($upload)) {
                        array_push($pictures, $upload);
                    }
                }
            }

            $post = $this->room_model->addRoomWithDetails($dataRoom, $selectedFacility, $pictures);
            if ($post === TRUE) {
                $this->session->set_flashdata('success', '');
            } else {
                $this->session->set_flashdata('failed', '');
            }
            redirect("hotel/$hotelId/show");
        }
    }

    public function edit($hotelId, $roomId)
    {
        guard('super');
        $this->load->model('room/room_facility_model');
        $this->load->model('room/room_code_model');
        $this->load->model('bed_model');
        $room = $this->room_model->find($roomId);
        // print_r($room);
        // exit();
        $hotelId = $room->hotel_id;
        $beds = $this->bed_model->all();
        $facilities = $this->room_facility_model->getFacilitiesByRoom($roomId);
        $roomCodes = $this->room_code_model->where(['room_id' => $roomId]);
        $data = [
            'title' => 'Update Room',
            'hotelId' => $hotelId,
            'room' => $room,
            'beds' => $beds,
            'facilities' => $facilities,
            'roomCodes' => $roomCodes
        ];
        $this->load->view('room/edit', $data);
    }

    public function update($hotelId, $roomId)
    {
        guard('super');
        $this->validation();
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('failed', '');
            redirect("hotel/$hotelId/room/$roomId/edit");
        } else {
            $pictures = [];
            $selectedFacility = $this->input->post('facility_ids');
            $dataRoom = $this->getData();

            for ($i = 1; $i <= 5; $i++) {
                if (!empty($_FILES["picture-$i"]['name'])) {
                    $upload = image($_FILES["picture-$i"], "picture-$i", "pictures");
                    if (!empty($upload)) {
                        array_push($pictures, $upload);
                    }
                }
            }

            $update = $this->room_model->updateRoomWithDetails($roomId, $dataRoom, $selectedFacility, $pictures);
            if ($update === TRUE) {
                $this->session->set_flashdata('success', '');
            } else {
                $this->session->set_flashdata('failed', '');
            }
            redirect("hotel/$hotelId/show");
        }
    }

    public function destroy($hotelId, $roomId)
    {
        guard('super');
        $this->load->model('room/room_code_model');
        $checkRoomCode = $this->room_code_model->where(['room_id' => $roomId]);
        if (empty($checkRoomCode)) {
            $delete = $this->room_model->delete($roomId);
            ($delete === TRUE) ?
                $this->session->set_flashdata('success', 'Hapus kamar sukses') : $this->session->set_flashdata('failed', 'Hapus kamar gagal');
        } else {
            $this->session->set_flashdata('failed', 'Kamar masih memiliki kode kamar');
        }
        redirect("hotel/$hotelId/show");
    }

    public function searchAvailableRooms($hotelId)
    {
        guard('admin');
        $this->load->model('facility_model');
        $checkIn = $this->input->get('check_in');
        $checkOut = $this->input->get('check_out');

        $rooms = $this->room_model->findAvailableRooms($hotelId, $checkIn, $checkOut);
        $facilities = $this->facility_model->findFacilitiesByHotel($hotelId);

        $data = [
            'title' => 'Search Room',
            'hotelId' => $hotelId,
            'rooms' => $rooms,
            'facilities' => $facilities
        ];

        $this->load->view('admin/room/search', $data);
    }

    public function guest_room($hotelId)
    {
        $this->load->model('hotel_model');
        $this->load->model('room_model');
        $this->load->model('room/room_picture_model');
        $this->load->model('facility_model');

        $checkIn = $this->input->get('check_in') ?? date('Y-m-d');
        $checkOut = $this->input->get('check_out') ?? date('Y-m-d', strtotime('+1 day'));
        print_r($checkIn);
        exit();

        $hotel = $this->hotel_model->find($hotelId);
        $rooms = $this->room_model->findAvailableRooms($hotelId, $checkIn, $checkOut);
        $pictures = $this->room_picture_model->get_picture($hotelId);
        $facilities = $this->facility_model->search_facility($hotelId);

        $data = [
            'title' => 'Detail',
            'hotelId' => $hotelId,
            'hotel' => $hotel,
            'rooms' => $rooms,
            'pictures' => $pictures,
            'facilities' => $facilities,
            'checkIn' => $checkIn,
            'checkOut' => $checkOut
        ];
        $this->load->view('detail', $data);
    }

    public function findAvaiableRooms()
    {
        guard('fo');
        $hotelId = $this->session->userdata('hotel_id');
        $checkIn = $this->input->get('check_in');
        $checkOut = $this->input->get('check_out');

        $rooms = $this->room_model->findAvailableRoomCodesByHotel($hotelId, $checkIn, $checkOut);

        echo json_encode($rooms);
    }
}
