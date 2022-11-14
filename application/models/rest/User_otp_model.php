<?php



defined('BASEPATH') or exit('No direct script access allowed');



class User_otp_model extends CI_Model

{

    public function __construct()

    {

        parent::__construct();

        $this->table = 'tbl_otp';

    }



    public function get_record($id)

    {

        $this->db->where('id', $id);

        $query  = $this->db->get($this->table);

        $result = $query->row();

        return $result;

    }



    public function get_record_by_email($email)

    {

        $this->db->select('tbl_otp.*');

        $this->db->where('tbl_otp.email', $email);

        $this->db->where('tbl_otp.email !='," ");

        $query  = $this->db->get($this->table);

        $result = $query->row();

        return $result;

    }



    public function get_record_by_mobile($mobile)

    {

        $this->db->select('tbl_otp.*');

        $this->db->where('tbl_otp.mobile_number', $mobile);

        $query  = $this->db->get($this->table);

        $result = $query->row();

        return $result;

    }
    // public function get_record_by_email($email)

    // {

    //     $this->db->select('tbl_otp.*');

    //     $this->db->where('tbl_otp.email', $email);

    //     $query  = $this->db->get($this->table);

    //     $result = $query->row();

    //     return $result;

    // }


    public function get_record_by_id($user_id)

    {

        $this->db->select('*');

        $this->db->where('tbl_otp.id', $user_id);

        $query  = $this->db->get($this->table);

        $result = $query->row();

        return $result;

    }



    public function get_record_by_user_id($user_id)

    {

        $this->db->select('*');

        $this->db->where('tbl_otp.id', $user_id);

        $query  = $this->db->get($this->table);

        $result = $query->row();

        return $result;

    }



    public function add_record($data)

    {

        $this->db->set($data);

        $this->db->set('created_at', date('Y-m-d H:i:s A'));

        $this->db->insert($this->table);

        return $this->db->insert_id();

    }



    public function get_record_by_email_password($email, $password)

    {

        $this->db->select('tbl_otp.id,tbl_otp.profile_image,tbl_otp.is_admin,tbl_otp.is_leader,tbl_otp.is_excluded_from_leaderboard');

        $this->db->where('email', $email);

        $this->db->where('is_email_verified', 'Yes');

        $this->db->where('password', encrpty_password($password));

        $query  = $this->db->get('tbl_otp');

        $result = $query->row();

        return $result;

    }



    public function get_record_by_username_password($username, $password)

    {

        $this->db->select('tbl_otp.*');



        $this->db->group_start();

        $this->db->where('username', $username);

        $this->db->or_where('email', $username);

        $this->db->group_end();

        $this->db->where('password', encrpty_password($password));

        $query  = $this->db->get('tbl_otp');

        $result = $query->row();

        return $result;

    }



    public function get_count_total_user()

    {

        $this->db->select('COUNT(*) as total_user');

        $this->db->where('status', "Active");

        $query  = $this->db->get('tbl_otp');

        $result = $query->row();

        return $result;

    }



    public function is_referral_code_exists($code, $id)

    {

        $this->db->where('shopify_customer_id !=', $id);

        $this->db->where('code', $code);

        $query  = $this->db->get('tbl_otp');

        $result = $query->row();



        if ($result) {

            return true;



        } else {

            return false;

        }

    }



    public function update_profile_picture($profile_image, $user_id)

    {

        $user = $this->get_record($user_id);



        // unlink the existing image first

        if ($user->profile_image) {

            $image_path = './assets/uploads/users/user_' . $user->id . '/' . $user->profile_image;



            unlink($image_path);

        }



        // now update the file name in table

        $this->_update(array('profile_image' => $profile_image), $user_id);

    }



    public function update_record($data, $id) // try to get rid from this method

    {

        //pr($data); die;

        $this->_update($data, $id);

    }



    protected function _update($data, $id)

    {

        $this->db->where('id', $id);

        $this->db->set($data);

        $this->db->update($this->table);

    }

   public function checkValidUser($email,$password)

   {

      $this->db->select('*');

      $this->db->where('status', 'Active');

      $this->db->group_start();

         $this->db->where('mobile_number', $email);

         $this->db->or_where('email', $email);

      $this->db->group_end();

      $this->db->where('password',$password);

      $this->db->from('tbl_otp');

      $query = $this->db->get();

      return $query->row();

   }

}

