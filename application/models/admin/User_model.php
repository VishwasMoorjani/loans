<?php
/**
* User_model Model for Admin
*/

if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->table = 'tbl_users';
	}

	function getAllUsers() {
		$id = $this->session->userdata('admin_id');
		$this->db->select('*');
		$this->db->where('id !=',$id);	
		$query = $this->db->get('tbl_users');
		$result = $query->result();
		return $result;
	}

	function getAllUserMobile() {
		$this->db->select('name,email,mobile_no,device_id');
		$this->db->where('status','Active');	
		$query = $this->db->get('users');
		$result = $query->result();
		return $result;
	}
	function getAllActiveUsers() {
		$this->db->select('id, first_name');
		$this->db->where('status','Active');
		$this->db->order_by('first_name', 'asc');
		$query = $this->db->get($this->table);
		$result = $query->result();
		return $result;
	}
	
	function changeStatusByID($id, $status) 
	{
		$this->db->where('id',$id);
		$this->db->update($this->table, array('status' => $status));
	}

	function getUser($id) {
		$this->db->select('*');
		$this->db->from('tbl_users');
		$this->db->where(array('id' => $id));
		$query = $this->db->get();
		return $query->row();
	}

	function getSingleRecordById($id) 
	{
	  $this->db->select('*');
      $this->db->order_by('id','DESC');
	  $this->db->where('id',$id);
	  $query = $this->db->get($this->table);	
	  $result = $query->row();
	  return $result;
	}
	

	function insertUser($data) {
		$this->db->insert($this->table,$data);
		return $this->db->insert_id();
	}

	function updateUser($id, $data) {

		if(isset($data['profile_image']) && $data['profile_image'])
		{
			$this->removeFileById($id);
		}
		$this->db->where('id',$id);
		$result = $this->db->update($this->table,$data);
		return $result;
	}

	function removeFileById($id)
	{
		$users = $this->getUser($id);
		if ($users->profile_image) 
		{
			$path = './assets/uploads/users/';
			unlink($path . $users->profile_image);
		}
	}

	function deleteUser($id) {
		$this->db->where('id', $id);
		$this->db->delete('tbl_users');
	}

	function changeStatus($id, $status) {
		$this->db->where('id',$id);
		$this->db->update('tbl_users', array('status' => $status));
	}

	function checkEmailAddressUnique($emailId, $id)
	{
		$this->db->where('id !=',$id);
		$this->db->where('email',$emailId);
		$query = $this->db->get('tbl_users');
		$result = $query->row();
		return $result;		
	}

	function checkUsernameUnique($username,$id)
	{
		$this->db->where('id !=',$id);
		$this->db->where('username',$username);
		$query = $this->db->get('tbl_users');
		$result = $query->row();
		return $result;	
	}
	
	function checkUserExistByOldPassword($password,$userId)
	{
		$this->db->where('id',$userId);
		$this->db->where('password',$password);
		$query = $this->db->get('tbl_users');
		$result = $query->row();
		return $result;
	}

    
	function getAdminUserNamebyEditedId($id)
	{
		$this->db->select('username');
		$this->db->where('id',$id);
		$query = $this->db->get('tbl_users');
		$result = $query->row();
		if($result)
			return $result->username;
	}

	function getUserFullNameByUserId($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get('tbl_users');
		$result = $query->row();
		return $result->first_name;
	}	

	function getUserEmailAddressByUserId($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get('tbl_users');
		$result = $query->row();
		return $result->email;
	}

	function getSingleRecordByUserId($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get('tbl_users');
		$result = $query->row();
		return $result;
	}

	function getAllUsersForCategory($user_type) {		
		$this->db->select('*');
		$this->db->where('user_type',$user_type);	
		$query = $this->db->get('tbl_users');
		$result = $query->result();
		return $result;
	}

	function getAllActiveUsersForAll() {
		$id = $this->session->userdata('admin_id');
		$this->db->select('id,first_name,last_name');
		$this->db->where('id !=',$id);	
		$this->db->where('status','Active');
		$this->db->order_by('first_name', 'asc');
		$query = $this->db->get($this->table);
		$result = $query->result();
		return $result;
	}

	function getReferralCodeById($id) {
		$this->db->select('referral_code');
		$this->db->where('id',$id);					
		$query = $this->db->get($this->table);
		$result = $query->row();
		return $result;		
	}

	function getReferrarByCode($code) {
		$this->db->select('id');
		$this->db->where('identification_number',$code);					
		$query = $this->db->get($this->table);
		$result = $query->row();
		return $result;		
	}

	function deleteAuthenticationInfo($user_id) {
		$this->db->where('user_id', $user_id);
		$this->db->delete('tbl_two_factor_authentication');
	}

	function get_single_authentication_record($user_id) {
		$this->db->where('user_id',$user_id);
		$this->db->order_by('id','DESC');
		$query = $this->db->get('tbl_two_factor_authentication');
		$result = $query->row();
		return $result;
	}

	function addTwoFactorAuthentication($data) {
		$this->db->set($data);
		$this->db->set('add_date', $this->common_model->getDefaultToGMTDate(time()));
		$this->db->insert('tbl_two_factor_authentication');
		return $this->db->insert_id();
	}

	
	
}