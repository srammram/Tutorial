<?php

/* * ************************
  Project Name	: POS
  Created on		: 19 Feb, 2016
  Last Modified 	: 19 Feb, 2016
  Description		: Page contains dashboard related functions.

 * ************************* */
defined('BASEPATH') or exit('No direct script access allowed');

class Projects extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->module = "homepage";
        $this->module_label = "Home";
        $this->module_labels = "Home";
        $this->folder = "projects/";
        $this->user_folder = "user/";
        $this->login_table = 'users';
        $this->login_history_table = 'login_history';
        $this->user_type_table = 'user_type';
        $this->departments_table = 'departments';
        $this->countries = 'countries';
        $this->states_table = 'states';
        $this->cities_table = 'cities';
        $this->projects_table = 'projects';
        $this->load->library('common');
    }

    public function index() {
        $data = $this->load_module_info();
        $projectdetails = $this->Mydb->custom_query("select * from $this->projects_table where status<>3");
        $data['project_details'] = $projectdetails;
        $this->layout->display_frontend($this->folder . 'projects', $data);
    }

    public function add() {
        $data = $this->load_module_info();
        $getteamdetails = $this->Mydb->custom_query("select name,slug,id from $this->departments_table where status=1");
        $data['team_details'] = $getteamdetails;
        $this->layout->display_frontend($this->folder . 'add-project', $data);
    }

    public function insert() {
        $data = $this->load_module_info();
        $this->form_validation->set_rules('pro_title', 'Project Title', 'required|trim');
        $this->form_validation->set_rules('pro_description', 'Project Description', 'required|trim');
        $this->form_validation->set_rules('pro_type', 'Project Type', 'required|trim');
        if ($this->input->post('pro_team') != '') {
            $proteam = implode(',', $this->input->post('pro_team'));
        } else {
            $proteam = '';
        }
        if ($this->form_validation->run($this) == TRUE) :
            $pro_title = $this->input->post('pro_title');
            $pro_description = $this->input->post('pro_description');
            $pro_type = $this->input->post('pro_type');
            $pro_file = $_FILES['pro_file']['name'];
            $pro_start = $this->input->post('pro_start');
            $pro_finished = $this->input->post('pro_finished');
            $pro_duration = $this->input->post('pro_duration');
            $pro_team = $proteam;

            $insert_array = array('project_name' => $pro_title,
                'project_slug' => url_title($pro_title, '-', TRUE),
                'project_description' => $pro_description,
                'project_type_status' => $pro_type,
                'project_during_hours' => $pro_duration,
                'project_start_date' => $pro_start,
                'project_finished_date' => $pro_finished,
                'project_team' => $pro_team,
                'created_on' => current_date(),
                'created_ip' => ip2long(get_ip()),
                'status' => 1
            );
            if (!empty($_FILES['pro_file']['name']) && isset($_FILES ['pro_file'] ['name'])) {
                $create_user_doc_name = url_title(substr($pro_title, 0, 10), '-', TRUE) . '-project-' . $_FILES['pro_file']['name'];
                $doc_image = $this->common->upload_image('pro_file', 'project/', $create_user_doc_name);
                $image_arr = array(
                    'project_file' => $doc_image
                );
                $insert_array = array_merge($insert_array, $image_arr);
            } else {
                $image_arr = array(
                    'project_file' => ''
                );
                $insert_array = array_merge($insert_array, $image_arr);
            }
            $insert_id = $this->Mydb->insert($this->projects_table, $insert_array);
            if ($insert_id):
                $session_datas = array('pms_err' => '0', 'pms_err_message' => 'New Project has been successfully added');
                $this->session->set_userdata($session_datas);
                redirect(frontend_url() . 'projects/add');
            else:
                $session_datas = array('pms_err' => '1', 'pms_err_message' => 'New Project cant be added. Please try again');
                $this->session->set_userdata($session_datas);
                redirect(frontend_url() . 'projects/add');
            endif;
        else:
            $session_datas = array('pms_err' => '1', 'pms_err_message' => validation_errors());
            $this->session->set_userdata($session_datas);
            $this->session->set_userdata('validation_errors', validation_errors());
            $this->session->mark_as_flash('validation_errors'); // data will automatically delete themselves after redirect
            $this->session->set_flashdata($this->input->post());
            $this->session->flashdata($this->input->post());
            redirect(frontend_url() . 'projects/add');
        endif;
    }

    public function update() {
        $data = $this->load_module_info();
        $edit_id = $this->input->post('edit_id');
        $pro_title = $this->input->post('pro_title');
        $pro_description = $this->input->post('pro_description');
        $pro_type = $this->input->post('pro_type');
        $pro_start = $this->input->post('pro_start');
        $pro_finished = $this->input->post('pro_finished');
        $pro_duration = $this->input->post('pro_duration');
        $pro_team = implode(',', $this->input->post('pro_team'));
        $update_array = array('project_name' => $pro_title,
            'project_slug' => url_title($pro_title, '-', TRUE),
            'project_description' => $pro_description,
            'project_type_status' => $pro_type,
            'project_during_hours' => $pro_duration,
            'project_start_date' => $pro_start,
            'project_finished_date' => $pro_finished,
            'project_team' => $pro_team,
            'updated_on' => current_date(),
            'created_ip' => ip2long(get_ip()),
            'status' => 1
        );
        $update_id = $this->Mydb->update($this->projects_table, array('id' => $edit_id), $update_array);
        if ($update_id) {
            $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Project has been successfully updated');
            $this->session->set_userdata($session_datas);
            redirect(frontend_url() . 'projects');
        } else {
            $session_datas = array('pms_err' => '1', 'pms_err_message' => 'Project cant be updated. Please try again');
            $this->session->set_userdata($session_datas);
            redirect(frontend_url() . 'projects');
        }
    }

    public function ediproject() {
        $edit_id = $this->input->post('edit_id');

        $getprojectdetails = $this->Mydb->custom_query("select * from $this->projects_table where id=$edit_id");
        $team_details = $this->Mydb->custom_query("select name,id from $this->departments_table where status=1");
        $data['records'] = $getprojectdetails;
        $data['team_details'] = $team_details;
        $data['edit_id'] = $edit_id;
        $body = $this->load->view($this->folder . 'editprojects', $data);
        echo $body;
    }

    private function load_module_info() {
        $data = array();
        $data ['module_label'] = $this->module_label;
        $data ['module_labels'] = $this->module_labels;
        $data ['module'] = $this->module;
        return $data;
    }

}
