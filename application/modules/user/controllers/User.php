<?php

/* * ************************
  Project Name	: POS
  Created on		: 19 Feb, 2016
  Last Modified 	: 19 Feb, 2016
  Description		: Page contains dashboard related functions.

 * ************************* */
defined('BASEPATH') or exit('No direct script access allowed');

class USER extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->module = "homepage";
        $this->module_label = "Home";
        $this->module_labels = "Home";
        $this->folder = "home/";
        $this->user_folder = "user/";
        $this->login_table = 'users';
        $this->login_history_table = 'login_history';
        $this->user_type_table = 'user_type';
        $this->departments_table = 'departments';
        $this->countries = 'countries';
        $this->states_table = 'states';
        $this->cities_table = 'cities';
        $this->srm_holidays_table = 'srm_holidays';
        $this->default_leftmenus_table = 'default_leftmenus';
        $this->account_history_table = 'account_history';
        $this->email_table = 'email_setting';
        $this->sms_table = 'sms_setting';
        $this->load->helper('smstemplate');
        $this->load->helper('emailtemplate');
        $config = Array(
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );
    }

    /* this method used to show all dashboard all details... */

    function _remap($method, $args) {
        if (method_exists($this, $method)) {
            $this->$method($args);
        } else {
            if ($method !== 'details') {
                $this->index($method, $args);
            } else if ($method == 'details') {
                $this->details($method, $args);
            }
        }
    }

    public function index() {


        $data = array();
        $data['module_label'] = $this->module_label;
        $data['module_labels'] = $this->module_label;
        $data['module'] = $this->module;
        $this->layout->display_frontend($this->folder . 'homepage', $data);
    }

    public function login() {

        $this->form_validation->set_rules('emailaddress', 'Email Address', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . PASSWORD_LENGHT . ']|trim');
        $emailaddress = $this->input->post('emailaddress');
        $password = md5($this->input->post('password'));
        if (empty(get_session_value('user_id'))) {
            if ($this->form_validation->run($this) == TRUE) {

                $userdetails = $this->Mydb->custom_query("select * from $this->login_table where user_email='$emailaddress' and user_pass='$password'");

                if (!empty($userdetails)) {
                    if ($userdetails[0]['status'] == 1) {
                        $user_id = $userdetails[0]['id'];
                        $user_name = $userdetails[0]['user_name'];
                        $user_email = $userdetails[0]['user_email'];
                        $user_mobile = $userdetails[0]['user_mobile'];
                        $user_type_id = $userdetails[0]['user_type_id'];
                        $user_departments_id = $userdetails[0]['user_departments_id'];
                        $user_access_menus_id = $userdetails[0]['user_access_menus_id'];
                        $user_access_menus_details = $userdetails[0]['user_access_menus_details'];
                        $session_datas = array('user_id' => $user_id, 'user_mobile' => $user_mobile, 'user_email' => $user_email, 'user_name' => $user_name, 'user_type_id' => $user_type_id, 'user_departments_id' => $user_departments_id, 'user_access_menus_id' => $user_access_menus_id, 'user_access_menus_details' => $user_access_menus_details);
                        $this->session->set_userdata($session_datas);
                        $this->Mydb->insert($this->login_history_table, array('login_time' => current_date(), 'login_ip' => ip2long(get_ip()), 'user_id' => $user_id));
                        redirect(frontend_url() . 'dashboard');
                    } else {
                        $session_datas = array('pms_err' => '1', 'pms_err_message' => 'Your user details is not active. Contact your reporting person');
                        $this->session->set_userdata($session_datas);
                        redirect(frontend_url());
                    }
                } else {
                    $session_datas = array('pms_err' => '1', 'pms_err_message' => 'Email/Password is not available. Please try again');
                    $this->session->set_userdata($session_datas);
                    redirect(frontend_url());
                }
            } else {
                $session_datas = array('pms_err' => '1', 'pms_err_message' => validation_errors());
                $this->session->set_userdata($session_datas);
                redirect(frontend_url());
            }
        } else {
            redirect(frontend_url() . 'dashboard');
        }
    }

    ########### Forgot Password ... ###########

    function forgot() {
        $this->form_validation->set_rules('user_email', 'Email Address', 'required|trim');
        $user_email = $this->input->post('user_email');
        if (empty(get_session_value('user_id'))) {
            if ($this->form_validation->run($this) == TRUE) {
                $check = $this->Mydb->get_record('user_name, user_email', $this->login_table, array('user_email' => $user_email));
                $user_forgot = md5(uniqid(rand()));
                if (!empty($check)) {
                    $forgot_array = array(
                        'user_forgot' => $user_forgot,
                        'user_forgot_active' => '0'
                    );
                    $this->Mydb->update($this->login_table, array('user_email' => $user_email), $forgot_array);
                    $name = $check['user_name'];
                    $to_email = $check ['user_email'];
                    $link = frontend_url('resetpassword/' . $user_forgot);
                    $response_email = $this->send_forgot_email($name, $to_email, $link);
                    $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Forgot Password Link sent to mail. please check it..', 'validation' => '2');
                    $this->session->set_userdata($session_datas);
                    redirect(frontend_url());
                } else {
                    $session_datas = array('pms_err' => '1', 'pms_err_message' => 'Your email not found data..', 'validation' => '2');
                    $this->session->set_userdata($session_datas);
                    redirect(frontend_url());
                }
            } else {
                $session_datas = array('pms_err' => '1', 'pms_err_message' => validation_errors(), 'validation' => '2');
                $this->session->set_userdata($session_datas);
                redirect(frontend_url());
            }
        } else {
            redirect(frontend_url());
        }
    }

    ########### Reset Password ... ###########

    public function resetpassword($method = null, $args = array()) {
        $data = $this->load_module_info();

        if (empty(get_session_value('user_id'))) {
            if (!empty($method)) {
                $user_forgot = $method[0];
                $check = $this->Mydb->get_record('user_forgot', $this->login_table, array('user_forgot' => $user_forgot));
                if (!empty($check)) {
                    $session_datas = array('user_forgot' => $user_forgot);
                    $this->session->set_userdata($session_datas);
                    redirect(frontend_url() . 'resetpassword');
                } else {
                    $session_datas = array('pms_err' => '1', 'pms_err_message' => 'Forgot Link is not working');
                    $this->session->set_userdata($session_datas);
                    redirect(frontend_url());
                }
            } else {
                if ($this->input->post('resetpassword-submit') == 'Submit') {
                    $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[' . PASSWORD_LENGHT . ']|trim');
                    $this->form_validation->set_rules('comfirm_password', 'Comfirm Password', 'required|min_length[' . PASSWORD_LENGHT . ']|trim|matches[new_password]');
                    $new_password = md5($this->input->post('new_password'));
                    $comfirm_password = md5($this->input->post('comfirm_password'));
                    $user_forgot = $this->input->post('forgot');
                    if ($this->form_validation->run($this) == TRUE) {


                        $this->Mydb->update($this->login_table, array('user_forgot' => $this->input->post('forgot')), array('user_pass' => $new_password, 'user_forgot_active' => '1'));

                        $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Reset password is success. please login here...');
                        $this->session->set_userdata($session_datas);
                        redirect(frontend_url());
                    } else {
                        $session_datas = array('pms_err' => '1', 'pms_err_message' => validation_errors());
                        $this->session->set_userdata($session_datas);
                        redirect(frontend_url() . 'resetpassword');
                    }
                }
            }
            $this->layout->display_frontend($this->folder . 'resetpassword', $data);
        } else {
            redirect(frontend_url());
        }
    }
	
	
	########### Profile Edit ... ###########
	
	public function profile($method = null, $args = array()) {
        $data = $this->load_module_info();
		$id = get_session_value('user_id');
		
		if (!empty($method)) {
			if ($method[0] == 'update'){
				$this->form_validation->set_rules('user_name', 'Name', 'required|trim');
				$this->form_validation->set_rules('user_address', 'Address', 'required');
				$this->form_validation->set_rules('user_dob', 'DOB', 'required');
				$this->form_validation->set_rules('user_country', 'Country', 'required');
				$this->form_validation->set_rules('user_state', 'State', 'required');
				$this->form_validation->set_rules('user_city', 'City', 'required');
				
				$user_name = $this->input->post('user_name');
				$user_address = $this->input->post('user_address');
				$user_dob = $this->input->post('user_dob');
				$user_country = $this->input->post('user_country');
				$user_state = $this->input->post('user_state');
				$user_city = $this->input->post('user_city');
				
				 if ($this->form_validation->run($this) == TRUE) {
					 $update_array = array(
					 	'user_name' => $user_name,
						'user_address' => $user_address,
						'user_dob' => $user_dob,
						'user_country' => $user_country,
						'user_state' => $user_state,
						'user_city' => $user_city,
						'created_ip' => ip2long(get_ip()),
						'created_by' => get_session_value('user_id'),
						'updated_on' => current_date(),
					 );
					 $this->Mydb->update($this->login_table, array('id' => get_session_value('user_id')), $update_array);
					 
					 $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Profile Edit is success', 'user_name' => $user_name);
					 $this->session->set_userdata($session_datas);
					 redirect(frontend_url() . 'profile');
				 }else{
					$session_datas = array('pms_err' => '1', 'pms_err_message' => validation_errors());
					$this->session->set_userdata($session_datas);
					$this->session->set_userdata('validation_errors', validation_errors());
					$this->session->mark_as_flash('validation_errors'); // data will automatically delete themselves after redirect
					$this->session->set_flashdata($this->input->post());
					$this->session->flashdata($this->input->post());
					redirect(frontend_url() . 'profile');
				 }
			}
		}else{
			$data['user'] = $this->Mydb->get_record('*', $this->login_table, array('id' => $id));
			$data['countries'] = $this->Mydb->custom_query("select title,id from $this->countries");
			$data['states'] = $this->Mydb->custom_query("select name,id from $this->states_table where country_id='".$data['user']['user_country']."'");
			$data['cities'] = $this->Mydb->custom_query("select name,id from $this->cities_table where state_id='".$data['user']['user_state']."'");
			$this->layout->display_frontend($this->folder . 'profile-edit', $data);
		}
    }
	
	########### Holidays ... ###########
	
	public function holidays($method = null, $args = array()) {
		$data = $this->load_module_info();
        if (!empty($method)) {
            if ($method[0] == 'add') {
                $data = $this->load_module_info();
                $this->layout->display_frontend($this->folder . 'holidays-add', $data);
            } elseif ($method[0] == 'insert') {
				
				$this->form_validation->set_rules('holiday_date', 'Holiday Date', 'required');
				$this->form_validation->set_rules('holiday_reason', 'Reason', 'required');
				$this->form_validation->set_rules('status', 'Status', 'required');
				
				$holiday_date = $this->input->post('holiday_date');
				$holiday_reason = $this->input->post('holiday_reason');
				$status = $this->input->post('status');
				
				if ($this->form_validation->run($this) == TRUE) {
                	$check = $this->Mydb->get_record('*', $this->srm_holidays_table, array('holiday_date' => $holiday_date));
                	if(!empty($check)){
						$session_datas = array('pms_err' => '1', 'pms_err_message' => 'Holiday date is already exit. please change data');
						$this->session->set_userdata($session_datas);
						redirect(frontend_url() . 'holidays/add');
					}else{
						$insert_array = array(
							'holiday_date' => $holiday_date,
							'holiday_reason' => $holiday_reason,
							'status' => $status,
							'created_by' => get_session_value('user_id'),
							'created_on' => current_date(),
						); 
						$holidays = $this->Mydb->insert($this->srm_holidays_table, $insert_array);
						
						if(!empty($holidays)){
							$session_datas = array('pms_err' => '0', 'pms_err_message' => 'Holidays has been successfully added.. ');
							$this->session->set_userdata($session_datas);
							redirect(frontend_url() . 'holidays/add');
						}else{
							$session_datas = array('pms_err' => '1', 'pms_err_message' => 'Holidays cannot be added. Please try again');
							$this->session->set_userdata($session_datas);
							redirect(frontend_url() . 'departments/add');
						}
					}
                } else {
                    $session_datas = array('pms_err' => '1', 'pms_err_message' => validation_errors());
                    $this->session->set_userdata($session_datas);
                    redirect(frontend_url() . 'holidays/add');
                }
            } else if ($method[0] == 'update') {
				
                $edit_id = $this->input->post('edit_id');
                $holiday_date = $this->input->post('holiday_date');
				$holiday_reason = $this->input->post('holiday_reason');
                $edit_status = $this->input->post('edit_status');
                $update_array = array('holiday_date' => $holiday_date,
							'holiday_reason' => $holiday_reason,
							'status' => $edit_status,
							'created_by' => get_session_value('user_id'),
							'created_on' => current_date());
                
				
				$check = $this->Mydb->get_record('*', $this->srm_holidays_table, array('holiday_date' => $holiday_date, 'id!=' => $edit_id));
				
                if(!empty($check)){
					$response['message'] = "<div class='alert alert-danger'>Your date already exit.</div>";
				}else{
					$updatedetails = $this->Mydb->update($this->srm_holidays_table, array('id' => $edit_id), $update_array);
					
					if ($updatedetails) {
						$response['message'] = "<div class='alert alert-success'>Your details has been successfully updated.</div>";
					} else {
						$response['message'] = "<div class='alert alert-danger'>Your details can't be  updated. please try again</div>";
					}
					
				}
				
                echo json_encode($response);
            }
        } else {
            $data = $this->load_module_info();
            $getholidaysdetails = $this->Mydb->custom_query("select * from $this->srm_holidays_table");
            $data['records'] = $getholidaysdetails;
            $this->layout->display_frontend($this->folder . 'holidays', $data);
        }
    }
	
	########### Holidays Edit ... ###########
	
	public function editholiday() {
        $editid = $this->input->post('edit_id');
        $getholidaydetails = $this->Mydb->custom_query("select holiday_date, holiday_reason,status from $this->srm_holidays_table where id=$editid");
        $data['holiday_date'] = $getholidaydetails[0]['holiday_date'];
		$data['holiday_reason'] = $getholidaydetails[0]['holiday_reason'];
        $data['status'] = $getholidaydetails[0]['status'];
        $data['edit_id'] = $editid;
        $body = $this->load->view($this->folder . 'editholiday', $data);
        echo $body;
    }
	
    public function dashboard() {
        $data = $this->load_module_info();

        $this->layout->display_frontend($this->folder . 'dashboard', $data);
    }

    public function usertype($method = null, $args = array()) {

        if (!empty($method)) {
            if ($method[0] == 'add') {
                $data = $this->load_module_info();

                $this->layout->display_frontend($this->folder . 'usertype-add', $data);
            } elseif ($method[0] == 'insert') {
                $data = $this->load_module_info();
                $this->form_validation->set_rules('use_type_name', 'User Type Name', 'required|trim');
                $this->form_validation->set_rules('type_status', 'Status', 'required');
                $use_type_name = $this->input->post('use_type_name');
                $type_status = $this->input->post('type_status');
                if ($this->form_validation->run($this) == TRUE) {
                    $typeslug = url_title($this->input->post('use_type_name'), '-', TRUE);
                    $getslugdetails = $this->Mydb->custom_query("select type_slug,id,type_name from $this->user_type_table where type_slug='$typeslug'");
                    if (!empty($getslugdetails)) {
                        $randno = rand(2222, 3333);
                        $slugvalue = $use_type_name . '-' . $randno;
                    } else {
                        $slugvalue = $use_type_name;
                    }
                    $insertarray = array('type_name' => $use_type_name, 'type_slug' => $typeslug, 'status' => $type_status, 'created_at' => current_date(), 'created_ip' => ip2long(get_ip()));
                    $usertypeinsertid = $this->Mydb->insert($this->user_type_table, $insertarray);
                    if (!empty($usertypeinsertid)) {
                        $session_datas = array('pms_err' => '0', 'pms_err_message' => 'User type has been successfully added..');
                        $this->session->set_userdata($session_datas);
                        redirect(frontend_url() . 'usertype/add');
                    } else {
                        $session_datas = array('pms_err' => '1', 'pms_err_message' => 'User type cannot be added. Please try again');
                        $this->session->set_userdata($session_datas);
                        redirect(frontend_url() . 'usertype/add');
                    }
                } else {
                    $session_datas = array('pms_err' => '1', 'pms_err_message' => validation_errors());
                    $this->session->set_userdata($session_datas);
                    redirect(frontend_url() . 'usertype/add');
                }
            } else if ($method[0] == 'update') {
                $edit_id = $this->input->post('edit_id');
                $edittype_name = $this->input->post('edittype_name');
                $edit_type_status = $this->input->post('edit_type_status');
                $update_array = array('type_name' => $edittype_name, 'status' => $edit_type_status);
                $updatedetails = $this->Mydb->update($this->user_type_table, array('id' => $edit_id), $update_array);
                if ($updatedetails) {
                    $response['message'] = "<div class='alert alert-success'>Your details has been successfully updated.</div>";
                } else {
                    $response['message'] = "<div class='alert alert-danger'>Your details can't be  updated. please try again</div>";
                }
                echo json_encode($response);
            }
        } else {
            $data = $this->load_module_info();
            $getusertypedetails = $this->Mydb->custom_query("select * from $this->user_type_table");
            $data['records'] = $getusertypedetails;
            $this->layout->display_frontend($this->folder . 'usertype', $data);
        }
    }

    public function departments($method = null, $args = array()) {
        if (!empty($method)) {
            if ($method[0] == 'add'):
                $data = $this->load_module_info();
                $this->layout->display_frontend($this->folder . 'department-add', $data);
            elseif ($method[0] == 'insert'):
                $data = $this->load_module_info();
                $this->form_validation->set_rules('department_name', 'Department Name', 'required|trim');
                $this->form_validation->set_rules('department_status', 'Status', 'required');
                $department_name = $this->input->post('department_name');
                $department_status = $this->input->post('department_status');
                if ($this->form_validation->run($this) == TRUE) :
                    $typeslug = url_title($this->input->post('department_name'), '-', TRUE);
                    $getslugdetails = $this->Mydb->custom_query("select slug,id,name from $this->departments_table where slug='$typeslug'");
                    if (!empty($getslugdetails)):
                        $randno = rand(2222, 3333);
                        $slugvalue = $department_name . '-' . $randno;
                    else:
                        $slugvalue = $department_name;
                    endif;
                    $insertarray = array('name' => $department_name, 'slug' => $typeslug, 'status' => $department_status, 'created_on' => current_date(), 'created_ip' => ip2long(get_ip()));
                    $usertypeinsertid = $this->Mydb->insert($this->departments_table, $insertarray);
                    if (!empty($usertypeinsertid)):
                        $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Department has been successfully added..');
                        $this->session->set_userdata($session_datas);
                        redirect(frontend_url() . 'departments/add');
                    else:
                        $session_datas = array('pms_err' => '1', 'pms_err_message' => 'Department cannot be added. Please try again');
                        $this->session->set_userdata($session_datas);
                        redirect(frontend_url() . 'departments/add');
                    endif;
                else:
                    $session_datas = array('pms_err' => '1', 'pms_err_message' => validation_errors());
                    $this->session->set_userdata($session_datas);
                    redirect(frontend_url() . 'departments/add');
                endif;
            elseif ($method[0] == 'update'):
                $edit_id = $this->input->post('edit_id');
                $editdepart_name = $this->input->post('editdepart_name');
                $edit_depart_status = $this->input->post('edit_depart_status');
                $update_array = array('name' => $editdepart_name, 'status' => $edit_depart_status);
                $updatedetails = $this->Mydb->update($this->departments_table, array('id' => $edit_id), $update_array);
                if ($updatedetails) {
                    $response['message'] = "<div class='alert alert-success'>Your details has been successfully updated.</div>";
                } else {
                    $response['message'] = "<div class='alert alert-danger'>Your details can't be  updated. please try again</div>";
                }
                echo json_encode($response);

            else:
                $data = $this->load_module_info();
                $getdepartmentdetails = $this->Mydb->custom_query("select * from $this->departments_table");
                $data['records'] = $getdepartmentdetails;
                $this->layout->display_frontend($this->folder . 'departments', $data);
            endif;
        }else {
            $data = $this->load_module_info();
            $getdepartmentdetails = $this->Mydb->custom_query("select * from $this->departments_table");
            $data['records'] = $getdepartmentdetails;
            $this->layout->display_frontend($this->folder . 'departments', $data);
        }
    }

    public function editusertype() {
        $editid = $this->input->post('edit_id');
        $getusertypedetails = $this->Mydb->custom_query("select type_name,status from $this->user_type_table where id=$editid");
        $data['typename'] = $getusertypedetails[0]['type_name'];
        $data['status'] = $getusertypedetails[0]['status'];
        $data['edit_id'] = $editid;
        $body = $this->load->view($this->folder . 'ediusertype', $data);
        echo $body;
    }

    public function editdepartment() {
        $editid = $this->input->post('edit_id');
        $getdepartmentdetails = $this->Mydb->custom_query("select name,status from $this->departments_table where id=$editid");
        $data['name'] = $getdepartmentdetails[0]['name'];
        $data['status'] = $getdepartmentdetails[0]['status'];
        $data['edit_id'] = $editid;
        $body = $this->load->view($this->folder . 'editdepartment', $data);
        echo $body;
    }

    public function employee($method = null, $args = array()) {

        if (!empty($method)) {
            if (empty($method[1])) :
                if ($method[0] == 'add'):
                    $data = $this->load_module_info();
                    $data['countries'] = $this->Mydb->custom_query("select title,id from $this->countries");
                    $data['usertype'] = $this->Mydb->custom_query("select type_name,id from $this->user_type_table");
                    $data['departments'] = $this->Mydb->custom_query("select name,id from $this->departments_table");
                    $data['leftmenus'] = $this->Mydb->custom_query("select menu_name,menu_slug,id from $this->default_leftmenus_table where status=1");
                    $this->layout->display_frontend($this->folder . 'employee-add', $data);
                elseif ($method[0] == 'insert'):
                    $this->form_validation->set_rules('employee_name', 'Employee Name', 'required|trim');
                    $this->form_validation->set_rules('employee_email', 'Email', 'required');
                    $this->form_validation->set_rules('employee_pass', 'Password', 'required|trim');
                    $this->form_validation->set_rules('user_type', 'User Type', 'required');
                    $this->form_validation->set_rules('emp_departments', 'Department Type', 'required');
					$this->form_validation->set_rules('emp_mobile', 'Mobile', 'required|trim|callback_phone_exists');
                    $this->form_validation->set_rules('employee_dob', 'DOB', 'required');
                    $this->form_validation->set_rules('emp_country', 'Country', 'required');
                    $this->form_validation->set_rules('emp_state', 'State', 'required');
                    if ($this->form_validation->run($this) == TRUE) :
                        $email = $this->input->post('employee_email');
                        $getemail_already_exist = $this->Mydb->custom_query("select id,user_slug from $this->login_table where user_email='$email'");
                        if (empty($getemail_already_exist)) {
                            $user_slug = url_title($this->input->post('employee_email'), '-', TRUE);
                            $userslug_already_exist = $this->Mydb->custom_query("select id from $this->login_table where user_slug='$user_slug'");
                            if (!empty($userslug_already_exist)) {
                                $randno = rand(2222, 9999);
                                $slugvalue = $user_slug . '-' . $randno;
                            } else {
                                $slugvalue = $user_slug;
                            }
                            $menusid = $this->input->post('emp_accessmenu');
                            $rows = array();
                            $menudetails['menu_details'] = array();
                            for ($i = 0; $i < count($menusid); $i++) {
                                $getmenudetails = $this->Mydb->custom_query("select id,menu_name,menu_slug from $this->default_leftmenus_table where id=$menusid[$i]");
                                $rows['name'] = $getmenudetails[0]['menu_name'];
                                $rows['slug'] = $getmenudetails[0]['menu_slug'];
                                $rows['id'] = $getmenudetails[0]['id'];
                                array_push($menudetails['menu_details'], $rows);
                            }
                            $jsonmenudetails = json_encode($menudetails);
                            $country_id = $this->input->post('emp_country');
                            $state_id = $this->input->post('emp_state');
                            $city_id = $this->input->post('emp_city');
                            $getcountries = $this->Mydb->custom_query("select id,title from $this->countries where id=$country_id");
                            $getstates = $this->Mydb->custom_query("select id,name,slug from $this->states_table where id=$state_id and country_id=$country_id");
                            $getcities = $this->Mydb->custom_query("select id,name,slug from $this->cities_table where id=$city_id");
                            $jsonval['countries'] = array('id' => $getcountries[0]['id'], 'name' => $getcountries[0]['title']);
                            $jsonval['states'] = array('id' => $getstates[0]['id'], 'name' => $getstates[0]['name'], 'slug' => $getstates[0]['slug']);
                            $jsonval['cities'] = array('id' => $getcities[0]['id'], 'name' => $getcities[0]['name'], 'slug' => $getcities[0]['slug']);
                            $jsonvalue = json_encode($jsonval);
                            $insert_array = array('user_type_id' => $this->input->post('user_type'),
                                'user_name' => $this->input->post('employee_name'),
                                'user_pass' => md5($this->input->post('employee_pass')),
                                'user_email' => $this->input->post('employee_email'),
                                'user_slug' => $slugvalue,
                                'user_departments_id' => $this->input->post('emp_departments'),
                                'user_mobile' => $this->input->post('emp_mobile'),
                                'user_address' => $this->input->post('emp_address'),
                                'user_country' => $this->input->post('emp_country'),
                                'user_state' => $this->input->post('emp_state'),
                                'user_city' => $this->input->post('emp_city'),
                                'user_dob' => date('Y-m-d', strtotime($this->input->post('employee_dob'))),
                                'user_details' => $jsonvalue,
                                'user_access_menus_id' => implode(',', $this->input->post('emp_accessmenu')),
                                'user_access_menus_details' => $jsonmenudetails,
                                'created_ip' => ip2long(get_ip()),
                                'created_by' => get_session_value('user_id'),
                                'status' => 0,
                                'created_on' => current_date(),
                            );
                            $insert_id = $this->Mydb->insert($this->login_table, $insert_array);
                            if ($insert_id) {
								$num = $insert_id;
								$user_emp_code = 'SRAM'.sprintf("%'.05d\n", $num);	
								$this->Mydb->update($this->login_table, array('id' => $insert_id), array('user_emp_code' => $user_emp_code));
                                $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Employee details has been successfully inserted');
                                $this->session->set_userdata($session_datas);
                                redirect(frontend_url() . 'employee/add');
                            } else {
                                $session_datas = array('pms_err' => '1', 'pms_err_message' => 'Employee not inserted. Please try again');
                                $this->session->set_userdata($session_datas);
                                redirect(frontend_url() . 'employee/add');
                            }
                        } else {
                            $session_datas = array('pms_err' => '1', 'pms_err_message' => 'Email Already Exists');
                            $this->session->set_userdata($session_datas);
                            redirect(frontend_url() . 'employee/add');
                        }
                    else:
                        $session_datas = array('pms_err' => '1', 'pms_err_message' => validation_errors());
                        $this->session->set_userdata($session_datas);
                        $this->session->set_userdata('validation_errors', validation_errors());
                        $this->session->mark_as_flash('validation_errors'); // data will automatically delete themselves after redirect
                        $this->session->set_flashdata($this->input->post());
                        $this->session->flashdata($this->input->post());
                        redirect(frontend_url() . 'employee/add');
                    endif;
                elseif ($method[0] == 'update'):
                    $employee_id = $this->input->post('emp_id');
                    $user_slug = url_title($this->input->post('employee_email'), '-', TRUE);
                    $userslug_already_exist = $this->Mydb->custom_query("select id from $this->login_table where user_slug='$user_slug' and id<>'$employee_id'");
                    if (!empty($userslug_already_exist)) {
                        $randno = rand(2222, 9999);
                        $slugvalue = $user_slug . '-' . $randno;
                    } else {
                        $slugvalue = $user_slug;
                    }
					$this->form_validation->set_rules('employee_name', 'Employee Name', 'required|trim');
                    $this->form_validation->set_rules('employee_email', 'Email', 'required');
                    $this->form_validation->set_rules('user_type', 'User Type', 'required');
                    $this->form_validation->set_rules('emp_departments', 'Department Type', 'required');
					$this->form_validation->set_rules('emp_mobile', 'Mobile', 'required|trim|callback_phone_exists');
                    $this->form_validation->set_rules('employee_dob', 'DOB', 'required');
                    $this->form_validation->set_rules('emp_country', 'Country', 'required');
                    $this->form_validation->set_rules('emp_state', 'State', 'required');
					
                    if ($this->form_validation->run($this) == TRUE){
					
						$country_id = $this->input->post('emp_country');
						$state_id = $this->input->post('emp_state');
						$city_id = $this->input->post('emp_city');
						$getcountries = $this->Mydb->custom_query("select id,title from $this->countries where id=$country_id");
						$getstates = $this->Mydb->custom_query("select id,name,slug from $this->states_table where id=$country_id");
						$getcities = $this->Mydb->custom_query("select id,name,slug from $this->cities_table where id=$country_id");
						$jsonval['countries'] = array('id' => $getcountries[0]['id'], 'name' => $getcountries[0]['title']);
						$jsonval['states'] = array('id' => $getstates[0]['id'], 'name' => $getstates[0]['name'], 'slug' => $getstates[0]['slug']);
						$jsonval['cities'] = array('id' => $getcities[0]['id'], 'name' => $getcities[0]['name'], 'slug' => $getcities[0]['slug']);
						$jsonvalue = json_encode($jsonval);
						$menusid = $this->input->post('emp_accessmenu');
						$rows = array();
						$menudetails['menu_details'] = array();
						for ($i = 0; $i < count($menusid); $i++) {
							$getmenudetails = $this->Mydb->custom_query("select id,menu_name,menu_slug from $this->default_leftmenus_table where id=$menusid[$i]");
							$rows['name'] = $getmenudetails[0]['menu_name'];
							$rows['slug'] = $getmenudetails[0]['menu_slug'];
							$rows['id'] = $getmenudetails[0]['id'];
							array_push($menudetails['menu_details'], $rows);
						}
						$jsonmenudetails = json_encode($menudetails);
						$update_array = array('user_type_id' => $this->input->post('user_type'),
							'user_name' => $this->input->post('employee_name'),
							'user_email' => $this->input->post('employee_email'),
							'user_slug' => $slugvalue,
							'user_departments_id' => $this->input->post('emp_departments'),
							'user_mobile' => $this->input->post('emp_mobile'),
							'user_address' => $this->input->post('emp_address'),
							'user_country' => $this->input->post('emp_country'),
							'user_state' => $this->input->post('emp_state'),
							'user_city' => $this->input->post('emp_city'),
							'user_dob' => date('Y-m-d', strtotime($this->input->post('employee_dob'))),
							'user_details' => $jsonvalue,
							'user_access_menus_id' => implode(',', $this->input->post('emp_accessmenu')),
							'user_access_menus_details' => $jsonmenudetails,
							'created_ip' => ip2long(get_ip()),
							'created_by' => get_session_value('user_id'),
							'status' => 0,
							'created_on' => current_date(),
						);
						$update_id = $this->Mydb->update($this->login_table, array('id' => $employee_id), $update_array);
						if ($update_id) {
							$session_datas = array('pms_err' => '0', 'pms_err_message' => 'Employee details has been successfully inserted');
							$this->session->set_userdata($session_datas);
							redirect(frontend_url() . 'employee');
						} else {
							$session_datas = array('pms_err' => '1', 'pms_err_message' => 'Employee not update. Please try again');
							$this->session->set_userdata($session_datas);
							redirect(frontend_url() . 'employee/edit/'.encode_value($employee_id));
						}
					}else{
						$session_datas = array('pms_err' => '1', 'pms_err_message' => validation_errors());
                        $this->session->set_userdata($session_datas);
                        $this->session->set_userdata('validation_errors', validation_errors());
                        $this->session->mark_as_flash('validation_errors'); // data will automatically delete themselves after redirect
                        $this->session->set_flashdata($this->input->post());
                        $this->session->flashdata($this->input->post());
                        redirect(frontend_url() . 'employee/edit/'.encode_value($employee_id));
					}
                endif;

            else:
                $edit_id = decode_value($method[1]);
                $getuserdetails = $this->Mydb->custom_query("select * from $this->login_table where id=$edit_id");
                $data['records'] = $getuserdetails;
                $country_id = $getuserdetails[0]['user_country'];
                $state_id = $getuserdetails[0]['user_state'];
                $city_id = $getuserdetails[0]['user_city'];
                $getcountrydetails = $this->Mydb->custom_query("select id,title from $this->countries where is_active=1");
                $getstatedetails = $this->Mydb->custom_query("select id,name from $this->states_table where is_active=1 and country_id=$country_id");
                $getcitydetails = $this->Mydb->custom_query("select id,name from $this->cities_table where is_active=1 and country_id=$country_id and state_id=$state_id");
                $getusertypedetails = $this->Mydb->custom_query("select id,type_name from $this->user_type_table where status=1");
                $getdepartmentdetails = $this->Mydb->custom_query("select id,name from $this->departments_table where status=1");
                $getmenudetails = $this->Mydb->custom_query("select menu_name,menu_slug,id from $this->default_leftmenus_table where status=1");
                $data['country_details'] = $getcountrydetails;
                $data['state_details'] = $getstatedetails;
                $data['city_details'] = $getcitydetails;
                $data['usertype_details'] = $getusertypedetails;
                $data['department_details'] = $getdepartmentdetails;
                $data['menu_details'] = $getmenudetails;
                $this->layout->display_frontend($this->folder . 'editemployee', $data);
            endif;
        } else {
            if (isset($_SESSION['user_departments_id'])):
                if ($_SESSION['user_departments_id'] == 9999):
                    $where = '';
                else:
                    $user_departments_id = $_SESSION['user_departments_id'];
                    $where = " AND user_departments_id=$user_departments_id";
                endif;
            else:
                $where = '';
            endif;
            $data = $this->load_module_info();
            $getemployeedetails = $this->Mydb->custom_query("select t1.*,t2.name as department_name,t3.type_name as usertype_name  from $this->login_table as t1 LEFT JOIN $this->departments_table t2 ON t2.id=t1.user_departments_id LEFT JOIN $this->user_type_table t3 ON t3.id=t1.user_type_id where t1.status<>3 and user_departments_id<>9999 $where");
            $data['records'] = $getemployeedetails;
            $this->layout->display_frontend($this->folder . 'employee', $data);
        }
    }
	
	
	
	########### Phone Check ... ###########

    public function phone_exists() {
        $user_mobile = $this->input->post('emp_mobile');
        $id = $this->input->post('emp_id');
		$where = array(
            'user_mobile' => trim($user_mobile),
        );
        if ($id != "") {
            $where = array_merge($where, array(
                "id !=" => $id
            ));
        }
		
		$result = $this->Mydb->get_record('user_mobile', $this->login_table, $where);
		if (!empty($result)) {
            $this->form_validation->set_message('phone_exists', 'Mobile Number Already Exit.');
            return false;
        } else {
            return true;
        }
        
    }
	
//    public function calculatehours() {
//       
//    }

    public function activate() {
        $activate_id = $this->input->post('activate_id');
        $activate_table = $this->input->post('activate_table');
        $status = $this->input->post('status');
        $update_array = array('status' => $status);
        $activatedetails = $this->Mydb->update_where_in($activate_table, 'id', $activate_id, $update_array);
        if ($activatedetails) {
            $response['message'] = "<div class='alert alert-success'>Your request has been successfully changed</div>";
        } else {
            $response['message'] = "<div class='alert alert-danger'>Your request can't be changed. Please try again</div>";
        }
        echo json_encode($response);
    }

    public function calculatehours() {
        $startdate = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $getholidays = $this->Mydb->custom_query("select holiday_date from $this->srm_holidays_table where status=1");
        $holidays = array();
        if (!empty($getholidays)) {
            foreach ($getholidays as $srmholiday):
                $holidays[] = $srmholiday['holiday_date'];
            endforeach;
        }else {
            $holidays[] = '';
        }
        $start = new DateTime($startdate);
        $end = new DateTime($end_date);
// otherwise the  end date is excluded (bug?)
        $end->modify('+1 day');

        $interval = $end->diff($start);

// total days
        $days = $interval->days;

// create an iterateable period of date (P1D equates to 1 day)
        $period = new DatePeriod($start, new DateInterval('P1D'), $end);

// best stored as array, so you can add more than one


        foreach ($period as $dt) {
            $curr = $dt->format('D');
//            echo $curr;
// substract if Saturday or Sunday
            if ($curr == 'Sun') {
                $days--;
            }

// (optional) for the updated question
            elseif (in_array($dt->format('Y-m-d'), $holidays)) {
                $days--;
            }
        }

        $officehours = 9;
        $total_hours['total_hours'] = $days * $officehours;
        echo json_encode($total_hours);
    }

########### Change Password ... ###########

    public function changepassword($method = null, $args = array()) {
        $id = get_session_value('user_id');
        if ($this->input->post('changepassword-submit') == 'Submit') {

            $this->form_validation->set_rules('old_password', 'Old Password', 'required|min_length[' . PASSWORD_LENGHT . ']|trim|callback_oldpasswordcheck');
            $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[' . PASSWORD_LENGHT . ']|trim');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|min_length[' . PASSWORD_LENGHT . ']|trim|matches[new_password]');

            $old_password = md5($this->input->post('old_password'));
            $new_password = md5($this->input->post('new_password'));
            $confirm_password = md5($this->input->post('confirm_password'));

            if ($this->form_validation->run($this) == TRUE) {

                $selectpass = $this->Mydb->get_record('user_pass', $this->login_table, array('id' => $id, 'user_pass' => md5($this->input->post('new_password'))));
                $new_password = md5($this->input->post('new_password'));
                if (!empty($selectpass)) {
                    $session_datas = array('pms_err' => '1', 'pms_err_message' => 'Your old password and current password is same. please change password');
                    $this->session->set_userdata($session_datas);
                    redirect(frontend_url() . 'changepassword');
                } else {
                    $this->Mydb->update($this->login_table, array('id' => $id), array('user_pass' => $new_password));
                    $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Your passowrd has been changed success. Please login again');
                    $this->session->sess_destroy();
                    redirect(BASE_URL());
                }
            } else {
                $session_datas = array('pms_err' => '1', 'pms_err_message' => validation_errors());
                $this->session->set_userdata($session_datas);
                $this->session->set_userdata('validation_errors', validation_errors());
                $this->session->mark_as_flash('validation_errors'); // data will automatically delete themselves after redirect
                $this->session->set_flashdata($this->input->post());
                $this->session->flashdata($this->input->post());
                redirect(frontend_url() . 'changepassword');
            }
        } else {
            $data = $this->load_module_info();
            $this->layout->display_frontend($this->folder . 'changepassword', $data);
        }
    }

    ########### Old password Check ... ###########

    public function oldpasswordcheck() {
        $old_password = md5($this->input->post('old_password'));
        $id = get_session_value('user_id');
        $check_details = $this->Mydb->get_record('user_pass', $this->login_table, array('id' => $id));
        if (!empty($check_details)) {

            if ($old_password == $check_details['user_pass']) {
                return true;
            } else {
                $this->form_validation->set_message('oldpasswordcheck', 'Old Password Miss Match');
                return false;
            }
        }
    }

    ########### Email Change ... ###########

    public function emailchange($method = null, $args = array()) {
        $data = $this->load_module_info();
        $id = get_session_value('user_id');

        if ($this->input->post('emailchange-submit') == 'Submit') {

            $this->form_validation->set_rules('old_email', 'Old Email Address', 'required|callback_oldemailcheck');
            $this->form_validation->set_rules('new_email', 'New Email Address', 'required');
            $this->form_validation->set_rules('comfirm_email', 'Confirm Email Address', 'required|matches[new_email]');

            $old_email = $this->input->post('old_email');
            $new_email = $this->input->post('new_email');
            $comfirm_email = $this->input->post('comfirm_email');

            if ($this->form_validation->run($this) == TRUE) {

                $selectemail = $this->Mydb->get_record('user_email', $this->login_table, array('id' => $id, 'user_email' => $this->input->post('new_email')));
                $new_email = $this->input->post('new_email');
                if (!empty($selectemail)) {
                    $session_datas = array('pms_err' => '1', 'pms_err_message' => 'Your old email and current email address is same. please change email address');
                    $this->session->set_userdata($session_datas);
                } else {
                    $check = $this->Mydb->get_record('*', $this->account_history_table, array('user_id' => $id, 'old_one' => $this->input->post('old_email'), 'status' => '0'));

                    if (!empty($check)) {
                        $email_array = array(
                            'activation_key' => md5(uniqid(rand())),
                            'new_one' => $new_email,
                            'created_on' => current_date(),
                            'expiry_datetime' => current_date(),
                            'created_ip' => ip2long(get_ip()),
                            'status' => '0'
                        );
                        $this->Mydb->update($this->account_history_table, array('id' => $check['id'], 'user_id' => $id, 'status' => '0'), $email_array);
                        $email_check = $this->Mydb->custom_query("SELECT h.new_one, h.activation_key, u.user_name FROM $this->account_history_table AS h
						JOIN $this->login_table AS u ON u.id = h.user_id
						WHERE h.old_one = '" . $old_email . "' AND h.user_id = '" . get_session_value('user_id') . "' AND  h.change_type = '1' AND h.status='0'");

                        $name = $email_check[0]['user_name'];
                        $activation_link = frontend_url('emailactivation/' . $email_check[0]['activation_key']);
                        $to_email = $email_check[0]['new_one'];
                        $response_email = $this->send_activation_email($name, $to_email, $activation_link);
                        $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Email Activation Link sent to mail. please check it..');
                        $this->session->set_userdata($session_datas);
                        redirect(frontend_url() . 'emailchange');
                    } else {
                        $email_array = array(
                            'user_id' => get_session_value('user_id'),
                            'change_type' => '1',
                            'activation_key' => md5(uniqid(rand())),
                            'new_one' => $new_email,
                            'old_one' => $old_email,
                            'created_on' => current_date(),
                            'expiry_datetime' => current_date(),
                            'created_ip' => ip2long(get_ip()),
                            'status' => '0'
                        );
                        $this->Mydb->insert($this->account_history_table, $email_array);
                        $email_check = $this->Mydb->custom_query("SELECT h.new_one, h.activation_key, u.user_name FROM $this->account_history_table AS h
						JOIN $this->login_table AS u ON u.id = h.user_id
						WHERE h.old_one = '" . $old_email . "' AND h.user_id = '" . get_session_value('user_id') . "' AND  h.change_type = '1' AND h.status='0'");

                        $name = $email_check[0]['user_name'];
                        $activation_link = frontend_url('emailactivation/' . $email_check[0]['activation_key']);
                        $to_email = $email_check[0]['new_one'];
                        $response_email = $this->send_activation_email($name, $to_email, $activation_link);
                        $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Email Activation Link sent to mail. please check it..');
                        $this->session->set_userdata($session_datas);
                        redirect(frontend_url() . 'emailchange');
                    }
                }
            } else {
                $session_datas = array('pms_err' => '1', 'pms_err_message' => validation_errors());
                $this->session->set_userdata($session_datas);
                $this->session->set_userdata('validation_errors', validation_errors());
                $this->session->mark_as_flash('validation_errors'); // data will automatically delete themselves after redirect
                $this->session->set_flashdata($this->input->post());
                $this->session->flashdata($this->input->post());
                redirect(frontend_url() . 'emailchange');
            }
        }

        $this->layout->display_frontend($this->folder . 'emailchange', $data);
    }

    ########### Old Email Check ... ###########

    public function oldemailcheck() {
        $old_email = $this->input->post('old_email');
        $id = get_session_value('user_id');
        $check_details = $this->Mydb->get_record('user_email', $this->login_table, array('id' => $id));
        if (!empty($check_details)) {

            if ($old_email == $check_details['user_email']) {
                return true;
            } else {
                $this->form_validation->set_message('oldemailcheck', 'Old Email Miss Match');
                return false;
            }
        }
    }

    ########### Email Activation ... ###########

    public function emailactivation($method = null, $args = array()) {
        $data = $this->load_module_info();
        $id = get_session_value('user_id');
        if (!empty($method)) {
            $active_key = $method[0];
            $check = $this->Mydb->get_record('*', $this->account_history_table, array('user_id' => $id, 'activation_key' => $active_key, 'status' => '0'));
            if (!empty($check)) {
                $email_array = array(
                    'created_on' => current_date(),
                    'expiry_datetime' => current_date(),
                    'created_ip' => ip2long(get_ip()),
                    'status' => '1'
                );
                $this->Mydb->update($this->account_history_table, array('id' => $check['id'], 'user_id' => $id), $email_array);
                $this->Mydb->update($this->login_table, array('id' => $id, 'user_email' => $check['old_one']), array('user_email' => $check['new_one']));
                $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Your Email Address Change Successfully.', 'user_email' => $check['new_one']);

                $this->session->set_userdata($session_datas);
                redirect(frontend_url() . 'emailactivation');
            } else {

                $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Email Address is not changed');
                $this->session->set_userdata($session_datas);
                redirect(frontend_url() . 'emailactivation');
            }
        }
        $this->layout->display_frontend($this->folder . 'emailactivation', $data);
    }

    ########### Mobile Change ... ###########

    public function mobilechange($method = null, $args = array()) {
        $data = $this->load_module_info();
        $id = get_session_value('user_id');


        if ($this->input->post('mobilechange-submit') == 'Submit') {
            $this->form_validation->set_rules('old_mobile', 'Old Mobile', 'required|min_length[' . PASSWORD_LENGHT . ']|trim|callback_oldmobilecheck');
            $this->form_validation->set_rules('new_mobile', 'New Mobile', 'required|min_length[' . PASSWORD_LENGHT . ']|trim');
            $this->form_validation->set_rules('confirm_mobile', 'Confirm Mobile', 'required|min_length[' . PASSWORD_LENGHT . ']|trim|matches[new_mobile]');

            $old_mobile = $this->input->post('old_mobile');
            $new_mobile = $this->input->post('new_mobile');
            $confirm_mobile = $this->input->post('confirm_mobile');

            if ($this->form_validation->run($this) == TRUE) {
                $selectmobile = $this->Mydb->get_record('user_mobile', $this->login_table, array('id' => $id, 'user_mobile' => $this->input->post('new_mobile')));
                $new_mobile = $this->input->post('new_mobile');
                if (!empty($selectmobile)) {
                    $session_datas = array('pms_err' => '1', 'pms_err_message' => 'Your old mobile and current mobile is same. please change mobile');
                    $this->session->set_userdata($session_datas);
                    redirect(frontend_url() . 'mobilechange');
                } else {
                    $check = $this->Mydb->get_record('*', $this->account_history_table, array('user_id' => $id, 'old_one' => $this->input->post('old_mobile'), 'status' => '0'));

                    if (!empty($check)) {
                        $mobile_array = array(
                            'activation_key' => random_string('numeric', 6),
                            'new_one' => $new_mobile,
                            'created_on' => current_date(),
                            'expiry_datetime' => current_date(),
                            'created_ip' => ip2long(get_ip()),
                            'status' => '0'
                        );
                        $this->Mydb->update($this->account_history_table, array('id' => $check['id'], 'user_id' => $id, 'status' => '0'), $mobile_array);
                        $mobile_check = $this->Mydb->custom_query("SELECT h.new_one, h.activation_key, u.user_country, c.phonecode FROM $this->account_history_table AS h
						JOIN $this->login_table AS u ON u.id = h.user_id
						JOIN $this->countries AS c ON c.id = u.user_country
						WHERE h.old_one = '" . $old_mobile . "' AND h.user_id = '" . get_session_value('user_id') . "' AND  h.change_type = '2' AND h.status='0'");
                        $sms_phone_otp = $mobile_check[0]['activation_key'];
                        $sms_phone = $mobile_check[0]['new_one'];
                        $sms_country_code = $mobile_check[0]['user_country'];

                        $response_sms = $this->sms_user_active($sms_phone_otp, $sms_phone, $sms_country_code);

                        $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Activation OTP sent to mobile please check it', 'mobile' => $mobile_check[0]['new_one']);
                        $this->session->set_userdata($session_datas);

                        redirect(frontend_url() . 'mobilechange');
                    } else {
                        $mobile_array = array(
                            'user_id' => get_session_value('user_id'),
                            'change_type' => '2',
                            'activation_key' => random_string('numeric', 6),
                            'new_one' => $new_mobile,
                            'old_one' => $old_mobile,
                            'created_on' => current_date(),
                            'expiry_datetime' => current_date(),
                            'created_ip' => ip2long(get_ip()),
                            'status' => '0'
                        );
                        $this->Mydb->insert($this->account_history_table, $mobile_array);
                        $mobile_check = $this->Mydb->custom_query("SELECT h.new_one, h.activation_key, u.user_country, c.phonecode FROM $this->account_history_table AS h
						JOIN $this->login_table AS u ON u.id = h.user_id
						JOIN $this->countries AS c ON c.id = u.user_country
						WHERE h.old_one = '" . $old_mobile . "' AND h.user_id = '" . get_session_value('user_id') . "' AND  h.change_type = '2' AND h.status='0'");
                        $sms_phone_otp = $mobile_check[0]['activation_key'];
                        $sms_phone = $mobile_check[0]['new_one'];
                        $sms_country_code = $mobile_check[0]['user_country'];
                        $response_sms = $this->sms_user_active($sms_phone_otp, $sms_phone, $sms_country_code);

                        $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Activation OTP sent to mobile please check it', 'mobile' => $mobile_check[0]['new_one']);

                        $this->session->set_userdata($session_datas);
                        redirect(frontend_url() . 'mobilechange');
                    }
                }
            } else {
                $session_datas = array('pms_err' => '1', 'pms_err_message' => validation_errors());
                $this->session->set_userdata($session_datas);
                $this->session->set_userdata('validation_errors', validation_errors());
                $this->session->mark_as_flash('validation_errors'); // data will automatically delete themselves after redirect
                $this->session->set_flashdata($this->input->post());
                $this->session->flashdata($this->input->post());
                redirect(frontend_url() . 'mobilechange');
            }
        } elseif ($this->input->post('mobilechange-otp') == 'Submit OTP') {

            $this->form_validation->set_rules('otp', 'OTP Code', 'required|min_length[' . PASSWORD_LENGHT . ']|trim');
            $otp = $this->input->post('otp');
            if ($this->form_validation->run($this) == TRUE) {
                $check = $this->Mydb->get_record('*', $this->account_history_table, array('user_id' => $id, 'change_type' => '2', 'activation_key' => $otp, 'status' => '0'));
                if (!empty($check)) {
                    $mobile_array = array(
                        'created_on' => current_date(),
                        'expiry_datetime' => current_date(),
                        'created_ip' => ip2long(get_ip()),
                        'status' => '1'
                    );
                    $this->Mydb->update($this->account_history_table, array('id' => $check['id'], 'user_id' => $id), $mobile_array);
                    $this->Mydb->update($this->login_table, array('id' => $id, 'user_mobile' => $check['old_one']), array('user_mobile' => $check['new_one']));
                    $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Your Mobile Number Change Successfully.', 'user_mobile' => $check['new_one']);

                    $this->session->set_userdata($session_datas);
                    redirect(frontend_url() . 'mobilechange');
                } else {
                    $session_datas = array('pms_err' => '1', 'pms_err_message' => 'Your OTP Code does not match. please correct otp.');
                    $this->session->set_userdata($session_datas);
                    redirect(frontend_url() . 'mobilechange');
                }
            } else {
                $session_datas = array('pms_err' => '1', 'pms_err_message' => validation_errors());
                $this->session->set_userdata($session_datas);
                $this->session->set_userdata('validation_errors', validation_errors());
                $this->session->mark_as_flash('validation_errors'); // data will automatically delete themselves after redirect
                $this->session->set_flashdata($this->input->post());
                $this->session->flashdata($this->input->post());
                redirect(frontend_url() . 'mobilechange');
            }
        } elseif ($this->input->post('mobilechange-resend') == 'Resend OTP') {
            $check = $this->Mydb->get_record('*', $this->account_history_table, array('user_id' => $id, 'old_one' => $this->input->post('user_mobile'), 'new_one' => $this->input->post('resend_mobile'), 'status' => '0'));
            if (!empty($check)) {
                $mobile_array = array(
                    'activation_key' => random_string('numeric', 6),
                    'created_on' => current_date(),
                    'expiry_datetime' => current_date(),
                    'created_ip' => ip2long(get_ip()),
                    'status' => '0'
                );
                $this->Mydb->update($this->account_history_table, array('id' => $check['id'], 'user_id' => $id), $mobile_array);
                $mobile_check = $this->Mydb->custom_query("SELECT h.new_one, h.activation_key, u.user_country, c.phonecode FROM $this->account_history_table AS h
				JOIN $this->login_table AS u ON u.id = h.user_id
				JOIN $this->countries AS c ON c.id = u.user_country
				WHERE h.old_one = '" . $this->input->post('user_mobile') . "' AND h.user_id = '" . get_session_value('user_id') . "' AND  h.change_type = '2' AND h.status='0'");

                $sms_phone_otp = $mobile_check[0]['activation_key'];
                $sms_phone = $mobile_check[0]['new_one'];
                $sms_country_code = $mobile_check[0]['user_country'];

                $response_sms = $this->sms_user_active($sms_phone_otp, $sms_phone, $sms_country_code);

                $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Resend OTP sent to mobile please check it', 'mobile' => $mobile_check[0]['new_one']);
                $this->session->set_userdata($session_datas);
                redirect(frontend_url() . 'mobilechange');
            } else {
                $session_datas = array('pms_err' => '1', 'pms_err_message' => 'Not resend OTP');
                $this->session->set_userdata($session_datas);
                redirect(frontend_url() . 'mobilechange');
            }
        }

        $this->layout->display_frontend($this->folder . 'mobilechange', $data);
    }

    ########### Old Mobile Check ... ###########

    public function oldmobilecheck() {
        $old_mobile = $this->input->post('old_mobile');
        $id = get_session_value('user_id');
        $check_details = $this->Mydb->get_record('user_mobile', $this->login_table, array('id' => $id));
        if (!empty($check_details)) {

            if ($old_mobile == $check_details['user_mobile']) {
                return true;
            } else {
                $this->form_validation->set_message('oldmobilecheck', 'Old Mobile Miss Match');
                return false;
            }
        }
    }

    ########### SMS User Active ... ###########

    public function sms_user_active($sms_phone_otp, $sms_phone, $sms_country_code) {

        $sms_chk_arr = array('[MOBILE_OTP]');
        $sms_rep_arr = array($sms_phone_otp);
        $response_sms = send_sms($sms_template_slug = "user-mobile-active", $sms_chk_arr, $sms_rep_arr, $sms_phone, $sms_country_code);
        return $response_sms;
    }

    ########### SMS Resend ... ###########

    public function sms_resend($sms_phone_otp, $sms_phone, $sms_country_code) {

        $sms_chk_arr = array('[MOBILE_OTP]');
        $sms_rep_arr = array($sms_phone_otp);
        $response_sms = send_sms($sms_template_slug = "resend-otp-sms", $sms_chk_arr, $sms_rep_arr, $sms_phone, $sms_country_code);
        return $response_sms;
    }

    ########### Email Active ... ###########

    public function send_activation_email($name, $to_email, $activation_link) {

        $chk_arr = array('[NAME]', '[ACTIVATIONLINK]');
        $rep_arr = array($name, $activation_link);
        $response_email = send_email($to_email, $template_slug = "user-account-activation", $chk_arr, $rep_arr, $attach_file = array(), $path = '', $subject = '', $cc = '', $html_template = 'electtv_email_template');
        return $response_email;
    }

    ########### Email Forgot ... ###########

    public function send_forgot_email($name, $to_email, $link) {

        $chk_arr = array('[NAME]', '[LINK]');
        $rep_arr = array($name, $link);
        $response_email = send_email($to_email, $template_slug = "forgot-password", $chk_arr, $rep_arr, $attach_file = array(), $path = '', $subject = '', $cc = '', $html_template = 'electtv_email_template');
        return $response_email;
    }

    ########### SMS Setting ... ###########

    public function smssetting($method = null, $args = array()) {
        if (!empty($method)) {
            if ($method[0] == 'add'):
                $data = $this->load_module_info();
                $this->layout->display_frontend($this->folder . 'smssetting-add', $data);
            elseif ($method[0] == 'insert'):
                $data = $this->load_module_info();

                $this->form_validation->set_rules('sms_name', 'Sms Name', 'required|trim');
                $this->form_validation->set_rules('sms_template', 'Sms Template', 'required|trim');
                $this->form_validation->set_rules('sms_variable', 'Sms Variable', 'required|trim');
                $this->form_validation->set_rules('sms_status', 'Status', 'required');



                $sms_name = $this->input->post('sms_name');
                $sms_template = $this->input->post('sms_template');
                $sms_variable = $this->input->post('sms_variable');
                $sms_status = $this->input->post('sms_status');
                if ($this->form_validation->run($this) == TRUE) {
                    $typeslug = url_title($this->input->post('sms_name'), '-', TRUE);

                    $insertarray = array('name' => $sms_name, 'slug' => $typeslug, 'sms_content' => $sms_template, 'sms_variable' => $sms_variable, 'status' => $sms_status, 'created_on' => current_date());
                    $smsinsertid = $this->Mydb->insert($this->sms_table, $insertarray);
                    if (!empty($smsinsertid)) {
                        $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Sms has been successfully added..');
                        $this->session->set_userdata($session_datas);
                        redirect(frontend_url() . 'smssetting/add');
                    } else {
                        $session_datas = array('pms_err' => '1', 'pms_err_message' => 'Sms cannot be added. Please try again');
                        $this->session->set_userdata($session_datas);
                        redirect(frontend_url() . 'smssetting/add');
                    }
                } else {
                    $session_datas = array('pms_err' => '1', 'pms_err_message' => validation_errors());
                    $this->session->set_userdata($session_datas);
                    redirect(frontend_url() . 'smssetting/add');
                }
            else:
                $data = $this->load_module_info();
                $getsmsdetails = $this->Mydb->custom_query("select * from $this->sms_table");
                $data['records'] = $getsmsdetails;
                $this->layout->display_frontend($this->folder . 'smssetting', $data);
            endif;
        }else {
            $data = $this->load_module_info();
            $getsmsdetails = $this->Mydb->custom_query("select * from $this->sms_table");
            $data['records'] = $getsmsdetails;
            $this->layout->display_frontend($this->folder . 'smssetting', $data);
        }
    }

    private function load_module_info() {
        $data = array();
        $data ['module_label'] = $this->module_label;
        $data ['module_labels'] = $this->module_labels;
        $data ['module'] = $this->module;
        return $data;
    }

    public function delete_actions() {
        $delete_id = $this->input->post('delete_id');
        $delete_table = $this->input->post('delete_table');
        $update_array = array('status' => 3);
        $update_details = $this->Mydb->update($delete_table, array('id' => $delete_id), $update_array);
        if ($update_details) {
            $respose['message'] = "The data has been successfully deleted";
        } else {
            $respose['message'] = "The data can't deleted.Please try again";
        }
        echo json_encode($respose);
    }

    public function get_state_by_country_id() {
        $country_id = $this->input->post('country_id');
        $getcountries = $this->Mydb->custom_query("select name,id from $this->states_table where is_active=1 and country_id=$country_id");
        echo json_encode($getcountries);
    }

    public function get_city_by_state_id() {
        $country_id = $this->input->post('country_id');
        $state_id = $this->input->post('state_id');
        $getcities = $this->Mydb->custom_query("select name,id from $this->cities_table where is_active=1 and country_id=$country_id and state_id=$state_id");
        echo json_encode($getcities);
    }

    public function logout() {
        $user_id = get_session_value('user_id');
        $this->Mydb->insert($this->login_history_table, array('	logout_time' => current_date(), 'login_ip' => ip2long(get_ip()), 'user_id' => $user_id));
        $this->session->sess_destroy();
        redirect(frontend_url());
    }

}

?>