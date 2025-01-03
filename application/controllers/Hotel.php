<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hotel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('hotel_model');
        $this->load->library('form_validation');
        is_login();
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
        $role = $this->session->userdata('role');
        $hotels = $this->hotel_model->all();
        $data = [
            'title' => 'Hotel',
            'hotels' => $hotels
        ];
        if ($role === 'admin') {
            $this->load->view('admin/hotel/index', $data);
        } else if ($role === 'tamu') {
            $this->load->view('home', $data);
        }
    }

    public function show($hotelId) {}

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
        guard('admin');
        $hotel = $this->hotel_model->find($hotelId);
        $data = [
            'title' => 'Update Hotel',
            'hotel' => $hotel
        ];
        $this->load->view('admin/hotel/edit', $data);
    }

    public function update($hotelId)
    {
        guard('admin');
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
        $delete = $this->hotel_model->delete($hotelId);
        if ($delete === TRUE) {
            $this->session->set_flashdata('success', '');
        } else {
            $this->session->set_flashdata('failed', '');
        }
        redirect('hotel');
    }
}
