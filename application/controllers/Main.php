<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function login()
	{
		$this->load->view('login');
	}
	public function user_login()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));

		$user = $this->main_model->user_login($username, $password);
		if ($user > 0) {
			$this->main_model->LoginActivity($user);
			$this->session->set_userdata('user_id', $user['user_id']);
			$this->session->set_userdata('user_name', $user['user_name']);
			$this->session->set_userdata('user_email', $user['user_email']);
			$this->session->set_userdata('user_mobile', $user['user_mobile']);
			$this->session->set_userdata('user_current_address', $user['user_current_address']);
			$this->session->set_userdata('user_reporting', $user['user_reporting']);
			$this->session->set_userdata('user_department', $user['user_department']);
			$this->session->set_userdata('user_branch', $user['user_branch']);
			$this->session->set_userdata('user_role', $user['user_role']);
			$this->session->set_userdata('user_reporting', $user['user_reporting']);
			$this->session->set_userdata('user_type', $user['user_type']);
			redirect(base_url() . 'main/dashboard', 'refresh');
		} else {
			$this->session->set_flashdata('error_msg', 'Email/Password not valid');
			redirect(base_url());
		}
	}
	public function logout()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$this->session->sess_destroy();
		redirect(base_url());
	}
	public function password($atr = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		if ($atr == 'update_password') {
			$cpass = md5($this->input->post('cpass'));
			$npass = md5($this->input->post('npass'));
			$cnfpass = md5($this->input->post('cnfpass'));

			$current_password = $this->db->get_where('tbl_users', array('user_id' => $this->session->userdata('user_id')))->row_array();
			if ($current_password['user_password'] == $cpass) {
				if ($npass == $cnfpass) {
					$update_pass = $this->main_model->UpdatePassword($npass, $this->input->post('npass'));
					if ($update_pass > 0) {
						$this->session->set_flashdata('success_msg', 'Password has been changed successfully');
						redirect(base_url() . 'main/password', 'refresh');
					} else {
						$this->session->set_flashdata('error_msg', 'Something went wrong, Try again');
						redirect(base_url() . 'main/password', 'refresh');
					}
				} else {
					$this->session->set_flashdata('error_msg', 'Password Not Matched, Try again');
					redirect(base_url() . 'main/password', 'refresh');
				}
			} else {
				$this->session->set_flashdata('error_msg', 'Current Password Not Matched, Try again');
				redirect(base_url() . 'main/password', 'refresh');
			}
		}

		$this->load->view('password');
	}

	public function dashboard()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$this->load->view('dashboard');
	}
	public function branches($param = '', $param1 = '', $param2 = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		if ($param == 'NewBranch') {
			$data = array(
				'branch_name' => $this->input->post('branch'),
				'branch_location' => $this->input->post('location'),
				'branch_status' => 1,
				'branch_date' => date('d-m-Y h:i:s')
			);
			$result = $this->main_model->NewBranch($data);
			if ($result > 0) {
				$this->session->set_flashdata('success_msg', 'New Branch added successfully');
				redirect(base_url() . 'main/branches', 'refresh');
			} else {
				$this->session->set_flashdata('error_msg', 'Something went wrong, Try again');
				redirect(base_url() . 'main/branches', 'refresh');
			}
		}
		if ($param == 'Status') {
			$status = $param2;
			$id = $param1;
			if ($status == 1) {
				$this->main_model->BranchInactive($id);
				$this->session->set_flashdata('BranchInactive_msg', 'Branch Inactive successfully');
				redirect(base_url() . 'main/branches', 'refresh');
			}
			if ($status == 0) {
				$this->main_model->BranchActive($id);
				$this->session->set_flashdata('BranchSuccess_msg', 'Branch Active successfully');
				redirect(base_url() . 'main/branches', 'refresh');
			}
		}
		if ($param == 'Delete') {
			$id = $param1;
			$this->main_model->BranchDelete($id);
			$this->session->set_flashdata('BranchSuccess_msg', 'Branch deleted successfully');
			redirect(base_url() . 'main/branches', 'refresh');
		}
		if ($param == 'UpdateBranch') {
			$id = $this->input->post('branch_id');
			$branch = $this->input->post('branch');
			$location = $this->input->post('location');

			$this->main_model->BranchUpdate($id, $branch, $location);
			$this->session->set_flashdata('BranchSuccess_msg', 'Branch updated successfully');
			redirect(base_url() . 'main/branches', 'refresh');
		}
		$this->load->view('branches');
	}
	public function newusertype($param = '', $param1 = '', $param2 = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		if ($param == 'newusertype') {
			$data = array(
				'title' => $this->input->post('branch'),
				'slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post('branch')))),
				'status' => 1,
				'add_date' => date('Y-m-d')
			);
			$check = $this->main_model->get_user_type_by_slug(strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post('branch')))));
			if (!$check) {
				$result = $this->main_model->Newusertype($data);
				if ($result > 0) {
					$this->session->set_flashdata('success_msg', 'New User type added successfully');
					redirect(base_url() . 'main/newusertype', 'refresh');
				} else {
					$this->session->set_flashdata('error_msg', 'Something went wrong, Try again');
					redirect(base_url() . 'main/newusertype', 'refresh');
				}
			} else {
				$this->session->set_flashdata('error_msg', 'User type Already Added');
				redirect(base_url() . 'main/newusertype', 'refresh');
			}
		}
		if ($param == 'Status') {
			$status = $param2;
			$id = $param1;
			if ($status == 1) {
				$this->main_model->UserTypeActive($id);
				$this->session->set_flashdata('BranchInactive_msg', 'Branch Inactive successfully');
				redirect(base_url() . 'main/newusertype', 'refresh');
			}
			if ($status == 0) {
				$this->main_model->UserTypeInactive($id);
				$this->session->set_flashdata('BranchSuccess_msg', 'Branch Active successfully');
				redirect(base_url() . 'main/newusertype', 'refresh');
			}
		}
		if ($param == 'Delete') {
			$id = $param1;
			$this->main_model->BranchDelete($id);
			$this->session->set_flashdata('BranchSuccess_msg', 'Branch deleted successfully');
			redirect(base_url() . 'main/newusertype', 'refresh');
		}
		if ($param == 'UpdateUserType') {
			$id = $this->input->post('id');
			$title = $this->input->post('title');
			$branch = $this->input->post('branch');
			$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post('title'))));
			$check = $this->main_model->get_user_type_by_slug_update(strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post('title')))), $id);
			if (!$check) {
				$this->main_model->UserTypeUpdate($id, $title, $slug, $branch);

				$this->session->set_flashdata('BranchSuccess_msg', 'Branch updated successfully');
			} else {
				$this->session->set_flashdata('error_msg', 'User type Already Added');
			}


			redirect(base_url() . 'main/newusertype', 'refresh');
		}
		$this->load->view('userTypes');
	}
	public function departments($param = '', $param1 = '', $param2 = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		if ($param == 'NewDepartment') {
			$data = array(
				'department_branch' => $this->input->post('branch'),
				'department_name' => $this->input->post('department'),
				'department_status' => 1,
				'department_date' => date('d-m-Y h:i:s')
			);
			$result = $this->main_model->NewDepartment($data);
			if ($result > 0) {
				$this->session->set_flashdata('success_msg', 'New Department added successfully');
				redirect(base_url() . 'main/departments', 'refresh');
			} else {
				$this->session->set_flashdata('error_msg', 'Something went wrong, Try again');
				redirect(base_url() . 'main/departments', 'refresh');
			}
		}
		if ($param == 'Status') {
			$status = $param2;
			$id = $param1;
			if ($status == 1) {
				$this->main_model->DepartmentInactive($id);
				$this->session->set_flashdata('DepartmentInactive_msg', 'Department Inactive successfully');
				redirect(base_url() . 'main/departments', 'refresh');
			}
			if ($status == 0) {
				$this->main_model->DepartmentActive($id);
				$this->session->set_flashdata('DepartmentSuccess_msg', 'Department Active successfully');
				redirect(base_url() . 'main/departments', 'refresh');
			}
		}
		if ($param == 'Delete') {
			$id = $param1;
			$this->main_model->DepartmentDelete($id);
			$this->session->set_flashdata('DepartmentSuccess_msg', 'Department deleted successfully');
			redirect(base_url() . 'main/departments', 'refresh');
		}
		if ($param == 'UpdateDepartment') {
			$id = $this->input->post('department_id');
			$branch = $this->input->post('branch');
			$department = $this->input->post('department');

			$this->main_model->DepartmentUpdate($id, $branch, $department);
			$this->session->set_flashdata('DepartmentSuccess_msg', 'Department updated successfully');
			redirect(base_url() . 'main/departments', 'refresh');
		}
		$this->load->view('departments');
	}
	public function roles($param = '', $param1 = '', $param2 = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}

		if ($param == 'Status') {
			$status = $param2;
			$id = $param1;
			if ($status == 1) {
				$this->main_model->RoleInactive($id);
				$this->session->set_flashdata('RoleInactive_msg', 'Role Inactive successfully');
				redirect(base_url() . 'main/roles', 'refresh');
			}
			if ($status == 0) {
				$this->main_model->RoleActive($id);
				$this->session->set_flashdata('RoleSuccess_msg', 'Role Active successfully');
				redirect(base_url() . 'main/roles', 'refresh');
			}
		}
		if ($param == 'Delete') {
			$id = $param1;
			$this->main_model->RoleDelete($id);

			$this->db->where('user', $id);
			$this->db->delete('tbl_permissions');
			$this->session->set_flashdata('RoleSuccess_msg', 'Role deleted successfully');
			redirect(base_url() . 'main/roles', 'refresh');
		}

		$this->load->view('roles');
	}
	public function newRole($param = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		if ($param == 'saveNewRole') {
			$data = array(
				'role_branch' => $this->input->post('branch'),
				'role_department' => $this->input->post('department'),
				'role_name' => $this->input->post('role'),
				'user_type' => $this->input->post('user_type'),
				'role_status' => 1,
				'role_date' => date('d-m-Y h:i:s')
			);
			$result = $this->main_model->NewRole($data);
			if ($result > 0) {
				$permissionData = array(
					'user' => $result,
					'permissions' => implode(',', $this->input->post('permimssion')),
				);
				$this->db->insert('tbl_permissions', $permissionData);
				$this->session->set_flashdata('success_msg', 'New Role added successfully');
				redirect(base_url() . 'main/roles', 'refresh');
			} else {
				$this->session->set_flashdata('error_msg', 'Something went wrong, Try again');
				redirect(base_url() . 'main/roles', 'refresh');
			}
		}
		$this->load->view('newRole');
	}
	public function editRole($param = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}

		if ($param == 'updateRole') {
			$id = $this->input->post('roleId');
			$branch = $this->input->post('branch');
			$department = $this->input->post('department');
			$role = $this->input->post('role');
			$user_type = $this->input->post('user_type');
			$this->main_model->RoleUpdate($id, $branch, $department, $role, $user_type);

			$permissions = implode(',', $this->input->post('permimssion'));
			$this->db->set('permissions', $permissions);
			$this->db->where('user', $id);
			$this->db->update('tbl_permissions');

			$this->session->set_flashdata('success_msg', 'New Role added successfully');
			redirect(base_url() . 'main/roles', 'refresh');
		}

		$userRole = $this->db->get_where('tbl_roles', array('role_id' => $param))->row_array();
		$user_permission = $this->db->get_where('tbl_permissions', array('user' => $param))->row_array();
		if ($user_permission > 0) {
			$UserPermission['UserPermissions'] = explode(',', $user_permission['permissions']);
		}
		$this->load->view('editRole', array_merge($UserPermission, $userRole));
	}
	public function loanSettings($param = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		if ($param == 'SaveSettings') {
			$data = array(
				'interest_rate' => $this->input->post('interest_rate'),
				'processing_fee' => $this->input->post('processing_fee'),
				'loan_duration' => $this->input->post('loan_duration'),
				'duration_unit' => $this->input->post('unit'),
				'penalty' => $this->input->post('penalty')
			);

			$SettingsData = $this->db->get('tbl_loan_settings')->num_rows();
			if ($SettingsData > 0) {
				$this->db->update('tbl_loan_settings', $data);
				$this->session->set_flashdata('Response_Msg', 'Loan Settings Updated');
				redirect(base_url() . 'main/LoanSettings', 'refresh');
			} else {
				$this->db->insert('tbl_loan_settings', $data);
				$this->session->set_flashdata('Response_Msg', 'Loan Settings Updated');
				redirect(base_url() . 'main/LoanSettings', 'refresh');
			}
		}

		$this->load->view('LoanSettings');
	}
	public function employees()
	{

		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$this->load->model('main_model', 'main');
		$reported_user =  $this->main->repot_user_list($this->session->userdata('user_id'));
		$this->load->view('employees', compact('reported_user'));
	}
	public function newEmployee($param = '', $param1 = '', $param2 = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}

		if ($param == 'SaveData') {
			$photo = $_FILES['photo'];
			if (!empty($photo['name'])) {
				$config['upload_path'] = './uploads/employees/photo/';
				$config['allowed_types'] = 'jpg|png|jpeg|bmp';
				$this->upload->initialize($config);
				$this->upload->do_upload('photo');
				$uphoto = $this->upload->data('file_name');
			}
			$aadhar_card = $_FILES['aadharcard'];
			if (!empty($aadhar_card['name'])) {
				$config['upload_path'] = './uploads/employees/document/';
				$config['allowed_types'] = 'jpg|png|jpeg|pdf';
				$this->upload->initialize($config);
				$this->upload->do_upload('aadharcard');
				$aadharcard = $this->upload->data('file_name');
			}
			$this->load->model('main_model', 'main');
			$role_user_type = $this->main->get_role_user_type_by_id($this->input->post('role'));
			if ($role_user_type['user_type'] == 1) {
				$user_type = 'Sale';
			} else if ($role_user_type['user_type'] == 2) {
				$user_type = 'collection';
			} else {
				$user_type = "other";
			}
			$data = array(
				'employee_id' => $this->input->post('emp_id'),
				'user_name' => $this->input->post('name'),
				'user_father' => $this->input->post('father'),
				'user_mother' => $this->input->post('mother'),
				'user_dob' => $this->input->post('dob'),
				'user_gender' => $this->input->post('gender'),
				'user_email' => $this->input->post('email'),
				'user_mobile' => $this->input->post('mobile'),
				'user_password' => md5($this->input->post('password')),
				'user_pass' => $this->input->post('password'),
				'user_aadharno' => $this->input->post('aadhar'),
				'user_permanent_address' => $this->input->post('paddress'),
				'user_current_address' => $this->input->post('caddress'),
				'user_branch' => $this->input->post('branch'),
				'user_department' => $this->input->post('department'),
				'user_role' => $this->input->post('role'),
				'user_reporting' => $this->input->post('authority'),
				'user_image' => $uphoto,
				'user_aadharcard' => $aadharcard,
				'user_status' => 1,
				'user_type' => $user_type,
				'user_date' => date('d-m-Y h:i:s'),
				'user_login' => '00-00-0000 00:00:00'

			);

			$result = $this->main_model->EmployeeAdd($data);
			if ($result > 0) {
				$this->session->set_flashdata('EmpSuccess_msg', 'Employee added successfully');
				redirect(base_url() . 'main/employees', 'refresh');
			} else {
				$this->session->set_flashdata('Emperror_msg', 'Something went wrong, Try again');
				redirect(base_url() . 'main/employees', 'refresh');
			}
		}
		if ($param == 'Suspend') {
			$id = $param1;
			$status = $param2;
			if ($status == 1) {
				$this->db->set('user_status', 0);
				$this->db->where('user_id', $id);
				$this->db->update('tbl_users');
				$this->session->set_flashdata('UserSuspended', 'Employee suspended successfully');
				redirect(base_url() . 'main/employees', 'refresh');
			}
			if ($status == 0) {
				$this->db->set('user_status', 1);
				$this->db->where('user_id', $id);
				$this->db->update('tbl_users');
				$this->session->set_flashdata('UserSuccess', 'Employee activated successfully');
				redirect(base_url() . 'main/employees', 'refresh');
			}
		}
		if ($param == 'Delete') {
			$id = $param1;
			$this->db->where('user_id', $id);
			$this->db->delete('tbl_users');
			$this->session->set_flashdata('UserSuccess', 'Employee deleted successfully');
			redirect(base_url() . 'main/employees', 'refresh');
		}
		$this->load->view('newEmployee');
	}
	public function newAdmin($param = '', $param1 = '', $param2 = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}

		if ($param == 'SaveData') {
			$photo = $_FILES['photo'];
			if (!empty($photo['name'])) {
				$config['upload_path'] = './uploads/employees/photo/';
				$config['allowed_types'] = 'jpg|png|jpeg|bmp';
				$this->upload->initialize($config);
				$this->upload->do_upload('photo');
				$uphoto = $this->upload->data('file_name');
			}
			$aadhar_card = $_FILES['aadharcard'];
			if (!empty($aadhar_card['name'])) {
				$config['upload_path'] = './uploads/employees/document/';
				$config['allowed_types'] = 'jpg|png|jpeg|pdf';
				$this->upload->initialize($config);
				$this->upload->do_upload('aadharcard');
				$aadharcard = $this->upload->data('file_name');
			}
			$data = array(
				'employee_id' => $this->input->post('emp_id'),
				'user_name' => $this->input->post('name'),
				'user_father' => $this->input->post('father'),
				'user_mother' => $this->input->post('mother'),
				'user_dob' => $this->input->post('dob'),
				'user_gender' => $this->input->post('gender'),
				'user_email' => $this->input->post('email'),
				'user_mobile' => $this->input->post('mobile'),
				'user_password' => md5($this->input->post('password')),
				'user_pass' => $this->input->post('password'),
				'user_aadharno' => $this->input->post('aadhar'),
				'user_permanent_address' => $this->input->post('paddress'),
				'user_current_address' => $this->input->post('caddress'),
				'user_branch' => $this->input->post('branch'),
				'user_department' => $this->input->post('department'),
				'user_role' => $this->input->post('role'),
				'user_reporting' => $this->input->post('authority'),
				'user_image' => $uphoto,
				'user_aadharcard' => $aadharcard,
				'user_status' => 1,
				'user_type' => 'admin',
				'user_date' => date('d-m-Y h:i:s'),
				'user_login' => '00-00-0000 00:00:00'

			);

			$result = $this->main_model->EmployeeAdd($data);
			if ($result > 0) {
				$this->session->set_flashdata('EmpSuccess_msg', 'Employee added successfully');
				redirect(base_url() . 'main/newEmployee', 'refresh');
			} else {
				$this->session->set_flashdata('Emperror_msg', 'Something went wrong, Try again');
				redirect(base_url() . 'main/newEmployee', 'refresh');
			}
		}
		if ($param == 'Suspend') {
			$id = $param1;
			$status = $param2;
			if ($status == 1) {
				$this->db->set('user_status', 0);
				$this->db->where('user_id', $id);
				$this->db->update('tbl_users');
				$this->session->set_flashdata('UserSuspended', 'Employee suspended successfully');
				redirect(base_url() . 'main/employees', 'refresh');
			}
			if ($status == 0) {
				$this->db->set('user_status', 1);
				$this->db->where('user_id', $id);
				$this->db->update('tbl_users');
				$this->session->set_flashdata('UserSuccess', 'Employee activated successfully');
				redirect(base_url() . 'main/employees', 'refresh');
			}
		}
		if ($param == 'Delete') {
			$id = $param1;
			$this->db->where('user_id', $id);
			$this->db->delete('tbl_users');
			$this->session->set_flashdata('UserSuccess', 'Employee deleted successfully');
			redirect(base_url() . 'main/employees', 'refresh');
		}
		$this->load->view('newAdmin');
	}
	public function employee($id = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$employee = $this->db->get_where('tbl_users', array('user_id' => $id))->row_array();
		$this->load->view('employee', $employee);
	}
	public function editEmployee($id = '', $param = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		if ($param == 'UpdateData') {
			$emp = $this->db->get_where('tbl_users', array('user_id' => $id))->row_array();
			$photo = $_FILES['photo'];
			if (empty($photo['name'])) {
				$uphoto = $emp['user_image'];
			}

			if (!empty($photo['name'])) {
				unlink('./uploads/employees/photo/' . $emp['user_image']);
				$config['upload_path'] = './uploads/employees/photo/';
				$config['allowed_types'] = 'jpg|png|jpeg|bmp';
				$this->upload->initialize($config);
				$this->upload->do_upload('photo');
				$uphoto = $this->upload->data('file_name');
			}
			$aadhar_card = $_FILES['aadharcard'];
			if (empty($aadhar_card['name'])) {
				$aadharcard = $emp['user_aadharcard'];
			}
			if (!empty($aadhar_card['name'])) {
				unlink('./uploads/employees/document/' . $emp['user_aadharcard']);
				$config['upload_path'] = './uploads/employees/document/';
				$config['allowed_types'] = 'jpg|png|jpeg|pdf';
				$this->upload->initialize($config);
				$this->upload->do_upload('aadharcard');
				$aadharcard = $this->upload->data('file_name');
			}
			$this->load->model('main_model', 'main');
			$role_user_type = $this->main->get_role_user_type_by_id($this->input->post('role'));
			if ($role_user_type['user_type'] == 1) {
				$user_type = 'Sale';
			} else if ($role_user_type['user_type'] == 2) {
				$user_type = 'collection';
			} else {
				$user_type = "other";
			}
			$data = array(
				'user_name' => $this->input->post('name'),
				'user_father' => $this->input->post('father'),
				'user_mother' => $this->input->post('mother'),
				'user_dob' => $this->input->post('dob'),
				'user_gender' => $this->input->post('gender'),
				'user_email' => $this->input->post('email'),
				'user_mobile' => $this->input->post('mobile'),
				'user_password' => md5($this->input->post('password')),
				'user_pass' => $this->input->post('password'),
				'user_aadharno' => $this->input->post('aadhar'),
				'user_permanent_address' => $this->input->post('paddress'),
				'user_current_address' => $this->input->post('caddress'),
				'user_branch' => $this->input->post('branch'),
				'user_department' => $this->input->post('department'),
				'user_role' => $this->input->post('role'),
				'user_reporting' => $this->input->post('authority'),
				'user_image' => $uphoto,
				'user_type' => $user_type,
				'user_aadharcard' => $aadharcard
			);

			$result = $this->main_model->EmployeeUpdate($id, $data);
			if ($result > 0) {
				$this->session->set_flashdata('EmpSuccess_msg', 'Employee details updated successfully');
				redirect(base_url() . 'main/editEmployee/' . $id, 'refresh');
			} else {
				$this->session->set_flashdata('Emperror_msg', 'Something went wrong, Try again');
				redirect(base_url() . 'main/editEmployee/' . $id, 'refresh');
			}
		}

		$employee = $this->db->get_where('tbl_users', array('user_id' => $id))->row_array();
		$this->load->view('editEmployee', $employee);
	}

	public function getDepartments()
	{
		$res = array();
		$departments = $this->db->get_where('tbl_departments', array('department_branch' => $_POST['branch_id']))->result_array();

		$user_type = $this->db->query("SELECT * FROM `tbl_user_type` WHERE status = '1' OR is_default='Yes'");

		$user_type = $user_type->result_array();
		$html = '<option value="">Select Department</option>';
		foreach ($departments as $dept) :
			$html .= '<option value="' . $dept['department_id'] . '">' . $dept['department_name'] . '</option>';
		//echo $role['role_name'];
		endforeach;

		$html2 = '<option value="">Select User type</option>';
		foreach ($user_type as $va) :
			$html2 .= '<option value="' . $va['id'] . '">' . $va['title'] . '</option>';
		//echo $role['role_name'];
		endforeach;
		$res['html'] = $html;
		$res['html2'] = $html2;
		echo json_encode($res);
		die;
	}
	public function getRoles()
	{
		$roles = $this->db->get_where('tbl_roles', array('role_department' => $_POST['department_id']))->result_array();
		echo '<option value="">Select Role</option>';
		foreach ($roles as $role) :
			echo  '<option value="' . $role['role_id'] . '">' . $role['role_name'] . '</option>';
		//	echo $role['role_name'];
		endforeach;
	}
	public function getDepartment($id)
	{
		$result = $this->db->get_where('tbl_departments', array('department_id' => $id))->row_array();
		return $result;
	}
	public function getRole($id)
	{
		$result = $this->db->get_where('tbl_roles', array('role_id' => $id))->row_array();
		return $result;
	}
	public function getAuthority($id)
	{
		$result = $this->db->get_where('tbl_users', array('user_id' => $id))->row_array();
		return $result;
	}
	public function getBranch($id)
	{
		$result = $this->db->get_where('tbl_branches', array('branch_id' => $id))->row_array();
		return $result;
	}
	public function customers($atr = '', $atr1 = '', $atr2 = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		if ($atr == 'Reject') {
			$client_id = $this->input->post('client_id');
			$loan_id = $this->input->post('loan_id');
			$data = array(
				'loan_status' => 'Rejected',
				'rejection_remark' => $this->input->post('reason')
			);
			$this->db->where('id', $loan_id);
			$this->db->update('tbl_customers_loan', $data);

			$timeline = array(
				'timeline_user' => $this->session->userdata('user_name'),
				'timeline_user_role' => $this->session->userdata('user_role'),
				'timeline_client' => $client_id,
				'timeline_message' => 'Customer application rejected by ' . $this->session->userdata('user_name') . ' on ' . date('d M. Y') . ' at ' . date('h:i:s') . ' because of <br/> ' . $this->input->post('reason'),
				'timeline_date' => date('d M. Y'),
				'timeline_time' => date('h:i:s')
			);
			$this->db->insert('tbl_timeline', $timeline);

			redirect(base_url() . 'main/ClientView/' . $client_id, 'refresh');
		}
		if ($atr == 'ApplicationSubmit') {
			$client_id = $atr1;
			$loan_id = $atr2;
			$data = array(
				'loan_status' => 'Submitted'
			);
			$this->db->where('id', $loan_id);
			$this->db->update('tbl_customers_loan', $data);

			$timeline = array(
				'timeline_user' => $this->session->userdata('user_name'),
				'timeline_user_role' => $this->session->userdata('user_role'),
				'timeline_client' => $client_id,
				'timeline_message' => 'Customer application submitted by ' . $this->session->userdata('user_name') . ' on ' . date('d M. Y') . ' at ' . date('h:i:s'),
				'timeline_date' => date('d M. Y'),
				'timeline_time' => date('h:i:s')
			);
			$this->db->insert('tbl_timeline', $timeline);

			redirect(base_url() . 'main/ClientView/' . $client_id, 'refresh');
		}
		if ($atr == 'ApplicationApprove') {
			$client_id = $atr1;
			$loan_id = $atr2;
			$data = array(
				'loan_status' => 'Approved'
			);
			$this->db->where('id', $loan_id);
			$this->db->update('tbl_customers_loan', $data);

			$timeline = array(
				'timeline_user' => $this->session->userdata('user_name'),
				'timeline_user_role' => $this->session->userdata('user_role'),
				'timeline_client' => $client_id,
				'timeline_message' => 'Customer application approved by ' . $this->session->userdata('user_name') . ' on ' . date('d M. Y') . ' at ' . date('h:i:s'),
				'timeline_date' => date('d M. Y'),
				'timeline_time' => date('h:i:s')
			);
			$this->db->insert('tbl_timeline', $timeline);

			redirect(base_url() . 'main/ClientView/' . $client_id, 'refresh');
		}
		if ($atr == 'LoanDisburse') {

			$client_id = $this->input->post('client_id');
			$loan_id = $this->input->post('loan_id');
			$collectionAgent = $this->input->post('user');
			$details = $this->input->post('details');
			if ($details != "")
				$details = $details;
			else
				$details = "";
			$data = array(
				'collection_user' => $collectionAgent,
				'disbursed_by' => $this->session->userdata('user_id'),
				'loan_status' => 'Disbursed',
				'disbursement_method' => $this->input->post('payment_type'),
				//'disbursed_date'=>date('d-m-Y'),
				'details' => $details,
			);
			$this->db->where('id', $loan_id);
			$this->db->update('tbl_customers_loan', $data);

			$timeline = array(
				'timeline_user' => $this->session->userdata('user_name'),
				'timeline_user_role' => $this->session->userdata('user_role'),
				'timeline_client' => $client_id,
				'timeline_message' => 'Customer loan disbursed by ' . $this->session->userdata('user_name') . ' on ' . date('d M. Y') . ' at ' . date('h:i:s'),
				'timeline_date' => date('d M. Y'),
				'timeline_time' => date('h:i:s')
			);
			$this->db->insert('tbl_timeline', $timeline);

			$client = $this->db->get_where('tbl_customers_loan', array('id' => $loan_id))->row_array();
			if ($_POST['payment_type'] == "other") {
				$cashEntry = array(
					'auth_id' => $this->session->userdata('user_id'),
					'bank_id' => $this->input->post('sources'),
					'debit' => $client['disbursed_amount'] - $client['previous_due'],
					'credit_amt' => 0,
					//'collect_by'=>$agent,
					'remark' => 'Amount  Debit for Customer Loan Disbursement',
					'add_date' => date('Y-m-d')
				);
				$this->db->insert('tbl_bank_legder', $cashEntry);
			} else {
				$cashEntry = array(
					'emp_id' => $this->session->userdata('user_id'),
					'method' => $client['disbursement_method'],
					'cash_debit' => $client['disbursed_amount'] - $client['previous_due'],
					'cash_credit' => 0,
					'receiving_from' => $this->session->userdata('user_id'),
					'received_by' => $this->session->userdata('user_id'),
					'receiving_status' => 1,
					'remark' => 'Cash Debit for Customer Loan Disbursement',
					'date' => date('d-m-Y')
				);
				$this->db->insert('tbl_cashbook', $cashEntry);
			}



			if ($client['duration_unit'] == 'Day') {
				for ($i = 0; $i < $client['loan_duration']; $i++) :
					$emiDate = date('d-m-Y', strtotime("+" . $i . " day", strtotime($client['emi_start_date'])));
					$data = array(
						'emi_client' => $client_id,
						'emi_loan' => $loan_id,
						'emi_date' => $emiDate,
						'emi_amount' => $client['emi_amount'],
						'emi_paid' => 0,
						'emi_penalty' => 0,
						'emi_status' => 0
					);
					$this->db->insert('tbl_emi', $data);
				endfor;
			}
			if ($client['duration_unit'] == 'Month') {
				for ($i = 0; $i < $client['loan_duration']; $i++) :
					$emiDate = date('d-m-Y', strtotime("+" . $i . " month", strtotime($client['emi_start_date'])));
					$data = array(
						'emi_client' => $client_id,
						'emi_loan' => $loan_id,
						'emi_date' => $emiDate,
						'emi_amount' => $client['emi_amount'],
						'emi_paid' => 0,
						'emi_penalty' => 0,
						'emi_status' => 0
					);
					$this->db->insert('tbl_emi', $data);
				endfor;
			}


			$previousDue = $this->db->get_where('tbl_customers_loan', array('id' => $loan_id))->row_array();

			if ($previousDue > 0) {
				$topup = $this->db->get_where('tbl_topup', array('loan_id' => $previousDue['previous_loan']))->row_array();
				if ($topup > 0) {

					// set in waidoff

					$this->db->where('loan_id', $topup['loan_id']);
					$this->db->set('status', 1);
					$this->db->update('tbl_waived_off');


					// set in waidoff

					$this->db->where('loan_id', $topup['loan_id']);
					$this->db->set('status', 1);
					$this->db->update('tbl_penalty');

					//echo "<pre>"; print_r($_POST); die;
					$client_id = $topup['user_id'];
					$loan_id = $topup['loan_id'];
					$dueAmount = $topup['final_due'];
					$waivedOff = 0;
					$pmind = $topup['penalty_waivedoff'] + $topup['penalty_received'];
					$minus = $topup['penalty'] - $pmind;
					$Received = $topup['final_due'] - $minus;
					$agent = $this->input->post('user');
					$date = date('d-m-Y');
					$amount = $Received + $waivedOff;
					$loanData = $this->db->get_where('tbl_customers_loan', array('id' => $loan_id))->row_array();
					$EmiAmount = $loanData['emi_amount'];
					$EMI_Amount = $EmiAmount;
					$data = array(
						'pay_client' => $client_id,
						'pay_loan' => $loan_id,
						'pay_agent' => $agent,
						'pay_amount' => $Received,
						'pay_date' => $date,
						'add_date' => date("Y-m-d"),
						'pay_update_by' => $this->session->userdata('user_id')

					);
					if ($_POST['payment_type'] == "other") {
						$data['source_id'] = $this->input->post('sources');
					} else {
						$data['source_id'] = 0;
					}
					$this->db->insert('tbl_payments', $data);


					if ($_POST['payment_type'] == "other") {
						$cashEntrydf = array(
							'auth_id' => $this->session->userdata('user_id'),
							'bank_id' => $this->input->post('sources'),
							'debit' => 0,
							'credit_amt' => $Received,
							//'collect_by'=>$agent,
							'remark' => 'Amount Recived for account YM00' . $loan_id,
							'add_date' => date('Y-m-d')
						);
						$this->db->insert('tbl_bank_legder', $cashEntrydf);
					} else {
						$cashEntrydf = array(
							'emp_id' => $this->session->userdata('user_id'),
							'method' => "CASH",
							'cash_debit' => 0,
							'cash_credit' => $Received,
							'receiving_from' => $this->session->userdata('user_id'),
							'received_by' => $this->session->userdata('user_id'),
							'receiving_status' => 1,
							'remark' => 'Amount Recived for account YM00' . $loan_id,
							'date' => date('d-m-Y')
						);
						//echo  "<pre>"; print_r($cashEntrydf); die;
						$this->db->insert('tbl_cashbook', $cashEntrydf);
					}


					$this->db->where('loan_id', $topup['loan_id']);
					$this->db->set('status', 1);
					$this->db->update('tbl_cashbook');


					$this->db->where('loan_id', $topup['loan_id']);
					$this->db->set('status', 1);
					$this->db->update('tbl_bank_legder');
					// entary of penalty
					$pmin = $topup['penalty'] - ($topup['penalty_waivedoff'] + $topup['penalty_received']);
					//var_dump($pmin);
					$pedata = array(
						'user_id' => $topup['user_id'],
						'loan_id' => $loan_id,
						'paid_amount' => $pmin,
						'waived_off' => 0,
						'payment_date' => date('d-m-Y'),
						'payment_user' => $this->session->userdata('user_id'),
						'payment_update' => $this->session->userdata('user_id')
					);
					// if($this->input->post('received')>0)
					// {
					// 	if($this->input->post('payment_type')=="other"){
					// 	$data['source_id'] = $this->input->post('sources');
					// 	}else{
					// 		$data['source_id'] = 0;
					// 	}
					// }
					//echo "<pre>"; print_r($pedata); die;
					//
					//
					//legder maitain for panetly
					if ($_POST['payment_type'] == "other") {
						$cashEntryas = array(
							'auth_id' => $this->session->userdata('user_id'),
							'bank_id' => $this->input->post('sources'),
							'debit' => 0,
							'credit_amt' => $pmin,
							//'collect_by'=>$agent,
							'remark' => 'Penality Recived for account YM00' . $loan_id,
							'add_date' => date('Y-m-d')
						);
						$this->db->insert('tbl_bank_legder', $cashEntryas);
					} else {
						$cashEntryas = array(
							'emp_id' => $this->session->userdata('user_id'),
							'method' => "CASH",
							'cash_debit' => 0,
							'cash_credit' => $pmin,
							'receiving_from' => $this->session->userdata('user_id'),
							'received_by' => $this->session->userdata('user_id'),
							'receiving_status' => 1,
							'remark' => 'Penality Recived for account YM00' . $loan_id,
							'date' => date('d-m-Y')
						);
						$this->db->insert('tbl_cashbook', $cashEntryas);
					}
					if ($_POST['payment_type'] == "other") {
						$pedata['source_id'] = $this->input->post('sources');
					} else {
						$pedata['source_id'] = 0;
					}
					$this->db->insert('tbl_penalty', $pedata);

					$EMI = ceil($amount / $EMI_Amount);
					$emi = $this->db->get_where('tbl_emi', array('emi_client' => $client_id, 'emi_loan' => $loan_id, 'emi_status' => 0))->result_array();
					//echo "<pre>"; print_r($emi); die;
					if ($emi[0]['emi_paid'] != 0) {
						$EMI = ceil(($amount + $emi[0]['emi_paid']) / $EMI_Amount);
					}
					for ($j = 0; $j < $EMI; $j++) :

						if ($emi[$j]['emi_paid'] != 0) {
							$PaidAmount = $amount + $emi[$j]['emi_paid'];

							if ($j == 0 || $PaidAmount > $EMI_Amount) {
								$PaidAmount = $EMI_Amount;
							} else {
								$PaidAmount = $amount + $emi[$j]['emi_paid'];
							}
							$status = 1;
							$due = $PaidAmount + $emi[$j]['emi_paid'] - $EMI_Amount;
							if ($due < 0) {
								$status = 0;
							}

							$PaidData = array(
								'emi_id' => $emi[$j]['emi_id'],
								'emi_paid' => $PaidAmount,
								'emi_status' => $status,
								'p_paid' => "Yes",
								'emi_payment_date' => date('d-m-Y')
							);
							$this->db->where('emi_id', $emi[$j]['emi_id']);
							$this->db->update('tbl_emi', $PaidData);
							//echo "<pre>"; print_r($PaidData); die;
							$PaidAmount = $amount -= $EMI_Amount - $emi[$j]['emi_paid'];
						}

						if ($emi[$j]['emi_paid'] == 0) {
							$PaidAmount = $amount;
							if ($j == 0 || $PaidAmount > $EMI_Amount) {
								$PaidAmount = $EMI_Amount;
							} else {
								$PaidAmount = $amount;
							}
							$status = 1;
							$due = $PaidAmount - $EMI_Amount;
							if ($due < 0) {
								$status = 0;
							}
							$PaidData = array(
								'emi_id' => $emi[$j]['emi_id'],
								'emi_paid' => $PaidAmount,
								'emi_status' => $status,
								'p_paid' => "Yes",
								'emi_payment_date' => date('d-m-Y')
							);
							$this->db->where('emi_id', $emi[$j]['emi_id']);
							$this->db->update('tbl_emi', $PaidData);
							//echo $emi[$j]['emi_id'];
							//echo "<pre>"; print_r($PaidData); die;
							$PaidAmount = $amount -= $EMI_Amount;
						}
					endfor;
					$timeline = array(
						'timeline_user' => $this->session->userdata('user_name'),
						'timeline_user_role' => $this->session->userdata('user_role'),
						'timeline_client' => $client_id,
						'timeline_message' => 'Customer Payment received and loan account has been closed on ' . date('d M. Y') . ' at ' . date('h:i:s'),
						'timeline_date' => date('d M. Y'),
						'timeline_time' => date('h:i:s')
					);
					$this->db->insert('tbl_timeline', $timeline);

					$this->db->where('id', $loan_id);
					$this->db->set('loan_status', 'Closed');
					$this->db->update('tbl_customers_loan');

					$this->db->where('id', $topup['id']);
					$this->db->delete('tbl_topup');
				}
			}


			redirect(base_url() . 'main/ClientView/' . $client_id, 'refresh');
		}
		if ($atr == 'Suspend') {
			$status = '';
			if ($atr2 == 1) {
				$status = 0;
			}
			if ($atr2 == 0) {
				$status = 1;
			}
			$result = $this->main_model->SuspendClient($atr1, $status);
			if ($result > 0) {
				if ($status > 0) {
					$timeline = array(
						'timeline_user' => $this->session->userdata('user_name'),
						'timeline_user_role' => $this->session->userdata('user_role'),
						'timeline_client' => $atr1,
						'timeline_message' => 'Customer profile activated on ' . date('d M. Y') . ' at ' . date('h:i:s'),
						'timeline_date' => date('d M. Y'),
						'timeline_time' => date('h:i:s')
					);
					$this->db->insert('tbl_timeline', $timeline);
					$this->session->set_flashdata('HeadSuccess_msg', 'Client Activated');
					redirect(base_url() . 'main/customers', 'refresh');
				} else {
					$timeline = array(
						'timeline_user' => $this->session->userdata('user_name'),
						'timeline_user_role' => $this->session->userdata('user_role'),
						'timeline_client' => $atr1,
						'timeline_message' => 'Customer profile suspended on ' . date('d M. Y') . ' at ' . date('h:i:s'),
						'timeline_date' => date('d M. Y'),
						'timeline_time' => date('h:i:s')
					);
					$this->db->insert('tbl_timeline', $timeline);
					$this->session->set_flashdata('HeadSuspend_msg', 'Client Suspended');
					redirect(base_url() . 'main/customers', 'refresh');
				}
			} else {
				$this->session->set_flashdata('HeadError_msg', 'Something Went Wrong Please Try Again..!!');
				redirect(base_url() . 'main/customers', 'refresh');
			}
		}

		if ($atr == 'Delete') {

			$data = $this->db->get_where('tbl_customers', array('client_id' => $atr1))->row_array();
			$data1 = $this->db->get_where('tbl_customers_loan', array('id' => $atr2))->row_array();
			unlink('./uploads/client_photos/' . $data['client_photo']);
			unlink('./uploads/client_aadhar/' . $data['client_aadhar_card']);
			unlink('./uploads/guarantor_photos/' . $data['client_gphoto']);
			unlink('./uploads/application_documents/' . $data1['loan_application']);
			$this->db->where('client_id', $atr1);
			$this->db->delete('tbl_customers');
			$this->session->set_flashdata('HeadSuccess_msg', 'Client Deleted');
			redirect(base_url() . 'main/customers', 'refresh');
		}

		if (isset($_GET['type'])) {
			$type = $_GET['type'];
		}
		$this->load->view('customers', compact('type'));
	}
	// public function getFilteredClient()
	// {
	//      if(empty($this->session->userdata('user_id'))){
	// 	    redirect(base_url());
	// 	 } 


	// 	 $sAgent=$this->input->post('sagent');
	// 	 $status=$this->input->post('status');
	// 	 $account=$this->input->post('account');
	// 	 $name=$this->input->post('name');
	// 	 $mobile=$this->input->post('mobile');
	// 	 $aadhar=$this->input->post('aadhar');
	// 	$loginUserId=$this->input->post('loginUserId');
	// 	if($loginUserId==""){
	// 		$loginUserId = $_GET['loginUserId'];
	// 	}
	// 	$loginUserType=$this->input->post('loginUserType');
	// 	if ($loginUserType == "") {
	// 		$loginUserType = $_GET['loginUserType'];
	// 	}
	//    if(!empty($name))
	//    {
	//        $cust= $this->db->like('client_name', $name)->get('tbl_customers')->row_array();
	//        if($cust>0)
	//        {
	//            $customerID=$cust['client_id'];
	//            if(!empty($customerID))
	//     	   {
	//     	       $this->db->where('customer_id', $customerID);
	//     	   }
	//        }
	//    }

	//    if(!empty($mobile))
	//    {
	//        $cust= $this->db->like('client_mobile', $mobile)->get('tbl_customers')->row_array();
	//        if($cust>0)
	//        {
	//            $customerID=$cust['client_id'];
	//            if(!empty($customerID))
	//     	   {
	//     	       $this->db->where('customer_id', $customerID);
	//     	   }
	//        }
	//    }
	//   // echo $loginUserType; $loginUserId; die;
	//    if(!empty($loginUserId) && $loginUserType=='admin' )
	//    {
	// 	   echo "Test";
	//        $cust= $this->db->where('admin_reporting', $loginUserId)->or_where('client_repoting', $loginUserId)->or_where('client_created', $loginUserId)->get('tbl_customers')->row_array();
	// 		echo "<pre>";
	// 		print_r($cust);
	// 		die;
	// 	   if($cust>0)
	//        {

	//            $customerID=$cust['client_id'];
	//            if(!empty($customerID))
	//     	   {
	//     	       $this->db->where('customer_id', $customerID);
	//     	   }
	//        }
	//    }
	// 	if (!empty($loginUserId) && $loginUserType == 'other') {
	// 		$cust = $this->db->where('client_repoting', $loginUserId)->or_where('client_created', $loginUserId)->get('tbl_customers')->row_array();
	// 		if ($cust > 0) {
	// 			$customerID = $cust['client_id'];
	// 			if (!empty($customerID)) {
	// 				$this->db->where('customer_id', $customerID);
	// 			}
	// 		}
	// 	}
	//    if(!empty($aadhar))
	//    {
	//        $cust= $this->db->like('client_aadhar', $aadhar)->get('tbl_customers')->row_array();
	//        if($cust>0)
	//        {
	//            $customerID=$cust['client_id'];
	//            if(!empty($customerID))
	//     	   {
	//     	       $this->db->where('customer_id', $customerID);
	//     	   }
	//        }
	//    }
	//    if(!empty($sAgent))
	//    {
	//        $this->db->where('application_user', $sAgent);
	//    }
	//     if(!empty($cAgent))
	//    {
	//        $this->db->where('collection_user', $cAgent);
	//    }
	//    if(!empty($status))
	//    {
	//        $this->db->like('loan_status', $status);
	//    }

	//    if(!empty($account))
	//    {
	//        $this->db->like('loan_account', $account);
	//    }

	//    $FilterData= $this->db->order_by('id', 'DESC')->get('tbl_customers_loan')->result_array();

	//     if(!empty($FilterData))
	//     {   $i=0;
	//         $permis=$this->db->get_where('tbl_permissions', array('user'=>$this->session->userdata('user_role')))->row_array();
	//         $permissions=explode(',',$permis['permissions']);
	//         foreach($FilterData as $data):
	//             $i++;
	//             $CustData=$this->db->get_where('tbl_customers', array('client_id'=>$data['customer_id']))->row_array();

	//             $SalesAgent=$this->db->get_where('tbl_users', array('user_id'=>$data['application_user']))->row_array();
	//             echo "<tr>
	//                     <td>".$data['loan_account']."</td>
	//                     <td><a href=".base_url()."main/ClientView/".$data['customer_id'].">".$CustData['client_name']."</a></td>
	//                     <td>".$CustData['client_mobile']."</td>
	//                     <td>".$CustData['client_aadhar']."</td>
	//                     <td>".$CustData['client_occupation']."</td>
	//                     <td>&#x20B9; ".$CustData['client_income']."</td>
	//                     <td>&#x20B9; ".$data['loan_amount']."</td>
	//                     <td>".$data['loan_duration']." ".$data['duration_unit']."</td>
	//                     <td>".$data['application_date']."</td>
	//                     <td>".$SalesAgent['user_name']."</td>
	//                     <td><label class='label label-info'>". $data['loan_status']."</label></td>
	//                     <td>";
	//                     if(in_array('editCustomer', $permissions)){
	//                         echo "<a href=".base_url()."main/ClientEdit/".$data['customer_id']."/".$data['id']."><button  class='btn-primary'><i class='fa fa-pencil'></i></button></a>";
	//                     }
	//                     if(in_array('blockCustomer', $permissions)){
	//                         if($CustData['client_status']>0){
	//                           echo "<a href=".base_url()."main/customers/Suspend/".$data['customer_id']."/".$CustData['client_status']."><button  class='btn-warning'><i class='fa fa-ban'></i></button></a>";  
	//                         }
	//                         else {
	//                             echo "<a href=".base_url()."main/customers/Suspend/".$data['customer_id']."/".$CustData['client_status']."><button  class='btn-success'><i class='fa fa-check'></i></button></a>";  
	//                         }
	//                     }
	//                     if(in_array('deleteCustomer', $permissions)){
	//                         echo "<a href=".base_url()."main/customers/Delete/".$data['customer_id']."/".$data['id']."><button  class='btn-danger'><i class='fa fa-trash'></i></button></a>"; 
	//                     }
	//                     echo "</td>
	//                   </tr>
	//                   ";
	//         endforeach;
	//        echo "<tr>
	//        <th colspan='2'>Total Applications:</th>
	//        <th colspan='10'>".$i."</th>
	//        </tr>";

	//     }
	//     else
	//     {
	//         echo"<tr><td colspan='12' style='color:red'><center>Data Not Available</center></td></tr>";
	//     }

	// }
	public function getFilteredClient()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$this->load->model('main_model', 'main');

		$sAgent = $this->input->post('sagent');
		$status = $this->input->post('status');
		$account = $this->input->post('account');
		$name = $this->input->post('name');
		$mobile = $this->input->post('mobile');
		$aadhar = $this->input->post('aadhar');
		$cagent = $this->input->post('cagent');
		$start = $this->input->get('start');
		$end = $this->input->get('end');
		$loginUserId = $this->input->post('loginUserId');
		if ($loginUserId == "") {
			$loginUserId = $_GET['loginUserId'];
		}
		$loginUserType = $this->input->post('loginUserType');
		if ($loginUserType == "") {
			$loginUserType = $_GET['loginUserType'];
		}
		$searchData['sagent']  = $sAgent;
		$searchData['status']         = $status;
		$searchData['account']       = $account;
		$searchData['name']       = $name;
		$searchData['mobile']   = $mobile;
		$searchData['aadhar'] = $aadhar;
		$searchData['cagent'] = $cagent;
		$searchData['loginUserId']        = $loginUserId;
		$searchData['loginUserType']        = $loginUserType;
		$searchData['start']        = $start;
		$searchData['end']        = $end;
		// echo "<pre>";
		// print_r($searchData);
		// die;
		$reported_user = array();
		//if($loginUserType=='admin'){
		$reported_user =  $this->main->repot_user_list_array($loginUserId);

		$FilterData                  = $this->main->getAllRecords($searchData, $reported_user);
		if (!empty($FilterData)) {
			$i = 0;
			$permis = $this->db->get_where('tbl_permissions', array('user' => $this->session->userdata('user_role')))->row_array();
			$permissions = explode(',', $permis['permissions']);
			foreach ($FilterData as $data) :
				$i++;
				$CustData = $this->db->get_where('tbl_customers', array('client_id' => $data['customer_id']))->row_array();

				$SalesAgent = $this->db->get_where('tbl_users', array('user_id' => $data['application_user']))->row_array();
				$collection_user = $this->db->get_where('tbl_users', array('user_id' => $data['collection_user']))->row_array();
				//	echo "<pre>"; print_r($data); die;
				if ($data['loan_status'] == "Submitted") {
					$l_status = "Application Submitted";
				} else if ($data['loan_status'] == "Disbursed") {
					$l_status = "Application Disbursed";
				} else if ($data['loan_status'] == "Approved") {
					$l_status = "Application Approved";
				} else if ($data['loan_status'] == "Pending") {
					$l_status = "Application Pending";
				} else if ($data['loan_status'] == "Rejected") {
					$l_status = "Application Rejected";
				} else if ($data['loan_status'] == "Closed") {
					$l_status = "Closed";
				} else if ($data['loan_status'] == "Loan Topup") {
					$l_status = "Loan Topup";
				}
				echo "<tr>
	                    <td>" . $data['loan_account'] . "</td>
	                    <td><a href=" . base_url() . "main/ClientView/" . $data['customer_id'] . ">" . $CustData['client_name'] . "</a></td>
	                    <td>" . $CustData['client_mobile'] . "</td>
	                    <td>" . $CustData['client_aadhar'] . "</td>
	                    <td>" . $CustData['client_occupation'] . "</td>
	                    <td>&#x20B9; " . $CustData['client_income'] . "</td>
	                    <td>&#x20B9; " . $data['loan_amount'] . "</td>
	                    <td>&#x20B9; " . ($data['loan_amount'] - (($data['interest_rate']*$data['loan_amount'])/100)) . "</td>
	                    <td>&#x20B9; " . (($data['interest_rate']*$data['loan_amount'])/100) . "</td>
	                    <td>" . $data['loan_duration'] . " " . $data['duration_unit'] . "</td>
	                    <td>" . $data['application_date'] . "</td>
	                    <td>" . $SalesAgent['user_name'] . "</td>
	                    <td>" . $collection_user['user_name'] . "</td>
	                    <td><label class='label label-info'>" . $l_status . "</label></td>
	                    <td><label class='label label-info'>" . $l_status . "</label></td>
	                    <td>";
				if (in_array('editCustomer', $permissions)) {
					echo "<a href=" . base_url() . "main/ClientEdit/" . $data['customer_id'] . "/" . $data['id'] . "><button  class='btn-primary'><i class='fa fa-pencil'></i></button></a>";
				}
				if (in_array('blockCustomer', $permissions)) {
					if ($CustData['client_status'] > 0) {
						echo "<a href=" . base_url() . "main/customers/Suspend/" . $data['customer_id'] . "/" . $CustData['client_status'] . "><button  class='btn-warning'><i class='fa fa-ban'></i></button></a>";
					} else {
						echo "<a href=" . base_url() . "main/customers/Suspend/" . $data['customer_id'] . "/" . $CustData['client_status'] . "><button  class='btn-success'><i class='fa fa-check'></i></button></a>";
					}
				}
				if (in_array('deleteCustomer', $permissions)) {
					echo "<a href=" . base_url() . "main/customers/Delete/" . $data['customer_id'] . "/" . $data['id'] . "><button  class='btn-danger'><i class='fa fa-trash'></i></button></a>";
				}
				echo "</td>


	                  </tr>
	                  ";
			endforeach;
			echo "<tr>
	       <th colspan='2'>Total Applications:</th>
	       <th colspan='10'>" . $i . "</th>
	       </tr>";
		} else {
			echo "<tr><td colspan='12' style='color:red'><center>Data Not Available</center></td></tr>";
		}
	}
	public function verifyMobile()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}


		$data = $this->db->get_where('tbl_customers', array('client_mobile' => $this->input->post('mobile')))->num_rows();
		echo $data;
	}
	public function verifyAadhar()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}


		$data = $this->db->get_where('tbl_customers', array('client_aadhar' => $this->input->post('aadhar')))->num_rows();
		echo $data;
	}
	public function NewClient($atr = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		if ($atr == 'SaveData') {
			$last_loan = $this->db->order_by('id', 'DESC')->get('tbl_customers_loan')->row_array();
			if ($last_loan > 0) {
				$loan_no = 'YM00' . ($last_loan['id'] + 1);
			} else {
				$loan_no = 'YM001';
			}


			$photo = $_FILES['photo'];
			if (!empty($photo['name'])) {
				$config['upload_path'] = './uploads/client_photos/';
				$config['allowed_types'] = 'jpg|png|jpeg|bmp';
				$config['file_name'] = $loan_no . '_' . $photo['name'];
				$this->upload->initialize($config);
				$this->upload->do_upload('photo');
				$photo = $this->upload->data('file_name');
			}
			$aadhar_card = $_FILES['aadhar_card'];
			if (!empty($aadhar_card['name'])) {
				$config['upload_path'] = './uploads/client_aadhar/';
				$config['allowed_types'] = 'jpg|png|jpeg|pdf';
				$config['file_name'] = $loan_no . '_' . $aadhar_card['name'];
				$this->upload->initialize($config);
				$this->upload->do_upload('aadhar_card');
				$aadhar = $this->upload->data('file_name');
			}
			$guarantor_photo = $_FILES['gphoto'];
			if (!empty($guarantor_photo['name'])) {
				$config['upload_path'] = './uploads/guarantor_photos/';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['file_name'] = $loan_no . '_' . $guarantor_photo['name'];
				$this->upload->initialize($config);
				$this->upload->do_upload('gphoto');
				$gphoto = $this->upload->data('file_name');
			}
			$application_doc = $_FILES['app_doc'];
			if (!empty($application_doc['name'])) {
				$config['upload_path'] = './uploads/application_documents/';
				$config['allowed_types'] = 'pdf';
				$config['file_name'] = $loan_no . '_' . $application_doc['name'];
				$this->upload->initialize($config);
				$this->upload->do_upload('app_doc');
				$app_doc = $this->upload->data('file_name');
			}
			$userBranch = $this->db->get_where('tbl_users', array('user_id' => $this->input->post('user')))->row_array();
			$data = array(
				'client_name' => $this->input->post('name'),
				'client_father' => $this->input->post('father'),
				'client_mother' => $this->input->post('mother'),
				'client_dob' => $this->input->post('dob'),
				'client_gender' => $this->input->post('gender'),
				'client_email' => $this->input->post('email'),
				'client_mobile' => $this->input->post('mobile'),
				'client_aadhar' => $this->input->post('aadhar'),
				'client_occupation' => $this->input->post('occupation'),
				'client_current_address' => $this->input->post('caddress'),
				'client_cpincode' => $this->input->post('cpincode'),
				'client_permanent_address' => $this->input->post('paddress'),
				'client_ppincode' => $this->input->post('ppincode'),
				'client_income' => $this->input->post('income'),
				'client_guarantor' => $this->input->post('guarentor'),
				'client_gmobile' => $this->input->post('gmobile'),
				'client_gaddress' => $this->input->post('gaddress'),
				'client_gpincode' => $this->input->post('gpincode'),
				'client_photo' => $photo,
				'client_aadhar_card' => $aadhar,
				'client_gphoto' => $gphoto,
				'client_status' => '1',
				'client_user' => $this->input->post('user'),
				'client_branch' => $userBranch['user_branch'],
				'client_created' => $this->session->userdata('user_id'),
				'client_date' => date('d-m-Y h:i:s'),
				'client_repoting' => $this->session->userdata('user_reporting'),
				'add_date' => date('Y-m-d'),
			);

			$result = $this->main_model->AddClient($data);
			if ($result > 0) {
				$data1 = array(
					'customer_id' => $result,
					'file_no' => $loan_no,
					'loan_account' => $loan_no,
					'loan_application' => $app_doc,
					'loan_amount' => $this->input->post('amount'),
					'loan_duration' => $this->input->post('duration'),
					'duration_unit' => $this->input->post('unit'),
					'penalty' => $this->input->post('penalty'),
					'processing_fee' => $this->input->post('fee'),
					'interest_rate' => $this->input->post('interest'),
					'repayment_amount' => $this->input->post('repay'),
					'disbursed_amount' => $this->input->post('damount'),
					'emi_amount' => $this->input->post('emi'),
					'emi_start_date' => $this->input->post('emistart'),
					'loan_status' => 'Pending',
					'application_remark' => $this->input->post('remark'),
					'application_date' => date('d-m-Y h:i:s'),
					'add_date' => date('Y-m-d'),
					'disbursed_date' => date('d-m-Y', strtotime($this->input->post('disbursed_date'))),
					'application_user' => $this->input->post('user'),
					'created_by' => $this->session->userdata('user_id'),

				);

				$this->db->insert('tbl_customers_loan', $data1);

				$timeline = array(
					'timeline_user' => $this->session->userdata('user_name'),
					'timeline_user_role' => $this->session->userdata('user_role'),
					'timeline_client' => $result,
					'timeline_message' => 'Customer profile created on ' . date('d M. Y') . ' at ' . date('h:i:s'),
					'timeline_date' => date('d M. Y'),
					'timeline_time' => date('h:i:s')
				);
				$this->db->insert('tbl_timeline', $timeline);
				$this->session->set_flashdata('ClientSuccess_msg', 'Client Data Saved Successfully');
				redirect(base_url() . 'main/ClientView/' . $result, 'refresh');
			} else {
				$this->session->set_flashdata('ClientError_msg', 'Something Went Wrong, Please Try again..!!');
				redirect(base_url() . 'main/NewClient', 'refresh');
			}
		}
		$this->load->view('new_client');
	}

	public function ClientView($atr = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$output = array();
		$Client = $this->db->get_where('tbl_customers', array('client_id' => $atr))->row_array();
		//$reported_user=$this->report_user();
		//$output['Client'] = $Client;
		//$output['reported_user'] = $reported_user;
		$this->load->view('view_client', $Client);
	}
	public function timeline($atr = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}

		$timeline['message'] = $this->main_model->GetTimeline($atr);
		$this->load->view('timeline', $timeline);
	}
	public function ClientEdit($param = '', $param1 = '', $param2 = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}

		if ($param2 == 'UpdateData') {
			$clientData = $this->db->get_where('tbl_customers', array('client_id' => $param))->row_array();
			$LoanData = $this->db->get_where('tbl_customers_loan', array('id' => $param1))->row_array();

			$photo = $_FILES['photo'];
			if (!empty($photo['name'])) {
				unlink('./uploads/client_photos/' . $clientData['client_photo']);
				$config['upload_path'] = './uploads/client_photos/';
				$config['allowed_types'] = 'jpg|png|jpeg|bmp';
				$config['file_name'] = $LoanData['loan_account'] . '_' . $photo['name'];
				$this->upload->initialize($config);
				$this->upload->do_upload('photo');
				$cphoto = $this->upload->data('file_name');
			}
			if (empty($photo['name'])) {
				$cphoto = $clientData['client_photo'];
			}
			$aadhar_card = $_FILES['aadhar_card'];
			if (!empty($aadhar_card['name'])) {
				unlink('./uploads/client_aadhar/' . $clientData['client_aadhar_card']);
				$config['upload_path'] = './uploads/client_aadhar/';
				$config['allowed_types'] = 'jpg|png|jpeg|pdf';
				$config['file_name'] = $LoanData['loan_account'] . '_' . $aadhar_card['name'];
				$this->upload->initialize($config);
				$this->upload->do_upload('aadhar_card');
				$aadhar = $this->upload->data('file_name');
			}
			if (empty($aadhar_card['name'])) {
				$aadhar = $clientData['client_aadhar_card'];
			}
			$guarantor_photo = $_FILES['gphoto'];
			if (!empty($guarantor_photo['name'])) {
				unlink('./uploads/guarantor_photos/' . $clientData['client_gphoto']);
				$config['upload_path'] = './uploads/guarantor_photos/';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['file_name'] = $LoanData['loan_account'] . '_' . $guarantor_photo['name'];
				$this->upload->initialize($config);
				$this->upload->do_upload('gphoto');
				$gphoto = $this->upload->data('file_name');
			}
			if (empty($guarantor_photo['name'])) {
				$gphoto = $clientData['client_gphoto'];
			}
			$application_doc = $_FILES['app_doc'];
			if (!empty($application_doc['name'])) {
				$config['upload_path'] = './uploads/application_documents/';
				$config['allowed_types'] = 'pdf';
				$config['file_name'] = $LoanData['loan_account'] . '_' . $application_doc['name'];
				$this->upload->initialize($config);
				$this->upload->do_upload('app_doc');
				$app_doc = $this->upload->data('file_name');
			}
			if (empty($application_doc['name'])) {
				$app_doc = $LoanData['loan_application'];
			}
			$userBranch = $this->db->get_where('tbl_users', array('user_id' => $this->input->post('user')))->row_array();
			$data = array(
				'client_name' => $this->input->post('name'),
				'client_father' => $this->input->post('father'),
				'client_mother' => $this->input->post('mother'),
				'client_dob' => $this->input->post('dob'),
				'client_gender' => $this->input->post('gender'),
				'client_email' => $this->input->post('email'),
				'client_mobile' => $this->input->post('mobile'),
				'client_aadhar' => $this->input->post('aadhar'),
				'client_occupation' => $this->input->post('occupation'),
				'client_current_address' => $this->input->post('caddress'),
				'client_cpincode' => $this->input->post('cpincode'),
				'client_permanent_address' => $this->input->post('paddress'),
				'client_ppincode' => $this->input->post('ppincode'),
				'client_income' => $this->input->post('income'),
				'client_guarantor' => $this->input->post('guarentor'),
				'client_gmobile' => $this->input->post('gmobile'),
				'client_gaddress' => $this->input->post('gaddress'),
				'client_gpincode' => $this->input->post('gpincode'),
				'client_photo' => $cphoto,
				'client_aadhar_card' => $aadhar,
				'client_gphoto' => $gphoto,
				'client_status' => '1',
				'client_user' => $this->input->post('user'),
				'client_branch' => $userBranch['user_branch'],
				'client_created' => $this->session->userdata('user_id'),
				'client_date' => date('d-m-Y h:i:s')
			);

			$result = $this->main_model->UpdateClient($param, $data);
			if ($result > 0) {
				$data1 = array(
					'loan_application' => $app_doc,
					'loan_amount' => $this->input->post('amount'),
					'loan_duration' => $this->input->post('duration'),
					'duration_unit' => $this->input->post('unit'),
					'penalty' => $this->input->post('penalty'),
					'processing_fee' => $this->input->post('fee'),
					'interest_rate' => $this->input->post('interest'),
					'repayment_amount' => $this->input->post('repay'),
					'emi_amount' => $this->input->post('emi'),
					'disbursed_amount' => $this->input->post('damount'),
					'emi_start_date' => $this->input->post('emistart'),
					'loan_status' => 'Pending',
					'application_remark' => $this->input->post('remark'),
					'application_date' => date('d-m-Y h:i:s'),
					'application_user' => $this->input->post('user'),
					'created_by' => $this->session->userdata('user_id')
				);

				$this->db->where('id', $param1);
				$this->db->update('tbl_customers_loan', $data1);

				$timeline = array(
					'timeline_user' => $this->session->userdata('user_name'),
					'timeline_user_role' => $this->session->userdata('user_role'),
					'timeline_client' => $result,
					'timeline_message' => 'Customer profile updated on ' . date('d M. Y') . ' at ' . date('h:i:s'),
					'timeline_date' => date('d M. Y'),
					'timeline_time' => date('h:i:s')
				);
				$this->db->insert('tbl_timeline', $timeline);
				$this->session->set_flashdata('ClientSuccess_msg', 'Client Data Updated Successfully');
				redirect(base_url() . 'main/ClientEdit/' . $result . '/' . $param1, 'refresh');
			} else {
				$this->session->set_flashdata('ClientError_msg', 'Something Went Wrong, Please Try again..!!');
				redirect(base_url() . 'main/NewClient', 'refresh');
			}
		}

		$client = $this->db->get_where('tbl_customers', array('client_id' => $param))->row_array();
		$LoanData = $this->db->get_where('tbl_customers_loan', array('id' => $param1))->row_array();
		$this->load->view('ClientEdit', array_merge($client, $LoanData));
	}
	public function dailyPayments()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$agent_id = "";
		$mobile = "";
		$client_name = "";
		if (isset($_GET['agent_id'])) {
			$agent_id = $_GET['agent_id'];
		}
		if (isset($_GET['mobile'])) {
			$mobile = $_GET['mobile'];
		}
		if (isset($_GET['client_name'])) {
			$client_name = $_GET['client_name'];
		}
		if (isset($_GET['file_number'])) {
			$file_number = $_GET['file_number'];
		} else {
			$file_number = "";
		}
		$this->load->view('dailyPayments', compact('agent_id', 'mobile', 'client_name', 'file_number'));
	}
	public function getCustomers()
	{

		if (isset($_POST['file_number']) && !empty($_POST['file_number'])) {
			$sql = "SELECT `tbl_customers_loan`.*, `tbl_emi`.* FROM `tbl_customers_loan` JOIN `tbl_emi` ON `tbl_emi`.`emi_client` = `tbl_customers_loan`.`customer_id`  JOIN `tbl_customers` ON `tbl_emi`.`emi_client` = `tbl_customers`.`client_id` WHERE `tbl_customers_loan`.`loan_status` = 'Disbursed' AND `tbl_customers_loan`.`file_no` = '" . $_POST['file_number'] . "' AND `tbl_emi`.`emi_status` = '0'  GROUP BY tbl_emi.emi_loan limit 1";
			$Clients = $this->db->query($sql)->result_array();
		} else {
			if ($_POST['agent_id'] != "" && $_POST['client_mobile'] != "") {

				// echo "<pre>"; print_r($_POST); 
				//	$Clients=$this->db->get_where('tbl_customers_loan', array('collection_user'=>$_POST['agent_id'], 'loan_status'=>'Disbursed'))->result_array();
				// $sql="SELECT `tbl_customers_loan`.*, `tbl_emi`.* FROM `tbl_customers_loan` JOIN `tbl_emi` ON `tbl_emi`.`emi_client` = `tbl_customers_loan`.`customer_id` WHERE `tbl_emi`.`emi_date` = '".$_POST['date']."' AND `tbl_customers_loan`.`loan_status` = 'Disbursed' AND `tbl_customers_loan`.`collection_user` = '".$_POST['agent_id']."' AND `tbl_emi`.`emi_status` = '0'";
				$sql = "SELECT `tbl_customers_loan`.*, `tbl_emi`.* FROM `tbl_customers_loan` JOIN `tbl_emi` ON `tbl_emi`.`emi_client` = `tbl_customers_loan`.`customer_id`  JOIN `tbl_customers` ON `tbl_emi`.`emi_client` = `tbl_customers`.`client_id` WHERE `tbl_customers_loan`.`loan_status` = 'Disbursed' AND `tbl_customers_loan`.`collection_user` = '" . $_POST['agent_id'] . "' AND `tbl_emi`.`emi_status` = '0' AND `tbl_customers`.`client_mobile` = '" . $_POST['client_mobile'] . "' GROUP BY tbl_emi.emi_loan limit 1";
				$Clients = $this->db->query($sql)->result_array();
				//echo $this->db->last_query();
				// $this->db->select('tbl_customers_loan.*,tbl_emi.*')
				// ->from('tbl_customers_loan')
				// ->join('tbl_emi', 'tbl_emi.emi_client = tbl_customers_loan.customer_id')
				// ->where('tbl_emi.emi_date',$_POST['date'])
				// ->where('tbl_customers_loan.loan_status','Disbursed');
				// $Clients = $this->db->get();
				// echo $this->db->last_query();
				//$Clients->result_array();
			} else if ($_POST['agent_id'] != "") {
				// echo "<pre>"; print_r($_POST); 
				//	$Clients=$this->db->get_where('tbl_customers_loan', array('collection_user'=>$_POST['agent_id'], 'loan_status'=>'Disbursed'))->result_array();
				// $sql="SELECT `tbl_customers_loan`.*, `tbl_emi`.* FROM `tbl_customers_loan` JOIN `tbl_emi` ON `tbl_emi`.`emi_client` = `tbl_customers_loan`.`customer_id` WHERE `tbl_emi`.`emi_date` = '".$_POST['date']."' AND `tbl_customers_loan`.`loan_status` = 'Disbursed' AND `tbl_customers_loan`.`collection_user` = '".$_POST['agent_id']."' AND `tbl_emi`.`emi_status` = '0'";
				$sql = "SELECT `tbl_customers_loan`.*, `tbl_emi`.* FROM `tbl_customers_loan` JOIN `tbl_emi` ON `tbl_emi`.`emi_client` = `tbl_customers_loan`.`customer_id` WHERE `tbl_customers_loan`.`loan_status` = 'Disbursed' AND `tbl_customers_loan`.`collection_user` = '" . $_POST['agent_id'] . "' AND `tbl_emi`.`emi_status` = '0' GROUP BY tbl_emi.emi_loan";
				$Clients = $this->db->query($sql)->result_array();
				//echo $this->db->last_query();
				// $this->db->select('tbl_customers_loan.*,tbl_emi.*')
				// ->from('tbl_customers_loan')
				// ->join('tbl_emi', 'tbl_emi.emi_client = tbl_customers_loan.customer_id')
				// ->where('tbl_emi.emi_date',$_POST['date'])
				// ->where('tbl_customers_loan.loan_status','Disbursed');
				// $Clients = $this->db->get();
				// echo $this->db->last_query();
				//$Clients->result_array();
			} else if ($_POST['client_mobile'] != "") {
				$sql = "SELECT `tbl_customers_loan`.*, `tbl_emi`.* FROM `tbl_customers_loan` JOIN `tbl_emi` ON `tbl_emi`.`emi_client` = `tbl_customers_loan`.`customer_id` JOIN `tbl_customers` ON `tbl_emi`.`emi_client` = `tbl_customers`.`client_id` WHERE `tbl_customers_loan`.`loan_status` = 'Disbursed' AND `tbl_customers`.`client_mobile` = '" . $_POST['client_mobile'] . "' AND `tbl_emi`.`emi_status` = '0' GROUP BY tbl_emi.emi_loan";
				$Clients = $this->db->query($sql)->result_array();
			} else if ($_POST['client_name'] != "") {
				$sql = "SELECT `tbl_customers_loan`.*, `tbl_emi`.* FROM `tbl_customers_loan` JOIN `tbl_emi` ON `tbl_emi`.`emi_client` = `tbl_customers_loan`.`customer_id`  JOIN `tbl_customers` ON `tbl_emi`.`emi_client` = `tbl_customers`.`client_id` WHERE `tbl_customers_loan`.`loan_status` = 'Disbursed' AND `tbl_customers`.`client_name` = '" . $_POST['client_name'] . "' AND `tbl_emi`.`emi_status` = '0' GROUP BY tbl_emi.emi_loan";
				$Clients = $this->db->query($sql)->result_array();
			} else {
				//$Clients=$this->db->get_where('tbl_customers_loan', array('loan_status'=>'Disbursed'))->result_array();
				$sql = "SELECT `tbl_customers_loan`.*, `tbl_emi`.* FROM `tbl_customers_loan` JOIN `tbl_emi` ON `tbl_emi`.`emi_client` = `tbl_customers_loan`.`customer_id` WHERE `tbl_customers_loan`.`loan_status` = 'Disbursed' AND `tbl_emi`.`emi_status` = '0' GROUP BY tbl_emi.emi_loan";
				$Clients = $this->db->query($sql)->result_array();
			}
		}
		$i = 0;
		$loan_array = array();
		if (!empty($Clients)) {
			foreach ($Clients as $client) :
				//echo "<pre>"; echo "<pre>"; print_r($client);
				$loan_array[] = $client['customer_id'];


				$emiDate = strtotime($client['emi_date']);
				$currentDate = strtotime($_POST['date']);
				if ($emiDate <= $currentDate) {

					$ddate = $this->getEmiData($client['customer_id'], $client['id'], $_POST['date']);
					$customer = $this->db->get_where('tbl_customers', array('client_id' => $client['customer_id']))->row_array();
					$i++;
					$dueEMI = $this->getDueEMI($client['customer_id'], $client['id'], $_POST['date']);
					$advanceDueEMI = $this->advanceDueEMI($client['customer_id'], $client['id'], $_POST['date']);
					$advanceDueEMIPaid = $this->advanceDueEMIPaid($client['customer_id'], $client['id'], $_POST['date']);
					$todayEmi = $this->todayEmi($client['customer_id'], $client['id'], $_POST['date']);
					$totalPenalty = $this->totalPenalty($client['customer_id'], $client['id']);
					$paidPenalty = $this->paidPenalty($client['customer_id'], $client['id']);
					$client_view = base_url() . 'main/ClientView/' . $client['customer_id'];
					$temi = 0;
					if ($dueEMI == 0) {
						$temi = 0;
					} else {
						$temi = ($client["emi_amount"] + $dueEMI);
					}
					$semi = 0;

					$semi = $client["emi_amount"] - ($todayEmi + $advanceDueEMIPaid);
					if ($semi > 0) {
						$semi = $semi;
					} else {
						$semi = 0;
					}
					$p = $totalPenalty - $paidPenalty;
					if ($semi > 0 || $p > 0) {
						echo ' <tr>
					<input type="hidden" name="client_id[]" value="' . $client['customer_id'] . '"/>
					<input type="hidden" name="loan_id[]" value="' . $client['id'] . '"/>
					<input type="hidden" name="emi[]" value="' . $client['emi_amount'] . '"/>
					  <td>' . $i . '.</td>
					  <td><a href="' . $client_view . '">' . $client['loan_account'] . '</a></td>
                      <td><a href="' . $client_view . '">' . $customer["client_name"] . '</a></td>                    
                      <td>' . $customer["client_guarantor"] . '</td> 
                      <td>' . $client['disbursed_date'] . '</td>
                      <td>&#x20B9; ' . $client["loan_amount"] . '</td>
                      <td>&#x20B9; ' . $semi . '</td>
                      <td>&#x20B9; ' . $dueEMI . '</td>
                      <td>&#x20B9; ' . $temi . '</td>
                      <td>&#x20B9; ' . $advanceDueEMI . '</td>
                      <td>&#x20B9; ' . ($totalPenalty - $paidPenalty) . '</td>     
                      

                      <td><input type="text" name="amount[]" placeholder="Today Payment" class="form-control"></td>
                    </tr>';
					} else {
						echo '<tr>
			<td colspan="11"><center style="color:red">No Amount Due</center></td>
			</tr>';
					}
				}
			endforeach;
		} else {
			echo '<tr>
			<td colspan="11"><center style="color:red">Customers are not available for selected collection agent</center></td>
			</tr>';
		}
	}
	public function getCustomerPayments($atr)
	{
		$payments = $this->db->get_where('tbl_payments', array('pay_client' => $atr))->result_array();
		$paid = 0;
		foreach ($payments as $payment) :
			$paid += $payment['pay_amount'];
		endforeach;
		return $paid;
	}
	public function getDueEMI($atr, $atr1, $date)
	{
		$DueEMI = $this->db->get_where('tbl_emi', array('emi_client' => $atr, 'emi_loan' => $atr1))->result_array();
		// echo $this->db->last_query(); 
		$DueAmount = 0;
		$paidEmi = 0;
		foreach ($DueEMI as $Due) :
			$emiDate = strtotime($Due['emi_date']);
			$currentDate = strtotime($date);
			if ($emiDate < $currentDate) {
				$DueAmount += $Due['emi_amount'];
				$paidEmi += $Due['emi_paid'];
			}
		endforeach;
		return $DueAmount - $paidEmi;
	}
	public function advanceDueEMI($atr, $atr1, $date)
	{
		$DueEMI = $this->db->get_where('tbl_emi', array('emi_client' => $atr, 'emi_loan' => $atr1))->result_array();
		// echo $this->db->last_query(); 
		$DueAmount = 0;
		$paidEmi = 0;
		foreach ($DueEMI as $Due) :
			$emiDate = strtotime($Due['emi_date']);
			$currentDate = strtotime($date);
			if ($emiDate > $currentDate) {
				//$DueAmount+=$Due['emi_amount'];
				$paidEmi += $Due['emi_paid'];
			}
		endforeach;
		return $paidEmi;
	}
	public function advanceDueEMIPaid($atr, $atr1, $date)
	{
		$DueEMI = $this->db->get_where('tbl_emi', array('emi_client' => $atr, 'emi_loan' => $atr1, 'emi_status' => 1))->result_array();
		//echo $this->db->last_query(); 
		$DueAmount = 0;
		$paidEmi = 0;
		foreach ($DueEMI as $Due) :
			$emiDate = strtotime($Due['emi_date']);
			$currentDate = strtotime($date);
			if ($emiDate >= $currentDate) {
				//$DueAmount+=$Due['emi_amount'];
				$paidEmi += $Due['emi_paid'];
			}
		endforeach;
		return $paidEmi;
	}
	public function todayEmi($atr, $atr1, $date)
	{
		$DueEMI = $this->db->get_where('tbl_emi', array('emi_client' => $atr, 'emi_loan' => $atr1, 'emi_date' => $date, 'emi_status' => 0))->result_array();
		// echo $this->db->last_query(); 
		$DueAmount = 0;
		$paidEmi = 0;
		foreach ($DueEMI as $Due) :
			$emiDate = strtotime($Due['emi_date']);
			$currentDate = strtotime($date);
			if ($emiDate == $currentDate) {
				//$DueAmount+=$Due['emi_amount'];
				$paidEmi += $Due['emi_paid'];
			}
		endforeach;
		return $paidEmi;
	}
	public function getDueEMIDas($atr, $atr1)
	{
		$DueEMI = $this->db->get_where('tbl_emi', array('emi_client' => $atr, 'emi_loan' => $atr1))->result_array();
		//echo $this->db->last_query(); 
		$DueAmount = 0;
		$paidEmi = 0;
		foreach ($DueEMI as $Due) :
			$emiDate = strtotime($Due['emi_date']);
			$currentDate = strtotime(date('d-m-Y'));
			if ($emiDate <= $currentDate) {
				$DueAmount += $Due['emi_amount'];
				$paidEmi += $Due['emi_paid'];
			}
		endforeach;
		return $DueAmount - $paidEmi;
	}

	public function getDueEMITillDate()
	{
		if ($this->session->userdata('user_type') == "super_admin") {
			//$disbursed = $this->db->get_where('tbl_customers_loan', array('loan_status=' => 'Disbursed'))->result_array();
			$this->db->select('*');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

			//$this->db->where('tbl_customers_loan.loan_status=', 'Disbursed');
			//$this->db->where_in('tbl_customers_loan.application_user', $reported_user);
			$query  = $this->db->get('tbl_customers');
			$Clients = $query->result_array();
		} else {

			$loginUserId = $this->session->userdata('user_id');
			$reported_user =  $this->main->repot_user_list_array($loginUserId);

			$this->db->select('*');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

			//$this->db->where('tbl_customers_loan.loan_status=', 'Disbursed');
			$this->db->where_in('tbl_customers_loan.application_user', $reported_user);
			$query  = $this->db->get('tbl_customers');
			$Clients = $query->result_array();
		}


		$i = 0;
		$dueEMI = 0;
		if (!empty($Clients)) {
			foreach ($Clients as $client) :
				//echo "<pre>"; print_r($client);
				if ($client['loan_status'] == "Disbursed" || $client['loan_status'] == "Loan Topup") {
					$dueEMI += $this->getDueEMIDas($client['customer_id'], $client['id']);
					//echo "<pre>"; print_r($dueEMI);
				}
			endforeach;
		}
		return $dueEMI;
	}
	public function getEmiData($atr, $atr1, $date)
	{
		$DueEMI = $this->db->get_where('tbl_emi', array('emi_client' => $atr, 'emi_loan' => $atr1, 'emi_date' => $date))->row();
		//echo "<pre>"; print_r($DueEMI);
		return $DueEMI->emi_date;
	}
	public function savePayments()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		//echo "<pre>"; print_r($_POST); die;
		if ($_POST['optradio'] == "cash") {
			$date = $this->input->post('date');
			$agent = $this->input->post('agent');
			$client = $this->input->post('client_id');
			$loan_id = $this->input->post('loan_id');
			$amount = $this->input->post('amount');
			$EmiAmount = $this->input->post('emi');

			foreach ($client as $key => $value) :
				if (!empty($amount[$key])) {
					$EMI_Amount = $EmiAmount[$key];
					$data = array(
						'pay_client' => $value,
						'pay_loan' => $loan_id[$key],
						'pay_agent' => $agent,
						'pay_amount' => $amount[$key],
						'pay_date' => $date,
						'add_date' => date("Y-m-d"),
						'pay_update_by' => $this->session->userdata('user_id'),
						'source_id' => 0,
						'by_collection' => 1

					);
					$this->db->insert('tbl_payments', $data);

					$cashEntry = array(
						'emp_id' => $this->session->userdata('user_id'),
						'method' => 'CASH',
						'cash_debit' => 0,
						'cash_credit' => $amount[$key],
						'receiving_from' => $agent,
						'received_by' => $this->session->userdata('user_id'),
						'receiving_status' => 1,
						'remark' => 'Cash Received from Customer Daily Payment',
						'date' => date('d-m-Y')
					);
					$this->db->insert('tbl_cashbook', $cashEntry);

					$EMI = ceil($amount[$key] / $EMI_Amount);
					$emi = $this->db->get_where('tbl_emi', array('emi_client' => $value, 'emi_loan' => $loan_id[$key], 'emi_status' => 0))->result_array();
					if ($emi[0]['emi_paid'] != 0) {
						$EMI = ceil(($amount[$key] + $emi[0]['emi_paid']) / $EMI_Amount);
					}
					for ($j = 0; $j < $EMI; $j++) :

						if ($emi[$j]['emi_paid'] != 0) {	//echo "d";
							$PaidAmount = $amount[$key] + $emi[$j]['emi_paid'];

							if ($PaidAmount > $EMI_Amount) {
								$PaidAmount = $EMI_Amount;
							} else {
								$PaidAmount = $amount[$key] + $emi[$j]['emi_paid'];
							}
							//  die;
							$status = 1;
							$due = $PaidAmount + $emi[$j]['emi_paid'] - $EMI_Amount;
							if ($due < 0) {
								$status = 0;
							}

							$PaidData = array(
								'emi_id' => $emi[$j]['emi_id'],
								'emi_paid' => $PaidAmount,
								//'emi_paid'=>$$amount[$key],
								'emi_status' => $status,
								'emi_payment_date' => date('d-m-Y')
							);
							$this->db->where('emi_id', $emi[$j]['emi_id']);
							$this->db->update('tbl_emi', $PaidData);
							$PaidAmount = $amount[$key] -= $EMI_Amount - $emi[$j]['emi_paid'];
						}

						if ($emi[$j]['emi_paid'] == 0) {
							//	echo "c";
							//	echo $EMI_Amount;
							$PaidAmount = $amount[$key];
							if ($PaidAmount > $EMI_Amount) {
								echo $PaidAmount = $EMI_Amount;
							} else {
								echo $PaidAmount = $amount[$key];
							} //die ;
							$status = 1;
							$due = $PaidAmount - $EMI_Amount;
							if ($due < 0) {
								$status = 0;
							}
							$PaidData = array(
								'emi_id' => $emi[$j]['emi_id'],
								'emi_paid' => $PaidAmount,
								'emi_status' => $status,
								'emi_payment_date' => date('d-m-Y')
							);
							$this->db->where('emi_id', $emi[$j]['emi_id']);
							$this->db->update('tbl_emi', $PaidData);
							$PaidAmount = $amount[$key] -= $EMI_Amount;
						}

					endfor;
					$timeline = array(
						'timeline_user' => $this->session->userdata('user_name'),
						'timeline_user_role' => $this->session->userdata('user_role'),
						'timeline_client' => $value,
						'timeline_message' => 'Customer Payment received on ' . date('d M. Y') . ' at ' . date('h:i:s'),
						'timeline_date' => date('d M. Y'),
						'timeline_time' => date('h:i:s')
					);
					$this->db->insert('tbl_timeline', $timeline);
				}
			endforeach;
		} else {
			$date = $this->input->post('date');
			$agent = $this->input->post('agent');
			$client = $this->input->post('client_id');
			$loan_id = $this->input->post('loan_id');
			$amount = $this->input->post('amount');
			$EmiAmount = $this->input->post('emi');
			$amt = array();;
			foreach ($client as $key => $value) :
				if (!empty($amount[$key])) {
					$EMI_Amount = $EmiAmount[$key];
					$data = array(
						'pay_client' => $value,
						'pay_loan' => $loan_id[$key],
						'pay_agent' => $agent,
						'pay_amount' => $amount[$key],
						'pay_date' => $date,
						'add_date' => date("Y-m-d"),
						'pay_update_by' => $this->session->userdata('user_id'),
						'source_id' => $this->input->post('sources'),
						'by_collection' => 1

					);
					$this->db->insert('tbl_payments', $data);

					//$amount[] = $amount[$key];
					$cashEntry = array(
						'auth_id' => $this->session->userdata('user_id'),
						'bank_id' => $this->input->post('sources'),
						'debit' => 0,
						'credit_amt' => $amount[$key],
						'collect_by' => $agent,
						'remark' => 'Amount Received from Customer Daily Payment',
						'add_date' => date('Y-m-d')
					);
					$this->db->insert('tbl_bank_legder', $cashEntry);
					$EMI = ceil($amount[$key] / $EMI_Amount);
					$emi = $this->db->get_where('tbl_emi', array('emi_client' => $value, 'emi_loan' => $loan_id[$key], 'emi_status' => 0))->result_array();
					if ($emi[0]['emi_paid'] != 0) {
						$EMI = ceil(($amount[$key] + $emi[0]['emi_paid']) / $EMI_Amount);
					}
					for ($j = 0; $j < $EMI; $j++) :

						if ($emi[$j]['emi_paid'] != 0) {
							$PaidAmount = $amount[$key] + $emi[$j]['emi_paid'];

							if ($j == 0 || $PaidAmount > $EMI_Amount) {
								$PaidAmount = $EMI_Amount;
							} else {
								$PaidAmount = $amount[$key] + $emi[$j]['emi_paid'];
							}
							$status = 1;
							$due = $PaidAmount + $emi[$j]['emi_paid'] - $EMI_Amount;
							if ($due < 0) {
								$status = 0;
							}

							$PaidData = array(
								'emi_id' => $emi[$j]['emi_id'],
								'emi_paid' => $PaidAmount,
								'emi_status' => $status,
								'emi_payment_date' => date('d-m-Y')
							);
							$this->db->where('emi_id', $emi[$j]['emi_id']);
							$this->db->update('tbl_emi', $PaidData);
							$PaidAmount = $amount[$key] -= $EMI_Amount - $emi[$j]['emi_paid'];
						}

						if ($emi[$j]['emi_paid'] == 0) {
							$PaidAmount = $amount[$key];
							if ($j == 0 || $PaidAmount > $EMI_Amount) {
								$PaidAmount = $EMI_Amount;
							} else {
								$PaidAmount = $amount[$key];
							}
							$status = 1;
							$due = $PaidAmount - $EMI_Amount;
							if ($due < 0) {
								$status = 0;
							}
							$PaidData = array(
								'emi_id' => $emi[$j]['emi_id'],
								'emi_paid' => $PaidAmount,
								'emi_status' => $status,
								'emi_payment_date' => date('d-m-Y')
							);
							$this->db->where('emi_id', $emi[$j]['emi_id']);
							$this->db->update('tbl_emi', $PaidData);
							$PaidAmount = $amount[$key] -= $EMI_Amount;
						}

					endfor;
					$timeline = array(
						'timeline_user' => $this->session->userdata('user_name'),
						'timeline_user_role' => $this->session->userdata('user_role'),
						'timeline_client' => $value,
						'timeline_message' => 'Customer Payment received on ' . date('d M. Y') . ' at ' . date('h:i:s'),
						'timeline_date' => date('d M. Y'),
						'timeline_time' => date('h:i:s')
					);
					$this->db->insert('tbl_timeline', $timeline);
				}
			endforeach;
		}
		$this->session->set_flashdata('PaymentMsg', 'Daily Payment Updated Successfully');
		redirect(base_url() . 'main/dailyPayments', 'refresh');
	}

	public function CalculatePenalty($atr)
	{
		//$LoanSettings=$this->db->get('tbl_loan_settings')->row_array();
		$emiData = $this->db->get_where('tbl_emi', array('emi_id' => $atr))->row_array();
		$LoanSettings = $this->db->get_where('tbl_customers_loan', array('id' => $emiData['emi_loan']))->row_array();
		$emiDate = $emiData['emi_date'];
		$paymentDate = $emiData['emi_payment_date'];
		$currentDate = date('d-m-Y');
		if (strtotime($emiDate) < strtotime($paymentDate)) {
			$diff = strtotime($emiDate) - strtotime($paymentDate);
			$dateDiff = abs(round($diff / 86400));

			$penalty = $dateDiff * $LoanSettings['penalty'];
			return $penalty;
		}
		if (empty($paymentDate) && strtotime($emiDate) < strtotime($currentDate)) {
			$diff = strtotime($emiDate) - strtotime($currentDate);
			$dateDiff = abs(round($diff / 86400));

			$penalty = $dateDiff * $LoanSettings['penalty'];
			return $penalty;
		} else {
			return 0;
		}
	}
	public function totalPenalty($atr, $atr1)
	{
		$LoanSettings = $this->db->get('tbl_loan_settings')->row_array();
		$emiData = $this->db->get_where('tbl_emi', array('emi_client' => $atr, 'emi_loan' => $atr1))->result_array();
		// echo $this->db->last_query();
		$totalPenalty = 0;
		foreach ($emiData as $emi) :
			$penalty = $this->CalculatePenalty($emi['emi_id']);
			$totalPenalty += $penalty;
		endforeach;
		return $totalPenalty;
	}

	public function paidPenalty($atr, $atr1)
	{
		$LoanSettings = $this->db->get('tbl_loan_settings')->row_array();
		$paidData = $this->db->get_where('tbl_penalty', array('user_id' => $atr, 'loan_id' => $atr1))->result_array();
		$paidPenalty = 0;
		foreach ($paidData as $data) :
			$paidPenalty += $data['paid_amount'] + $data['waived_off'];
		endforeach;
		return $paidPenalty;
	}

	public function penaltySettelement()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		///echo "<pre>"; print_r($_POST); die; 
		$data = array(
			'user_id' => $this->input->post('user_id'),
			'loan_id' => $this->input->post('loan_id'),
			'paid_amount' => $this->input->post('received'),
			'waived_off' => $this->input->post('waived_off'),
			'payment_date' => date('d-m-Y'),
			'payment_user' => $this->input->post('user'),
			'payment_update' => $this->session->userdata('user_id')
		);
		if ($this->input->post('received') > 0) {
			if ($this->input->post('payment_type') == "other") {
				$data['source_id'] = $this->input->post('sources');
			} else {
				$data['source_id'] = 0;
			}
		}
		$this->db->insert('tbl_penalty', $data);
		if ($this->input->post('received') > 0) {
			if ($this->input->post('payment_type') == "other") {
				$cashEntry = array(
					'auth_id' => $this->session->userdata('user_id'),
					'bank_id' => $this->input->post('sources'),
					'debit' => 0,
					'credit_amt' => $this->input->post('received'),
					//'collect_by'=>$agent,
					'received_status' => 1,
					'receivedby' => 1,
					'remark' => 'Credit from Customer Penalty Payment',
					'add_date' => date('Y-m-d')
				);
				$this->db->insert('tbl_bank_legder', $cashEntry);
			} else {
				$cashEntry = array(
					'emp_id' => $this->session->userdata('user_id'),
					'method' => 'CASH',
					'cash_debit' => 0,
					'cash_credit' => $this->input->post('received'),
					'receiving_from' => $this->input->post('user'),
					'received_by' => $this->session->userdata('user_id'),
					'receiving_status' => 1,
					'remark' => 'Cash Credit from Customer Penalty Payment',
					'date' => date('d-m-Y')
				);
				$this->db->insert('tbl_cashbook', $cashEntry);
			}
		}
		redirect(base_url() . 'main/ClientView/' . $this->input->post('user_id'), 'refresh');
	}

	public function loanSettelement()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		//echo "<pre>"; print_r($_POST); die;
		$client_id = $this->input->post('client_id');
		$loan_id = $this->input->post('loan_id');
		$dueAmount = $this->input->post('amount');
		$waivedOff = $this->input->post('waived_off');
		$Received = $this->input->post('ramount');
		$agent = $this->input->post('user');
		$date = date('d-m-Y');
		$amount = $Received + $waivedOff;
		$loanData = $this->db->get_where('tbl_customers_loan', array('id' => $loan_id))->row_array();
		$EmiAmount = $loanData['emi_amount'];

		$EMI_Amount = $EmiAmount;
		$data = array(
			'pay_client' => $client_id,
			'pay_loan' => $loan_id,
			'pay_agent' => $agent,
			'pay_amount' => $Received,
			'pay_date' => $date,
			'add_date' => date("Y-m-d"),
			'pay_update_by' => $this->session->userdata('user_id')

		);
		if ($this->input->post('payment_type') == "other") {
			$data['source_id'] = $this->input->post('sources');
		} else {
			$data['source_id'] = 0;
		}
		$this->db->insert('tbl_payments', $data);
		if ($this->input->post('payment_type') == "other") {
			$cashEntry = array(
				'auth_id' => $this->session->userdata('user_id'),
				'bank_id' => $this->input->post('sources'),
				'debit' => 0,
				'credit_amt' => $Received,
				'collect_by' => $agent,
				'received_status' => 1,
				'receivedby' => 1,
				'remark' => 'Cash Credit from Customer Loan Settlement',
				'add_date' => date('Y-m-d')
			);
			$this->db->insert('tbl_bank_legder', $cashEntry);
		} else {
			$cashEntry = array(
				'emp_id' => $this->session->userdata('user_id'),
				'method' => 'CASH',
				'cash_debit' => 0,
				'cash_credit' => $Received,
				'receiving_from' => $agent,
				'received_by' => $this->session->userdata('user_id'),
				'receiving_status' => 1,
				'remark' => 'Cash Credit from Customer Loan Settlement',
				'date' => date('d-m-Y')
			);
			$this->db->insert('tbl_cashbook', $cashEntry);
		}



		$EMI = ceil($amount / $EMI_Amount);
		$emi = $this->db->get_where('tbl_emi', array('emi_client' => $client_id, 'emi_loan' => $loan_id, 'emi_status' => 0))->result_array();
		if ($emi[0]['emi_paid'] != 0) {
			$EMI = ceil(($amount + $emi[0]['emi_paid']) / $EMI_Amount);
		}
		for ($j = 0; $j < $EMI; $j++) :

			if ($emi[$j]['emi_paid'] != 0) {
				$PaidAmount = $amount + $emi[$j]['emi_paid'];

				if ($j == 0 || $PaidAmount > $EMI_Amount) {
					$PaidAmount = $EMI_Amount;
				} else {
					$PaidAmount = $amount + $emi[$j]['emi_paid'];
				}
				$status = 1;
				$due = $PaidAmount + $emi[$j]['emi_paid'] - $EMI_Amount;
				if ($due < 0) {
					$status = 0;
				}

				$PaidData = array(
					'emi_id' => $emi[$j]['emi_id'],
					'emi_paid' => $PaidAmount,
					'emi_status' => $status,
					'emi_payment_date' => date('d-m-Y')
				);
				$this->db->where('emi_id', $emi[$j]['emi_id']);
				$this->db->update('tbl_emi', $PaidData);
				$PaidAmount = $amount -= $EMI_Amount - $emi[$j]['emi_paid'];
			}

			if ($emi[$j]['emi_paid'] == 0) {
				$PaidAmount = $amount;
				if ($j == 0 || $PaidAmount > $EMI_Amount) {
					$PaidAmount = $EMI_Amount;
				} else {
					$PaidAmount = $amount;
				}
				$status = 1;
				$due = $PaidAmount - $EMI_Amount;
				if ($due < 0) {
					$status = 0;
				}
				$PaidData = array(
					'emi_id' => $emi[$j]['emi_id'],
					'emi_paid' => $PaidAmount,
					'emi_status' => $status,
					'emi_payment_date' => date('d-m-Y')
				);
				$this->db->where('emi_id', $emi[$j]['emi_id']);
				$this->db->update('tbl_emi', $PaidData);
				$PaidAmount = $amount -= $EMI_Amount;
			}

		endfor;
		$timeline = array(
			'timeline_user' => $this->session->userdata('user_name'),
			'timeline_user_role' => $this->session->userdata('user_role'),
			'timeline_client' => $client_id,
			'timeline_message' => 'Customer Payment received and loan account has been closed on ' . date('d M. Y') . ' at ' . date('h:i:s'),
			'timeline_date' => date('d M. Y'),
			'timeline_time' => date('h:i:s')
		);
		$this->db->insert('tbl_timeline', $timeline);

		$this->db->where('id', $loan_id);
		$this->db->set('loan_status', 'Closed');
		$this->db->update('tbl_customers_loan');

		$waivedOff = array(
			'user_id' => $client_id,
			'loan_id' => $loan_id,
			'waived_off' => $waivedOff,
			'payment_user' => $agent,
			'payment_update' => $this->session->userdata('user_id'),
			'payment_date' => date('d-m-Y')
		);
		$this->db->insert('tbl_waived_off', $waivedOff);

		redirect(base_url() . 'main/ClientView/' . $client_id, 'refresh');
	}

	public function topupAccount()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}

		$user_id = $this->input->post('user_id');
		$loan_id = $this->input->post('loan_id');
		$outstanding = $this->input->post('outstanding');
		$loanwaivedoff = $this->input->post('loanwaived_off');
		$ramount = $this->input->post('ramount');
		$penalty = $this->input->post('penalty');
		$penaltywaived_off = $this->input->post('penaltywaived_off');
		$penaltyreceived = $this->input->post('penaltyreceived');
		$finalDue = $this->input->post('finalDue');
		$agent = $this->input->post('user');
		//echo "<pre>"; print_r($_POST); die;
		if ($ramount > 0) {
			if ($this->input->post('payment_type') == "other") {
				$cashEntry = array(
					'auth_id' => $this->session->userdata('user_id'),
					'bank_id' => $this->input->post('sources'),
					'debit' => 0,
					'credit_amt' => $ramount,
					'collect_by' => $agent,
					'received_status' => 1,
					'receivedby' => 1,
					'remark' => 'Cash Credit from Customer Loan account topup',
					'add_date' => date('Y-m-d'),
					'status' => 0,
					'loan_id' => $loan_id
				);
				$this->db->insert('tbl_bank_legder', $cashEntry);
			} else {
				$cashEntry = array(
					'emp_id' => $this->session->userdata('user_id'),
					'method' => 'CASH',
					'cash_debit' => 0,
					'cash_credit' => $ramount,
					'receiving_from' => $agent,
					'received_by' => $this->session->userdata('user_id'),
					'receiving_status' => 1,
					'remark' => 'Cash Credit from Customer Loan account topup',
					'date' => date('d-m-Y'),
					'status' => 0,
					'loan_id' => $loan_id
				);
				$this->db->insert('tbl_cashbook', $cashEntry);
			}
		}
		if ($penaltyreceived > 0) {
			if ($this->input->post('payment_type') == "other") {
				$cashEntry = array(
					'auth_id' => $this->session->userdata('user_id'),
					'bank_id' => $this->input->post('sources'),
					'debit' => 0,
					'credit_amt' => $penaltyreceived,
					'collect_by' => $agent,
					'received_status' => 1,
					'receivedby' => 1,
					'remark' => 'Cash Credit from Customer Loan account topup penalty',
					'add_date' => date('Y-m-d'),
					'status' => 0,
					'loan_id' => $loan_id
				);
				$this->db->insert('tbl_bank_legder', $cashEntry);
			} else {
				$cashEntry = array(
					'emp_id' => $this->session->userdata('user_id'),
					'method' => 'CASH',
					'cash_debit' => 0,
					'cash_credit' => $penaltyreceived,
					'receiving_from' => $agent,
					'received_by' => $this->session->userdata('user_id'),
					'receiving_status' => 1,
					'remark' => 'Cash Credit from Customer Loan account topup penalty',
					'date' => date('d-m-Y'),
					'status' => 0,
					'loan_id' => $loan_id
				);
				$this->db->insert('tbl_cashbook', $cashEntry);
			}
		}

		if ($ramount > 0 || $loanwaivedoff > 0) {
			$client_id = $this->input->post('user_id');
			$loan_id = $this->input->post('loan_id');
			$dueAmount = $this->input->post('outstanding');
			$waivedOff = $this->input->post('loanwaived_off');
			$Received = $this->input->post('ramount');
			$agent = $this->input->post('user');
			$date = date('d-m-Y');
			$amount = $Received + $waivedOff;
			$loanData = $this->db->get_where('tbl_customers_loan', array('id' => $loan_id))->row_array();
			$EmiAmount = $loanData['emi_amount'];

			$EMI_Amount = $EmiAmount;

			if ($Received > 0) {
				$data = array(
					'pay_client' => $client_id,
					'pay_loan' => $loan_id,
					'pay_agent' => $agent,
					'pay_amount' => $Received,
					'pay_date' => $date,
					'add_date' => date("Y-m-d"),
					'pay_update_by' => $this->session->userdata('user_id')
				);
				$this->db->insert('tbl_payments', $data);
			}

			$EMI = ceil($amount / $EMI_Amount);
			$emi = $this->db->get_where('tbl_emi', array('emi_client' => $client_id, 'emi_loan' => $loan_id, 'emi_status' => 0))->result_array();
			if ($emi[0]['emi_paid'] != 0) {
				$EMI = ceil(($amount + $emi[0]['emi_paid']) / $EMI_Amount);
			}
			for ($j = 0; $j < $EMI; $j++) :

				if ($emi[$j]['emi_paid'] != 0) {
					echo $PaidAmount = $amount + $emi[$j]['emi_paid'];

					if ($j == 0 || $PaidAmount > $EMI_Amount) {
						$PaidAmount = $EMI_Amount;
					} else {
						$PaidAmount = $amount + $emi[$j]['emi_paid'];
					}
					$status = 1;
					$due = $PaidAmount + $emi[$j]['emi_paid'] - $EMI_Amount;
					if ($due < 0) {
						$status = 0;
					}

					$PaidData = array(
						'emi_id' => $emi[$j]['emi_id'],
						'emi_paid' => $PaidAmount,
						'emi_status' => $status,
						'p_paid' => 'Yes',
						'emi_payment_date' => date('d-m-Y')
					);
					$this->db->where('emi_id', $emi[$j]['emi_id']);
					$this->db->update('tbl_emi', $PaidData);
					$PaidAmount = $amount -= $EMI_Amount - $emi[$j]['emi_paid'];
				}

				if ($emi[$j]['emi_paid'] == 0) {
					$PaidAmount = $amount;
					if ($j == 0 || $PaidAmount > $EMI_Amount) {
						$PaidAmount = $EMI_Amount;
					} else {
						$PaidAmount = $amount;
					}
					$status = 1;
					$due = $PaidAmount - $EMI_Amount;
					if ($due < 0) {
						$status = 0;
					}
					$PaidData = array(
						'emi_id' => $emi[$j]['emi_id'],
						'emi_paid' => $PaidAmount,
						'emi_status' => $status,
						'p_paid' => 'Yes',
						'emi_payment_date' => date('d-m-Y')
					);
					$this->db->where('emi_id', $emi[$j]['emi_id']);
					$this->db->update('tbl_emi', $PaidData);
					$PaidAmount = $amount -= $EMI_Amount;
				}

			endfor;
			$timeline = array(
				'timeline_user' => $this->session->userdata('user_name'),
				'timeline_user_role' => $this->session->userdata('user_role'),
				'timeline_client' => $client_id,
				'timeline_message' => 'Customer Payment received and loan account created for topup on ' . date('d M. Y') . ' at ' . date('h:i:s'),
				'timeline_date' => date('d M. Y'),
				'timeline_time' => date('h:i:s')
			);
			$this->db->insert('tbl_timeline', $timeline);

			//$this->db->where('id', $loan_id);
			//$this->db->set('loan_status', 'Loan Topup');	
			//	$this->db->update('tbl_customers_loan');

			$waivedOff = array(
				'user_id' => $client_id,
				'loan_id' => $loan_id,
				'waived_off' => $waivedOff,
				'payment_user' => $agent,
				'payment_update' => $this->session->userdata('user_id'),
				'payment_date' => date('d-m-Y'),
				'status' => 0
			);
			$this->db->insert('tbl_waived_off', $waivedOff);
		}
		if ($penaltyreceived > 0 || $penaltywaived_off > 0) {
			$data = array(
				'user_id' => $this->input->post('user_id'),
				'loan_id' => $this->input->post('loan_id'),
				'paid_amount' => $this->input->post('penaltyreceived'),
				'waived_off' => $this->input->post('penaltywaived_off'),
				'payment_date' => date('d-m-Y'),
				'payment_user' => $this->input->post('user'),
				'payment_update' => $this->session->userdata('user_id'),
				'status' => 0
			);
			if ($this->input->post('payment_type') == "other") {
				$data['source_id'] = $this->input->post('sources');
			} else {
				$data['source_id'] = 0;
			}
			$this->db->insert('tbl_penalty', $data);
		}

		$topup = array(
			'user_id' => $this->input->post('user_id'),
			'loan_id' => $this->input->post('loan_id'),
			'outstanding' => $this->input->post('outstanding'),
			'loan_waivedoff' => $this->input->post('loanwaived_off'),
			'loan_received' => $this->input->post('ramount'),
			'penalty' => $this->input->post('penalty'),
			'penalty_waivedoff' => $this->input->post('penaltywaived_off'),
			'penalty_received' => $this->input->post('penaltyreceived'),
			'final_due' => $this->input->post('finalDue'),
			'collection_agent' => $agent
		);
		$this->db->insert('tbl_topup', $topup);

		$this->db->where('id', $this->input->post('loan_id'));
		$this->db->set('previous_due', $this->input->post('finalDue'));
		$this->db->set('previous_loan', $this->input->post('loan_id'));
		$this->db->update('tbl_customers_loan');

		redirect(base_url() . 'main/loanTopup/' . $loan_id, 'refresh');
	}
	public function loanTopup($atr = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}

		if ($atr == 'SaveData') {
			$clientData = $this->db->get_where('tbl_customers', array('client_id' => $this->input->post('client_id')))->row_array();
			$LoanData = $this->db->get_where('tbl_customers_loan', array('id' => $this->input->post('loan_id')))->row_array();

			$last_loan = $this->db->order_by('id', 'DESC')->get('tbl_customers_loan')->row_array();
			if ($last_loan > 0) {
				$loan_no = 'YM00' . ($last_loan['id'] + 1);
			} else {
				$loan_no = 'YM001';
			}

			$photo = $_FILES['photo'];
			if (!empty($photo['name'])) {
				unlink('./uploads/client_photos/' . $clientData['client_photo']);
				$config['upload_path'] = './uploads/client_photos/';
				$config['allowed_types'] = 'jpg|png|jpeg|bmp';
				$config['file_name'] = $LoanData['loan_account'] . '_' . $photo['name'];
				$this->upload->initialize($config);
				$this->upload->do_upload('photo');
				$cphoto = $this->upload->data('file_name');
			}
			if (empty($photo['name'])) {
				$cphoto = $clientData['client_photo'];
			}
			$aadhar_card = $_FILES['aadhar_card'];
			if (!empty($aadhar_card['name'])) {
				unlink('./uploads/client_aadhar/' . $clientData['client_aadhar_card']);
				$config['upload_path'] = './uploads/client_aadhar/';
				$config['allowed_types'] = 'jpg|png|jpeg|pdf';
				$config['file_name'] = $LoanData['loan_account'] . '_' . $aadhar_card['name'];
				$this->upload->initialize($config);
				$this->upload->do_upload('aadhar_card');
				$aadhar = $this->upload->data('file_name');
			}
			if (empty($aadhar_card['name'])) {
				$aadhar = $clientData['client_aadhar_card'];
			}
			$guarantor_photo = $_FILES['gphoto'];
			if (!empty($guarantor_photo['name'])) {
				unlink('./uploads/guarantor_photos/' . $clientData['client_gphoto']);
				$config['upload_path'] = './uploads/guarantor_photos/';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['file_name'] = $LoanData['loan_account'] . '_' . $guarantor_photo['name'];
				$this->upload->initialize($config);
				$this->upload->do_upload('gphoto');
				$gphoto = $this->upload->data('file_name');
			}
			if (empty($guarantor_photo['name'])) {
				$gphoto = $clientData['client_gphoto'];
			}
			$application_doc = $_FILES['app_doc'];
			if (!empty($application_doc['name'])) {
				$config['upload_path'] = './uploads/application_documents/';
				$config['allowed_types'] = 'pdf';
				$config['file_name'] = $LoanData['loan_account'] . '_' . $application_doc['name'];
				$this->upload->initialize($config);
				$this->upload->do_upload('app_doc');
				$app_doc = $this->upload->data('file_name');
			}
			if (empty($application_doc['name'])) {
				$app_doc = $LoanData['loan_application'];
			}
			$data = array(
				'client_name' => $this->input->post('name'),
				'client_father' => $this->input->post('father'),
				'client_mother' => $this->input->post('mother'),
				'client_dob' => $this->input->post('dob'),
				'client_gender' => $this->input->post('gender'),
				'client_email' => $this->input->post('email'),
				'client_mobile' => $this->input->post('mobile'),
				'client_aadhar' => $this->input->post('aadhar'),
				'client_occupation' => $this->input->post('occupation'),
				'client_current_address' => $this->input->post('caddress'),
				'client_cpincode' => $this->input->post('cpincode'),
				'client_permanent_address' => $this->input->post('paddress'),
				'client_ppincode' => $this->input->post('ppincode'),
				'client_income' => $this->input->post('income'),
				'client_guarantor' => $this->input->post('guarentor'),
				'client_gmobile' => $this->input->post('gmobile'),
				'client_gaddress' => $this->input->post('gaddress'),
				'client_gpincode' => $this->input->post('gpincode'),
				'client_photo' => $cphoto,
				'client_aadhar_card' => $aadhar,
				'client_gphoto' => $gphoto,
				'client_status' => '1',
				'client_user' => $this->input->post('user'),
				'client_created' => $this->session->userdata('user_id'),
				'client_date' => date('d-m-Y h:i:s')
			);

			$result = $this->main_model->UpdateClient($this->input->post('client_id'), $data);
			if ($result > 0) {
				$data1 = array(
					'customer_id' => $this->input->post('client_id'),
					'file_no' => $loan_no,
					'loan_account' => $loan_no,
					'loan_application' => $app_doc,
					'loan_amount' => $this->input->post('amount'),
					'loan_duration' => $this->input->post('duration'),
					'duration_unit' => $this->input->post('unit'),
					'penalty' => $this->input->post('penalty'),
					'processing_fee' => $this->input->post('fee'),
					'interest_rate' => $this->input->post('interest'),
					'repayment_amount' => $this->input->post('repay'),
					'emi_amount' => $this->input->post('emi'),
					//'disbursed_amount'=>$this->input->post('damount'),
					'disbursed_amount' => $this->input->post('damount') + $this->input->post('previousDue'),
					'emi_start_date' => $this->input->post('emistart'),
					'loan_status' => 'Pending',
					'previous_due' => $this->input->post('previousDue'),
					'previous_loan' => $this->input->post('loan_id'),
					'application_remark' => $this->input->post('remark'),
					'application_date' => date('d-m-Y h:i:s'),
					'application_user' => $this->input->post('user'),
					'created_by' => $this->session->userdata('user_id'),
					'add_date' => date("Y-m-d"),
				);
				//print_r($data1);
				//	exit;
				$this->db->insert('tbl_customers_loan', $data1);

				$timeline = array(
					'timeline_user' => $this->session->userdata('user_name'),
					'timeline_user_role' => $this->session->userdata('user_role'),
					'timeline_client' => $this->input->post('client_id'),
					'timeline_message' => 'Customer profile created for loan topup on ' . date('d M. Y') . ' at ' . date('h:i:s'),
					'timeline_date' => date('d M. Y'),
					'timeline_time' => date('h:i:s')
				);
				$this->db->insert('tbl_timeline', $timeline);
				$this->session->set_flashdata('ClientSuccess_msg', 'Customer profile created Successfully');
				redirect(base_url() . 'main/ClientView/' . $result, 'refresh');
			} else {
				$this->session->set_flashdata('ClientError_msg', 'Something Went Wrong, Please Try again..!!');
				redirect(base_url() . 'main/loanTopup/' . $this->input->post('loan_id'), 'refresh');
			}
		}
		$data['loan_id'] = $atr;
		$this->load->view('topupLoan', $data);
	}

	public function cashBook()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$this->load->model('main_model', 'main');
		if ($this->session->userdata('user_type') == "super_admin") {
			$loginUserId = $this->session->userdata('user_id');
			$reported_user =  $this->main->repot_user_list_array($loginUserId);
			$this->db->select('*');
			$this->db->where_in('tbl_users.user_id', $reported_user);
			$query  = $this->db->get('tbl_users');
			$empData = $query->result_array();
		} else {
			$loginUserId = $this->session->userdata('user_id');
			$reported_user =  $this->main->repot_user_list_array($loginUserId);
			$this->db->select('*');
			$this->db->where_in('tbl_users.user_id', $reported_user);
			$query  = $this->db->get('tbl_users');
			$empData = $query->result_array();
		}
		//  echo "<pre>"; print_r($empData); die;
		//echo $this->db->last_query(); die;
		//return $disbursed;
		$this->load->view('cashBook', compact('empData'));
	}
	public function totalCashCredit($atr)
	{
		$cash = 0;
		$emp = $this->db->get_where('tbl_cashbook', array('emp_id' => $atr, 'receiving_status' => 1))->result_array();
		foreach ($emp as $data) :
			$cash += $data['cash_credit'];
		endforeach;
		return $cash;
	}

	public function totalCashDebit($atr)
	{
		$cash = 0;
		$emp = $this->db->get_where('tbl_cashbook', array('emp_id' => $atr, 'receiving_status' => 1))->result_array();
		foreach ($emp as $data) :
			$cash += $data['cash_debit'];
		endforeach;
		return $cash;
	}

	public function cashDetails($atr = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$data['emp_id'] = $atr;

		$this->load->view('cashDetails', $data);
	}

	public function myCashBook($atr = '', $atr1 = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}

		if ($atr == 'Approved') {
			$cashEntry = $this->db->get_where('tbl_cashbook', array('id' => $atr1))->row_array();
			$data = array(
				'cash_credit' => $cashEntry['cash_debit'],
				'cash_debit' => 0,
				'receiving_status' => 1
			);
			$this->db->where('id', $atr1);
			$this->db->update('tbl_cashbook', $data);

			$data1 = array(
				'emp_id' => $cashEntry['receiving_from'],
				'method' => $cashEntry['method'],
				'cash_debit' => $cashEntry['cash_debit'],
				'cash_credit' => 0,
				'receiving_from' => $cashEntry['receiving_from'],
				'received_by' => $this->session->userdata('user_id'),
				'receiving_status' => 1,
				'remark' => 'Cash Received by ' . $this->session->userdata('user_name'),
				'date' => date('d-m-Y')
			);
			$this->db->insert('tbl_cashbook', $data1);

			redirect(base_url() . 'main/myCashBook', 'refresh');
		}

		$this->load->view('myCashBook');
	}
	public function cashTransfer($atr = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		if ($atr == 'SaveEntry') {
			if ($_POST['optradio'] == "cash") {

				$data = array(
					'emp_id' => $this->input->post('receiver'),
					'method' => $this->input->post('method'),
					'cash_debit' => $this->input->post('amount'),
					'cash_credit' => 0,
					'receiving_from' => $this->session->userdata('user_id'),
					'received_by' => $this->input->post('receiver'),
					'receiving_status' => 0,
					'remark' => $this->input->post('remark'),
					'date' => date('d-m-Y')
				);
				$this->db->insert('tbl_cashbook', $data);
			} else {
				$cashEntry = array(
					'auth_id' => $this->session->userdata('user_id'),
					'bank_id' => $this->input->post('sources'),
					'debit' => 0,
					'credit_amt' => $this->input->post('amount'),
					//'collect_by'=>$agent,
					'received_status' => 0,
					'receivedby' => 1,
					'remark' => 'Amount Received from Customer Daily Payment',
					'add_date' => date('Y-m-d')
				);
				$this->db->insert('tbl_bank_legder', $cashEntry);
			}

			redirect(base_url() . 'main/myCashBook', 'refresh');
		}
		$this->load->view('cashTransfer');
	}

	public function totalDisbursed()
	{
		//echo $this->session->userdata('user_type'); die;
		$this->load->model('main_model', 'main');
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		if ($this->session->userdata('user_type') == "super_admin") {
			$this->db->select('*');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

			//$this->db->where('tbl_customers_loan.loan_status', 'Disbursed');
			//$this->db->where_in('tbl_customers_loan.application_user', $reported_user);


			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->result_array();
		} else {

			$loginUserId = $this->session->userdata('user_id');
			$reported_user =  $this->main->repot_user_list_array($loginUserId);
			//echo "<pre>"; print_r($reported_user); die;
			$this->db->select('*');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

			//$this->db->where('tbl_customers_loan.loan_status', 'Disbursed');
			$this->db->where_in('tbl_customers_loan.application_user', $reported_user);


			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->result_array();
		}


		$totalDisbursed = 0;
		foreach ($disbursed as $dAmount) :
			if ($dAmount['loan_status'] == "Disbursed" || $dAmount['loan_status'] == "Loan Topup")
				$totalDisbursed += $dAmount['disbursed_amount'];
		endforeach;

		return $totalDisbursed;
	}
	public function totalTillDateDisbursed()
	{
		//echo $this->session->userdata('user_type'); die;
		$this->load->model('main_model', 'main');
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		if ($this->session->userdata('user_type') == "admin") {
			$loginUserId = $this->session->userdata('user_id');
			$reported_user =  $this->main->repot_user_list($loginUserId);
			//print_r($reported_user); die;
			$this->db->select('*');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

			//$this->db->where('tbl_customers_loan.loan_status', 'Disbursed');
			$this->db->where('tbl_customers.client_created', $loginUserId);
			$this->db->or_where_in('tbl_customers.client_repoting', $reported_user);

			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->result_array();
		} else if ($this->session->userdata('user_type') == "sale") {
			$loginUserId = $this->session->userdata('user_id');
			$reported_user =  $this->main->repot_user_list($loginUserId);
			//echo "<pre>"; print_r($reported_user); die;
			$this->db->select('*');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

			//$this->db->where('tbl_customers_loan.loan_status', 'Disbursed');
			$this->db->where('tbl_customers.client_created', $loginUserId);
			if (isset($reported_user['user_id']) && $reported_user['user_id'])
				$this->db->or_where(
					'tbl_customers.client_created',
					$reported_user['user_id']
				);

			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->result_array();
		} else {
			$disbursed = $this->db->get_where('tbl_customers_loan', array())->result_array();
		}


		$totalDisbursed = 0;
		foreach ($disbursed as $dAmount) :
			$totalDisbursed += $dAmount['disbursed_amount'];
		endforeach;

		return $totalDisbursed;
	}
	public function totalProcessingFee()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		if ($this->session->userdata('user_type') == "super_admin") {


			//$disbursed = $this->db->get_where('tbl_customers_loan', array('loan_status=' => 'Disbursed'))->result_array();
			$this->db->select('*');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

			//$this->db->where('tbl_customers_loan.loan_status=', 'Disbursed');
			//$this->db->where_in('tbl_customers_loan.application_user', $reported_user);
			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->result_array();
		} else {
			$loginUserId = $this->session->userdata('user_id');
			$reported_user =  $this->main->repot_user_list_array($loginUserId);

			$this->db->select('*');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

			//$this->db->where('tbl_customers_loan.loan_status=', 'Disbursed');
			$this->db->where_in('tbl_customers_loan.application_user', $reported_user);
			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->result_array();
		}
		$totalFee = 0;
		foreach ($disbursed as $dAmount) :
			if ($dAmount['loan_status'] == "Disbursed" || $dAmount['loan_status'] == "Loan Topup") {
				$loanAmount = $dAmount['loan_amount'];
				$fee = $dAmount['processing_fee'];
				$totalFee += ($loanAmount / 100) * $fee;
			}
		endforeach;

		return $totalFee;
	}
	public function totalProcessingFeeTillDate()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		if ($this->session->userdata('user_type') == "super_admin") {


			$disbursed = $this->db->get_where('tbl_customers_loan', array('loan_status !=' => 'Pending'))->result_array();
		} else {
			$loginUserId = $this->session->userdata('user_id');
			$reported_user =  $this->main->repot_user_list_array($loginUserId);

			$this->db->select('*');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

			$this->db->where_in('tbl_customers_loan.application_user', $reported_user);
			//	$this->db->where('tbl_customers_loan.loan_status !=', 'Pending');
			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->result_array();
		}
		$totalFee = 0;
		foreach ($disbursed as $dAmount) :
			//echo "<pre>"; print_r($dAmount);
			if ($dAmount['loan_status'] == "Pending" || $dAmount['loan_status'] == "Submitted" || $dAmount['loan_status'] == "Approved") {
			} else {
				$loanAmount = $dAmount['loan_amount'];
				$fee = $dAmount['processing_fee'];
				$totalFee += ($loanAmount / 100) * $fee;
			}

		endforeach;

		return $totalFee;
	}

	public function totalwaiedoffTillDate()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		if ($this->session->userdata('user_type') == "super_admin") {


			$tbl_waived_off = $this->db->get_where('tbl_waived_off', array('status' => 1))->result_array();
			//echo "<pre>"; print_r($tbl_waived_off); die;
			$amt = 0;
			foreach ($tbl_waived_off as $val) {
				$amt += $val['waived_off'];
			}
			return $amt;
		} else {
			$loginUserId = $this->session->userdata('user_id');
			$reported_user =  $this->main->repot_user_list_array($loginUserId);

			$this->db->select('tbl_customers_loan.id');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

			$this->db->where_in('tbl_customers_loan.application_user', $reported_user);
			//	$this->db->where('tbl_customers_loan.loan_status !=', 'Pending');
			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->result_array();
		}
		$totalFee = 0;
		foreach ($disbursed as $dAmount) :

			$tbl_waived_off = $this->db->get_where('tbl_waived_off', array('loan_id' => $dAmount['id'], 'status' => 1))->row();

			$totalFee += $tbl_waived_off->waived_off;

		endforeach;

		return $totalFee;
	}

	public function totalwaiepenTillDate()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		if ($this->session->userdata('user_type') == "super_admin") {


			$tbl_waived_off = $this->db->get_where('tbl_penalty', array('status' => 1))->result_array();
			//echo "<pre>"; print_r($tbl_waived_off); die;
			$amt = 0;
			foreach ($tbl_waived_off as $val) {
				$amt += $val['waived_off'];
			}
			return $amt;
		} else {
			$loginUserId = $this->session->userdata('user_id');
			$reported_user =  $this->main->repot_user_list_array($loginUserId);

			$this->db->select('tbl_customers_loan.id');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

			$this->db->where_in('tbl_customers_loan.application_user', $reported_user);
			//	$this->db->where('tbl_customers_loan.loan_status !=', 'Pending');
			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->result_array();
		}
		$totalFee = 0;
		foreach ($disbursed as $dAmount) :

			$tbl_waived_off = $this->db->get_where('tbl_penalty', array('loan_id' => $dAmount['id'], 'status' => 1))->row();

			$totalFee += $tbl_waived_off->waived_off;

		endforeach;

		return $totalFee;
	}
	public function totalApprovedLoan()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		if ($this->session->userdata('user_type') == "super_admin") {
			$approved_loan = $this->db->get_where('tbl_customers_loan', array('loan_status=' => 'Approved'))->num_rows();
		} else {
			$loginUserId = $this->session->userdata('user_id');
			$reported_user =  $this->main->repot_user_list_array($loginUserId);


			$this->db->select('*');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

			$this->db->where('tbl_customers_loan.loan_status=', 'Approved');
			$this->db->where_in('tbl_customers_loan.application_user', $reported_user);
			// if (isset($reported_user['user_id']) && $reported_user['user_id'])
			// $this->db->or_where('tbl_customers.client_created', $reported_user['user_id']);

			$query  = $this->db->get('tbl_customers');
			$approved_loan = $query->num_rows();
		}


		return $approved_loan;
	}
	public function totalLoanAmount()
	{
		$this->load->model('main_model', 'main');
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		if ($this->session->userdata('user_type') == "super_admin") {

			//$disbursed = $this->db->get_where('tbl_customers_loan', array('loan_status=' => 'Disbursed'))->result_array();

			$this->db->select('*');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');


			//$this->db->where_in('tbl_customers_loan.application_user', $reported_user);
			$this->db->where('tbl_customers_loan.loan_status', 'Disbursed');
			$this->db->or_where('tbl_customers_loan.loan_status', 'Loan Topup');


			// if(isset($reported_user))
			// 	$this->db->or_where('tbl_customers.client_created', $reported_user['user_id']);

			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->result_array();
		} else {
			$loginUserId = $this->session->userdata('user_id');
			$reported_user =  $this->main->repot_user_list_array($loginUserId);
			//print_r($reported_user);
			$this->db->select('*');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');


			$this->db->where_in('tbl_customers_loan.application_user', $reported_user);
			//$this->db->where('tbl_customers_loan.loan_status', 'Disbursed');
			//$this->db->or_where('tbl_customers_loan.loan_status', 'Loan Topup');


			// if(isset($reported_user))
			// 	$this->db->or_where('tbl_customers.client_created', $reported_user['user_id']);

			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->result_array();
			//echo "<pre>"; print_r($disbursed); die;
		}
		//echo "<pre>";
		//print_r($disbursed);
		$totalLoan = 0;
		foreach ($disbursed as $dAmount) :

			if ($dAmount['loan_status'] == "Disbursed" || $dAmount['loan_status'] == "Loan Topup")
				$totalLoan += $dAmount['loan_amount'];
		endforeach;

		return $totalLoan;
	}

	public function report_user()
	{
		$this->load->model('main_model', 'main');
		$loginUserId = $this->session->userdata('user_id');
		$reported_user =  $this->main->repot_user_list_array($loginUserId);
		$this->db->select('*');
		$this->db->where_in('tbl_users.user_id', $reported_user);
		$query  = $this->db->get('tbl_users');
		$disbursed = $query->result_array();
		//echo $this->db->last_query(); die;
		return $disbursed;
	}
	public function totalLoanTillDate()
	{
		$this->load->model('main_model', 'main');
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		if ($this->session->userdata('user_type') == "admin") {
			$loginUserId = $this->session->userdata('user_id');
			$reported_user =  $this->main->repot_user_list($loginUserId);
			//print_r($reported_user); die;
			$this->db->select('*');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');


			$this->db->where('tbl_customers.client_created', $loginUserId);
			$this->db->or_where_in('tbl_customers.client_repoting', $reported_user);

			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->result_array();
		} else if ($this->session->userdata('user_type') == "sale") {
			$loginUserId = $this->session->userdata('user_id');
			$reported_user =  $this->main->repot_user_list($loginUserId);
			//echo "<pre>"; print_r($reported_user); die;
			$this->db->select('*');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');


			$this->db->where('tbl_customers.client_created', $loginUserId);
			if (isset($reported_user['user_id']) && $reported_user['user_id'])
				$this->db->or_where('tbl_customers.client_created', $reported_user['user_id']);

			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->result_array();
		} else {
			$disbursed = $this->db->get_where('tbl_customers_loan', array())->result_array();
		}

		$totalLoan = 0;
		foreach ($disbursed as $dAmount) :
			$totalLoan += $dAmount['loan_amount'];
		endforeach;

		return $totalLoan;
	}
	public function totalRepayment()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$this->load->model('main_model', 'main');
		if ($this->session->userdata('user_type') == "super_admin") {

			//$disbursed = $this->db->get_where('tbl_customers_loan', array('loan_status=' => 'Disbursed'))->result_array();

			$this->db->select('*');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

			//$this->db->where('tbl_customers_loan.loan_status', 'Disbursed');
			//$this->db->where_in('tbl_customers_loan.application_user', $reported_user);

			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->result_array();
		} else {
			$loginUserId = $this->session->userdata('user_id');
			//$reported_user =  $this->main->repot_user_list($loginUserId);
			$reported_user =  $this->main->repot_user_list_array($loginUserId);

			$this->db->select('*');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

			//$this->db->where('tbl_customers_loan.loan_status', 'Disbursed');
			$this->db->where_in('tbl_customers_loan.application_user', $reported_user);

			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->result_array();
		}
		$totalRepayment = 0;
		foreach ($disbursed as $dAmount) :
			if ($dAmount['loan_status'] == "Disbursed" || $dAmount['loan_status'] == "Loan Topup")
				$totalRepayment += $dAmount['repayment_amount'];
		endforeach;

		return $totalRepayment;
	}

	public function totalRepaymentPaid()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$this->load->model('main_model', 'main');
		if ($this->session->userdata('user_type') == "super_admin") {

			//$disbursed = $this->db->get_where('tbl_customers_loan', array('loan_status=' => 'Disbursed'))->result_array();

			$this->db->select('tbl_customers_loan.id,tbl_customers_loan.loan_status');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

			//$this->db->where('tbl_customers_loan.loan_status', 'Disbursed');
			//$this->db->where_in('tbl_customers_loan.application_user', $reported_user);

			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->result_array();
		} else {
			$loginUserId = $this->session->userdata('user_id');
			//$reported_user =  $this->main->repot_user_list($loginUserId);
			$reported_user =  $this->main->repot_user_list_array($loginUserId);

			$this->db->select('tbl_customers_loan.id,tbl_customers_loan.loan_status');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

			//$this->db->where('tbl_customers_loan.loan_status', 'Disbursed');
			$this->db->where_in('tbl_customers_loan.application_user', $reported_user);

			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->result_array();
		}
		//echo "<pre>"; print_r($disbursed);
		$totalRepaymentPaid = 0;
		foreach ($disbursed as $dAmount) :
			if ($dAmount['loan_status'] == "Disbursed" || $dAmount['loan_status'] == "Loan Topup") {

				$paid_repayment = $this->db->get_where('tbl_emi', array('emi_loan=' => $dAmount['id'], 'emi_status' => '1', 'emi_paid!=' => 0))->result_array();
				foreach ($paid_repayment as $v) {
					//echo "<pre>"; print_r($v);

					$totalRepaymentPaid += $v['emi_paid'];
				}
			}
		endforeach;

		return $totalRepaymentPaid;
	}
	public function totalRepaymentTillDate()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$this->load->model('main_model', 'main');
		if ($this->session->userdata('user_type') == "admin") {
			$loginUserId = $this->session->userdata('user_id');
			$reported_user =  $this->main->repot_user_list($loginUserId);

			$this->db->select('*');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');


			$this->db->where('tbl_customers.client_created', $loginUserId);
			$this->db->or_where_in('tbl_customers.client_repoting', $reported_user);

			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->result_array();
		} else if ($this->session->userdata('user_type') == "sale") {
			$loginUserId = $this->session->userdata('user_id');
			$reported_user =  $this->main->repot_user_list($loginUserId);

			$this->db->select('*');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');


			$this->db->where('tbl_customers.client_created', $loginUserId);
			if (isset($reported_user['user_id']) && $reported_user['user_id'])
				$this->db->or_where('tbl_customers.client_created', $reported_user['user_id']);

			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->result_array();
		} else {
			$disbursed = $this->db->get_where('tbl_customers_loan', array())->result_array();
		}
		$totalRepayment = 0;
		foreach ($disbursed as $dAmount) :
			$totalRepayment += $dAmount['repayment_amount'];
		endforeach;

		return $totalRepayment;
	}

	public function totalDueEMI()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$DueEMI = 0;
		$DueAmount = 0;
		$this->load->model('main_model', 'main');
		if ($this->session->userdata('user_type') == "super_admin") {

			$disbursed = $this->db->get_where('tbl_customers_loan', array())->result_array();
		} else {
			$loginUserId = $this->session->userdata('user_id');
			//$reported_user =  $this->main->repot_user_list($loginUserId);
			$reported_user =  $this->main->repot_user_list_array($loginUserId);

			$this->db->select('*');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

			//	$this->db->where('tbl_customers_loan.loan_status', 'Disbursed');
			$this->db->where_in('tbl_customers_loan.application_user', $reported_user);

			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->result_array();
		}


		foreach ($disbursed as $dAmount) :
			if ($dAmount['loan_status'] == "Disbursed" || $dAmount['loan_status'] == "Loan Topup") {
				$DueEMI = $this->db->get_where('tbl_emi', array('emi_client' => $dAmount['customer_id'], 'emi_loan' => $dAmount['id'], 'emi_status' => '0', 'emi_date' => date('d-m-Y')))->result_array();
				//echo "<pre>"; print_r($DueEMI);
				foreach ($DueEMI as $Due) :
					$emiDate = strtotime($Due['emi_date']);
					$currentDate = strtotime(date('d-m-Y'));
					// if($emiDate<$currentDate)
					//{
					$DueAmount += $Due['emi_amount'];
				//}

				endforeach;
				//$DueEMI+=$DueAmount;
			}
		endforeach;
		return $DueAmount;
	}


	public function dailyPrintOuts()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}

		$this->load->view('dailyPrintOuts');
	}

	public function getDailyPrintOuts()
	{
		//echo "<pre>"; print_r($_POST); die;
		if ($_POST['agent_id'] != "") {
			//	$Clients=$this->db->get_where('tbl_customers_loan', array('collection_user'=>$_POST['agent_id'], 'loan_status'=>'Disbursed'))->result_array();
			$sql = "SELECT `tbl_customers_loan`.*, `tbl_emi`.* FROM `tbl_customers_loan` JOIN `tbl_emi` ON `tbl_emi`.`emi_client` = `tbl_customers_loan`.`customer_id` WHERE `tbl_customers_loan`.`loan_status` = 'Disbursed' AND `tbl_customers_loan`.`collection_user` = '" . $_POST['agent_id'] . "' AND `tbl_emi`.`emi_status` = '0' GROUP BY tbl_emi.emi_loan";
			$Clients = $this->db->query($sql)->result_array();
			// $this->db->select('tbl_customers_loan.*,tbl_emi.*')
			// ->from('tbl_customers_loan')
			// ->join('tbl_emi', 'tbl_emi.emi_client = tbl_customers_loan.customer_id')
			// ->where('tbl_emi.emi_date',$_POST['date'])
			// ->where('tbl_customers_loan.loan_status','Disbursed');
			// $Clients = $this->db->get();
			// echo $this->db->last_query();
			//$Clients->result_array();
		} else {
			//$Clients=$this->db->get_where('tbl_customers_loan', array('loan_status'=>'Disbursed'))->result_array();
			$sql = "SELECT `tbl_customers_loan`.*, `tbl_emi`.* FROM `tbl_customers_loan` JOIN `tbl_emi` ON `tbl_emi`.`emi_client` = `tbl_customers_loan`.`customer_id` WHERE `tbl_customers_loan`.`loan_status` = 'Disbursed' AND `tbl_emi`.`emi_status` = '0' GROUP BY tbl_emi.emi_loan";

			$Clients = $this->db->query($sql)->result_array();
		}
		$i = 0;

		if (!empty($Clients)) {
			foreach ($Clients as $client) :
				$emiDate = strtotime($client['emi_date']);
				$currentDate = strtotime($_POST['date']);
				if ($emiDate <= $currentDate) {
					$ddate = $this->getEmiData($client['customer_id'], $client['id'], $_POST['date']);
					$customer = $this->db->get_where('tbl_customers', array('client_id' => $client['customer_id']))->row_array();
					$i++;
					$dueEMI = $this->getDueEMI($client['customer_id'], $client['id'], $_POST['date']);
					$advanceDueEMI = $this->advanceDueEMI($client['customer_id'], $client['id'], $_POST['date']);
					$advanceDueEMIPaid = $this->advanceDueEMIPaid($client['customer_id'], $client['id'], $_POST['date']);
					$todayEmi = $this->todayEmi($client['customer_id'], $client['id'], $_POST['date']);
					//echo $todayEmi;
					$totalPenalty = $this->totalPenalty($client['customer_id'], $client['id']);
					$paidPenalty = $this->paidPenalty($client['customer_id'], $client['id']);
					$link = base_url() . 'main/ClientView/' . $client['customer_id'];
					$temi = 0;
					if ($dueEMI == 0) {
						$temi = 0;
					} else {
						$temi = ($client["emi_amount"] + $dueEMI);
					}
					$semi = 0;

					$semi = $client["emi_amount"] - ($todayEmi + $advanceDueEMIPaid);
					if ($semi > 0) {
						$semi = $semi;
					} else {
						$semi = 0;
					}
					// <td><a href=".base_url()."main/ClientView/".$data['customer_id'].">".$CustData['client_name']."</a></td>
					$p = $totalPenalty - $paidPenalty;
					if ($semi > 0 || $p > 0) {

						echo ' <tr>					
					  <td>' . $i . '.</td>
					  <td><a href="' . $link . '">' . $client['loan_account'] . '</a></td>
                      <td><a href="' . $link . '">' . $customer["client_name"] . ' <br/> ' . $customer["client_mobile"] . '</a></td>                    
                      <td>' . $customer["client_guarantor"] . ' <br/> ' . $customer["client_gmobile"] . '</td> 
                      <td>' . $client['disbursed_date'] . '</td>
                      <td>&#x20B9; ' . $client["loan_amount"] . '</td>
                      <td>&#x20B9; ' . $semi . '</td>
                      <td>&#x20B9; ' . $dueEMI . '</td>
                      <td>&#x20B9; ' . $temi . '</td>
                      <td>&#x20B9; ' . $advanceDueEMI . '</td>
                      <td>&#x20B9; ' . ($totalPenalty - $paidPenalty) . '</td>                    

                      <td></td>
                    </tr>';
					} else {
						echo '<tr>
			<td colspan="11"><center style="color:red">No Amount Due</center></td>
			</tr>';
					}
				}
			endforeach;
		} else {
			echo '<tr>
			<td colspan="11"><center style="color:red">Customers are not available for selected collection agent</center></td>
			</tr>';
		}
	}
	public function getDailyPrintOutsforPrint()
	{
		//echo "<pre>"; print_r($_POST); die;
		if ($_POST['agent_id'] != "") {
			//	$Clients=$this->db->get_where('tbl_customers_loan', array('collection_user'=>$_POST['agent_id'], 'loan_status'=>'Disbursed'))->result_array();
			$sql = "SELECT `tbl_customers_loan`.*, `tbl_emi`.* FROM `tbl_customers_loan` JOIN `tbl_emi` ON `tbl_emi`.`emi_client` = `tbl_customers_loan`.`customer_id` WHERE `tbl_emi`.`emi_date` = '" . $_POST['date'] . "' AND `tbl_customers_loan`.`loan_status` = 'Disbursed' AND `tbl_customers_loan`.`collection_user` = '" . $_POST['agent_id'] . "' AND `tbl_emi`.`emi_status` = '0'";
			$Clients = $this->db->query($sql)->result_array();
			// $this->db->select('tbl_customers_loan.*,tbl_emi.*')
			// ->from('tbl_customers_loan')
			// ->join('tbl_emi', 'tbl_emi.emi_client = tbl_customers_loan.customer_id')
			// ->where('tbl_emi.emi_date',$_POST['date'])
			// ->where('tbl_customers_loan.loan_status','Disbursed');
			// $Clients = $this->db->get();
			// echo $this->db->last_query();
			//$Clients->result_array();
		} else {
			//$Clients=$this->db->get_where('tbl_customers_loan', array('loan_status'=>'Disbursed'))->result_array();
			$sql = "SELECT `tbl_customers_loan`.*, `tbl_emi`.* FROM `tbl_customers_loan` JOIN `tbl_emi` ON `tbl_emi`.`emi_client` = `tbl_customers_loan`.`customer_id` WHERE `tbl_emi`.`emi_date` = '" . $_POST['date'] . "' AND `tbl_customers_loan`.`loan_status` = 'Disbursed' AND `tbl_emi`.`emi_status` = '0'";
			$Clients = $this->db->query($sql)->result_array();
		}
		$i = 0;

		if (!empty($Clients)) {
			foreach ($Clients as $client) :
				$ddate = $this->getEmiData($client['customer_id'], $client['id'], $_POST['date']);
				$customer = $this->db->get_where('tbl_customers', array('client_id' => $client['customer_id']))->row_array();
				$i++;
				$dueEMI = $this->getDueEMI($client['customer_id'], $client['id'], $_POST['date']);
				$advanceDueEMI = $this->advanceDueEMI($client['customer_id'], $client['id'], $_POST['date']);
				$advanceDueEMIPaid = $this->advanceDueEMIPaid($client['customer_id'], $client['id'], $_POST['date']);
				$todayEmi = $this->todayEmi($client['customer_id'], $client['id'], $_POST['date']);
				//echo $todayEmi;
				$totalPenalty = $this->totalPenalty($client['customer_id'], $client['id']);
				$paidPenalty = $this->paidPenalty($client['customer_id'], $client['id']);
				$link = base_url() . 'main/ClientView/' . $client['customer_id'];
				$temi = 0;
				if ($dueEMI == 0) {
					$temi = 0;
				} else {
					$temi = ($client["emi_amount"] + $dueEMI);
				}
				$semi = 0;

				$semi = $client["emi_amount"] - ($todayEmi + $advanceDueEMIPaid);
				if ($semi > 0) {
					$semi = $semi;
				} else {
					$semi = 0;
				}
				// <td><a href=".base_url()."main/ClientView/".$data['customer_id'].">".$CustData['client_name']."</a></td>
				$p = $totalPenalty - $paidPenalty;
				if ($semi > 0 || $p > 0) {

					echo ' <tr>					
					  <td>' . $i . '.</td>
					  <td>' . $client['loan_account'] . '</td>
                      <td>' . $customer["client_name"] . ' <br/> ' . $customer["client_mobile"] . '</td>                    
                      <td>' . $customer["client_guarantor"] . ' <br/> ' . $customer["client_gmobile"] . '</td> 
                      <td>' . $client['disbursed_date'] . '</td>
                      <td>&#x20B9; ' . $client["loan_amount"] . '</td>
                      <td>&#x20B9; ' . $semi . '</td>
                      <td>&#x20B9; ' . $dueEMI . '</td>
                      <td>&#x20B9; ' . $temi . '</td>
                      <td>&#x20B9; ' . $advanceDueEMI . '</td>
                      <td>&#x20B9; ' . ($totalPenalty - $paidPenalty) . '</td>                    

                      <td></td>
                    </tr>';
				}
			endforeach;
		} else {
			echo '<tr>
			<td colspan="11"><center style="color:red">Customers are not available for selected collection agent</center></td>
			</tr>';
		}
	}
	public function getTotalBranch()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}

		$branch = $this->db->get_where('tbl_branches', array('branch_status' => 1))->num_rows();


		return $branch;
	}
	public function getTotalemp()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		if ($this->session->userdata('user_type') == "super_admin") {
			$emp = $this->db->get_where('tbl_users', array('user_status' => 1))->num_rows();
		} else {
			$emp = $this->db->get_where('tbl_users', array('user_status' => 1, 'user_branch' => $this->session->userdata('user_branch')))->num_rows();
		}
		return $emp;
	}
	public function getTotalPendingLoans()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$this->load->model('main_model', 'main');
		if ($this->session->userdata('user_type') == "super_admin") {

			$disbursed = $this->db->get_where('tbl_customers_loan', array('loan_status=' => 'Pending'))->num_rows();
		} else {
			$loginUserId = $this->session->userdata('user_id');
			//$reported_user =  $this->main->repot_user_list($loginUserId);
			$reported_user =  $this->main->repot_user_list_array($loginUserId);

			$this->db->select('*');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

			$this->db->where('tbl_customers_loan.loan_status', 'Pending');
			$this->db->where_in('tbl_customers_loan.application_user', $reported_user);

			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->num_rows();
		}
		return $disbursed;
	}
	public function getTotalDisbursedLoans()
	{
		//    if(empty($this->session->userdata('user_id'))){
		//     redirect(base_url());
		// }
		// $this->load->model('main_model', 'main');
		// if ($this->session->userdata('user_type') == "admin") {
		// 	$loginUserId = $this->session->userdata('user_id');
		// 	$reported_user =  $this->main->repot_user_list($loginUserId);

		// 	$this->db->select('*');
		// 	$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

		// 	$this->db->where('tbl_customers_loan.loan_status', 'Disbursed');
		// 	$this->db->where('tbl_customers.client_created', $loginUserId);
		// 	$this->db->or_where_in('tbl_customers.client_repoting', $reported_user);

		// 	$query  = $this->db->get('tbl_customers');
		// 	$disbursed = $query->num_rows();
		// } else if ($this->session->userdata('user_type') == "sale") {
		// 	$loginUserId = $this->session->userdata('user_id');
		// 	$reported_user =  $this->main->repot_user_list($loginUserId);

		// 	$this->db->select('*');
		// 	$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

		// 	$this->db->where('tbl_customers_loan.loan_status', 'Disbursed');
		// 	$this->db->where('tbl_customers.client_created', $loginUserId);
		// 	if (isset($reported_user['user_id']) && $reported_user['user_id'])
		// 		$this->db->or_where('tbl_customers.client_created', $reported_user['user_id']);

		// 	$query  = $this->db->get('tbl_customers');
		// 	$disbursed = $query->num_rows();
		// } else {
		// 	$disbursed = $this->db->get_where('tbl_customers_loan', array('loan_status=' => 'Disbursed'))->num_rows();
		// }
		// //$loan=$this->db->get_where('tbl_customers_loan', array('loan_status'=>'Disbursed'))->num_rows();
		// return $disbursed;


		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$this->load->model('main_model', 'main');
		if ($this->session->userdata('user_type') == "super_admin") {

			$disbursed = $this->db->get_where('tbl_customers_loan', array('loan_status=' => 'Disbursed'))->num_rows();
		} else {
			$loginUserId = $this->session->userdata('user_id');
			//$reported_user =  $this->main->repot_user_list($loginUserId);
			$reported_user =  $this->main->repot_user_list_array($loginUserId);

			$this->db->select('*');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

			$this->db->where('tbl_customers_loan.loan_status', 'Disbursed');
			$this->db->where_in('tbl_customers_loan.application_user', $reported_user);

			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->num_rows();
		}
		// $totalRepayment=0;
		// foreach($disbursed as $dAmount):
		// $totalRepayment +=$dAmount['repayment_amount'];
		// endforeach;

		return $disbursed;
	}
	public function getTotalSubmitedLoans()
	{


		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$this->load->model('main_model', 'main');
		if ($this->session->userdata('user_type') == "super_admin") {

			$disbursed = $this->db->get_where('tbl_customers_loan', array('loan_status=' => 'Submitted'))->num_rows();
		} else {
			$loginUserId = $this->session->userdata('user_id');
			//$reported_user =  $this->main->repot_user_list($loginUserId);
			$reported_user =  $this->main->repot_user_list_array($loginUserId);

			$this->db->select('*');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

			$this->db->where('tbl_customers_loan.loan_status', 'Submitted');
			$this->db->where_in('tbl_customers_loan.application_user', $reported_user);

			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->num_rows();
		}
		return $disbursed;
	}

	public function getTotalRejectedLoans()
	{


		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$this->load->model('main_model', 'main');
		if ($this->session->userdata('user_type') == "super_admin") {

			$disbursed = $this->db->get_where('tbl_customers_loan', array('loan_status=' => 'Rejected'))->num_rows();
		} else {
			$loginUserId = $this->session->userdata('user_id');
			//$reported_user =  $this->main->repot_user_list($loginUserId);
			$reported_user =  $this->main->repot_user_list_array($loginUserId);

			$this->db->select('*');
			$this->db->join('tbl_customers_loan', 'tbl_customers_loan.customer_id=tbl_customers.client_id', 'left');

			$this->db->where('tbl_customers_loan.loan_status', 'Rejected');
			$this->db->where_in('tbl_customers_loan.application_user', $reported_user);

			$query  = $this->db->get('tbl_customers');
			$disbursed = $query->num_rows();
		}
		return $disbursed;
	}

	public function getCustomerDetails($atr = "")
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$Details = $this->db->get_where('tbl_customers', array('client_id' => $atr))->row_array();
		return $Details;
	}
	public function getUserDetails($atr = "")
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$userDetails = $this->db->get_where('tbl_users', array('user_id' => $atr))->row_array();
		return $userDetails;
	}
	public function npaReports()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$this->load->view('npaReports');
	}
	public function monthlyReports()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$this->load->view('monthlyReports');
	}

	public function emis()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$output = array();
		$this->load->view('emireport/emis');
	}


	public function get_emi_ajax_list()
	{
		$this->load->model('Emi_model', 'emi');
		$this->load->library('pagination');
		$column_name   = $this->input->get('column_name');
		$date       = $this->input->get('date');
		$sorting_order = $this->input->get('sorting_order');
		$page_limit    = $this->input->get('page_limit');
		$status        = $this->input->get('status');
		$page_no       = $this->input->get('page_no') ? $this->input->get('page_no') : 1;
		$page_no_index = ($page_no - 1) * $page_limit;

		$sQuery = '';

		if ($date) {
			$sQuery = $sQuery . '&keyword=' . $date;
		}

		if ($column_name) {
			$sQuery = $sQuery . '&column_name=' . $column_name;
		}

		if ($sorting_order) {
			$sQuery = $sQuery . '&sorting_order=' . $sorting_order;
		}

		if ($page_limit) {
			$sQuery = $sQuery . '&page_limit=' . $page_limit;
		}
		$searchData['search_index']  = $page_no_index;
		$searchData['limit']         = $page_limit;
		$searchData['date']       = $date;
		$searchData['column_name']   = $column_name;
		$searchData['sorting_order'] = $sorting_order;
		$searchData['status']        = $status;
		$config['base_url']          = site_url('main/get_emi_ajax_list?' . $sQuery);
		$total_rows                  = $this->emi->countAllRecords($searchData);
		$config['total_rows']        = $total_rows;
		$config['per_page']          = $page_limit;

		$this->pagination->initialize($config);
		$paging             = $this->pagination->create_links();
		$records            = $this->emi->getAllRecords($searchData);
		$output['products'] = $records;
		// pr($records);
		$html = $this->load->view('emireport/ajax_list', $output, true);

		$data['success'] = true;
		$data['html']    = $html;
		$data['paging']  = $paging;
		header('Content-Type: application/json');
		echo json_encode($data);
		die;
	}

	public function cashtoday()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$output = array();
		$this->load->view('cashtoday/index');
	}


	public function get_today_cash_ajax_list()
	{
		$this->load->model('Cash_model', 'cash');
		$this->load->library('pagination');
		$column_name   = $this->input->get('column_name');
		$sagent       = $this->input->get('sagent');
		$hidden_start_date = $this->input->get('hidden_start_date');
		$hidden_end_date = $this->input->get('hidden_end_date');
		$sorting_order = $this->input->get('sorting_order');
		$sorting_order = $this->input->get('sorting_order');
		$page_limit    = $this->input->get('page_limit');
		$status        = $this->input->get('status');
		$page_no       = $this->input->get('page_no') ? $this->input->get('page_no') : 1;
		$page_no_index = ($page_no - 1) * $page_limit;

		$sQuery = '';

		if ($sagent) {
			$sQuery = $sQuery . '&sagent=' . $sagent;
		}

		if ($column_name) {
			$sQuery = $sQuery . '&column_name=' . $column_name;
		}

		if ($sorting_order) {
			$sQuery = $sQuery . '&sorting_order=' . $sorting_order;
		}
		if ($hidden_end_date) {
			$sQuery = $sQuery . '&hidden_end_date=' . $hidden_end_date;
		}
		if ($hidden_start_date) {
			$sQuery = $sQuery . '&hidden_start_date=' . $hidden_start_date;
		}

		if ($page_limit) {
			$sQuery = $sQuery . '&page_limit=' . $page_limit;
		}
		$searchData['search_index']  = $page_no_index;
		$searchData['limit']         = $page_limit;
		$searchData['date']       = $date;
		$searchData['column_name']   = $column_name;
		$searchData['sorting_order'] = $sorting_order;
		$searchData['hidden_start_date'] = $hidden_start_date;
		$searchData['hidden_end_date'] = $hidden_end_date;
		$searchData['sagent'] = $sagent;
		$searchData['status']        = $status;
		$config['base_url']          = site_url('main/get_today_cash_ajax_list?' . $sQuery);
		$total_rows                  = $this->cash->countAllRecords($searchData);
		$config['total_rows']        = $total_rows;
		$config['per_page']          = $page_limit;

		$this->pagination->initialize($config);
		$paging             = $this->pagination->create_links();
		$records            = $this->cash->getAllRecords($searchData);
		foreach ($records as $record) {
			$receiving_from = $this->getUserDetails($record->receiving_from);
			$received_by = $this->getUserDetails($record->received_by);
			$record->receiving_from = $receiving_from['user_name'];
			$record->received_by = $received_by['user_name'];
		}
		$output['products'] = $records;
		// pr($records);
		$html = $this->load->view('cashtoday/ajax_list', $output, true);

		$data['success'] = true;
		$data['html']    = $html;
		$data['paging']  = $paging;
		header('Content-Type: application/json');
		echo json_encode($data);
		die;
	}

	public function bank($param = '', $param1 = '', $param2 = '')
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$this->load->model('Bank_model', 'bank');
		$this->load->model('Bank_ledger_model', 'bank_ledger_m');
		if ($param == 'Newbank') {
			$data = array(
				'title' => $this->input->post('title'),
				'number' => $this->input->post('number'),
				//'balance'=>$this->input->post('balance'),
				'status' => 1,
				'auth_id' => $this->session->userdata('user_id'),
				'add_date' => date('Y-m-d')
			);
			$result = $this->bank->add_record($data);
			if ($result > 0) {
				$bank_ledger = array();
				$bank_ledger['bank_id'] = $result;
				$bank_ledger['credit_amt'] = $this->input->post('balance');
				$bank_ledger['debit'] = 0.00;
				$bank_ledger['remark'] = "Balance Added";
				$bank_ledger['add_date'] = date("Y-m-d");
				$this->bank_ledger_m->add_record($bank_ledger);
				$this->session->set_flashdata('success_msg', 'New Branch added successfully');
				redirect(base_url() . 'main/bank', 'refresh');
			} else {
				$this->session->set_flashdata('error_msg', 'Something went wrong, Try again');
				redirect(base_url() . 'main/bank', 'refresh');
			}
		}
		if ($param == 'Status') {
			$status = $param2;
			$id = $param1;
			if ($status == 1) {
				$this->bank->change_status($id, '0');
				$this->session->set_flashdata('BranchInactive_msg', 'Branch Inactive successfully');
				redirect(base_url() . 'main/bank', 'refresh');
			}
			if ($status == 0) {
				$this->bank->change_status($id, '1');
				$this->session->set_flashdata('BranchSuccess_msg', 'Branch Active successfully');
				redirect(base_url() . 'main/bank', 'refresh');
			}
		}
		if ($param == 'Delete') {
			$id = $param1;
			$this->bank->BranchDelete($id);
			$this->session->set_flashdata('BranchSuccess_msg', 'Branch deleted successfully');
			redirect(base_url() . 'main/bank', 'refresh');
		}
		if ($param == 'UpdateBranch') {
			$id = $this->input->post('id');
			$update = array();
			$update['title'] = $this->input->post('title');
			$update['number'] = $this->input->post('number');

			$this->bank->update_record($update, $id);
			$this->session->set_flashdata('BranchSuccess_msg', 'Bank updated successfully');
			redirect(base_url() . 'main/bank', 'refresh');
		}
		$this->load->view('bank');
	}

	public function bank_details($id)
	{
		$output = array();
		$this->load->model('Bank_ledger_model', 'bank_ledger_m');
		$this->load->model('Bank_model', 'bank');
		$records = $this->bank_ledger_m->get_record_by_bank_id($id);
		$credit_amt = $this->bank_ledger_m->get_sum_type($id, 'credit_amt');
		$debit_amt = $this->bank_ledger_m->get_sum_type($id, 'debit');
		$bank_detail = $this->bank->get_record_by_id($id);
		$output['records'] = $records;
		$output['debit_amt'] = $debit_amt;
		$output['credit_amt'] = $credit_amt;
		$output['bank_detail'] = $bank_detail;
		$this->load->view('bankDetails', $output);
	}

	public function change_bank_status($id)
	{
		$this->load->model('Bank_ledger_model', 'bank_ledger_m');
		$update = array();
		$update['received_status'] = 1;

		$this->bank_ledger_m->update_record($update, $id);
		$this->session->set_flashdata('BranchSuccess_msg', 'Bank updated successfully');
		redirect(base_url() . 'main/bank/', 'refresh');
	}

	public function transfer()
	{
		$loan_id = $_GET['loan_id'];
		$this->db->select('*');
		$this->db->select('tbl_customers.*');
		$this->db->where('tbl_customers_loan.loan_status !=', 'Closed');
		$this->db->join('tbl_customers', 'tbl_customers.client_id=tbl_customers_loan.customer_id');
		$query  = $this->db->get('tbl_customers_loan');
		$client = $query->result_array();
		$this->load->view('transfer', compact('client', 'loan_id'));
	}

	public function savetransfer()
	{
		// echo "<pre>($_POST); die;
		$this->db->set('collection_user', $_POST['agent']);
		$this->db->where('id', $_POST['sources']);
		$this->db->update('tbl_customers_loan');
		$this->session->set_flashdata('transfer', 'Employee transfer successfully');
		redirect(base_url() . 'main/transfer', 'refresh');
	}

	public function getLoanAccountAgent()
	{
		$this->db->select('tbl_users.*');
		$this->db->join('tbl_users', 'tbl_customers_loan.collection_user=tbl_users.user_id', 'left');
		$this->db->where('tbl_customers_loan.id', $_POST['loan_account']);
		$query  = $this->db->get('tbl_customers_loan');
		$Clients = $query->row();
		$html = '';

		$html .= '<option value="' . $Clients->user_id . '">' . $Clients->user_name . '</option>';
		//echo $role['role_name'];
		echo $html;
	}

	public function applicationreport()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		if (isset($_POST) && !empty($_POST)) {

			$this->db->select('sum(disbursed_amount) as sum_amount,count(id) as c ');
			$this->db->select('tbl_users.*');
			if ($_POST['agent_id'] != "") {
				$this->db->group_start();
				$this->db->where('tbl_customers_loan.application_user', $_POST['agent_id']);
				$this->db->group_end();
				$this->db->group_start();
				$this->db->or_where('tbl_customers_loan.loan_status', 'Disbursed');
				$this->db->or_where('tbl_customers_loan.loan_status', 'Closed');
				$this->db->group_end();
			} else {

				$this->db->group_start();
				$this->db->where('tbl_customers_loan.loan_status', 'Disbursed');
				$this->db->or_where('tbl_customers_loan.loan_status', 'Closed');
				$this->db->group_end();
			}
			$this->db->where('tbl_customers_loan.add_date >=', $_POST['start']);
			$this->db->where('tbl_customers_loan.add_date <=', $_POST['end']);
			$this->db->join('tbl_users', 'tbl_customers_loan.application_user=tbl_users.user_id');
			$this->db->group_by('application_user');
			$query = $this->db->get('tbl_customers_loan');
			$result = $query->result();
			$sum = 0;
			$c = 1;
			$html = "";
			foreach ($result as $key => $v) {
				//echo "<pre>"; print_r($v);
				$html .= "<tr>
							<td>" . ++$key . "</td>
							<td>" . $v->user_name . "</td>
							<td>" . $v->c . "</td>
							<td>" . $v->sum_amount . "</td>
						</tr>";


				$c++;
			}
			echo $html;
			die;
			//return $result;
		}

		$this->load->view('applicationreport');
	}
	public function collectionreport()
	{
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		if (isset($_POST) && !empty($_POST)) {

			$this->db->select('pay_date,pay_amount ');
			$this->db->select('tbl_users.*');
			if ($_POST['agent_id'] != "") {

				$this->db->where('tbl_payments.pay_agent', $_POST['agent_id']);
			}
			$this->db->join('tbl_users', ' tbl_payments.pay_agent=tbl_users.user_id');
			//$this->db->group_by('pay_agent');
			$query = $this->db->get('tbl_payments');
			$result = $query->result();
			//echo $this->db->last_query();
			$sum = array();
			$c = 1;
			$html = "";
			$agent = array();

			foreach ($result as $key => $v) {
				$pdate = strtotime($v->pay_date);
				$sdate = strtotime($_POST['start']);
				$edate = strtotime($_POST['end']);
				if ($pdate >= $sdate  &&  $pdate <= $edate) {
					$sum[] = $v->pay_amount;
					// if(!in_array($v->user_id,$agent)){
					// $agent[] = $v->user_id;

					// 	$html.="<tr>
					// 			<td>".++$key."</td>
					// 			<td>".$v->user_name."</td>
					// 			<td>".array_sum($sum)."</td>
					// 		</tr>";
					// }

					//echo "<pre>"; print_r($sum);
					$c++;
				}
			}
			foreach ($result as $key => $v) {
				$pdate = strtotime($v->pay_date);
				$sdate = strtotime($_POST['start']);
				$edate = strtotime($_POST['end']);
				if ($pdate >= $sdate  &&  $pdate <= $edate) {
					//$sum[] = $v->pay_amount;						
					if (!in_array($v->user_id, $agent)) {
						$agent[] = $v->user_id;

						$html .= "<tr>
							<td>" . ++$key . "</td>
							<td>" . $v->user_name . "</td>
							<td>" . array_sum($sum) . "</td>
						</tr>";
					}

					//echo "<pre>"; print_r($sum);
					$c++;
				}
			}
			echo $html;
			die;
			//return $result;
		}
		$this->load->view('collectionreport');
	}
	public function interest_report() {
		if (empty($this->session->userdata('user_id'))) {
			redirect(base_url());
		}
		$this->load->model('main_model', 'Main_model');
		if($_GET){
			$start_date = date('d-m-Y',(strtotime($_GET['start_date'])));
			$end_date = date('d-m-Y',(strtotime($_GET['end_date'])));
			$data['data'] = $this->Main_model->vish($start_date,$end_date);
			print_r($data);
			die();
		}
		else{
			$data['data'] = $this->Main_model->vish();
		}
		$this->load->view('vish',compact('data'));
	}
}
