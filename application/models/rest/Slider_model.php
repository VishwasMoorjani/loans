<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Slider_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'tbl_sliders';
    }

    public function get_active_records()
    {
        $this->db->select('tbl_sliders.*');
       $this->db->where('status', "Active");
        $query  = $this->db->get($this->table);
        $result = $query->result();
        return $result;
    }
    public function get_active_type_slider($type)
    {
        $this->db->select('tbl_sliders.*');
       $this->db->where('status', "Active");
       $this->db->where('type', $type);
        $query  = $this->db->get($this->table);
        $result = $query->row();
        return $result;
    }

}
