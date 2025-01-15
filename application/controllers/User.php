<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('form_validation');
    }

    public function login_validation()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|trim', [
            'min_length' => 'The Password is too short',
        ]);
    }

    public function register_validation()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|numeric|min_length[10]|max_length[13]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|matches[confirm_password]|trim', [
            'min_length' => 'The Password is too short',
            'matches' => 'The Password does not match',
        ]);
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim');
    }

    public function index()
    {
        $data = [
            'title' => 'Sign In'
        ];
        $this->load->view('sign-in', $data);
    }

    public function login()
    {
        $this->login_validation();
        if ($this->form_validation->run() === FALSE) {
            $this->index();
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->user_model->user_email($email);
            if (!$user) {
                $this->session->set_flashdata('failed', 'User not found!');
                $this->load->view('sign-in');
            } else {
                if (password_verify($password, $user->password)) {
                    $dataSession = [
                        'user_id' => $user->user_id,
                        'name' => $user->name,
                        'role' => $user->role,
                        'is_login' => TRUE
                    ];
                    $this->session->set_flashdata('success', 'Login Success');
                    $this->session->set_userdata($dataSession);
                    if ($user->role === 'admin') {
                        redirect('hotel');
                    } else {
                        redirect('guest');
                    }
                } else {
                    $this->session->set_flashdata('failed', 'Password!');
                    $this->load->view('auth/sign-in');
                }
            }
        }
    }

    public function create()
    {
        $data = [
            'title' => 'Sign Up',
        ];
        $this->load->view('sign-up', $data);
    }

    public function register()
    {
        $this->register_validation();
        if ($this->form_validation->run() === FALSE) {
            $this->create();
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $phone_number = $this->input->post('phone_number');
            $password = $this->input->post('password');
            $checkUser = $this->user_model->user_email($email);
            if ($checkUser) {
                $this->session->set_flashdata('failed', 'Email already exists!');
                $this->create();
            }

            $dataUser = [
                'name' => $name,
                'email' => $email,
                'phone_number' => $phone_number,
                'password' => password_hash($password, PASSWORD_DEFAULT),
            ];

            $register =  $this->user_model->create($dataUser);
            if ($register) {
                $this->session->set_flashdata('success', 'Register Success!');
                redirect('user');
            } else {
                $this->session->set_flashdata('failed', 'Register Failed!');
                $this->create();
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('user');
    }
}
