<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hotel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('hotel_model');
        $this->load->library('form_validation');
        // is_login();
    }

    public function validation()
    {
        $this->form_validation->set_rules('name', 'Nama Hotel', 'trim|required');
        $this->form_validation->set_rules('city', 'Kota', 'trim|required');
        $this->form_validation->set_rules('address', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim');
    }

    public function index()
    {
        guard('super');
        $hotels = $this->hotel_model->all();
        $data = [
            'title' => 'Hotel',
            'hotels' => $hotels
        ];
        $this->load->view('hotel/index', $data);
    }


    public function show($hotelId)
    {
        guard('super');
        $this->load->model('room/room_model');
        $this->load->model('room/room_picture_model');
        $hotel = $this->hotel_model->find($hotelId);
        $rooms = $this->room_model->findRoomWithHotel($hotelId);
        $pictures = $this->room_picture_model->getPicturesByHotel($hotelId);
        $data = [
            'title' => 'Detail',
            'hotelId' => $hotelId,
            'hotel' => $hotel,
            'rooms' => $rooms,
            'pictures' => $pictures,
        ];
        $this->load->view('hotel/detail', $data);
    }

    public function create()
    {
        guard('admin');
        $data = [
            'title' => 'Tambah Hotel',
        ];
        $this->load->view('admin/hotel/create', $data);
    }

    public function store()
    {
        guard('admin');
        $this->validation();
        if ($this->form_validation->run() === FALSE) {
            $this->create();
        } else {
            $name = $this->input->post('name');
            $address = $this->input->post('address');
            $city = $this->input->post('city');
            $description = $this->input->post('description');
            $thumbnailName = null;

            if (!empty($_FILES["thumbnail"]['name'])) {
                $upload = image($_FILES["thumbnail"], "thumbnail", "thumbnail");
                if (!empty($upload)) {
                    $thumbnailName = $upload;
                }
            }

            $data = [
                'name' => $name,
                'address' => $address,
                'city' => $city,
                'description' => $description,
                'thumbnail' => $thumbnailName,
            ];

            $store = $this->hotel_model->create($data);
            if ($store === TRUE) {
                $this->session->set_flashdata('success', '');
            } else {
                $this->session->set_flashdata('failed', '');
            }
            redirect('hotel');
        }
    }

    public function edit($hotelId)
    {
        guard('super');
        $hotel = $this->hotel_model->find($hotelId);
        $data = [
            'title' => 'Update Hotel',
            'hotel' => $hotel
        ];
        $this->load->view('hotel/edit', $data);
    }

    public function update($hotelId)
    {
        guard('super');
        $this->validation();
        if ($this->form_validation->run() === FALSE) {
            $this->create();
        } else {
            $name = $this->input->post('name');
            $city = $this->input->post('city');
            $address = $this->input->post('address');
            $description = $this->input->post('description');
            $data = [
                'name' => $name,
                'city' => $city,
                'address' => $address,
                'description' => $description,
            ];
            $update = $this->hotel_model->update($hotelId, $data);
            if ($update === TRUE) {
                $this->session->set_flashdata('success', '');
            } else {
                $this->session->set_flashdata('failed', '');
            }
            redirect('hotel');
        }
    }

    public function destroy($hotelId)
    {
        guard('admin');
        $this->load->model('room/room_model');

        $checkRoom = $this->room_model->where(['hotel_id' => $hotelId]);
        if (empty($checkRoom)) {
            $delete = $this->hotel_model->delete($hotelId);
            ($delete === TRUE) ?
                $this->session->set_flashdata('success', 'Hapus hotel sukses') : $this->session->set_flashdata('failed', 'Hapus hotel gagal');
        } else {
            $this->session->set_flashdata('failed', 'Hotel masih memiliki kamar');
        }
    }

    public function findAvailableHotel()
    {
        $checkIn = $this->input->post('check_in');
        $checkOut = $this->input->post('check_out');
        $hotels = $this->hotel_model->findAvailableHotels($checkIn, $checkOut);
        $data = [
            'title' => 'Search Hotel',
            'hotels' => $hotels,
            'checkIn' => $checkIn,
            'checkOut' => $checkOut
        ];
        $this->load->view('home', $data);
    }

    public function setDetailHotel()
    {
        $hotelId = $this->input->post('hotel_id');
        $checkIn = $this->input->post('check_in') ?? date('Y-m-d');
        $checkOut = $this->input->post('check_out') ?? date('Y-m-d', strtotime('+1 days'));

        $dataSession = [
            'hotel_id' => $hotelId,
            'check_in' => $checkIn,
            'check_out' => $checkOut
        ];
        $this->session->set_userdata('detail-hotel', $dataSession);
        redirect('guest/hotel/detail');
    }

    public function showDetailHotel()
    {
        $this->load->model('room/room_model');
        $this->load->model('room/room_picture_model');
        $this->load->model('facility_model');

        $data = $this->session->userdata('detail-hotel');
        $hotelId = $data['hotel_id'];
        $checkIn = $data['check_in'];
        $checkOut = $data['check_out'];

        $hotel = $this->hotel_model->find($hotelId);
        $hotelPictures = $this->room_picture_model->getPicturesByHotel($hotelId);
        $availableRooms = $this->room_model->findAvailableRooms($hotelId, $checkIn, $checkOut);
        $facilities = $this->facility_model->findFacilitiesByHotel($hotelId);

        $data = [
            'title' => 'Detai Hotel',
            'hotel' => $hotel,
            'pictures' => $hotelPictures,
            'rooms' => $availableRooms,
            'facilities' => $facilities,
            'checkIn' => $checkIn,
            'checkOut' => $checkOut
        ];
        $this->load->view('detail', $data);
    }
}
