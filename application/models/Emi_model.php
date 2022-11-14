<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Emi_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'tbl_emi';
    }

    public function get_records()
    {
        $this->db->select('tbl_emi.*');
        $query  = $this->db->get($this->table);
        $result = $query->result();
        return $result;
    }

    public function get_record_by_id($id)
    {
        $this->db->select('*');
        $this->db->where('tbl_emi.id', $id);
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
        $this->db->set('created_at', getDefaultToGMTDate(time()));
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

        $this->db->select('tbl_emi.emi_id');
        if (isset($searchData) && $searchData['date']) {
            $this->db->where('tbl_emi.emi_date', date("d-m-Y", strtotime($searchData['date'])));
        }
         $this->db->where('tbl_customers_loan.loan_status', 'Disbursed');
         $this->db->where('tbl_users.user_branch',$this->session->userdata('user_branch'));
        $this->db->join('tbl_customers', 'tbl_customers.client_id  = tbl_emi.emi_client');

        $this->db->join('tbl_customers_loan', 'tbl_customers.client_id = tbl_customers_loan.customer_id');
        $this->db->join('tbl_users', 'tbl_customers_loan.application_user = tbl_users.user_id');
        if (isset($searchData) && $searchData['sorting_order']) {
            $this->db->order_by('tbl_emi.' . $searchData['column_name'], $searchData['sorting_order']);
        }
        $query  = $this->db->get($this->table);
        $result = $query->num_rows();
        return $result;
    }

    public function getAllRecords($searchData)
    {

        
             $this->db->select('*');
        if (isset($searchData) && $searchData['date']) {
            $this->db->where('tbl_emi.emi_date', date("d-m-Y", strtotime($searchData['date'])));
        }
         $this->db->where('tbl_customers_loan.loan_status', 'Disbursed');
         $this->db->where('tbl_users.user_branch',$this->session->userdata('user_branch'));
        $this->db->join('tbl_customers', 'tbl_customers.client_id  = tbl_emi.emi_client');

        $this->db->join('tbl_customers_loan', 'tbl_customers.client_id = tbl_customers_loan.customer_id');
        $this->db->join('tbl_users', 'tbl_customers_loan.application_user = tbl_users.user_id');
        if (isset($searchData) && $searchData['sorting_order']) {
            $this->db->order_by('tbl_emi.' . $searchData['column_name'], $searchData['sorting_order']);
        }
        $query  = $this->db->get($this->table);
        $result = $query->result();
        return $result;
    }
}
