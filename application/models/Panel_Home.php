<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Panel_Home extends CI_Model
{

 
    public function get_parent_category() {
        try {
            $sql = "SELECT id, title FROM shop_categories WHERE status='Active' order by title asc";
            $stmt = $this->db->conn_id-> query($sql);
            $result = $stmt -> fetch_all(MYSQLI_ASSOC);
            if ($result) {
                $response = array(
                    "success" => 1,
                    "message" => "Categories fetched successfully.",
                    "data" => $result
                );
            } else {
                $response = array(
                    "success" => 0,
                    "message" => "No category found"
                );
            }
        } catch (Exception $ex) {
            $response = array(
                "success" => 0,
                "message" => $ex->getMessage()
            );
        }
        return $response;
    }

    

    public function get_sub_category_by_id($id)
    {
        try {
            $sql = "SELECT * FROM sub_category WHERE category_id=$id";
            $stmt = $this->db->conn_id-> query($sql);
            if($stmt){
                $result = $stmt -> fetch_all(MYSQLI_ASSOC);
            if ($result) {
                $response = array(
                    "success" => 1,
                    "message" => "Sub categories fetched successfully.",
                    "data" => $result
                );
            } else {
                $response = array(
                    "success" => 0,
                    "message" => "No sub category found"
                );
            }
            }else{
             $response = array(
                    "success" => 0,
                    "message" => "No sub category found"
                );   
            }
            
        } catch (Exception $ex) {
            $response = array(
                "success" => 0,
                "message" => $ex->getMessage()
            );
        }
        return $response;
    }

    public function get_sub_sub_category_by_id($id)
    {
        try {
            $sql = "SELECT * FROM sub_sub_category WHERE sub_category_id=$id";
            $stmt = $this->db->conn_id-> query($sql);
            $result = $stmt -> fetch_all(MYSQLI_ASSOC);
            if ($result) {
                $response = array(
                    "success" => 1,
                    "message" => "Sub sub-categories fetched successfully.",
                    "data" => $result
                );
            } else {
                $response = array(
                    "success" => 0,
                    "message" => "No sub sub-category found"
                );
            }
        } catch (Exception $ex) {
            $response = array(
                "success" => 0,
                "message" => $ex->getMessage()
            );
        }
        return $response;
    }
    public function get_slider()
    {
        try {
            $sql = "SELECT image FROM tbl_sliders";
            $stmt = $this->db->conn_id-> query($sql);
                        if($stmt){
                $result = $stmt -> fetch_all(MYSQLI_ASSOC);
            
            if ($result) {
                $response = array(
                    "success" => 1,
                    "message" => "Sub categories fetched successfully.",
                    "data" => $result
                );
            } else {
                $response = array(
                    "success" => 0,
                    "message" => "No sub category found"
                );
            }
            }else{
             $response = array(
                    "success" => 0,
                    "message" => "No sub category found"
                );   
            }
            
            
        } catch (Exception $ex) {
            $response = array(
                "success" => 0,
                "message" => $ex->getMessage()
            );
        }
        return $response;
    }
     public function get_speacial_offers()
    {
        try {
            $sql = "SELECT * FROM speical_offter WHERE status='Active'";
            $stmt = $this->db->conn_id-> query($sql);
            $result = $stmt -> fetch_all(MYSQLI_ASSOC);
            if ($result) {
                $response = array(
                    "success" => 1,
                    "message" => "Speacial offers fetched successfully.",
                    "data" => $result
                );
            } else {
                $response = array(
                    "success" => 0,
                    "message" => "No speical offter found"
                );
            }
        } catch (Exception $ex) {
            $response = array(
                "success" => 0,
                "message" => $ex->getMessage()
            );
        }
        return $response;
    }
    
   
   


    public function getAllRecords($searchData,$store_id)
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
        if($store_id!=1)
         $this->db->where('sub_category.store_id', $store_id);
       $query  = $this->db->get($this->table);
        $result = $query->result();
       
        return $result;
    }

   

}
