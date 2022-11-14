<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Return_order_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'orders';
    }


    public function get_records()
    {
        $this->db->select('*');
        $query  = $this->db->get($this->table);
        $result = $query->result();
        return $result;
    }
    public function get_limit_records()
    {
        $this->db->select('*');
        $this->db->limit(10);
        $query  = $this->db->get($this->table);
        $result = $query->result();
        return $result;
    }

    public function get_month_wise_record()
    {

        $monthWiseSale = '';
        $month             = date('m');
        $year              = date("Y");
        for ($i = 1; $i <= $month; $i++) {
            $this->db->select('SUM(amount) as Sale');
            $this->db->where('MONTH(created_at)',$i);
            $this->db->where('YEAR(created_at)',$year);
            $query = $this->db->get($this->table);
            $result = $query->row();
            if($result->Sale){
                $sale = $result->Sale;
            }else{
                $sale =0;
            }
            //pr($result); 
           $monthWiseSale .= $sale . ',';
        }
         return $monthWiseSale;
    }

    public function get_parent_category()
    {
         $this->db->select('id,title');
        $this->db->where('status', 'Active');
        $this->db->where('parent', 0);
        $query  = $this->db->get($this->table);
        $result = $query->result();
        return $result;
    }
    public function get_active_categorys()
    {
        $this->db->select('*');
        $this->db->where('status', 'Active');
        $query  = $this->db->get($this->table);
        $result = $query->result();
        return $result;
    }

    public function get_record_by_id($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query  = $this->db->get($this->table);
        $result = $query->row();
        return $result;
    }

    public function change_status($id, $status)
    {
        $this->db->where('id', $id);
        $this->db->set(array('order_status' => $status));
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

    public function countAllRecords($searchData)
    {

        $this->db->select('orders.id');
        if (isset($searchData) && $searchData['keyword']) {

            $this->db->group_start();
            $this->db->or_like('tbl_users.name', $searchData['keyword']);
            $this->db->or_like('tbl_users.email', $searchData['keyword']);
            $this->db->or_like('tbl_users.mobile_number', $searchData['keyword']);
            //$this->db->having("FullName LIKE '%".$searchData['keyword']."%'");
            $this->db->group_end();
        }
        if (isset($searchData) && $searchData['status']) {
            $this->db->where('orders.status', $searchData['status']);
        }
        if (isset($searchData) && $searchData['sorting_order']) {
            $this->db->order_by('orders.' . $searchData['column_name'], $searchData['sorting_order']);

        }
          $this->db->where('orders.return', '1');
        $this->db->join('tbl_users', 'tbl_users.id = orders.user_id');
        $query  = $this->db->get($this->table);
        $result = $query->num_rows();
        return $result;
    }   

    public function countAllRecordsCommission($searchData)
    {

        $this->db->select('orders.id');
        if (isset($searchData) && $searchData['keyword']) {

            $this->db->group_start();
            $this->db->or_like('tbl_users.name', $searchData['keyword']);
            $this->db->or_like('tbl_users.email', $searchData['keyword']);
            $this->db->or_like('tbl_users.mobile_number', $searchData['keyword']);
            //$this->db->having("FullName LIKE '%".$searchData['keyword']."%'");
            $this->db->group_end();
        }
        if (isset($searchData) && $searchData['status']) {
            $this->db->where('orders.status', $searchData['status']);
        }
        if (isset($searchData) && $searchData['sorting_order']) {
            $this->db->order_by('orders.' . $searchData['column_name'], $searchData['sorting_order']);

        }
        $this->db->where('orders.order_status', 'Delivered');
        $this->db->join('tbl_users', 'tbl_users.id = orders.user_id');
        $query  = $this->db->get($this->table);
        $result = $query->num_rows();
        return $result;
    }

    public function getAllRecords($searchData)
    {

        $this->db->select('orders.*');
        $this->db->select('tbl_users.name,tbl_users.email,tbl_users.mobile_number');
        if (isset($searchData) && $searchData['keyword']) {

            $this->db->group_start();
            $this->db->or_like('tbl_users.name', $searchData['keyword']);
            $this->db->or_like('tbl_users.email', $searchData['keyword']);
            $this->db->or_like('tbl_users.mobile_number', $searchData['keyword']);
            $this->db->group_end();
        }

        if (isset($searchData) && $searchData['sorting_order']) {
            $this->db->order_by('orders.' . $searchData['column_name'], $searchData['sorting_order']);

        }
        if (isset($searchData) && $searchData['limit']) {
            $this->db->limit($searchData['limit'], $searchData['search_index']);
        }
        $this->db->where('orders.return', '1');
        $this->db->join('tbl_users', 'tbl_users.id = orders.user_id');
       $query  = $this->db->get($this->table);
        $result = $query->result();
       
        return $result;
    }
    public function getAllRecordSaller($order_id)
    {

        $this->db->select('orders.*');
        $this->db->select('tbl_users.name,tbl_users.email,tbl_users.mobile_number');
        $this->db->where('orders.id',$order_id);
        $this->db->join('tbl_users', 'tbl_users.id = orders.user_id');
       $query  = $this->db->get($this->table);
        $result = $query->row();
       
        return $result;
    }

    public function get_records_for_saller($store_id)
    {
        $this->db->select('order_id');
        $this->db->where('store_id',$store_id);
        $this->db->group_by('order_id');
        $query = $this->db->get('order_items');
        //echo $this->db->last_query();
        $result = $query->result();
        //echo $this->db->last_query(); die;
        return $result;
    }
    public function getAllRecordsCommission($searchData)
    {

        $this->db->select('orders.*');
        $this->db->select('tbl_users.name,tbl_users.email,tbl_users.mobile_number');
        if (isset($searchData) && $searchData['keyword']) {

            $this->db->group_start();
            $this->db->or_like('tbl_users.name', $searchData['keyword']);
            $this->db->or_like('tbl_users.email', $searchData['keyword']);
            $this->db->or_like('tbl_users.mobile_number', $searchData['keyword']);
            $this->db->group_end();
        }

        if (isset($searchData) && $searchData['sorting_order']) {
            $this->db->order_by('orders.' . $searchData['column_name'], $searchData['sorting_order']);

        }
        if (isset($searchData) && $searchData['limit']) {
            $this->db->limit($searchData['limit'], $searchData['search_index']);
        }
        $this->db->where('orders.order_status', 'Delivered');
        $this->db->join('tbl_users', 'tbl_users.id = orders.user_id');
       $query  = $this->db->get($this->table);
        $result = $query->result();
       
        return $result;
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    public function get_all_active_records()
    {
        $this->db->select('id,name');
        $this->db->where('status', 'Active');
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get($this->table);
        //echo $this->db->last_query();
        $result = $query->result();
        //echo $this->db->last_query(); die;
        return $result;
    }

}
