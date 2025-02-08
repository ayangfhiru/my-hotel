<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Facility extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('facility_model');
        $this->load->library('form_validation');
        $this->load->helper('icon');
        // is_login();
        // guard('admin');
    }

    public function index()
    {
        $facilities = $this->facility_model->all();
        $data = [
            'title' => 'Fasilitas',
            'facilities' => $facilities,
        ];
        // print_r($data);
        // exit();
        $this->load->view('facility/list-facility', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Fasilitas'
        ];
        $this->load->view('admin/facility/create', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('facility_name', 'Facility Name', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $this->create();
        } else {
            $elementIcon = $this->input->post('icon');
            $data = [
                'facility_name' => $this->input->post('facility_name'),
            ];
            if (!empty($elementIcon)) {
                $data['icon'] = toIcon($elementIcon);
            }
            $addFacility =  $this->facility_model->create($data);
            if ($addFacility === TRUE) {
                $this->session->set_flashdata('success', 'Tambah Fasilitas Berhasil!');
            } else {
                $this->session->set_flashdata('failed', 'Tambah Fasilitas Gagal!');
            }
            redirect('facility');
        }
    }

    public function update($id)
    {
        $this->form_validation->set_rules('facility_name', 'Facility Name', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $this->create();
        } else {
            $elementIcon = $this->input->post('icon');
            $data = [
                'facility_name' => $this->input->post('facility_name'),
            ];
            if (!empty($elementIcon)) {
                $data['icon'] = toIcon($elementIcon);
            }
            $this->facility_model->update($id, $data);
            redirect('facility');
        }
    }

    public function destroy($facilityId)
    {
        guard('admin');
        $this->load->model('room/room_facility_model');

        $checkFacility = $this->room_facility_model->findFacility(['facility_id' => $facilityId]);
        if (empty($checkFacility)) {
            $delete = $this->facility_model->delete($facilityId);
            ($delete === TRUE) ?
                $this->session->set_flashdata('success', 'Hapus fasilitas sukses') : $this->session->set_flashdata('failed', 'Hapus fasilitas gagal');
        } else {
            $this->session->set_flashdata('failed', 'Fasilitas masih digunakan kamar');
        }
    }
}
