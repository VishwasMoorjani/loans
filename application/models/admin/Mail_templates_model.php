<?php
/**
* Mail_templates_model Model for Admin
*/
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Mail_templates_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->table = 'tbl_emails';
	}

	function getAllTemplates() {
		$this->db->select('*');
		$query = $this->db->get($this->table);
		$result = $query->result();
		return $result;
	}

	function changeStatusById($id,$status) {
		$this->db->where('id',$id);
		$this->db->update($this->table,array('status' => $status));
	}

	function getSingleRecordById($id) {
		$this->db->select('*');
		$query = $this->db->where('id',$id);
		$query = $this->db->get($this->table);
		$result = $query->row();
		return $result;
	}	

    function updateEmailTemplate($id, $data) 
	{
		$this->db->where('id',$id);
		$result = $this->db->update($this->table,$data);
		return $result;
	}
}
