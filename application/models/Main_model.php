<?php

class Main_model extends CI_Model

{

    public function __construct()

    {

        parent::__construct();

    } 

    

	function user_login($username, $password)

	{

		$user=$this->db->get_where('tbl_users', array('user_email'=>$username, 'user_password'=>$password))->row_array();

		return $user;

	}

	function get_role_user_type_by_id($role)

	{

		$user=$this->db->get_where('tbl_roles', array('role_id'=> $role))->row_array();

		//echo $this->db->last_query();

		return $user;

	}

	function UpdatePassword($password, $pass)

	{

		$this->db->set('user_password', $password);

		$this->db->set('user_pass', $pass);

		$this->db->where('user_id', $this->session->userdata('user_id'));

		$result=$this->db->update('tbl_users');

		return $result;

	}

	function LoginActivity($data)

	{

		$this->db->set('user_login', date('d-m-Y h:i:s'));

		$this->db->where('user_id', $data['user_id']);

		$this->db->update('tbl_users');

	}

	function NewRole($data)

	{

		$result=$this->db->insert('tbl_roles', $data);

		return $result=$this->db->insert_id();

	}

	function RoleInactive($id)

	{

		$this->db->set('role_status', 0);

		$this->db->where('role_id', $id);

		$this->db->update('tbl_roles');

	}

	function RoleActive($id)

	{

		$this->db->set('role_status', 1);

		$this->db->where('role_id', $id);

		$this->db->update('tbl_roles');

	}

	function RoleDelete($id)

	{

		$this->db->where('role_id', $id);

		$this->db->delete('tbl_roles');

	}

	function RoleUpdate($id, $branch, $department, $role,$user_type)

	{

		$this->db->set('role_name', $role);

		$this->db->set('role_branch', $branch);

		$this->db->set('role_department', $department);

		$this->db->set('user_type', $user_type);

		$this->db->set('role_date', date('d-m-Y h:i:s'));

		$this->db->where('role_id', $id);	

		$this->db->update('tbl_roles');

	}

	function NewBranch($data)

	{

		$result=$this->db->insert('tbl_branches', $data);

		return $result;

	}

	function Newusertype($data)

	{

		$result=$this->db->insert('tbl_user_type', $data);

		return $result;

	}

	function get_user_type_by_slug($slug)

	{

		$user = $this->db->get_where('tbl_user_type', array('slug' => $slug))->row_array();

		//echo $this->db->last_query();

		return $user;

	}

	function get_user_type_by_slug_update($slug,$id)

	{

		$user = $this->db->get_where('tbl_user_type', array('slug' => $slug,'id!='=>$id))->row_array();

		//echo $this->db->last_query(); die;

		return $user;

	}

	function BranchInactive($id)

	{

		$this->db->set('branch_status', 0);

		$this->db->where('branch_id', $id);

		$this->db->update('tbl_branches');

	}

	function UserTypeInactive($id)

	{

		$this->db->set('status', 0);

		$this->db->where('id', $id);

		$this->db->update('tbl_user_type');

	}

	function UserTypeActive($id)

	{

		$this->db->set('status', 1);

		$this->db->where('id', $id);

		$this->db->update('tbl_user_type');

	}

	function BranchActive($id)

	{

		$this->db->set('branch_status', 1);

		$this->db->where('branch_id', $id);

		$this->db->update('tbl_branches');

	}

	function BranchDelete($id)

	{

		$this->db->where('branch_id', $id);

		$this->db->delete('tbl_branches');

	}

	function BranchUpdate($id, $branch, $location)

	{

		$this->db->set('branch_name', $branch);

		$this->db->set('branch_location', $location);

		$this->db->where('branch_id', $id);	

		$this->db->update('tbl_branches');

	}

	function UserTypeUpdate($id, $title, $slug, $branch_id)

	{

		$this->db->set('title', $title);

		$this->db->set('branch_id', $branch_id);

		$this->db->set('slug', $slug);

		$this->db->where('id', $id);	

		$this->db->update('tbl_user_type');

	}

	function NewDepartment($data)

	{

		$result=$this->db->insert('tbl_departments', $data);

		return $result;

	}

	function DepartmentInactive($id)

	{

		$this->db->set('department_status', 0);

		$this->db->where('department_id', $id);

		$this->db->update('tbl_departments');

	}

	function DepartmentActive($id)

	{

		$this->db->set('department_status', 1);

		$this->db->where('department_id', $id);

		$this->db->update('tbl_departments');

	}

	function DepartmentDelete($id)

	{

		$this->db->where('department_id', $id);

		$this->db->delete('tbl_departments');

	}

	function DepartmentUpdate($id, $branch, $department)

	{

		$this->db->set('department_branch', $branch);

		$this->db->set('department_name', $department);

		$this->db->where('department_id', $id);	

		$this->db->update('tbl_departments');

	}

	function EmployeeAdd($data)

	{

		$result=$this->db->insert('tbl_users', $data);

		return $result=$this->db->insert_id();

	}

	function EmployeeUpdate($id, $data)

	{

		$this->db->where('user_id', $id);

		$result= $this->db->update('tbl_users', $data);

		return $result;

	}

	function AddClient($data)

	{

		$this->db->insert('tbl_customers', $data);

		$result= $this->db->insert_id();

		return $result;

	}

	function UpdateClient($client_id, $data)

	{

		$this->db->where('client_id', $client_id);

		$result=$this->db->update('tbl_customers', $data);

		return $client_id;

	}

	function SuspendClient($atr1, $status)

	{

		$this->db->set('client_status', $status);

		$this->db->where('client_id', $atr1);

		$result=$this->db->update('tbl_customers');

		return $result;

	}

	function DeleteClient($atr1)

	{

		$this->db->where('client_id', $atr1);

		$this->db->delete('tbl_clients');

	}

	function GetTimeline($atr)

	{

		$result= $this->db->order_by('timeline_id', 'DESC')->get_where('tbl_timeline', array('timeline_client'=>$atr))->result_array();

		return $result;

	}

	function repot_user_list($auth_id){

		$user = $this->db->select('user_id')->get_where('tbl_users', array('user_reporting' => $auth_id))->row_array();
		//echo $this->db->last_query();die;
		return $user;

	}	
	function repot_user_list_array($auth_id){

		$user = $this->db->select('user_id')->get_where('tbl_users', array('user_reporting' => $auth_id))->result_array();
		$user_array = array();
	//	array_push($user_array,$auth_id);
		foreach ($user as $key => $value) {
		array_push($user_array,$value);
		$users = $this->db->select('user_id')->get_where('tbl_users', array('user_reporting' => $value['user_id']))->result_array();
		if($users)
			
			foreach($users as $ve){
				array_push($user_array,$ve);
				$users_a = $this->db->select('user_id')->get_where('tbl_users', array('user_reporting' => $ve['user_id']))->result_array();
				if($users_a){
					foreach($users_a as $vas){
					array_push($user_array,$vas);
						$users_aas = $this->db->select('user_id')->get_where('tbl_users', array('user_reporting' => $vas['user_id']))->result_array();
						if($users_aas){
							array_push($user_array,$users_aas);
							
						}
					}
				}
			}
				
		}
		$new_user_array = array();
		foreach($user_array as $val){
		 		array_push($new_user_array,$val['user_id']);
		}
		array_push($new_user_array,$auth_id);
		//echo "<pre>"; print_r($new_user_array);
		return $new_user_array;

	}

	public function getAllRecords($searchData,$reportUser=null)

	{

	//	echo "<pre>"; print_r($searchData);

		if ($searchData['loginUserType'] == "super_admin") {

		$this->db->select('*');

		$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

		if (isset($searchData) && $searchData['name']) {

			$this->db->group_start();

			$this->db->or_like('tbl_customers.client_name', $searchData['name']);

			$this->db->group_end();

		}

		if (isset($searchData) && $searchData['mobile']) {

			$this->db->group_start();

			$this->db->or_like('tbl_customers.client_mobile', $searchData['mobile']);

			$this->db->group_end();

		}

		if (isset($searchData) && $searchData['aadhar']) {

			$this->db->group_start();

			$this->db->or_like('tbl_customers.client_aadhar', $searchData['aadhar']);

			$this->db->group_end();

		}

		if (isset($searchData) && $searchData['account']) {

			$this->db->group_start();

			$this->db->or_like('tbl_customers_loan.loan_account', $searchData['account']);

			$this->db->group_end();

		}

		if (isset($searchData) && $searchData['sagent']) {

			$this->db->group_start();

			$this->db->where('tbl_customers_loan.application_user', $searchData['sagent']);

			$this->db->group_end();

		}

		if (isset($searchData) && $searchData['cagent']) {

			$this->db->group_start();

			$this->db->where('tbl_customers_loan.collection_user', $searchData['cagent']);

			$this->db->group_end();

		}

		if (isset($searchData) && $searchData['status']) {

			$this->db->group_start();

			$this->db->where('tbl_customers_loan.loan_status', $searchData['status']);

			$this->db->group_end();

		}

			if (isset($searchData) && $searchData['start']) {

			//	$this->db->group_start();

				$this->db->where('tbl_customers_loan.add_date >=', $searchData['start']);

			//	$this->db->group_end();

			}
			if (isset($searchData) && $searchData['end']) {

			//	$this->db->group_start();

				$this->db->where('tbl_customers_loan.add_date <=', $searchData['end']);

			//	$this->db->group_end();

			}
		$query  = $this->db->get('tbl_customers');

		$result = $query->result_array();

		//echo $this->db->last_query(); die;

	}else{

			$this->db->select('*');

			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');
		//	$this->db->join('tbl_users', 'tbl_users.user_id=tbl_customers_loan.application_user', 'left');

			if (isset($searchData) && $searchData['name']) {

			//	$this->db->group_start();

				$this->db->or_like('tbl_customers.client_name', $searchData['name']);

				//$this->db->group_end();

			}

			if (isset($searchData) && $searchData['mobile']) {

				//$this->db->group_start();

				$this->db->or_like('tbl_customers.client_mobile', $searchData['mobile']);

				//$this->db->group_end();

			}

			if (isset($searchData) && $searchData['aadhar']) {

				//$this->db->group_start();

				$this->db->or_like('tbl_customers.client_aadhar', $searchData['aadhar']);

			//	$this->db->group_end();

			}

			if (isset($searchData) && $searchData['account']) {

			//	$this->db->group_start();

				$this->db->or_like('tbl_customers_loan.loan_account', $searchData['account']);

			//	$this->db->group_end();

			}

			if (isset($searchData) && $searchData['sagent']) {

				//$this->db->group_start();

				$this->db->where('tbl_customers_loan.application_user', $searchData['sagent']);

				//$this->db->group_end();

			}

			if (isset($searchData) && $searchData['cagent']) {

			//	$this->db->group_start();

				$this->db->where('tbl_customers_loan.collection_user', $searchData['cagent']);

				//$this->db->group_end();

			}

			if (isset($searchData) && $searchData['status']) {

			//	$this->db->group_start();

				$this->db->where('tbl_customers_loan.loan_status', $searchData['status']);

			//	$this->db->group_end();

			}
			if (isset($searchData) && $searchData['start']) {

			//	$this->db->group_start();

				$this->db->where('tbl_customers_loan.add_date >=', $searchData['start']);

			//	$this->db->group_end();

			}
			if (isset($searchData) && $searchData['end']) {

			//	$this->db->group_start();

				$this->db->where('tbl_customers_loan.add_date <=', $searchData['end']);

			//	$this->db->group_end();

			}
		//	if ($searchData['cagent'] == "" && $searchData['sagent'] == ""  && $searchData['name'] == ""  && $searchData['mobile'] == ""  && $searchData['aadhar'] == "" && $searchData['account'] == "") {

					//$this->db->where('tbl_customers.client_repoting', $searchData['loginUserId']);
					$this->db->where_in('tbl_customers_loan.application_user', $reportUser);
		//	}

			$query  = $this->db->get('tbl_customers');

			$result = $query->result_array();

			//echo $this->db->last_query();

			//die;

	}

		return $result;

	}

	public function vish($start_date = 'NULL' , $end_date ="NULL") {
		if($start_date == 'NULL' && $end_date == 'NULL'){
			$start_date = date('d-m-Y');
			$end_date = date('d-m-Y');
		}
		$this->db->select('*');
		$this->db->select("tbl_customers_loan.id as loan_id",  FALSE );
		$this->db->from('tbl_customers');
		$this->db->limit(1);  
		$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id = tbl_customers.client_id');
		$CustData = $this->db->get()->result_array();
		$count = 0;
		foreach($CustData as $customer)
		{
		$count++;	
		$emiTotal = 0;
		$Balance = 0;
		$penalty = 0;
		$this->db->select_sum('emi_paid');
		$this->db->select('COUNT(emi_paid) as installment', FALSE);
		$this->db->from('tbl_emi');
		$this->db->where(array('emi_client =' => $customer['client_id'], 'emi_loan'=>$customer['loan_id']));
		$this->db->where('emi_payment_date >="'.$start_date.'"');
		$this->db->where('emi_payment_date <= "'.$end_date.'"');
		$this->db->where('emi_paid >= 0');
		$query = $this->db->get()->row_array();
		print_r($this->db);
		die();
		
		$paidAmount = $query['emi_paid'];
		$i = $query['installment'];
		$controllerInstance = & get_instance();
        $pAmount = $controllerInstance->totalPenalty($customer['client_id'], $customer['customer_id']);

		$this->db->select_sum('paid_amount');
		$this->db->select_sum('waived_off');
		$this->db->from('tbl_penalty');
		$this->db->where(array('user_id' => $customer['client_id'], 'loan_id'=>$customer['loan_id']));
		// $this->db->where(' payment_date >= date("'.$start_date.'")');
		// $this->db->where( 'payment_date <= date("'.$end_date.'")');
		$tbl_penalty = $this->db->get()->row_array();
		$paid_amount = $tbl_penalty['paid_amount'];
		$waived_off = $tbl_penalty['waived_off'];
		$TotalPaid = $paid_amount;
		

		$data[$count]['name'] = $customer['client_name'];
		$data[$count]['address'] = $customer['client_current_address'];
		$data[$count]['mobile'] = $customer['client_mobile'];
		$data[$count]['status'] = $customer['loan_status'];
		
		$data[$count]['disbursed_date'] = date('d M,Y' , strtotime($customer['disbursed_date'])); //Disbursed Date

		if($customer['loan_status'] == 'Closed'){
			$data[$count]['closing_date'] = date('d M,Y' , strtotime($customer['application_date'])); //Closing Date
		}
		$data[$count]['emi_amount'] = $customer['emi_amount']; //Emi Amount
		$data[$count]['emi_principal'] = (float)$customer['emi_amount']*((100 - $customer['interest_rate'])/100); //Emi Principal
		$data[$count]['emi_interest'] = (float)$customer['emi_amount']*($customer['interest_rate']/100); //Emi interest
		$data[$count]['installments'] =  $i; //Paid Emis
		$data[$count]['total_interest'] =  (float)((int)$i*(float)($customer['emi_amount'])*((float)$customer['interest_rate']/100)); //Total Interest
		$data[$count]['processing_fee'] =  (float)$customer['loan_amount']*((float)$customer['processing_fee']/100); //processing_fee
		$data[$count]['total_emi'] =  $customer['loan_amount']; //Total emi
		$data[$count]['paid_emi'] =  $paidAmount; //Total Deposited Amt
		$data[$count]['rest_emi'] =  $customer['loan_amount'] - $paidAmount; //Remaining Amt	

		$data[$count]['total_penalty'] =  $pAmount; //Total Penalty
		$data[$count]['paid_penalty'] =  $TotalPaid; //Penalty Deposit
		$data[$count]['pending_penalty'] =  $pAmount - $TotalPaid; //Penalty Pending
		$data[$count]['sales_agent'] = $this->db->get_where('tbl_users', array('user_id' => $customer['application_user']))->row_array()['user_name'];
		$data[$count]['collection_agent'] = $this->db->get_where('tbl_users', array('user_id' => $customer['collection_user']))->row_array()['user_name'];
		}
		return $data;
	}

}

?>