<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Media_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'tbl_media';
    }


    public function get_records()
    {
        $this->db->select('*');
        $query  = $this->db->get($this->table);
        $result = $query->result();
        return $result;
    }
    public function get_active_records()
    {
        $this->db->select('*');
        $this->db->where('status','Active');
        $query  = $this->db->get($this->table);
        $result = $query->result();
        return $result;
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
        $this->db->where('product_id', $id);
        $this->db->set(array('status' => $status));
        $this->db->update($this->table);
    }

    public function change_stock_status($id, $status)
    {
        $this->db->where('product_id', $id);
        $this->db->set(array('in_stock' => $status));
        $this->db->update($this->table);
    }
    public function add_record($data)
    {
        $this->db->set($data);
        $this->db->set('add_date', getDefaultToGMTDate(time()));
        $this->db->insert($this->table);
        return $this->db->insert_id();
    }


    public function update_record($data, $id)
    {
        $this->_update($data, $id);
    }


    protected function _update($data, $id)
    {
        $this->db->where('product_id', $id);
        $this->db->set($data);
        $this->db->update($this->table);
    }

    public function countAllRecords($searchData)
    {

        $this->db->select('tbl_media.*');
        if (isset($searchData) && $searchData['keyword']) {

            $this->db->group_start();
           // $this->db->or_like('tbl_media.product_name', $searchData['keyword']);
            //$this->db->having("FullName LIKE '%".$searchData['keyword']."%'");
            $this->db->group_end();
        }
        if (isset($searchData) && $searchData['status']) {
            $this->db->where('tbl_media.status', $searchData['status']);
        }
        if (isset($searchData) && $searchData['sorting_order']) {
            $this->db->order_by('tbl_media.' . $searchData['column_name'], $searchData['sorting_order']);

        }
        $query  = $this->db->get($this->table);
        $result = $query->num_rows();
        return $result;
    }

    public function getAllRecords($searchData)
    {

        $this->db->select('tbl_media.*');
        if (isset($searchData) && $searchData['keyword']) {

            $this->db->group_start();
          //  $this->db->or_like('tbl_media.product_name', $searchData['keyword']);
            $this->db->group_end();
        }

        if (isset($searchData) && $searchData['sorting_order']) {
            $this->db->order_by('tbl_media.' . $searchData['column_name'], $searchData['sorting_order']);

        }
        if (isset($searchData) && $searchData['limit']) {
            $this->db->limit($searchData['limit'], $searchData['search_index']);
        }

        $query  = $this->db->get($this->table);
        $result = $query->result();
       
        return $result;
    }

    public function delete($id)
    {
        $this->db->where('product_id', $id);
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

    public function add_product_images($data)
    {
        $this->db->set($data);
        $this->db->insert('tbl_product_images');
        return $this->db->insert_id();
    }

    public function get_images_by_product($product_id){
        $this->db->select('*');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('tbl_product_images');
        //echo $this->db->last_query();
        $result = $query->result();
        //echo $this->db->last_query(); die;
        return $result;
    }



    public function get_record_by_product_id($id)
    {
        $this->db->select('*');
        $this->db->where('product_id', $id);
        $query  = $this->db->get('tbl_product_images');
        $result = $query->row();
        return $result;
    }

    public function delete_product_images($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_product_images');
    }

    public function get_product_details_by_product_id($id)
    {
        $this->db->select('*');
        $this->db->where('product_id', $id);
        $query  = $this->db->get('purchase');
        $result = $query->result();
        return $result;
    }    
    public function get_product_varient_details_by_product_id($purchase_id,$product_id)
    {
        $this->db->select('*');
        $this->db->where('purchase_id', $purchase_id);
        $this->db->where('product_id', $product_id);
        $query  = $this->db->get('tbl_product_varient_details');
        $result = $query->result();
        return $result;
    }

    public function add_color($data)
    {
        $this->db->set($data);
        $this->db->insert('tbl_product_varient_details');
        return $this->db->insert_id();
    }

    public function delete_product_color($purchase_id,$product_id)
    {
        $this->db->where('purchase_id', $purchase_id);
        $this->db->where('product_id', $product_id);
        $this->db->delete('tbl_product_varient_details');
    }

    public function get_records_by_keyword($keyword)
    {
        $this->db->select('product_id,product_name');
        $this->db->group_start();
        $this->db->like('tbl_media.product_name', $keyword);
        $this->db->group_end();
        $this->db->limit(50);
        $query  = $this->db->get($this->table);
        $result = $query->result();
        return $result;
    }
}
