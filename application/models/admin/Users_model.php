<?php



if (!defined('BASEPATH')) {

    exit('No direct script access allowed');

}



class Users_model extends CI_Model

{



    public function __construct()

    {

        parent::__construct();

        $this->table = 'tbl_users';

    }



    /**

     * Returns list of Product Category.

     *

     * @return object list of product category

     *

     */



    public function get_records()

    {

        $this->db->select('*');

        $query  = $this->db->get($this->table);



        $result = $query->result();

        return $result;

    }

    public function get_vendors()

    {

        $this->db->select('*');

        $this->db->where('user_type','Vendor');

        $this->db->where('status', 'Active');

        $this->db->limit(10);

        $query  = $this->db->get($this->table);

        $result = $query->result();

        return $result;

    }





    public function get_active_customer()

    {

        $this->db->select('*');

        $this->db->where('status', 'Active');

        $this->db->where('user_type','Customer');

        $query  = $this->db->get($this->table);

        $result = $query->result();

        return $result;

    }

    public function get_active_vendors()

    {

        $this->db->select('*');

        $this->db->where('user_type','Vendor');

        $this->db->where('status', 'Active');

        $query  = $this->db->get($this->table);

        $result = $query->result();

        return $result;

    }

    public function get_customer()

    {

        $this->db->select('*');

        $this->db->where('user_type','Customer');

        $this->db->where('status', 'Active');

        $this->db->limit(10);

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

    /**

     * Returns list of Product Category by id.

     *

     * @param int $id id of category

     *

     * @return object list of product category

     *

     */



    public function get_record_by_id($id)

    {

        $this->db->select('*');

        $this->db->where('id', $id);

        $query  = $this->db->get($this->table);

        $result = $query->row();

        return $result;

    }

    public function get_record_by_exam_id($exam_id)

    {

        $this->db->select('*');

        $this->db->where('exam_id', $exam_id);

        $query  = $this->db->get($this->table);

        $result = $query->result();

        return $result;

    }

    public function get_vendor_list()

    {

        $this->db->select('*');

        $this->db->where('user_type', 'vendor');

        $this->db->where('status', 'Active');

        $query  = $this->db->get($this->table);

        $result = $query->result();

        return $result;

    }

    /**

     * update status of category.

     *

     * @param int $id id of category

     *

     * @param string $status status

     *

     */



    public function change_status($id, $status)

    {

        $this->db->where('id', $id);

        $this->db->set(array('status' => $status));

        $this->db->update($this->table);

    }



    /**

     * add records.

     *

     * @param array $data data of category

     *

     * @return object last insert id

     *

     */



    public function add_record($data)

    {

        $this->db->set($data);

        $this->db->set('add_date', getDefaultToGMTDate(time()));

        $this->db->insert($this->table);

        return $this->db->insert_id();

    }



    /**

     * update records of category.

     *

     * @param array $data data of category

     *

     * @param int $id id of category

     *

     */



    public function update_record($data, $id)

    {

        $this->_update($data, $id);

    }



    /**

     * update records of category.

     *

     * @param array $data data of category

     *

     * @param int $id id of category

     *

     */



    protected function _update($data, $id)

    {

        $this->db->where('id', $id);

        $this->db->set($data);

        $this->db->update($this->table);

    }



    public function countAllRecords($searchData)

    {



        $this->db->select('tbl_users.id');

        if (isset($searchData) && $searchData['keyword']) {



            $this->db->group_start();

            $this->db->or_like('tbl_users.full_name', $searchData['keyword']);

            $this->db->or_like('tbl_users.email', $searchData['keyword']);

            $this->db->or_like('tbl_users.mobile_number', $searchData['keyword']);

            //$this->db->having("FullName LIKE '%".$searchData['keyword']."%'");

            $this->db->group_end();

        }

        if (isset($searchData) && $searchData['status']) {

            $this->db->where('tbl_users.status', $searchData['status']);

        }
        if (isset($searchData) && $searchData['mobile']) {

            $this->db->where('tbl_users.mobile_number', $searchData['mobile']);

        }
        if (isset($searchData) && $searchData['sorting_order']) {

            $this->db->order_by('tbl_users.' . $searchData['column_name'], $searchData['sorting_order']);



        }

        $this->db->where('is_admin','No');

        $this->db->where('user_type','customer');

        $query  = $this->db->get($this->table);

        $result = $query->num_rows();

        return $result;

    }



    public function getAllRecords($searchData)

    {



        $this->db->select('*');

        if (isset($searchData) && $searchData['keyword']) {



            $this->db->group_start();

            $this->db->or_like('tbl_users.full_name', $searchData['keyword']);

            $this->db->or_like('tbl_users.email', $searchData['keyword']);

            $this->db->or_like('tbl_users.mobile_number', $searchData['keyword']);

            $this->db->group_end();

        }



        if (isset($searchData) && $searchData['sorting_order']) {

            $this->db->order_by('tbl_users.' . $searchData['column_name'], $searchData['sorting_order']);



        }
        if (isset($searchData) && $searchData['mobile']) {

            $this->db->where('tbl_users.mobile_number', $searchData['mobile']);

        }
        if (isset($searchData) && $searchData['limit']) {

            $this->db->limit($searchData['limit'], $searchData['search_index']);

        }
$this->db->order_by('tbl_users.id','DESC');
        $this->db->where('is_admin','No');

        $this->db->where('user_type','customer');

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

        $this->db->select('*');

        $this->db->where('status', 'Active');

        $this->db->order_by('created_at', 'DESC');

        $query = $this->db->get($this->table);

        //echo $this->db->last_query();

        $result = $query->result();

        //echo $this->db->last_query(); die;

        return $result;

    }



    public function get_record_for_notification($board_id,$class,$medium)

    {

        $this->db->select('fcm_id');

        $this->db->where('board_id', $board_id);

        $this->db->where('class_id', $class);

        $this->db->where('medium', $medium);

        $query  = $this->db->get($this->table);

        $result = $query->result();

        return $result;

    }



    public function get_all_customer()

    {

        $this->db->select('*');

        $this->db->where('status', 'Active');

        $this->db->where('user_type', 'Customer');
       // $this->db->where('id', '799');

        $this->db->order_by('created_at', 'DESC');

        $query = $this->db->get($this->table);

        //echo $this->db->last_query();

        $result = $query->result();

        //echo $this->db->last_query(); die;

        return $result; 

    }



    public function get_all_vendors()

    {

        $this->db->select('*');

        $this->db->where('status', 'Active');

        $this->db->where('user_type', 'Vendor');

        $this->db->order_by('created_at', 'DESC');

        $query = $this->db->get($this->table);

        //echo $this->db->last_query();

        $result = $query->result();

        //echo $this->db->last_query(); die;

        return $result; 

    }





    public function countAllStaffRecords($searchData)

    {



        $this->db->select('tbl_users.id');

        if (isset($searchData) && $searchData['keyword']) {



            $this->db->group_start();

            $this->db->or_like('tbl_users.full_name', $searchData['keyword']);

            $this->db->or_like('tbl_users.email', $searchData['keyword']);

            $this->db->or_like('tbl_users.mobile_number', $searchData['keyword']);

            //$this->db->having("FullName LIKE '%".$searchData['keyword']."%'");

            $this->db->group_end();

        }

        if (isset($searchData) && $searchData['status']) {

            $this->db->where('tbl_users.status', $searchData['status']);

        }

        if (isset($searchData) && $searchData['sorting_order']) {

            $this->db->order_by('tbl_users.' . $searchData['column_name'], $searchData['sorting_order']);



        }

        $this->db->where('is_admin','No');

        $this->db->where('user_type','staff');

        $query  = $this->db->get($this->table);

        $result = $query->num_rows();

        return $result;

    }



    public function getAllStaffRecords($searchData)

    {



        $this->db->select('*');

        if (isset($searchData) && $searchData['keyword']) {



            $this->db->group_start();

            $this->db->or_like('tbl_users.full_name', $searchData['keyword']);

            $this->db->or_like('tbl_users.email', $searchData['keyword']);

            $this->db->or_like('tbl_users.mobile_number', $searchData['keyword']);

            $this->db->group_end();

        }



        if (isset($searchData) && $searchData['sorting_order']) {

            $this->db->order_by('tbl_users.' . $searchData['column_name'], $searchData['sorting_order']);



        }

        if (isset($searchData) && $searchData['limit']) {

            $this->db->limit($searchData['limit'], $searchData['search_index']);

        }

        $this->db->where('is_admin','No');

        $this->db->where('user_type','staff');

        $query  = $this->db->get($this->table);

        $result = $query->result();



        return $result;

    }





//group email ids list....

    public function get_user_type_group_emails($type)

    {

        $this->db->select('*');

        $this->db->where('user_type',$type);

        $this->db->where('status', 'Active');

        $query  = $this->db->get($this->table);

        $result = $query->result();

        return $result;

    }



}

