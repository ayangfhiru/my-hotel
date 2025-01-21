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
        is_login();
        guard('admin');
    }

    public function index()
    {
        $facilities = $this->facility_model->all();
        $data = [
            'title' => 'Fasilitas',
            'facilities' => $facilities,
        ];
        $this->load->view('admin/facility/index', $data);
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
                'icon' => toIcon($elementIcon)
            ];
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
            if ($elementIcon !== '') {
                $data['icon'] = toIcon($elementIcon);
            }
            $this->facility_model->update($id, $data);
            redirect('facility');
        }
    }

    public function destroy($id)
    {
        $this->facility_model->delete($id);
        redirect('facility');
    }
}
