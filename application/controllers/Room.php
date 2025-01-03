<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Room extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('room_model');
        $this->load->library('form_validation');
        is_login();
    }

    public function validation()
    {
        $this->form_validation->set_rules('room_type', 'Tipe Kamar', 'required');
        $this->form_validation->set_rules('bed_id', 'Tipe Kasur', 'required');
        $this->form_validation->set_rules('capacity', 'Kapasitas', 'required');
        $this->form_validation->set_rules('price', 'Harga', 'required');
    }

    public function get_data_post($hotelId)
    {
        $roomType = $this->input->post('room_type');
        $bedId = $this->input->post('bed_id');
        $capacity = $this->input->post('capacity');
        $price = $this->input->post('price');

        return [
            'hotel_id' => $hotelId,
            'room_type' => $roomType,
            'bed_id' => $bedId,
            'capacity' => $capacity,
            'price' => $price
        ];
    }

    public function index($hotelId)
    {
        $rooms = $this->room_model->where(['hotel_id' => $hotelId]);
        $data = [
            'title' => 'Room',
            'hotelId' => $hotelId,
            'rooms' => $rooms
        ];
        $this->load->view('admin/room/index', $data);
    }
    public function show() {}
    public function create($hotelId)
    {
        guard('admin');
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

        $this->load->view('admin/room/create', $data);
    }

    public function store($hotelId)
    {
        guard('admin');
        $this->validation();
        if ($this->form_validation->run() === FALSE) {
            $this->create($hotelId);
        } else {
            $pictures = [];
            $selectedFacility = $this->input->post('facility_ids');
            $dataRoom = $this->get_data_post($hotelId);

            for ($i = 1; $i <= 5; $i++) {
                if (!empty($_FILES["picture-$i"]['name'])) {
                    $upload = image($_FILES["picture-$i"], "picture-$i", "pictures");
                    if (!empty($upload)) {
                        array_push($pictures, $upload);
                    }
                }
            }

            $post = $this->room_model->insert_multiple_tables($dataRoom, $selectedFacility, $pictures);
            if ($post === TRUE) {
                $this->session->set_flashdata('success', '');
            } else {
                $this->session->set_flashdata('failed', '');
            }
            redirect("hotel/$hotelId/room");
        }
    }

    public function edit($hotelId, $roomId)
    {
        guard('admin');
        $this->load->model('R_facility');
        $this->load->model('bed_model');
        $room = $this->room_model->find($roomId);
        $beds = $this->bed_model->all();
        $facility = $this->R_facility->get_facility($roomId);
        $data = [
            'title' => 'Update Room',
            'hotelId' => $hotelId,
            'roomId' => $roomId,
            'room' => $room,
            'beds' => $beds,
            'facility' => $facility,
        ];
        $this->load->view('admin/room/edit', $data);
    }

    public function update($hotelId, $roomId)
    {
        guard('admin');
        $this->validation();
        if ($this->form_validation->run() === FALSE) {
            $this->edit($hotelId, $roomId);
        } else {
            $pictures = [];
            $selectedFacility = $this->input->post('facility_ids');
            $dataRoom = $this->get_data_post($hotelId);

            for ($i = 1; $i <= 5; $i++) {
                if (!empty($_FILES["picture-$i"]['name'])) {
                    $upload = image($_FILES["picture-$i"], "picture-$i", "pictures");
                    if (!empty($upload)) {
                        array_push($pictures, $upload);
                    }
                }
            }

            $update = $this->room_model->update_multiple_tables($roomId, $dataRoom, $selectedFacility, $pictures);
            if ($update === TRUE) {
                $this->session->set_flashdata('success', '');
            } else {
                $this->session->set_flashdata('failed', '');
            }
            redirect("hotel/{$hotelId}/room");
        }
    }
    public function destroy() {}

    public function search_room_available($hotelId)
    {
        $this->form_validation->set_rules('check_in', 'Check In', 'required');
        $this->form_validation->set_rules('check_out', 'Check Out', 'required');
        if ($this->form_validation->run() === FALSE) {
            redirect("hotel/$hotelId/room/");
        } else {
            $checkIn = $this->input->post('check_in');
            $checkOut = $this->input->post('check_out');

            $rooms = $this->room_model->search_room($hotelId, $checkIn, $checkOut);

            $data = [
                'hotelId' => $hotelId,
                'title' => 'Search Room',
                'rooms' => $rooms
            ];

            $this->load->view('admin/room/search', $data);
        }
    }
}
