<?php



if (!defined('BASEPATH')) {

    exit('No direct script access allowed');
}



class Sub_category_model extends CI_Model

{



    public function __construct()

    {

        parent::__construct();

        $this->table = 'sub_category';
    }





    public function get_records()

    {

        $this->db->select('*');

        $query  = $this->db->get($this->table);

        $result = $query->result();

        return $result;
    }



    public function get_parent_category()

    {

        $this->db->select('id,title');

        $this->db->where('status', 'Active');

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

    public function get_record_by_category($id)

    {

        $this->db->select('*');

        $this->db->where('category_id', $id);

        $query  = $this->db->get($this->table);

        $result = $query->result();

        return $result;
    }

    public function get_record_by_category_sub($id)

    {

        $this->db->select('*');

        $this->db->where('sub_category_id', $id);
        $this->db->where('status', 'Active');

        $query  = $this->db->get('sub_sub_category');

        $result = $query->result();

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

        $this->db->where('id', $id);

        $this->db->set($data);

        $this->db->update($this->table);
    }



    public function countAllRecords($searchData, $store_id)

    {



        $this->db->select('sub_category.id');

        if (isset($searchData) && $searchData['keyword']) {



            $this->db->group_start();

            $this->db->or_like('sub_category.title', $searchData['keyword']);

            //$this->db->having("FullName LIKE '%".$searchData['keyword']."%'");

            $this->db->group_end();
        }

        if (isset($searchData) && $searchData['status']) {

            $this->db->where('sub_category.status', $searchData['status']);
        }

        if (isset($searchData) && $searchData['sorting_order']) {

            $this->db->order_by('sub_category.' . $searchData['column_name'], $searchData['sorting_order']);
        }

        if ($store_id != 1)

            $this->db->where('sub_category.store_id', $store_id);

        $query  = $this->db->get($this->table);

        $result = $query->num_rows();

        return $result;
    }



    public function getAllRecords($searchData, $store_id)

    {



        $this->db->select('*');

        if (isset($searchData) && $searchData['keyword']) {



            $this->db->group_start();

            $this->db->or_like('sub_category.title', $searchData['keyword']);

            $this->db->group_end();
        }



        if (isset($searchData) && $searchData['sorting_order']) {

            $this->db->order_by('sub_category.' . $searchData['column_name'], $searchData['sorting_order']);
        }

        if (isset($searchData) && $searchData['limit']) {

            $this->db->limit($searchData['limit'], $searchData['search_index']);
        }

        if ($store_id != 1)

            $this->db->where('sub_category.store_id', $store_id);

        $query  = $this->db->get($this->table);

        $result = $query->result();



        return $result;
    }



    public function delete($id)

    {

        $this->db->where('id', $id);

        $this->db->delete($this->table);
    }



    public function get_all_active_records($store_id)

    {

        $this->db->select('id,title');

        $this->db->where('status', 'Active');

        // $this->db->where('store_id', $store_id);

        $this->db->order_by('add_date', 'DESC');

        $query = $this->db->get($this->table);

        //echo $this->db->last_query();

        $result = $query->result();

        //echo $this->db->last_query(); die;

        return $result;
    }
}
