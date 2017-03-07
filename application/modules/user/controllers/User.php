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
                        $session_datas = array('user_id' => $user_id, 'user_mobile' => $user_mobile, 'user_email' => $user_email, 'user_name' => $user_name, 'user_type_id' => $user_type_id);
                        $this->session->set_userdata($session_datas);
                        $this->Mydb->insert($this->login_history_table, array('login_time' => current_date(), 'login_ip' => ip2long(get_ip()), 'user_id' => $user_id));
                        redirect(frontend_url() . 'dashboard');
                    } else {
                        $session_datas = array('pms_err' => '1', 'pms_err_message' => 'Email/Password is wrong. Please try again');
                        $this->session->set_userdata($session_datas);
                    }
                } else {
                    $session_datas = array('pms_err' => '1', 'pms_err_message' => 'Email/Password is not available. Please try again');
                    $this->session->set_userdata($session_datas);
                }
            } else {
                $session_datas = array('pms_err' => '1', 'pms_err_message' => validation_errors());
                $this->session->set_userdata($session_datas);
            }
        } else {
            redirect(frontend_url() . 'dashboard');
        }
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
                if ($this->form_validation->run($this) == TRUE) {
                    $typeslug = url_title($this->input->post('department_name'), '-', TRUE);
                    $getslugdetails = $this->Mydb->custom_query("select slug,id,name from $this->departments_table where slug='$typeslug'");
                    if (!empty($getslugdetails)) {
                        $randno = rand(2222, 3333);
                        $slugvalue = $department_name . '-' . $randno;
                    } else {
                        $slugvalue = $department_name;
                    }
                    $insertarray = array('name' => $department_name, 'slug' => $typeslug, 'status' => $department_status, 'created_on' => current_date(), 'created_ip' => ip2long(get_ip()));
                    $usertypeinsertid = $this->Mydb->insert($this->departments_table, $insertarray);
                    if (!empty($usertypeinsertid)) {
                        $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Department has been successfully added..');
                        $this->session->set_userdata($session_datas);
                        redirect(frontend_url() . 'departments/add');
                    } else {
                        $session_datas = array('pms_err' => '1', 'pms_err_message' => 'Department cannot be added. Please try again');
                        $this->session->set_userdata($session_datas);
                        redirect(frontend_url() . 'departments/add');
                    }
                } else {
                    $session_datas = array('pms_err' => '1', 'pms_err_message' => validation_errors());
                    $this->session->set_userdata($session_datas);
                    redirect(frontend_url() . 'departments/add');
                }
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

    public function employee($method = null, $args = array()) {
        if (!empty($method)) {
            if ($method[0] == 'add'):
                $data = $this->load_module_info();
                $data['countries'] = $this->Mydb->custom_query("select title,id from $this->countries");
                $data['usertype'] = $this->Mydb->custom_query("select type_name,id from $this->user_type_table");
                $data['departments'] = $this->Mydb->custom_query("select name,id from $this->departments_table");
                $this->layout->display_frontend($this->folder . 'employee-add', $data);
            elseif ($method[0] == 'insert'):
                $this->form_validation->set_rules('employee_name', 'Employee Name', 'required|trim');
                $this->form_validation->set_rules('employee_email', 'Email', 'required');
                $this->form_validation->set_rules('employee_pass', 'Password', 'required|trim');
                $this->form_validation->set_rules('user_type', 'User Type', 'required');
                $this->form_validation->set_rules('emp_departments', 'Department Type', 'required');
                $this->form_validation->set_rules('employee_dob', 'DOB', 'required');
                $this->form_validation->set_rules('emp_country', 'Country', 'required');
                $this->form_validation->set_rules('emp_state', 'State', 'required');
                if ($this->form_validation->run($this) == TRUE) {
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
                        $insert_array = array('user_type_id' => $this->input->post('user_type'),
                            'user_name' => $this->input->post('employee_name'),
                            'user_pass' => md5($this->input->post('employee_pass')),
                            'user_email' => $this->input->post('employee_email'),
                            'user_slug' => $slugvalue,
                            'user_departments_id' => $this->input->post('emp_departments'),
                            'user_mobile' => $this->input->post('emp_mobile'),
                            'user_address' => $this->input->post('emp_address'),
                            'user_country' => $this->input->post('emp_country'),
                            'user_dob' => $this->input->post('employee_dob'),
                            'created_ip' => ip2long(get_ip()),
                            'created_by' => get_session_value('user_id'),
                            'status' => 1,
                            'created_on' => current_date(),
                        );
                        $insert_id = $this->Mydb->insert($this->login_table, $insert_array);
                        if ($insert_id) {
                            $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Employee details has been successfully inserted');
                            $this->session->set_userdata($session_datas);
                            redirect(frontend_url() . 'departments/add');
                        } else {
                            $session_datas = array('pms_err' => '1', 'pms_err_message' => 'Employee not inserted. Please try again');
                            $this->session->set_userdata($session_datas);
                            redirect(frontend_url() . 'departments/add');
                        }
                    } else {
                        $session_datas = array('pms_err' => '1', 'pms_err_message' => 'Email Already Exists');
                        $this->session->set_userdata($session_datas);
                        redirect(frontend_url() . 'departments/add');
                    }
                } else {
                    $session_datas = array('pms_err' => '1', 'pms_err_message' => validation_errors());
                    $this->session->set_userdata($session_datas);
                    $this->session->set_userdata('validation_errors', validation_errors());
                    $this->session->mark_as_flash('validation_errors'); // data will automatically delete themselves after redirect
                    $this->session->set_flashdata($this->input->post());
                    $this->session->flashdata($this->input->post());
                    redirect(frontend_url() . 'employee/add');
                }
            endif;
        } else {
            $data = $this->load_module_info();
            $getdepartmentdetails = $this->Mydb->custom_query("select * from $this->departments_table");
            $data['records'] = $getdepartmentdetails;
            $this->layout->display_frontend($this->folder . 'employee', $data);
        }
    }

    private function load_module_info() {
        $data = array();
        $data ['module_label'] = $this->module_label;
        $data ['module_labels'] = $this->module_labels;
        $data ['module'] = $this->module;
        return $data;
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
