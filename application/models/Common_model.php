<?php
/**
 * Common_Model Model for Admin and site
 */
class Common_Model extends CI_Model
{

    public function __construct()
    {
        global $URI, $CFG, $IN;
        $ci = get_instance();
        $ci->load->config('config');
        $this->setSiteConfigData();
        //$this->setMemberConfigData();
        $this->setLocalTimeZone();
    }

    public function setSiteConfigData()
    {
        $this->config->set_item('per_page', 20);
        $this->config->set_item('per_page_front', 4);
    }

    public function setMemberConfigData()
    {
        if ($this->session->userdata('user_id')) {
            $userData = $this->getUserDataById($this->session->userdata('user_id'));
            if ($userData) {
                $this->config->set_item('name', $userData->name);
            }
        }
    }

    public function setLocalTimeZone()
    {
        if (!$this->session->userdata('local_time_zone')) {

            $timezone = 'America/Denver';

            $this->session->set_userdata('local_time_zone', $timezone);

        }
        date_default_timezone_set($this->session->userdata('local_time_zone'));
    }

    public function createSlugForTable($title, $table)
    {
        $slug = url_title($title);
        $slug = strtolower($slug);
        $i = 0;
        $params = array();
        $params['slug'] = $slug;
        while ($this->db->where($params)->get($table)->num_rows()) {
            if (!preg_match('/-{1}[0-9]+$/', $slug)) {
                $slug .= '-' . ++$i;
            } else {
                $slug = preg_replace('/[0-9]+$/', ++$i, $slug);
            }
            $params['slug'] = $slug;
        }
        return $slug;
    }

    public function getDefaultToGMTTime($time)
    {
        $gmtTime = local_to_gmt($time);
        return $gmtTime;
    }

    public function getDefaultToGMTDate($time, $format = 'Y-m-d H:i:s A')
    {
        $gmtTime = local_to_gmt($time);
        return date($format, $gmtTime);
    }

    public function getGMTDateToLocalDate($date, $format = 'Y-m-d H:i:s')
    {
        $date = new DateTime($date, new DateTimeZone('GMT'));
        $date->setTimeZone(new DateTimeZone($this->session->userdata('local_time_zone')));
        return $date->format($format);
    }

    public function showLimitedText($string, $len)
    {
        $string = strip_tags($string);
        if (strlen($string) > $len) {
            $string = mb_substr($string, 0, $len - 3) . "...";
        }

        return $string;
    }

    public function getUserDataById($user_id)
    {
        $this->db->where('id', $user_id);
        $query = $this->db->get('tbl_users');
        $result = $query->row();
        return $result;
    }

    public function checkAdminLogin()
    {
        if ($this->session->userdata('admin_id')) {
            return true;
        } else {
            if ($this->input->is_ajax_request()) {
                $data['success'] = false;
                $data['message'] = 'Please login first';
                $data['error_type'] = 'auth';
                echo json_encode($data);die;
            } else {
                redirect('admin/login');
            }
        }
    }

    public function checkLoginAdminStatus()
    {
        $user = $this->getLoginAdmin();
        if ($user) {
            return true;
        } else {
            $this->session->sess_destroy();
            redirect('admin/login');
            return false;
        }

    }

    public function getLoginAdmin()
    {
        $userId = $this->session->userdata('admin_id');
        $this->db->where('id', $userId);
        $this->db->where('status', 'Active');
        $this->db->where('is_delete', 'No');
        $query = $this->db->get('tbl_users');
        $result = $query->row();
        return $result;
    }

    public function getOptionValue($slug = '', $language_abbr = '')
    {
        $this->db->select('*');
        $this->db->where('website_setting.slug', $slug);
        if ($language_abbr) {
            $this->db->where('website_setting.language_abbr', $language_abbr);
        }

        $query = $this->db->get('website_setting');
        $result = $query->row();
        if ($result) {
            return $result->value;
        }

    }

    public function checkUserLogin()
    {
        if ($this->session->userdata('user_id')) {
            return true;
        } else {
            if ($this->input->is_ajax_request()) {
                $data['success'] = false;
                $data['message'] = 'Please login first';
                $data['error_type'] = 'auth';
                echo json_encode($data);die;
            } else {
                redirect('');
            }
        }
    }
    public function checkUserLoginPortal()
    {
        if ($this->session->userdata('user_id_portal')) {
            return true;
        } else {
            if ($this->input->is_ajax_request()) {
                $data['success'] = false;
                $data['message'] = 'Please login first';
                $data['error_type'] = 'auth';
                echo json_encode($data);die;
            } else {
                redirect('portal/login');
            }
        }
    }

    public function checkUseAlreadyLogin()
    {
        $userId = $this->session->userdata('user_id');

        if ($userId) {
            redirect('demo');
        } else {
            return false;
        }
    }
    public function checkUseAlreadyLoginPortal()
    {
        $userId = $this->session->userdata('user_id_portal');

        if ($userId) {
            redirect('portal');
        } else {
            return false;
        }
    }

    function data_update($table,$set_array,$condition){
        $this->db->update($table,$set_array,$condition);
        return $this->db->affected_rows();
    }




}
