<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bed extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bed_model');
        $this->load->library('form_validation');
        // is_login();
        // guard('super');
    }

    public function index()
    {
        $beds = $this->bed_model->all();
        $data = [
            'title' => 'Tempat Tidur',
            'beds' => $beds,
        ];
        $this->load->view('bed/list-beds', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('bed_type', 'Bed Name', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $this->index();
        } else {
            $data = [
                'bed_type' => $this->input->post('bed_type')
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
        $this->form_validation->set_rules('bed_type', 'Facility Name', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $this->create();
        } else {
            $data = [
                'bed_type' => $this->input->post('bed_type')
            ];
            $this->bed_model->update($id, $data);
            redirect('bed');
        }
    }

    public function destroy($bedId)
    {
        guard('admin');
        $this->load->model('room/room_model');

        $checkRoom = $this->room_model->where(['bed_id' => $bedId]);
        if (empty($checkRoom)) {
            $delete = $this->bed_model->delete($bedId);
            ($delete === TRUE) ?
                $this->session->set_flashdata('success', 'Hapus tampat tidur sukses') : $this->session->set_flashdata('failed', 'Hapus tampat tidur gagal');
        } else {
            $this->session->set_flashdata('failed', 'Masih ada kamar yang memakai');
        }
    }
}
