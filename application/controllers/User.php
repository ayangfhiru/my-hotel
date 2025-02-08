<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('role_model');
        $this->load->library('form_validation');
        is_login();
    }

    public function index()
    {
        $allStaff = $this->user_model->allStaff();
        $roles = $this->role_model->all();
        $data = [
            'users' => $allStaff,
            'roles' => $roles,
        ];
        $this->load->view('user/list-users', $data);
    }

    private function staffValidation()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|min_length[10]|max_length[13]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|trim', [
            'min_length' => 'The Password is too short',
            'matches' => 'The Password does not match',
        ]);
    }

    private function getDataStaff()
    {
        return [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'phone_number' => $this->input->post('phone_number'),
            'role_code' => $this->input->post('role_code'),
            'password' => $this->input->post('password'),
        ];
    }

    public function addStaff()
    {
        $this->staffValidation();
        if ($this->form_validation->run() === FALSE) {
            redirect('users');
        } else {
            $data = $this->getDataStaff();
            $checkUser = $this->user_model->findUserByEmail($data['email']);
            if ($checkUser) {
                $this->session->set_flashdata('failed', 'Email already exists!');
                redirect('users');
            }

            $dataStaff = [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'role_code' => $data['role_code'],
            ];

            $register =  $this->user_model->create($dataStaff);
            if ($register) {
                $this->session->set_flashdata('success', 'Register Success!');
            } else {
                $this->session->set_flashdata('failed', 'Register Failed!');
            }
            redirect('users');
        }
    }
}
