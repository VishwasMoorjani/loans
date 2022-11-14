<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Bank_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'tbl_bank';
    }

    public function get_records()
    {
        $this->db->select('tbl_bank.*');
        $query  = $this->db->get($this->table);
        $result = $query->result();
        return $result;
    }

    public function get_record_by_id($id)
    {
        $this->db->select('*');
        $this->db->where('tbl_bank.id', $id);
        $query  = $this->db->get($this->table);
        $result = $query->row();
        return $result;
    }

    public function change_status($id, $status)
    {
        $this->db->where('id', $id);
        $this->db->set(array('status' => $status));
        $this->db->update($this->table);
    }

    public function add_record($data)
    {

        $this->db->set($data);
        // $this->db->set('created_at', getDefaultToGMTDate(time()));
        $this->db->insert($this->table);
        return $this->db->insert_id();
    }

    public function update_record($data, $id)
    {

        $this->_update($data, $id);
    }

    protected function _update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->set($data);
        $this->db->update($this->table);
    }

    public function delete_record($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
    public function countAllRecords($searchData)
    {

        $this->db->select('tbl_bank.id');
        if (isset($searchData) && $searchData['date']) {
            $this->db->where('tbl_bank.date', date("d-m-Y", strtotime($searchData['date'])));
        }

        if (isset($searchData) && $searchData['sorting_order']) {
            $this->db->order_by('tbl_bank.' . $searchData['column_name'], $searchData['sorting_order']);
        }
        $this->db->where('tbl_bank.cash_credit!=', '0');
        $query  = $this->db->get($this->table);
        $result = $query->num_rows();
        return $result;
    }

    public function getAllRecords($searchData)
    {
        $this->db->select('*');
        if (isset($searchData) && $searchData['date']) {
            $this->db->where('tbl_bank.date', date("d-m-Y", strtotime($searchData['date'])));
        }

        if (isset($searchData) && $searchData['sorting_order']) {
            $this->db->order_by('tbl_bank.' . $searchData['column_name'], $searchData['sorting_order']);
        }
        if (isset($searchData) && $searchData['limit']) {
            $this->db->limit($searchData['limit'], $searchData['search_index']);
        }
        $this->db->where('tbl_bank.cash_credit!=','0' );
        $query = $this->db->get($this->table);
        //echo $this->db->last_query();
        $result = $query->result();
        //echo $this->db->last_query(); die;
        return $result;
    }
}
