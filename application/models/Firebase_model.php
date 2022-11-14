<?php
/**
 * Admin_model Model for Admin
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Firebase_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->API_ACCESS_KEY = "AAAA3T6eeGI:APA91bE3zHhWwkIHgj2kmX9Ht8iyMnr7b16Z8X9Uhgu0T_nF20Ra_eT1pelIxAzr3YHpvtTd_vF5sB6Rz_3yTrUepux7Zo0HmexDS21HNexu3Rd3qXBoswy4-kt7Ucogp9vExaOE6xz_";
        $this->table          = 'notification';
    }

    public function send_notification($divice_id, $title, $message)
    {
        $registrationIds = array($divice_id);
        $msg             = array
            (
            'title'   => $title,
            'message'     => $message,
            // 'subtitle'   => 'This is a subtitle. subtitle',
            //'tickerText' => 'Ticker text here...Ticker text here...Ticker text here',
            'vibrate'   => 1,
            'sound'     => 1,
            'largeIcon' => 'large_icon',
            'smallIcon' => 'small_icon',
        );
        $fields = array
            (
            'registration_ids' => $registrationIds,
            'data'             => $msg,
        );

        return $this->curl($fields);

    }

    public function add_record($data)
    {
        $this->db->set($data);
        $this->db->set('created_at', getDefaultToGMTDate(time()));
        $this->db->insert($this->table);
        return $this->db->insert_id();
    }
    public function countAllRecords($searchData)
    {

        $this->db->select(' notification.id');
        if (isset($searchData) && $searchData['sorting_order']) {
            $this->db->order_by('notification.' . $searchData['column_name'], $searchData['sorting_order']);

        }
        $query  = $this->db->get($this->table);
        $result = $query->num_rows();
        return $result;
    }
    public function getAllRecords($searchData)
    {

        $this->db->select('*');

        if (isset($searchData) && $searchData['sorting_order']) {
            $this->db->order_by('notification.' . $searchData['column_name'], $searchData['sorting_order']);

        }
        if (isset($searchData) && $searchData['limit']) {
            $this->db->limit($searchData['limit'], $searchData['search_index']);
        }
        $query = $this->db->get($this->table);
        //echo $this->db->last_query();
        $result = $query->result();
        //echo $this->db->last_query(); die;
        return $result;
    }
    public function curl($fields)
    {
        $headers = array
            (
            'Authorization: key=' . $this->API_ACCESS_KEY,
            'Content-Type: application/json',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        // pr($result); die;
        return json_decode($result);
    }
}
