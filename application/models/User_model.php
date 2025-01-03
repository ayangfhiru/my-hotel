<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';

    public function find($userId)
    {
        $this->db->from($this->table);
        $this->db->where($this->primaryKey, $userId);
    }

    public function create($dataUser)
    {
        return $this->db->insert($this->table, $dataUser);
    }

    public function user_email($email)
    {
        $this->db->where('email', $email);
        return $this->db->get($this->table)->row();
    }
}
