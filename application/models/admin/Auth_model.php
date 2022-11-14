<?php
/**
 * Auth_model Model for Admin
 */
if (!defined('BASEPATH')) {
   exit('No direct script access allowed');
}

class Auth_model extends CI_Model
{

   public function __construct()
   {
      parent::__construct();
   }

   public function checkValidUser($email,$password)
   {
      $this->db->select('id');
      $this->db->where('status', 'Active');
   //   $this->db->where('is_admin','Yes');
      $this->db->group_start();
         $this->db->where('username', $email);
         $this->db->or_where('email', $email);
      $this->db->group_end();
      $this->db->where('password',$password);
      $this->db->from('tbl_users');
      $query = $this->db->get();
     //echo $this->db->last_query(); die;
      return $query->row();
   }
   public function checkValidVendor($email,$password)
   {
      $this->db->select('id');
      //$this->db->where('status', 'Active');
      $this->db->where('is_admin','No');
      $this->db->where('user_type','Vendor');
      $this->db->group_start();
         $this->db->where('username', $email);
         $this->db->or_where('email', $email);
      $this->db->group_end();
      $this->db->where('password',$password);
      $this->db->from('tbl_users');
      $query = $this->db->get();
      return $query->row();
   }

   public function getPassword()
   {
      $this->db->select('password');
      $this->db->from('tbl_users');
      $this->db->where(array('username' => $this->session->userdata('username')));
      $query = $this->db->get();
      return $query->row();
   }

   public function checkUserExistByOldPassword($password, $userId)
   {
      $this->db->where('id', $userId);
      $this->db->where('password', $password);
      $query  = $this->db->get('tbl_users');
      $result = $query->row();
      return $result;
   }

   public function updateAdminPassword($id, $data)
   {
      $this->db->where('id', $id);
      $this->db->update('tbl_users', $data);
   }

   public function getUserByLoginId($id)
   {
      $this->db->where('id', $id);
      $query  = $this->db->get('tbl_users');
      $result = $query->row();
      return $result;
   }

   public function getUserByEmailId($emailId)
   {
      $this->db->select('*');
      $this->db->where('email', $emailId);
      $query  = $this->db->get('tbl_users');
      $result = $query->row();
      return $result;
   }

   public function updateUserForgotKeyByEmailid($id, $data)
   {
      $this->db->where('id', $id);
      $this->db->update('tbl_users', $data);
   }

   public function getUserByForgotPasswordKey($key)
   {
      $this->db->where('forgot_password_key', $key);
      $query  = $this->db->get('tbl_users');
      $result = $query->row();
      return $result;
   }

   public function checkExpireTime($email, $key)
   {
      $time = date('Y-m-d H:i:s');
      // $this->db->where('expire_time >',$time);
      $this->db->where('email', $email);
      $this->db->where('forgot_password_key', $key);
      $query  = $this->db->get('tbl_users');
      $result = $query->row();
      return $result;
   }

   public function updateUserPassword($data, $id)
   {
      $this->db->where('id', $id);
      $this->db->update('tbl_users', $data);
     // echo $this->db->last_query();die;
   }

   public function get_user_by_email($email)
   {
      $this->db->select('*');
      $this->db->where('email', $email);
      $query  = $this->db->get('tbl_users');
      $result = $query->row();
      return $result;
   }

}
