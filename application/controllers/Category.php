<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function index()
	{ 
		$this->load->model('Panel_Home', 'Panel_Home');
		$cat_id = $_REQUEST['id'];
		$result = array();
		$sub =  $this->Panel_Home->get_sub_category_by_id($cat_id);

		if ($sub['success']==1) {
			$result['subcategory'] = $subcategory = $sub['data'];

			// foreach ($subcategory as $sk => $sv) {
			// 	$sid =  $sv['id'];
			// 	$ssc =  $CI->Panel_Home->get_sub_sub_category_by_id($sid);
			// 	if ($ssc['success']==1) {
			// 		$result['subcategory'][$sk]['sub_sub_category'] = $sub_sub_category = $ssc['data'];
			// 	}else{

			// 	}
			// }

		}else{
          // echo "<br>No subcategory found<br>";
		}
		print_r($result);

		// $this->load->view('header.php');

		// $this->load->view('cat_section');
		// $this->load->view('index.php');
	}
}
