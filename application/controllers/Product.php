<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function index()
	{
		$this->load->model('Panel_Home', 'Panel_Home');
    $cat = $this->Panel_Home->get_parent_category();
    if ($cat['success']==1) {
      $result = array();
      $category = $cat['data'];
      foreach ($category as $key => $value) {
        $cid =  $value['id'];
        $sub =  $this->Panel_Home->get_sub_category_by_id($cid);
        if ($sub['success']==1) {
          $category[$key]['subcategory'] = $subcategory = $sub['data'];


          foreach ($subcategory as $sk => $sv) {
            $sid =  $sv['id'];
            $ssc =  $this->Panel_Home->get_sub_sub_category_by_id($cid);
            if ($ssc['success']==1) {
              $category[$key]['subcategory'][$sk]['sub_sub_category'] = $sub_sub_category = $ssc['data'];
          // print_r($sub_sub_category);
            }else{
              // echo "<br>No sub sub-category found<br>";
            }
          }

        }else{
          // echo "<br>No subcategory found<br>";
        }
      }
    }
        $result['category'] = $category;
        $slider = $this->Panel_Home->get_slider();
        if ($slider['success']==1) {
          $result['slider'] = $slider['data'];
        }
        $this->load->view('top.php');
        $this->load->view('loader.php');
        $this->load->view('header.php',  $result);
		$this->load->view('index.php');
  }
}
