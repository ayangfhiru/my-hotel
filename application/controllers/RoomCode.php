<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RoomCode extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('room_code_model');
        $this->load->library('form_validation');
        is_login();
    }

    public function validation()
    {
        $this->form_validation->set_rules('room_code', 'Room Code', 'trim|required');
        $this->form_validation->set_rules('room_status', 'Available', 'trim|required');
    }

    public function room_status()
    {
        $roomSatatus = $this->room_code_model->get_room_status();
        preg_match_all("/'([^']+)'/", $roomSatatus, $matches);
        return $matches[1];
    }

    public function index($hotelId, $roomId)
    {
        $this->load->model('room_model');
        $room = $this->room_model->find($roomId);
        $roomCode = $this->room_code_model->where(['room_id' => $roomId]);
        $roomSatatus = $this->room_status();
        $data = [
            'title' => 'Room Code',
            'hotelId' => $hotelId,
            'roomId' => $roomId,
            'room' => $room,
            'room_code' => $roomCode,
            'room_status' => $roomSatatus
        ];
        $this->load->view('admin/room-code/index', $data);
    }

    public function store($hotelId, $roomId)
    {
        guard('admin');
        $this->form_validation->set_rules('room_code', 'Room Code', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $this->create();
        } else {
            $roomCode = $this->input->post('room_code');

            $dataRoomCode = [
                'room_id' => $roomId,
                'room_code' => $roomCode,
                'room_status' => 'VC'
            ];
            $post = $this->room_code_model->create($dataRoomCode);
            if ($post === TRUE) {
                $this->session->set_flashdata('success', '');
            } else {
                $this->session->set_flashdata('failed', '');
            }
            redirect("hotel/$hotelId/room/$roomId/room-code");
        }
    }

    public function update($hotelId, $roomId, $codeId)
    {
        guard('admin');
        $this->validation();
        if ($this->form_validation->run() === FALSE) {
            $this->index($hotelId, $roomId);
        } else {
            $code = $this->input->post('room_code');
            $roomStatus = $this->input->post('room_status');

            $dataRoomCode = [
                'room_code' => $code,
                'room_status' => $roomStatus
            ];

            $update = $this->room_code_model->update($codeId, $dataRoomCode);
            if ($update === TRUE) {
                $this->session->set_flashdata('success', '');
            } else {
                $this->session->set_flashdata('failed', '');
            }
            redirect("hotel/$hotelId/room/$roomId/room-code");
        }
    }

    public function destroy($roomCodeId) {}

    public function update_room_code_status($hotelId, $roomCodeId)
    {
        $roomStatus = $this->input->post('room_status');
        $update = $this->room_code_model->update($roomCodeId, ['room_status' => $roomStatus]);
        if ($update === TRUE) {
            $this->session->set_flashdata('success', '');
        } else {
            $this->session->set_flashdata('failed', '');
        }
        redirect("hotel/$hotelId/reservation/calendar");
    }
}
