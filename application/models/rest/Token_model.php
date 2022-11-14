
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Token_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'tbl_login_tokens';
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

    public function get_record_by_token($token)
    {
        $this->db->select('*');
        $this->db->where('token', $token);
        $query  = $this->db->get('tbl_login_tokens');
        $result = $query->row();
        return $result;
    }

    /**
     * delete record by id
     *
     * @param int $id id
     *
     *
     */

    public function delete_record_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    /**
     * get user record by token
     *
     * @param int $id id
     *
     * @return object token data
     *
     */

    public function get_user_by_token($token)
    {
        $this->db->select('tbl_login_tokens.id as token_id, tbl_login_tokens.expire_date, tbl_login_tokens.status');
        $this->db->select('tbl_users.*');
        $this->db->join('tbl_users', 'tbl_login_tokens.user_id = tbl_users.id');
        $this->db->where('tbl_login_tokens.token', $token);
        $this->db->where('tbl_login_tokens.status', 'Active');
        $query  = $this->db->get($this->table);
        $result = $query->row();
        return $result;
    }

}