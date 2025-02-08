<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';

    public function allStaff()
    {
        try {
            return $this->db->get($this->table)->result();
        } catch (Exception $e) {
            log_message('error', 'Error retrieving all beds: ' . $e->getMessage());
            return [];
        }
    }
    public function find($userId)
    {
        try {
            $this->db->from($this->table);
            $this->db->where($this->primaryKey, $userId);
            return $this->db->get()->row();
        } catch (Exception $e) {
            log_message('error', 'Error fetching user with ID ' . $userId . ': ' . $e->getMessage());
            return null;
        }
    }

    public function create($dataUser)
    {
        try {
            return $this->db->insert($this->table, $dataUser);
        } catch (Exception $e) {
            log_message('error', 'Error creating user: ' . $e->getMessage());
            return false;
        }
    }

    public function findUserByEmail($email)
    {
        try {
            $this->db->where('email', $email);
            return $this->db->get($this->table)->row();
        } catch (Exception $e) {
            log_message('error', 'Error fetching user with email ' . $email . ': ' . $e->getMessage());
            return null;
        }
    }
}
