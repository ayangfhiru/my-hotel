<?php
defined('BASEPATH') or exit('No direct script access allowed');

class R_picture extends CI_Model
{
    protected $table = 'room_pictures';

    public function all()
    {
        return $this->db->get($this->table)->result();
    }

    // public function find($id)
    // {
    //     $this->db->from($this->table);
    //     $this->db->where($this->primaryKey, $id);
    //     return $this->db->get()->row();
    // }

    public function many_create($data)
    {
        return $this->db->insert_batch($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, [$this->primaryKey => $id]);
    }
}
