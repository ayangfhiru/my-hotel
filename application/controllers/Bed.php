<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bed extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bed_model');
        $this->load->library('form_validation');
        is_login();
        guard('admin');
    }

    public function index()
    {
        $beds = $this->bed_model->all();
        $data = [
            'title' => 'Tempat Tidur',
            'beds' => $beds,
        ];
        $this->load->view('admin/bed/index', $data);
    }

    public function create() {}

    public function store()
    {
        $this->form_validation->set_rules('bed_name', 'Bed Name', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $this->index();
        } else {
            $data = [
                'bed_name' => $this->input->post('bed_name')
            ];
            $add =  $this->bed_model->create($data);
            if ($add === TRUE) {
                $this->session->set_flashdata('success', 'Tambah Fasilitas Berhasil!');
            } else {
                $this->session->set_flashdata('failed', 'Tambah Fasilitas Gagal!');
            }
            redirect('bed');
        }
    }

    public function update($id)
    {
        $this->form_validation->set_rules('bed_name', 'Facility Name', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $this->create();
        } else {
            $data = [
                'bed_name' => $this->input->post('bed_name')
            ];
            $this->bed_model->update($id, $data);
            redirect('bed');
        }
    }

    public function destroy($id)
    {
        $this->bed_model->delete($id);
        redirect('bed');
    }
}
