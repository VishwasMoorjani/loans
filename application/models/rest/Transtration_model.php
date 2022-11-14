
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transtration_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'tbl_transtrations';
    }

    /**
     * add records.
     *
     * @param array $data data of user
     *
     * @return object last insert id
     *
     */

    public function add_record($data)
    {
        $this->db->set($data);
        $this->db->set('add_date', date('Y-m-d H:i:s A'));
        $this->db->insert($this->table);
        return $this->db->insert_id();
    }
    /**
     * get record by token
     *
     * @param string $token token
     *
     * @return object token data
     *
     */

    public function get_record_by_exam_id($exam_id,$user_id)
    {
        $this->db->select('*');
        $this->db->where('exam_id', $exam_id);
        $this->db->where('user_id', $user_id);
        $query  = $this->db->get('tbl_transtrations');
        $result = $query->row();
        
        return $result;
    }

}