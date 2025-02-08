<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('form_validation');
    }

    public function loginValidation()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|trim', [
            'min_length' => 'The Password is too short',
        ]);
    }

    public function login()
    {
        $this->load->view('auth/signin');
    }

    public function loginProcess()
    {
        $this->loginValidation();
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('failed', validation_errors());
            redirect('login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->user_model->findUserByEmail($email);
            if (!$user) {
                $this->session->set_flashdata('failed', 'User not found!');
                redirect('login');
            } else {
                if (password_verify($password, $user->password)) {
                    $role = $user->role_code;
                    $dataSession = [
                        'user_id' => $user->user_id,
                        'name' => $user->name,
                        'role' => $role,
                        'is_login' => TRUE
                    ];
                    $this->session->set_flashdata('success', 'Login Success');
                    $this->session->set_userdata($dataSession);
                    redirect('dashboard');
                } else {
                    $this->session->set_flashdata('failed', 'Password salah!');
                    redirect('login');
                }
            }
        }
    }

    public function registerValidation()
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

    public function register()
    {
        $this->load->view('auth/signup');
    }

    public function registerProcess()
    {
        $this->registerValidation();
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function staffLogin()
    {
        $this->load->model('hotel_model');
        $hotels = $this->hotel_model->all();

        $data = [
            'hotels' => $hotels
        ];
        $this->load->view('auth/staff-signin', $data);
    }

    public function staffLoginProcess()
    {
        $this->loginValidation();
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('failed', validation_errors());
            redirect('staf-login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $hotelId = $this->input->post('hotel');
            $user = $this->user_model->findUserByEmail($email);
            if (!$user) {
                $this->session->set_flashdata('failed', 'User not found!');
                redirect('staff-login');
            } else {
                if ($user->role_code !== 'FRONT_OFFICE') {
                    $this->session->set_flashdata('failed', 'User not staff FO!');
                    redirect('staff-login');
                }

                if (password_verify($password, $user->password)) {
                    $role = $user->role_code;
                    $dataSession = [
                        'user_id' => $user->user_id,
                        'name' => $user->name,
                        'role' => $role,
                        'is_login' => TRUE,
                        'hotel_id' => $hotelId
                    ];
                    $this->session->set_flashdata('success', 'Login Success');
                    $this->session->set_userdata($dataSession);
                    redirect('dashboard');
                } else {
                    $this->session->set_flashdata('failed', 'Password salah!');
                    redirect('login');
                }
            }
        }
    }
}
