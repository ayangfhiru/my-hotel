<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hotel_model extends CI_Model
{
    protected $table = 'hotels';
    protected $primaryKey = 'hotel_id';

    public function all()
    {
        return $this->db->get($this->table)->result();
    }

    public function find($hotelId)
    {
        $this->db->from($this->table);
        $this->db->where($this->primaryKey, $hotelId);
        return $this->db->get()->row();
    }

    public function create($dataHotel)
    {
        return $this->db->insert($this->table, $dataHotel);
    }

    public function update($hotelId, $data)
    {
        $this->db->where($this->primaryKey, $hotelId);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, [$this->primaryKey => $id]);
    }
}
