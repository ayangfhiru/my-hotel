<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service_model');
        $this->load->library('form_validation');
        is_login();
        guard('admin');
    }

    private function validation()
    {
        $this->form_validation->set_rules('service_name', 'Service Name', 'trim|required');
        $this->form_validation->set_rules('service_price', 'Harga', 'trim|required');
        $this->form_validation->set_rules('description', 'Harga', 'trim');
    }

    private function get_data()
    {
        return [
            'service_name' => $this->input->post('service_name'),
            'service_price' => $this->input->post('service_price'),
            'description' => $this->input->post('description')
        ];
    }

    public function index()
    {
        $services = $this->service_model->all();
        $data = [
            'title' => 'Tempat Tidur',
            'services' => $services,
        ];
        $this->load->view('admin/service/index', $data);
    }

    public function create() {}

    public function store()
    {
        $this->validation();
        if ($this->form_validation->run() === FALSE) {
            $this->index();
        } else {
            $data = $this->get_data();
            // print_r($data);
            // exit();
            $add =  $this->service_model->create($data);
            if ($add === TRUE) {
                $this->session->set_flashdata('success', 'Tambah Service Berhasil!');
            } else {
                $this->session->set_flashdata('failed', 'Tambah Service Gagal!');
            }
            redirect('service');
        }
    }

    public function update($id)
    {
        $this->validation();
        if ($this->form_validation->run() === FALSE) {
            $this->create();
        } else {
            $data = $this->get_data();
            $update = $this->service_model->update($id, $data);
            if ($update === TRUE) {
                $this->session->set_flashdata('success', 'Update Service Berhasil!');
            } else {
                $this->session->set_flashdata('failed', 'Update Service Gagal!');
            }
            redirect('service');
        }
    }

    public function destroy($id)
    {
        $delete = $this->service_model->delete($id);
        if ($delete === TRUE) {
            $this->session->set_flashdata('success', 'Delete Service Berhasil!');
        } else {
            $this->session->set_flashdata('failed', 'Delete Service Gagal!');
        }
        redirect('service');
    }
}
