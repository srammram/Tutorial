<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tasks extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->module = "homepage";
        $this->module_label = "Home";
        $this->module_labels = "Home";
        $this->folder = "tasks/";
        $this->user_folder = "user/";
        $this->login_table = 'users';
        $this->login_history_table = 'login_history';
        $this->user_type_table = 'user_type';
        $this->departments_table = 'departments';
        $this->countries = 'countries';
        $this->states_table = 'states';
        $this->cities_table = 'cities';
        $this->projects_table = 'projects';
        $this->project_teams_table = 'project_teams';
        $this->srm_holidays_table = 'srm_holidays';
        $this->task_history_table = 'task_history';
        $this->static_reasons_table = 'static_reasons';
        $this->assigned_tasks_table = 'assigned_tasks';
        $this->tasks_table = 'tasks';
        $this->task_dependendy_table = 'task_dependendy';

        $this->load->library('common');
        $this->load->helper('download');
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

    function _remap($method, $args) {

        if (method_exists($this, $method)) {
            $this->$method($args);
        } else {
            if ($method !== 'manage_new_task_history') {
                $this->index($method, $args);
            } else if ($method == 'manage_new_task_history') {
                $this->manage_new_task_history($method, $args);
            }
        }
    }

    public function index() {
        $data = $this->load_module_info();
        $user_id = $_SESSION['user_id'];
        $user_type_id = $_SESSION['user_type_id'];
        $user_departments_id = $_SESSION['user_departments_id'];
        if ($user_type_id == 5):
            $gettaskdetails = $this->Mydb->custom_query("select t1.*,t2.user_name as from_username,t4.user_name as to_user_name,t3.project_name,t3.project_description from $this->task_history_table t1 LEFT JOIN $this->login_table t2 ON t2.id=t1.from_user_id LEFT JOIN $this->login_table t4 ON t4.id=t1.to_user_id LEFT JOIN $this->projects_table t3 ON t3.id=t1.projects_id where (from_user_id=$user_id OR to_user_id=$user_id) AND t1.status<>2");
        elseif ($user_type_id == 6):
            $gettaskdetails = $this->Mydb->custom_query("select t1.*,t2.user_name as from_username,t4.user_name as to_user_name,t3.project_name,t3.project_description from $this->task_history_table t1 LEFT JOIN $this->login_table t2 ON t2.id=t1.from_user_id LEFT JOIN $this->login_table t4 ON t4.id=t1.to_user_id LEFT JOIN $this->projects_table t3 ON t3.id=t1.projects_id where (from_user_id=$user_id OR to_user_id=$user_id) AND t1.status<>2");
        else:
            $gettaskdetails = $this->Mydb->custom_query("select t1.*,t2.user_name as from_username,t4.user_name as to_user_name,t3.project_name,t3.project_description from $this->task_history_table t1 LEFT JOIN $this->login_table t2 ON t2.id=t1.from_user_id LEFT JOIN $this->login_table t4 ON t4.id=t1.to_user_id LEFT JOIN $this->projects_table t3 ON t3.id=t1.projects_id where t1.status<>2");
        endif;
        $data['task_details'] = $gettaskdetails;
        $this->layout->display_frontend($this->folder . 'manage-tasks', $data);
    }

    public function add_new_task() {
        $data = $this->load_module_info();
        $user_id = $_SESSION['user_id'];
        $user_reporter_id = $_SESSION['user_reporter_id'];
        $user_type_id = $_SESSION['user_type_id'];
        if ($user_type_id < 5):
            $getprojectdetails = $this->Mydb->custom_query("select id as projects_id,project_name from $this->projects_table where status<>2");
        elseif ($user_type_id == 5):
            $getprojectdetails = $this->Mydb->custom_query("select DISTINCT(t2.id) as projects_id,t2.project_name from project_teams t1 LEFT JOIN projects t2 ON t2.id=t1.projects_id OR t2.project_type_status=4 where  (t1.team_tl_id=$user_id OR t2.project_type_status=4)");
        elseif ($user_type_id == 6):
            $getprojectdetails = $this->Mydb->custom_query("select DISTINCT(t1.projects_id),t2.project_name from $this->tasks_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id where t1.status<>2 and t1.to_user_id=$user_id");
        endif;
        $data['project_details'] = $getprojectdetails;
        $this->layout->display_frontend($this->folder . 'add-new-tasks', $data);
    }

    public function getnewtask_details() {
        $project_id = $this->input->post('project_id');
        $user_id = $_SESSION['user_id'];
        if ($project_id != 'others'):
            $gettask_details = $this->Mydb->custom_query("select t1.id,t1.task_title as task_name from $this->tasks_table t1 where  projects_id=$project_id and to_user_id=$user_id and t1.status<>5 and t1.status<>2");
        else:
            $gettask_details = $this->Mydb->custom_query("select id,reason as task_name from $this->static_reasons_table where status=1");
        endif;
        echo json_encode($gettask_details);
    }

    public function insert_new_task() {
        $data = $this->load_module_info();
        $user_id = $_SESSION['user_id'];
        $user_reporter_id = $_SESSION['user_reporter_id'];
        $user_departments_id = $_SESSION['user_departments_id'];
        $user_type_id = $_SESSION['user_type_id'];
        $add_project = $this->input->post('add_project');
        $add_selected_task = $this->input->post('add_selected_task');
        $add_message = $this->input->post('add_message');
        $add_start_date = $this->input->post('add_start_date');
        $add_end_date = $this->input->post('add_end_date');
        $add_duration_hours = $this->input->post('add_duration_hours');
        $task_status = $this->input->post('task_status');
        $assigned_task_id = $this->input->post('add_selected_task');
        $delay_reason = $this->input->post('delay_reason') != '' ? $this->input->post('delay_reason') : '';
        if ($add_project != 'others'):
            $gettaskdetails = $this->Mydb->custom_query("select task_title from $this->tasks_table where id=$add_selected_task");
        else:
            $gettaskdetails = $this->Mydb->custom_query("select reason as task_title from $this->static_reasons_table where id=$add_selected_task");
        endif;
        $insert_array = array('projects_id' => $add_project,
            'task_title' => $gettaskdetails[0]['task_title'],
            'tasks_id' => $assigned_task_id,
            'project_duration' => $add_duration_hours,
            'message' => $add_message,
            'from_user_id' => $user_id,
            'to_user_id' => $user_reporter_id,
            'departments_id' => $user_departments_id,
            'start_datetime' => date('Y-m-d H:i:s', strtotime($add_start_date)),
            'end_datetime' => date('Y-m-d H:i:s', strtotime($add_end_date)),
            'created_ip' => ip2long(get_ip()),
            'asigned_task_id' => $assigned_task_id,
            'status' => $this->input->post('task_status'));

        $insert_id = $this->Mydb->insert($this->task_history_table, $insert_array);
//        echo $this->Mydb->print_query();
//        die;
        $log_msg = 'Task Added by ' . get_session_value('user_name');
        $log_from = get_session_value('user_id');
        $log_to = $user_reporter_id;
        log_history($log_msg, $log_from, $log_to);
        $getfinishedhours = $this->Mydb->custom_query("select finished_duration_hours from $this->tasks_table where id=$assigned_task_id");
        $finished_duration_hours = $getfinishedhours[0]['finished_duration_hours'];


        if ($add_project != 'others'):
            $gethours_details = $this->Mydb->custom_query("select SUM(project_duration) as duration_hours from $this->task_history_table where projects_id=$add_project and from_user_id=$user_id and asigned_task_id=$assigned_task_id");
            $finishedarray = array('finished_datetime' => current_date(),
                'finished_message' => $add_message,
                'finished_hours' => $gethours_details[0]['duration_hours'],
                'status' => $this->input->post('task_status'));
            $updateid = $this->Mydb->update($this->assigned_tasks_table, array('id' => $assigned_task_id), $finishedarray);

            $tasks_array = array('finished_duration_hours' => $finished_duration_hours + $add_duration_hours,
                'status' => $this->input->post('task_status'), 'employee_finished_message' => $delay_reason);
            $updatetasks = $this->Mydb->update($this->tasks_table, array('id' => $assigned_task_id), $tasks_array);

        endif;


        if ($task_status == '3'):
            $statusmessage = "In Progress";
        elseif ($task_status == '4'):
            $statusmessage = "In Completed";
        elseif ($task_status == '5'):
            $statusmessage = "Completed";
        else:
            $statusmessage = "Pending";
        endif;
        $notiy_msg = stripslashes($gettaskdetails[0]['task_name']) . ' Task has been ' . $statusmessage . ' by ' . $_SESSION['user_name'];
        $notiy_from = $_SESSION['user_id'];
        $notiy_to = $_SESSION['user_reporter_id'];
        $notiy_type = 3;

        create_notification($notiy_msg, $notiy_from, $notiy_to, $notiy_type);
        if ($insert_id):
            $session_datas = array('pms_err' => '0', 'pms_err_message' => 'New Task has been successfully added');
            $this->session->set_userdata($session_datas);
            redirect(frontend_url() . 'tasks/add_new_task');
        else:
            $session_datas = array('pms_err' => '0', 'pms_err_message' => 'New Task cannot be added');
            $this->session->set_userdata($session_datas);
            redirect(frontend_url() . 'tasks/add_new_task');
        endif;
    }

    public function asign() {
        $data = $this->load_module_info();
        $user_id = $_SESSION['user_id'];
        $user_reporter_id = $_SESSION['user_reporter_id'];
        $user_type_id = $_SESSION['user_type_id'];
        if ($user_type_id < 5):
            $getprojectdetails = $this->Mydb->custom_query("select id as projects_id,project_name,project_type_status from $this->projects_table  where status<>2 group by id");
        elseif ($user_type_id == 5):
            $getprojectdetails = $this->Mydb->custom_query("select DISTINCT(t2.id) as projects_id,t2.project_name,t2.project_type_status from project_teams t1 LEFT JOIN projects t2 ON t2.id=t1.projects_id OR t2.project_type_status=4 where  (t1.team_tl_id=$user_id OR t2.project_type_status=4) group by t1.projects_id");
        elseif ($user_type_id == 6):
            $getprojectdetails = $this->Mydb->custom_query("select t1.projects_id,t2.project_name,t2.project_type_status from $this->assigned_tasks_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_table where t1.status<>2 and t1.team_tl_id=$user_id group by t1.projects_id");
        endif;
        $getdepartments = $this->Mydb->custom_query("select id,name from $this->departments_table where status<>2");
        $getusertypes = $this->Mydb->custom_query("select id,type_name from $this->user_type_table where status<>2");
        $data['project_details'] = $getprojectdetails;
        $data['department_details'] = $getdepartments;
        $data['usertype_details'] = $getusertypes;
        $this->layout->display_frontend($this->folder . 'asign-tasks', $data);
    }

    public function add_dependency() {
        $data = $this->load_module_info();
        $user_id = $_SESSION['user_id'];
        $getproject_details = $this->Mydb->custom_query("select t1.projects_id,t2.project_name from $this->project_teams_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id where team_tl_id=$user_id and t1.status<>2 and t1.status<>5 group by t1.projects_id");
        $data['project_details'] = $getproject_details;
        $this->layout->display_frontend($this->folder . 'add-dependency', $data);
    }

    public function get_dependency_task_details() {
        $user_id = $_SESSION['user_id'];
        $project_id = $this->input->post('project_id');
        $user_departments_id = $_SESSION['user_departments_id'];
        $get_task_details = $this->Mydb->custom_query("select id,task_title,project_duration,message from $this->tasks_table where projects_id=$project_id and from_user_id=$user_id and status<>2 and status<>5");
        $get_department_details = $this->Mydb->custom_query("select t1.team_departments_id as id,t2.name as name from $this->project_teams_table t1 LEFT JOIN $this->departments_table t2 ON t2.id=t1.team_departments_id where t1.status<>2 and t1.projects_id=$project_id ");
        $data['task_details'] = $get_task_details;
        $data['department_details'] = $get_department_details;
        $body = $this->load->view($this->folder . 'get-ajax-task-list', $data);
        echo $body;
    }

    public function selectend_datetime() {
        $departemtns_id = explode(',', $this->input->post('departemtns_id'));
        $department_name = array();
        $department_id = array();
        foreach ($departemtns_id as $ids):
            $department_id = $ids;
            $getdepartmentdetails = $this->Mydb->custom_query("select id,name from $this->departments_table where id=$department_id");
            $getdepartmentdetails[0]['name'];

            $departments_name[] = $getdepartmentdetails[0]['name'];
            $departments_id[] = $getdepartmentdetails[0]['id'];

        endforeach;
        $data['department_name'] = $departments_name;
        $data['department_id'] = $departments_id;
        $body = $this->load->view($this->folder . 'dependency-end-datetime', $data);
        echo $body;
    }

    public function insert_dependency() {
        $project_id = $this->input->post('select_project');
        $task_id = $this->input->post('select_task');
        $department_id = $this->input->post('select_department');
        $dependancy_endtime = $this->input->post('dependancy_endtime');
        $user_id = $_SESSION['user_id'];
//        task_dependendy_table
        $i = 0;
        foreach ($department_id as $ids):
            $gettlid = $this->Mydb->custom_query("select team_tl_id from $this->project_teams_table where team_departments_id=$ids and projects_id=$project_id");
            $insert_array = array('task_id' => $task_id,
                'projects_id' => $project_id,
                'set_datetime' => date('Y-m-d H:i:s', strtotime($dependancy_endtime[$i])),
                'departments_id' => $ids,
                'to_user_id' => $gettlid[0]['team_tl_id'],
                'created_at' => $user_id,
                'updated_on' => current_date(),
                'created_ip' => ip2long(get_ip()),
                'status' => 3);
            $insert_id = $this->Mydb->insert($this->task_dependendy_table, $insert_array);
            $notiy_msg = 'New Task Dependency has been added' . ' by ' . $_SESSION['user_name'];
            $notiy_from = $_SESSION['user_id'];
            $notiy_to = $gettlid[0]['team_tl_id'];
            $notiy_type = 5;
            create_notification($notiy_msg, $notiy_from, $notiy_to, $notiy_type);
            $i++;
        endforeach;

        if ($insert_id):
            $session_datas = array('pms_err' => '0', 'pms_err_message' => 'New Task Dependency has been successfully added');
            $this->session->set_userdata($session_datas);
            redirect(frontend_url() . 'tasks/add_dependency');
        else:
            $session_datas = array('pms_err' => '0', 'pms_err_message' => 'New Task Dependency cant be added');
            $this->session->set_userdata($session_datas);
            redirect(frontend_url() . 'tasks/add_dependency');
        endif;
    }

    public function manage_dependency() {
        $user_id = $_SESSION['user_id'];
        $user_departments_id = $_SESSION['user_departments_id'];
        $getdependency_details = $this->Mydb->custom_query("select t1.*,(if(t1.status=1,'Active',if(t1.status=3,'Set',if(t1.status=4,'Unset','Ignored'))))as dependency_status,t2.project_name,t3.task_title,t4.name as department_name from $this->task_dependendy_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id LEFT JOIN $this->tasks_table t3 ON t3.id=t1.task_id LEFT JOIN $this->departments_table t4 ON t4.id=t1.departments_id where (t1.to_user_id=$user_id OR t1.created_at=$user_id) AND t1.status<>2");
        $data['records'] = $getdependency_details;
        $this->layout->display_frontend($this->folder . 'manage-dependency', $data);
    }

    public function view_dependency() {
        $dependency_id = $this->input->post('dependency_id');
        $getdependency_details = $this->Mydb->custom_query("select t1.*,(if(t1.status=1,'Active',if(t1.status=3,'Set',if(t1.status=4,'Unset','Ignored'))))as dependency_status,t2.project_name,t3.task_title,t4.name as department_name from $this->task_dependendy_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id LEFT JOIN $this->tasks_table t3 ON t3.id=t1.task_id LEFT JOIN $this->departments_table t4 ON t4.id=t1.departments_id where t1.id=$dependency_id");
        $data['records'] = $getdependency_details;
        $body = $this->load->view($this->folder . 'view-dependency', $data);
        echo $body;
    }

    public function edit_dependency() {
        $dependency_id = $this->input->post('dependency_id');
        $getdependency_details = $this->Mydb->custom_query("select t1.*,(if(t1.status=1,'Active',if(t1.status=3,'Set',if(t1.status=4,'Unset','Ignored'))))as dependency_status,t2.project_name,t3.task_title,t4.name as department_name from $this->task_dependendy_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id LEFT JOIN $this->tasks_table t3 ON t3.id=t1.task_id LEFT JOIN $this->departments_table t4 ON t4.id=t1.departments_id where t1.id=$dependency_id");
        $data['records'] = $getdependency_details;
        $body = $this->load->view($this->folder . 'edit-dependency', $data);
        echo $body;
    }

    public function reasign_dependency() {
        $dependency_id = $this->input->post('dependency_id');
        $getdependency_details = $this->Mydb->custom_query("select t1.*,(if(t1.status=1,'Active',if(t1.status=3,'Set',if(t1.status=4,'Unset','Ignored'))))as dependency_status,t2.project_name,t3.task_title,t4.name as department_name from $this->task_dependendy_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id LEFT JOIN $this->tasks_table t3 ON t3.id=t1.task_id LEFT JOIN $this->departments_table t4 ON t4.id=t1.departments_id where t1.id=$dependency_id");
        $data['records'] = $getdependency_details;
        $body = $this->load->view($this->folder . 'reasign-dependency', $data);
        echo $body;
    }

    public function update_reasign_dependency() {
        $dependency_id = $this->input->post('dependency_id');
        $getdetails = $this->Mydb->custom_query("select to_user_id from $this->task_dependendy_table where id=$dependency_id");
        $set_datetime = date('Y-m-d H:i:s', strtotime($this->input->post('set_datetime')));
        $change_status = $this->input->post('change_status');
        $reassign_message = $this->input->post('reassign_message');
        $getreasign_count = $this->Mydb->custom_query("select reasign_count from $this->task_dependendy_table where id=$dependency_id");
        $reasign_count = $getreasign_count[0]['reasign_count'];
        $update_array = array('unset_datetime' => $set_datetime,
            'status' => $change_status,
            'reasign_message' => $reassign_message,
            'reasign_count' => $reasign_count + 1);
        $update_id = $this->Mydb->update($this->task_dependendy_table, array('id' => $dependency_id), $update_array);
        $notiy_msg = 'Task Dependency has been Reassigned' . ' by ' . $_SESSION['user_name'];
        $notiy_from = $_SESSION['user_id'];
        $notiy_to = $getdetails[0]['to_user_id'];
        $notiy_type = 5;

        create_notification($notiy_msg, $notiy_from, $notiy_to, $notiy_type);
        if ($update_id):
            $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Task Dependency has been successfully updated');
            $this->session->set_userdata($session_datas);
            redirect(frontend_url() . 'tasks/manage_dependency');
        else:
            $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Task Dependency cant be updated');
            $this->session->set_userdata($session_datas);
            redirect(frontend_url() . 'tasks/manage_dependency');
        endif;
    }

    public function update_dependency() {
        $dependency_id = $this->input->post('dependency_id');
        $getdetails = $this->Mydb->custom_query("select created_at from $this->task_dependendy_table where id=$dependency_id");
        $unset_datetime = date('Y-m-d H:i:s', strtotime($this->input->post('unset_datetime')));
        $change_status = $this->input->post('change_status');
        $update_array = array('unset_datetime' => $unset_datetime,
            'status' => $change_status);
        $update_id = $this->Mydb->update($this->task_dependendy_table, array('id' => $dependency_id), $update_array);
        $notiy_msg = 'Task Dependency has been updated' . ' by ' . $_SESSION['user_name'];
        $notiy_from = $_SESSION['user_id'];
        $notiy_to = $getdetails[0]['created_at'];
        $notiy_type = 3;
        create_notification($notiy_msg, $notiy_from, $notiy_to, $notiy_type);
        if ($update_id):
            $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Task Dependency has been successfully updated');
            $this->session->set_userdata($session_datas);
            redirect(frontend_url() . 'tasks/manage_dependency');
        else:
            $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Task Dependency cant be updated');
            $this->session->set_userdata($session_datas);
            redirect(frontend_url() . 'tasks/manage_dependency');
        endif;
    }

    public function get_user_details() {
        $data = $this->load_module_info();
        $user_type_id = $this->input->post('user_type_id');
        $department_id = $this->input->post('department_id');
        $project_id = $this->input->post('project_id');
        $user_id = $_SESSION['user_id'];
        $getdepartmentdetails = $this->Mydb->custom_query("select GROUP_CONCAT(team_departments_id) as department_id from $this->project_teams_table where team_tl_id=$user_id and projects_id=$project_id");
        $user_departments_id = explode(',', $_SESSION['user_departments_id']);
        if ($user_type_id == '') {
            $user_type_id = 6;
        } else {
            $user_type_id = $user_type_id;
        }
        if ($department_id == '') {
            $where = " AND user_type_id=$user_type_id";
        } else {
            $where = " AND user_type_id=$user_type_id AND user_departments_id=$department_id";
        }
        $getemployee_details = $this->Mydb->custom_query("select user_name,id from $this->login_table where status=1 $where");
        if (count($user_departments_id) > 1):
            $implode_department_details = $getdepartmentdetails[0]['department_id'];
            $getdepartmentdetails = $this->Mydb->custom_query("select id,name from $this->departments_table where id IN($implode_department_details)");
            $data['department_details'] = $getdepartmentdetails;
        else:
            $data['department_details'] = '';
        endif;
        $data['records'] = $getemployee_details;
        $body = $this->load->view($this->folder . 'get_user_details', $data);
        echo $body;
    }

    public function get_employee_details() {
        $department_id = $this->input->post('department_id');
        $user_id = $_SESSION['user_id'];
        $getdetails = $this->Mydb->custom_query("select user_name,id from $this->login_table where user_departments_id=$department_id and user_reporter_id=$user_id");
        $data['records'] = $getdetails;
        $body = $this->load->view($this->folder . 'get_employee_details', $data);
        echo $body;
    }

    public function upload_files() {
        if (!empty($_FILES['file']['name']) && isset($_FILES ['file'] ['name'])) {
//            $create_user_doc_name = url_title(substr($pro_title, 0, 10), '-', TRUE) . '-project-' . $_FILES['pro_file']['name'];
            $doc_image = $this->common->upload_image('file', 'task/', '');
            $image_arr = array(
                'image_name' => $doc_image,
                'created_at' => current_date(),
                'status' => 1
            );
            $json['success'] = 1;
            $json['success_message'] = "Image successfully uploaded";
            $json['file'] = $doc_image;
        } else {
            $json['success'] = 0;
            $json['success_message'] = "Image not uploaded";
        }
        echo json_encode($json);
    }

    public function insert_asign_task() {
        $asign_project = $this->input->post('asign_project');
        $asign_usertype = $this->input->post('asign_usertype') != '' ? $this->input->post('asign_usertype') : '';

        $asign_departments = $this->input->post('asign_departments') != '' ? $this->input->post('asign_departments') : '';
        if ($asign_departments != '') {
            $asign_departments = $asign_departments;
        } else {
            $asign_departments = $_SESSION['user_departments_id'];
        }
        $asign_task_title = $this->input->post('asign_task_title');
        $asign_task_message = $this->input->post('asign_task_message');
        $asign_user_details = $this->input->post('asign_user_details');
        $asign_start_date = $this->input->post('asign_start_date');
        $asign_end_date = $this->input->post('asign_end_date');
        $asign_duration_hours = $this->input->post('asign_duration_hours');
        $mediafiles = $this->input->post('mediaFiles');
        $insert_array = array('projects_id' => $asign_project,
            'task_name' => $asign_task_title,
            'assigned_from' => $_SESSION['user_id'],
            'assigned_to' => $asign_user_details,
            'asigned_message' => $asign_task_message,
            'assigned_hours' => $asign_duration_hours,
            'departments_id' => $asign_departments,
            'user_type_id' => $asign_usertype,
            'start_datetime' => date('Y-m-d H:i:s', strtotime($asign_start_date)),
            'end_datetime' => date('Y-m-d H:i:s', strtotime($asign_end_date)),
            'task_file' => $mediafiles != '' ? implode('|*|', $mediafiles) : '',
            'created_at' => $_SESSION['user_id'],
            'created_ip' => ip2long(get_ip()),
            'status' => 1,
        );

        $insert_id = $this->Mydb->insert($this->assigned_tasks_table, $insert_array);
        $log_msg = 'Task Assign Added by ' . get_session_value('user_name');
        $log_from = get_session_value('user_id');
        $log_to = $asign_user_details;
        log_history($log_msg, $log_from, $log_to);
        $insert_tasks_array = array('projects_id' => $asign_project,
            'task_title' => $asign_task_title,
            'from_user_id' => $_SESSION['user_id'],
            'to_user_id' => $asign_user_details,
            'message' => $asign_task_message,
            'project_duration' => $asign_duration_hours,
            'departments_id' => $asign_departments,
            'start_datetime' => date('Y-m-d H:i:s', strtotime($asign_start_date)),
            'end_datetime' => date('Y-m-d H:i:s', strtotime($asign_end_date)),
            'created_ip' => ip2long(get_ip()),
            'asigned_task_id' => $insert_id,
            'task_file' => $mediafiles != '' ? implode('|*|', $mediafiles) : '',
            'status' => 1,
        );
        $insert_task_id = $this->Mydb->insert($this->tasks_table, $insert_tasks_array);
        $insert_task_array = array('projects_id' => $asign_project,
            'task_title' => $asign_task_title,
            'tasks_id' => $insert_task_id,
            'from_user_id' => $_SESSION['user_id'],
            'to_user_id' => $asign_user_details,
            'message' => $asign_task_message,
            'project_duration' => $asign_duration_hours,
            'departments_id' => $asign_departments,
            'start_datetime' => date('Y-m-d H:i:s', strtotime($asign_start_date)),
            'end_datetime' => date('Y-m-d H:i:s', strtotime($asign_end_date)),
            'created_ip' => ip2long(get_ip()),
            'asigned_task_id' => $insert_id,
            'task_file' => $mediafiles != '' ? implode('|*|', $mediafiles) : '',
            'status' => 1,
        );

        $insert_task_id = $this->Mydb->insert($this->task_history_table, $insert_task_array);

        if ($insert_id):
            if ($_SESSION['user_type_id'] >= 4):
                $getreporter_details = $this->Mydb->custom_query("select user_type_id,user_reporter_id,user_name from $this->login_table where id=$asign_user_details");
                if ($getreporter_details[0]['user_type_id'] == 6):
                    $notiy_msg = stripslashes($asign_task_title) . ' Task has been Assigned by ' . $_SESSION['user_name'] . ' for your team member ' . $getreporter_details[0]['user_name'];
                    $notiy_from = $_SESSION['user_id'];
                    $notiy_to = $getreporter_details[0]['user_reporter_id'];
                    $notiy_type = 3;
                    create_notification($notiy_msg, $notiy_from, $notiy_to, $notiy_type);
                endif;
            endif;
            $notiy_msg = stripslashes($asign_task_title) . ' Task has been Assigned by ' . $_SESSION['user_name'];
            $notiy_from = $_SESSION['user_id'];
            $notiy_to = $asign_user_details;
            $notiy_type = 3;
            create_notification($notiy_msg, $notiy_from, $notiy_to, $notiy_type);

            $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Asign Task has been successfully inserted');
            $this->session->set_userdata($session_datas);
            redirect(frontend_url() . 'tasks/asign');
        else:
            $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Asign Task cannot inserted');
            $this->session->set_userdata($session_datas);
            redirect(frontend_url() . 'tasks/asign');
        endif;
    }

    public function edit_asign_task() {
        $data = $this->load_module_info();
        $user_departments_id = $_SESSION['user_departments_id'];
        $user_id = $_SESSION['user_id'];
        $user_type_id = $_SESSION['user_type_id'];
        $task_id = $this->input->post('task_id');
        $getdetails = $this->Mydb->custom_query("select t1.*,t2.project_name,t2.project_description,t3.user_name as from_name,t4.user_name as to_name from $this->assigned_tasks_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id LEFT JOIN $this->login_table t3 ON t3.id=t1.assigned_from LEFT JOIN $this->login_table t4 ON t4.id=t1.assigned_to where t1.id=$task_id");
        if ($user_type_id < 5):
            $getprojectdetails = $this->Mydb->custom_query("select id as projects_id,project_name from $this->projects_table where status<>2");
        elseif ($user_type_id == 5):
            $getprojectdetails = $this->Mydb->custom_query("select t1.projects_id,t2.project_name from $this->project_teams_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id where t1.status<>2 and team_tl_id=$user_id");
        elseif ($user_type_id == 6):
            $getprojectdetails = $this->Mydb->custom_query("select t1.projects_id,t2.project_name from $this->assigned_tasks_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_table where t1.status<>2 and t1.team_tl_id=$user_id");
        endif;
        $data['records'] = $getdetails;
        $getdepartments = $this->Mydb->custom_query("select id,name from $this->departments_table where status<>2");
        $getusertypes = $this->Mydb->custom_query("select id,type_name from $this->user_type_table where status<>2");
        if ($user_type_id == 5) {
            $getemployeedetails = $this->Mydb->custom_query("select id,user_name from $this->login_table where user_departments_id=$user_departments_id and user_type_id=6 and user_reporter_id=$user_id and status=1");
        } else if ($user_type_id >= 4) {
            $getemployeedetails = $this->Mydb->custom_query("select id,user_name from $this->login_table where status=1");
        } else {
            $getemployeedetails = $this->Mydb->custom_query("select id,user_name from $this->login_table where  status=1");
        }
        $data['project_details'] = $getprojectdetails;
        $data['employee_details'] = $getemployeedetails;
        $data['department_details'] = $getdepartments;
        $data['usertype_details'] = $getusertypes;
        $body = $this->load->view($this->folder . 'edit_asign_task', $data);
        echo $body;
    }

    public function view_asign_task() {
        $data = $this->load_module_info();
        $user_departments_id = $_SESSION['user_departments_id'];
        $user_id = $_SESSION['user_id'];
        $user_type_id = $_SESSION['user_type_id'];
        $task_id = $this->input->post('task_id');
        $getdetails = $this->Mydb->custom_query("select t1.*,t2.project_name,t2.project_description,t3.user_name as from_name,t4.user_name as to_name from $this->assigned_tasks_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id LEFT JOIN $this->login_table t3 ON t3.id=t1.assigned_from LEFT JOIN $this->login_table t4 ON t4.id=t1.assigned_to where t1.id=$task_id");
        if ($user_type_id < 5):
            $getprojectdetails = $this->Mydb->custom_query("select id as projects_id,project_name from $this->projects_table where status<>2");
        elseif ($user_type_id == 5):
            $getprojectdetails = $this->Mydb->custom_query("select t1.projects_id,t2.project_name from $this->project_teams_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id where t1.status<>2 and team_tl_id=$user_id ");
        elseif ($user_type_id == 6):
            $getprojectdetails = $this->Mydb->custom_query("select t1.projects_id,t2.project_name from $this->assigned_tasks_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_table where t1.status<>2 and t1.team_tl_id=$user_id");
        endif;
        $data['records'] = $getdetails;
        $getdepartments = $this->Mydb->custom_query("select id,name from $this->departments_table where status<>2");
        $getusertypes = $this->Mydb->custom_query("select id,type_name from $this->user_type_table where status<>2");
//        if ($user_type_id == 5) {
//            $getemployeedetails = $this->Mydb->custom_query("select id,user_name from $this->login_table where user_departments_id IN($user_departments_id) and user_type_id=6 and user_reporter_id=$user_id and status=1");
//        } else if ($user_type_id >= 4) {
//            $getemployeedetails = $this->Mydb->custom_query("select id,user_name from $this->login_table where status=1");
//        } else {
//            $getemployeedetails = $this->Mydb->custom_query("select id,user_name from $this->login_table where  status=1");
//        }
        $data['project_details'] = $getprojectdetails;
//        $data['employee_details'] = $getemployeedetails;
        $data['department_details'] = $getdepartments;
        $data['usertype_details'] = $getusertypes;
        $body = $this->load->view($this->folder . 'view_asign_task', $data);
        echo $body;
    }

    public function update_asign_task() {
        $edit_id = $this->input->post('edit_id');
        $asign_project = $this->input->post('asign_project');
        $asign_usertype = $this->input->post('asign_usertype') != '' ? $this->input->post('asign_usertype') : '';
        $asign_departments = $this->input->post('asign_departments') != '' ? $this->input->post('asign_departments') : '';
        if ($asign_departments != '') {
            $asign_departments = $asign_departments;
        } else {
            $asign_departments = $_SESSION['user_departments_id'];
        }
        $asign_task_title = $this->input->post('asign_task_title');
        $asign_task_message = $this->input->post('asign_task_message');
        $asign_user_details = $this->input->post('asign_user_details');
        $asign_start_date = $this->input->post('asign_start_date');
        $asign_end_date = $this->input->post('asign_end_date');
        $asign_duration_hours = $this->input->post('asign_duration_hours');
        $mediafiles = $this->input->post('mediaFiles');
        $update_array = array('projects_id' => $asign_project,
            'task_name' => $asign_task_title,
            'assigned_from' => $_SESSION['user_id'],
            'assigned_to' => $asign_user_details,
            'asigned_message' => $asign_task_message,
            'assigned_hours' => $asign_duration_hours,
            'departments_id' => $asign_departments,
            'user_type_id' => $asign_usertype,
            'start_datetime' => date('Y-m-d H:i:s', strtotime($asign_start_date)),
            'end_datetime' => date('Y-m-d H:i:s', strtotime($asign_end_date)),
            'task_file' => $mediafiles != '' ? implode('|*|', $mediafiles) : '',
            'created_at' => $_SESSION['user_id'],
            'created_ip' => ip2long(get_ip()),
        );

        $update_id = $this->Mydb->update($this->assigned_tasks_table, array('id' => $edit_id), $update_array);
        $log_msg = 'Task Assign Edit by ' . get_session_value('user_name');
        $log_from = get_session_value('user_id');
        $log_to = $asign_user_details;
        log_history($log_msg, $log_from, $log_to);
        $update_tasks_array = array('projects_id' => $asign_project,
            'task_title' => $asign_task_title,
            'from_user_id' => $_SESSION['user_id'],
            'to_user_id' => $asign_user_details,
            'message' => $asign_task_message,
            'project_duration' => $asign_duration_hours,
            'departments_id' => $asign_departments,
            'start_datetime' => date('Y-m-d H:i:s', strtotime($asign_start_date)),
            'end_datetime' => date('Y-m-d H:i:s', strtotime($asign_end_date)),
            'task_file' => $mediafiles != '' ? implode('|*|', $mediafiles) : '',
            'created_ip' => ip2long(get_ip()),
            'asigned_task_id' => $edit_id,
        );
        $update_tasks_id = $this->Mydb->update($this->tasks, array('asigned_task_id' => $edit_id), $update_tasks_array);
        $update_task_array = array('projects_id' => $asign_project,
            'task_title' => $asign_task_title,
            'from_user_id' => $_SESSION['user_id'],
            'to_user_id' => $asign_user_details,
            'message' => $asign_task_message,
            'project_duration' => $asign_duration_hours,
            'departments_id' => $asign_departments,
            'start_datetime' => date('Y-m-d H:i:s', strtotime($asign_start_date)),
            'end_datetime' => date('Y-m-d H:i:s', strtotime($asign_end_date)),
            'task_file' => $mediafiles != '' ? implode('|*|', $mediafiles) : '',
            'created_ip' => ip2long(get_ip()),
            'asigned_task_id' => $edit_id,
        );
        $update_task_id = $this->Mydb->update($this->task_history_table, array('tasks_id' => $update_tasks_id), $update_task_array);

        if ($update_id):
            $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Asign Task has been successfully updated');
            $this->session->set_userdata($session_datas);
            redirect(frontend_url() . 'tasks/manage_asign_task');
        else:
            $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Asign Task cannot be updated');
            $this->session->set_userdata($session_datas);
            redirect(frontend_url() . 'tasks/manage_asign_task');
        endif;
    }

    public function manage_asign_task() {
        $data = $this->load_module_info();
        $user_id = $_SESSION['user_id'];
        $user_type_id = $_SESSION['user_type_id'];
        if ($user_type_id >= 4):
            $getdetails = $this->Mydb->custom_query("select t1.*,t2.project_name,t2.project_description,t3.user_name as from_name,t4.user_name as to_name from $this->assigned_tasks_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id LEFT JOIN $this->login_table t3 ON t3.id=t1.assigned_from LEFT JOIN $this->login_table t4 ON t4.id=t1.assigned_to where t1.assigned_from=$user_id AND t1.status<>2");
        else:
            $getdetails = $this->Mydb->custom_query("select t1.*,t2.project_name,t2.project_description,t3.user_name as from_name,t4.user_name as to_name from $this->assigned_tasks_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id LEFT JOIN $this->login_table t3 ON t3.id=t1.assigned_from LEFT JOIN $this->login_table t4 ON t4.id=t1.assigned_to where t1.status<>2");
        endif;
        $data['records'] = $getdetails;
        $this->layout->display_frontend($this->folder . 'manage-asign-tasks', $data);
    }

    public function manage_new_task() {
        $data = $this->load_module_info();
        $user_id = $_SESSION['user_id'];
        $user_type_id = $_SESSION['user_type_id'];
        if ($user_type_id < 4):
            $getdetails = $this->Mydb->custom_query("select t1.task_title,t1.project_duration,t1.status,t1.finished_duration_hours,t1.id,t1.message,t2.project_name,t2.project_description,t1.projects_id,t3.assigned_hours,t3.finished_hours from $this->tasks_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id and t1.projects_id<>'others' LEFT JOIN $this->assigned_tasks_table t3 ON t3.id=t1.asigned_task_id where t1.to_user_id=$user_id AND t1.status<>2 group by asigned_task_id");
        else:
            $getdetails = $this->Mydb->custom_query("select t1.task_title,t1.project_duration,t1.status,t1.finished_duration_hours,t1.id,t1.message,t2.project_name,t2.project_description,t1.projects_id,t3.assigned_hours,t3.finished_hours from $this->tasks_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id and t1.projects_id<>'others' LEFT JOIN $this->assigned_tasks_table t3 ON t3.id=t1.asigned_task_id where  t1.status<>2 group by asigned_task_id");
        endif;

        $data['records'] = $getdetails;
        $this->layout->display_frontend($this->folder . 'manage-new-tasks', $data);
    }

    public function manage_new_task_history($method = null) {
        $data = $this->load_module_info();
        $task_id = (decode_value($method[0]));
        $user_id = $_SESSION['user_id'];
        $user_type_id = $_SESSION['user_type_id'];
        if ($user_type_id < 4):
            $getdetails = $this->Mydb->custom_query("select t1.task_title,t1.project_duration,t1.status,t1.id,t1.message,t2.project_name,t2.project_description,t1.projects_id,t3.assigned_hours,t3.finished_hours from $this->task_history_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id and t1.projects_id<>'others' LEFT JOIN $this->assigned_tasks_table t3 ON t3.id=t1.asigned_task_id where t1.to_user_id=$user_id AND t1.status<>2 AND t1.tasks_id=$task_id");
        else:
            $getdetails = $this->Mydb->custom_query("select t1.task_title,t1.project_duration,t1.status,t1.id,t1.message,t2.project_name,t2.project_description,t1.projects_id,t3.assigned_hours,t3.finished_hours from $this->task_history_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id and t1.projects_id<>'others' LEFT JOIN $this->assigned_tasks_table t3 ON t3.id=t1.asigned_task_id where  t1.status<>2 AND t1.tasks_id=$task_id");
        endif;

        $data['records'] = $getdetails;
        $this->layout->display_frontend($this->folder . 'manage-new-tasks-history', $data);
    }

    public function edit_new_task() {
        $task_id = $this->input->post('task_id');
        $user_type_id = $_SESSION['user_type_id'];
        $user_id = $_SESSION['user_id'];
        $getdetails = $this->Mydb->custom_query("select t1.*,t2.project_name,t3.status as finished_status,t3.finished_hours,t3.finished_message,t3.id as asigned_task_id,t3.assigned_hours,t3.finished_hours from $this->task_history_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id LEFT JOIN $this->assigned_tasks_table t3 ON t3.id=t1.asigned_task_id where t1.id=$task_id");
        if ($user_type_id < 5):
            $getprojectdetails = $this->Mydb->custom_query("select id as projects_id,project_name from $this->projects_table where status<>2");
        elseif ($user_type_id == 5):
            $getprojectdetails = $this->Mydb->custom_query("select t1.projects_id,t2.project_name from $this->project_teams_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id where t1.status<>2 and team_tl_id=$user_id");
        elseif ($user_type_id == 6):
            $getprojectdetails = $this->Mydb->custom_query("select DISTINCT(t1.projects_id),t2.project_name from $this->task_history_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id where t1.status<>2 and t1.to_user_id=$user_id");
        endif;
        $data['records'] = $getdetails;
        $data['project_details'] = $getprojectdetails;
        $body = $this->load->view($this->folder . 'edit_new_task', $data);
        echo $body;
    }

    public function add() {
        $data = $this->load_module_info();
        $user_id = $_SESSION['user_id'];
        $user_type_id = $_SESSION['user_type_id'];
        $user_departments_id = $_SESSION['user_departments_id'];

        if ($user_type_id == 5) {
            $getprojectdetails = $this->Mydb->custom_query("select t1.*,t2.project_name,t2.project_slug,t2.project_description from $this->project_teams_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id where team_tl_id=$user_id and t1.status<>2");
            $getemployeedetails = $this->Mydb->custom_query("select id,user_name from $this->login_table where user_departments_id=$user_departments_id and user_type_id=6 and user_reporter_id=$user_id and status=1");
            $data['project_details'] = $getprojectdetails;
            $data['employee_details'] = $getemployeedetails;
            $this->layout->display_frontend($this->folder . 'add-tasks', $data);
        } else if ($user_type_id == 6) {
            $projects_id = $this->Mydb->custom_query("select DISTINCT(projects_id) as projects_id from $this->task_history_table where to_user_id=$user_id and status<>2");
            $projecttitle = array();
            $projectsid = array();
            foreach ($projects_id as $projects):
                $projectid = $projects['projects_id'];
                $getprojectdetails = $this->Mydb->custom_query("select id,project_name from $this->projects_table where id=$projectid");
                $projecttitle[] = $getprojectdetails[0]['project_name'];
                $projectsid[] = $getprojectdetails[0]['id'];
            endforeach;
            if ($projecttitle != ''):
                $data['project_title'] = $projecttitle;
            else:
                $data['project_title'] = '';
            endif;
            $data['project_id'] = $projectsid;
            $this->layout->display_frontend($this->folder . 'add-employeetask', $data);
        }else if ($user_type_id >= 4) {
            $getprojectdetails = $this->Mydb->custom_query("select t2.project_name,t2.project_slug,t2.project_description,t2.id as projects_id from $this->projects_table t2 where t2.status<>2");
            $getemployeedetails = $this->Mydb->custom_query("select id,user_name from $this->login_table where user_departments_id=$user_departments_id and user_type_id=6 and user_reporter_id=$user_id and status=1");
            $data['project_details'] = $getprojectdetails;
            $data['employee_details'] = $getemployeedetails;
            $this->layout->display_frontend($this->folder . 'add-managetasks', $data);
        } else {
            $getprojectdetails = $this->Mydb->custom_query("select t1.*,t2.project_name,t2.project_slug,t2.project_description from $this->project_teams_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id where  t1.status<>2");
            $getemployeedetails = $this->Mydb->custom_query("select id,user_name from $this->login_table where user_departments_id=$user_departments_id and user_type_id=6 and status=1");
            $data['project_details'] = $getprojectdetails;
            $data['employee_details'] = $getemployeedetails;
            $this->layout->display_frontend($this->folder . 'add-managing-task', $data);
        }
    }

    public function edittask() {
        $data = $this->load_module_info();
        $user_id = $_SESSION['user_id'];
        $edit_id = $this->input->post('edit_id');
        $user_type_id = $_SESSION['user_type_id'];
        $user_departments_id = $_SESSION['user_departments_id'];
        if ($user_type_id == 5):
            $getprojectdetails = $this->Mydb->custom_query("select t1.*,t2.project_name,t2.project_slug,t2.project_description from $this->project_teams_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id where team_tl_id=$user_id");
        elseif ($user_type_id >= 4):
            $getprojectdetails = $this->Mydb->custom_query("select t2.project_name,t2.project_slug,t2.project_description,t2.id as projects_id from $this->projects_table t2 where t2.status<>2");
        elseif ($user_type_id == 6):
            $reporter_id = $_SESSION['user_reporter_id'];
            $getprojectdetails = $this->Mydb->custom_query("select t1.*,t2.project_name,t2.project_slug,t2.project_description from $this->project_teams_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id where team_tl_id=$reporter_id");
        else:

        endif;
        $getemployeedetails = $this->Mydb->custom_query("select id,user_name from $this->login_table where user_departments_id=$user_departments_id and user_type_id=6 and status=1");
        $taskdetails = $this->Mydb->custom_query("select * from $this->task_history_table where id=$edit_id");
        $data['project_details'] = $getprojectdetails;
        $data['employee_details'] = $getemployeedetails;
        $data['task_details'] = $taskdetails;
        $data['edit_id'] = $edit_id;
        $body = $this->load->view($this->folder . 'edit-task', $data);
        echo $body;
    }

    public function get_task_by_project() {
        $project_id = $this->input->post('project_id');
        $user_id = $_SESSION['user_id'];
        if ($project_id != 'others'):
            $gettask_details = $this->Mydb->custom_query("select DISTINCT(task_title),id,task_id from $this->task_history_table where projects_id=$project_id and (from_user_id=$user_id or to_user_id=$user_id)");
            $reponse['task_details'] = $gettask_details;
        else:
            $gettask_details = $this->Mydb->custom_query("select reason as task_title,id from $this->static_reasons_table where status=1");
            $reponse['task_details'] = $gettask_details;
        endif;
        echo json_encode($gettask_details);
    }

    public function update() {
        $data = $this->load_module_info();
        $edit_id = $this->input->post('edit_id');
        if ($_SESSION['user_type_id'] != 6):
            $this->form_validation->set_rules('task_project', 'Project Title', 'required|trim');
            if ($_SESSION['user_type_id'] != 6):
                $this->form_validation->set_rules('task_employee', 'Employee Name', 'required|trim');
            endif;
            $this->form_validation->set_rules('task_description', 'Task Description', 'required|trim');
            $this->form_validation->set_rules('task_start_date', 'Start Date', 'required|trim');
            $this->form_validation->set_rules('task_end_date', 'End Date', 'required|trim');
            $this->form_validation->set_rules('task_duration', 'Duration', 'required|trim');
            if ($this->form_validation->run($this) == TRUE) :
                $current_user_id = $_SESSION['user_id'];
                $project_id = $this->input->post('task_project');
                $task_employee = $this->input->post('task_employee');
                $task_title = $this->input->post('task_title');
                $task_description = $this->input->post('task_description');
                $task_start_date = date('Y-m-d H:i:s', strtotime($this->input->post('task_start_date')));
                $task_end_date = date('Y-m-d H:i:s', strtotime($this->input->post('task_end_date')));
                $task_duration = $this->input->post('task_duration');
                if ($_SESSION['user_id'] == 6):
                    $task_employee = $_SESSION['user_reporter_id'];
                    $task_status = $this->input->post('task_status');
                else:
                    $task_employee = $this->input->post('task_employee');
                    $task_status = 1;
                endif;
                $update_array = array('projects_id' => $project_id,
                    'project_duration' => $task_duration,
                    'task_title' => $task_title,
                    'message' => $task_description,
                    'from_user_id' => $current_user_id,
                    'to_user_id' => $task_employee,
                    'assigned_datetime' => $task_start_date,
                    'finished_datetime' => $task_end_date,
                    'created_ip' => ip2long(get_ip()),
                    'status' => $task_status);
                $insert_id = $this->Mydb->update($this->task_history_table, array('id' => $edit_id), $update_array);
                $log_msg = 'Task Edited by ' . get_session_value('user_name');
                $log_from = get_session_value('user_id');
                $log_to = $task_employee;
                log_history($log_msg, $log_from, $log_to);
                if ($insert_id):
                    $session_datas = array('pms_err' => '0', 'pms_err_message' => 'New Task has been successfully updated');
                    $this->session->set_userdata($session_datas);
                    $notiy_msg = stripslashes($task_title) . ' Task has been updated your Team Leader';
                    $notiy_from = $_SESSION['user_id'];
                    $notiy_to = $task_employee;
                    $notiy_type = 3;
                    create_notification($notiy_msg, $notiy_from, $notiy_to, $notiy_type);
                    redirect(frontend_url() . 'tasks');
                else:
                    $session_datas = array('pms_err' => '0', 'pms_err_message' => 'New Task can not be update');
                    $this->session->set_userdata($session_datas);
                    redirect(frontend_url() . 'tasks');
                endif;
            else:
                $session_datas = array('pms_err' => '0', 'pms_err_message' => validation_errors());
                $this->session->set_userdata($session_datas);
                redirect(frontend_url() . 'tasks');
            endif;
        else:
            $task_finished_date = date('Y-m-d H:i:s', strtotime($this->input->post('task_finished_date')));
            $task_finished_message = $this->input->post('task_finished_message');
            $task_end_date = date('Y-m-d H:i:s', strtotime($this->input->post('task_end_date')));
            if ($task_end_date < $task_finished_date):
                $timestamp1 = strtotime($task_end_date);
                $timestamp2 = strtotime($task_finished_date);
                $hour = number_format((abs($timestamp2 - $timestamp1) / (60 * 60)), 2) . " hour(s)";
            else:
                $hour = '';
            endif;
            $update_array = array('employee_finished_datetime' => $task_finished_date,
                'employee_finished_message' => $task_finished_message,
                'employee_finished_delay_hours' => $hour,
                'status' => 6);
            $update_id = $this->Mydb->update($this->task_history_table, array('id' => $edit_id), $update_array);
            if ($update_id):
                $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Task has been successfully updated');
                $this->session->set_userdata($session_datas);
                redirect(frontend_url() . 'tasks');
            else:
                $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Task cannot be updated');
                $this->session->set_userdata($session_datas);
                redirect(frontend_url() . 'tasks');
            endif;
        endif;
    }

    public function insert() {
        $data = $this->load_module_info();
        $this->form_validation->set_rules('task_project', 'Project Title', 'required|trim');
        if ($_SESSION['user_type_id'] != 6):
            $this->form_validation->set_rules('task_employee', 'Employee Name', 'required|trim');
        endif;
        $this->form_validation->set_rules('task_description', 'Task Description', 'required|trim');
        $this->form_validation->set_rules('task_start_date', 'Start Date', 'required|trim');
        $this->form_validation->set_rules('task_end_date', 'End Date', 'required|trim');
        $this->form_validation->set_rules('task_duration', 'Duration', 'required|trim');
        if ($this->form_validation->run($this) == TRUE) :
            $current_user_id = $_SESSION['user_id'];
            $project_id = $this->input->post('task_project');
            if ($_SESSION['user_type_id'] == 6):
                $task_employee = $_SESSION['user_reporter_id'];
                $task_status = $this->input->post('task_status');
            else:
                $task_employee = $this->input->post('task_employee');
                $task_status = 1;
            endif;

            $task_description = $this->input->post('task_description');
            $task_title = $this->input->post('task_title');
            $task_start_date = date('Y-m-d H:i:s', strtotime($this->input->post('task_start_date')));
            $task_end_date = date('Y-m-d H:i:s', strtotime($this->input->post('task_end_date')));
            $task_duration = $this->input->post('task_duration');
            $insert_array = array('projects_id' => $project_id,
                'project_duration' => $task_duration,
                'task_title' => $task_title,
                'message' => $task_description,
                'from_user_id' => $current_user_id,
                'to_user_id' => $task_employee,
                'departments_id' => $_SESSION['user_departments_id'],
                'assigned_datetime' => $task_start_date,
                'finished_datetime' => $task_end_date,
                'created_ip' => ip2long(get_ip()),
                'status' => $task_status);
            $insert_id = $this->Mydb->insert($this->task_history_table, $insert_array);
            $log_msg = 'Task Addedd by ' . get_session_value('user_name');
            $log_from = get_session_value('user_id');
            $log_to = $task_employee;
            log_history($log_msg, $log_from, $log_to);
            if ($_SESSION['user_type_id'] != 6):
                $notiy_msg = stripslashes($task_title) . ' Task has been asigned by ' . $_SESSION['user_name'];
                $notiy_from = $_SESSION['user_id'];
                $notiy_to = $task_employee;
                $notiy_type = 3;
            else:
                if ($task_status == '3'):
                    $statusmessage = "In Progress";
                elseif ($task_status == '4'):
                    $statusmessage = "Completed";
                elseif ($task_status == '5'):
                    $statusmessage = "Postponed";
                else:
                    $statusmessage = "Pending";
                endif;
                $notiy_msg = stripslashes($task_title) . ' Task has been ' . $statusmessage . ' by ' . $_SESSION['user_name'];
                $notiy_from = $_SESSION['user_id'];
                $notiy_to = $task_employee;
                $notiy_type = 3;
            endif;
            create_notification($notiy_msg, $notiy_from, $notiy_to, $notiy_type);
            if ($insert_id):
                $session_datas = array('pms_err' => '0', 'pms_err_message' => 'New Task has been successfully added');
                $this->session->set_userdata($session_datas);
                redirect(frontend_url() . 'tasks/add');
            else:
                $session_datas = array('pms_err' => '0', 'pms_err_message' => 'New Task can not be added');
                $this->session->set_userdata($session_datas);
                redirect(frontend_url() . 'tasks/add');
            endif;
        else:
            $session_datas = array('pms_err' => '0', 'pms_err_message' => validation_errors());
            $this->session->set_userdata($session_datas);
            redirect(frontend_url() . 'tasks/add');
        endif;
    }

    public function task_insert() {
        $data = $this->load_module_info();
//        $this->form_validation->set_rules('task_project', 'Project Title', 'required|trim');
//        if ($_SESSION['user_type_id'] != 6):
//            $this->form_validation->set_rules('task_employee', 'Employee Name', 'required|trim');
//        endif;
//        $this->form_validation->set_rules('task_description', 'Task Description', 'required|trim');
//        $this->form_validation->set_rules('task_start_date', 'Start Date', 'required|trim');
//        $this->form_validation->set_rules('task_end_date', 'End Date', 'required|trim');
//        $this->form_validation->set_rules('task_duration', 'Duration', 'required|trim');

        $current_user_id = $_SESSION['user_id'];
        $project_id = $this->input->post('task_project');
        if ($_SESSION['user_type_id'] == 6):
            $task_employee = $_SESSION['user_reporter_id'];
            $task_status = $this->input->post('task_status');
        elseif ($_SESSION['user_type_id'] == 5):
            $task_employee = $this->input->post('task_employee');
            $task_status = 1;
        elseif ($_SESSION['user_type_id'] == 4):
            $task_employee = $_SESSION['user_reporter_id'];
            $task_status = 1;
        elseif ($_SESSION['user_type_id'] > 4):
            $task_employee = 0;
            $task_status = 1;
        endif;

        $task_description = $this->input->post('task_description');
        $task_title = $this->input->post('task_title');
        $task_start_date = date('Y-m-d H:i:s', strtotime($this->input->post('task_start_date')));
        $task_end_date = date('Y-m-d H:i:s', strtotime($this->input->post('task_end_date')));
        $task_duration = $this->input->post('task_duration');
        $insert_array = array('projects_id' => $project_id,
            'project_duration' => $task_duration,
            'task_title' => $task_title,
            'message' => $task_description,
            'from_user_id' => $current_user_id,
            'to_user_id' => $task_employee,
            'task_type' => $this->input->post('task_type'),
            'departments_id' => $_SESSION['user_departments_id'],
            'assigned_datetime' => $task_start_date,
            'finished_datetime' => $task_end_date,
            'created_ip' => ip2long(get_ip()),
            'status' => $task_status);
        $insert_id = $this->Mydb->insert($this->task_history_table, $insert_array);
        $log_msg = 'Task Added by ' . get_session_value('user_name');
        $log_from = get_session_value('user_id');
        $log_to = $task_employee;
        log_history($log_msg, $log_from, $log_to);
        if ($_SESSION['user_type_id'] != 6):
            $notiy_msg = stripslashes($task_title) . ' Task has been asigned by ' . $_SESSION['user_name'];
            $notiy_from = $_SESSION['user_id'];
            $notiy_to = $task_employee;
            $notiy_type = 3;
        else:
            if ($task_status == '3'):
                $statusmessage = "In Progress";
            elseif ($task_status == '4'):
                $statusmessage = "Completed";
            elseif ($task_status == '5'):
                $statusmessage = "Postponed";
            else:
                $statusmessage = "Pending";
            endif;
            $notiy_msg = stripslashes($task_title) . ' Task has been ' . $statusmessage . ' by ' . $_SESSION['user_name'];
            $notiy_from = $_SESSION['user_id'];
            $notiy_to = $task_employee;
            $notiy_type = 3;
        endif;
        create_notification($notiy_msg, $notiy_from, $notiy_to, $notiy_type);
        if ($insert_id):
            $session_datas = array('pms_err' => '0', 'pms_err_message' => 'New Task has been successfully added');
            $this->session->set_userdata($session_datas);
            redirect(frontend_url() . 'tasks/add');
        else:
            $session_datas = array('pms_err' => '0', 'pms_err_message' => 'New Task can not be added');
            $this->session->set_userdata($session_datas);
            redirect(frontend_url() . 'tasks/add');
        endif;
    }

    public function calculate_hours() {
        $startdate = $this->input->post('task_start_date');
        $end_date = $this->input->post('task_end_date');
        $timestamp1 = strtotime($startdate);
        $timestamp2 = strtotime($end_date);
        $hour = number_format((abs($timestamp2 - $timestamp1) / (60 * 60)), 2) . " hour(s)";
        $response['message'] = $hour;
        echo json_encode($response);
    }

    public function calculatehours() {
        $startdate = $this->input->post('task_start_date');
        $end_date = $this->input->post('task_end_date');
        $getholidays = $this->Mydb->custom_query("select holiday_date from $this->srm_holidays_table where status=1");
        $holidays = array();
        if (!empty($getholidays)) {
            foreach ($getholidays as $srmholiday):
                $holidays[] = $srmholiday['holiday_date'];
            endforeach;
        }else {
            $holidays[] = '';
        }
        $date1 = $startdate;
        $date2 = $end_date;


        $new_time = date('Y-m-d') . ' 10:00 AM';
        $endtime_time = date('Y-m-d') . ' 07:00 PM';
        $at_time = '07:45:00';
        $another_time = '10:30:45';
        $ranges = [
            ['start' => '10:00:00', 'end' => '19:00:00']
        ];
        echo $at_time, " match? ", $this->arrayContainsTime($at_time, $ranges);
        echo "<br>";
        echo $another_time, " match? ", $this->arrayContainsTime($another_time, $ranges);
//        echo $hour = number_format((abs($timestamp2 - $timestamp1) / (60 * 60)), 2) . " hour(s)";
        $start = new DateTime($startdate);
        $end = new DateTime($end_date);
// otherwise the  end date is excluded (bug?)
        $end->modify('+1 day');

        $interval = $end->diff($start);

// total days
        $days = $interval->days;

// create an iterateable period of date (P1D equates to 1 day)
        $period = new DatePeriod($start, new DateInterval('P1D'), $end);
//        print_r($period);
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

    function arrayContainsTime($time, $ranges) {
        $target = strtotime($time);
        foreach ($ranges as $range) {
            $start = strtotime($range['start']);
            $end = strtotime($range['end']);

            if ($target > $start && $target < $end) {
                return 1;
            }
        }
        return 0;
    }

    public function download_files($fileName = NULL) {
        if ($fileName[0]) {
            $file = FCPATH . 'media/task/' . $fileName[0];

            // check file exists    
            if (file_exists($file)) {
                // get file content
                $data = file_get_contents($file);
                //force download
                force_download($fileName[0], $data);
            } else {
                // Redirect to base url
                redirect(frontend_url());
            }
        }
    }

    public function getfinished_hours() {
        $task_id = $this->input->post('task_id');
        $project_id = $this->input->post('project_id');
        $getfinished_hours = $this->Mydb->custom_query("select finished_duration_hours,project_duration,start_datetime,end_datetime from $this->tasks_table where projects_id=$project_id and id=$task_id");
        $response['finished_hours'] = $getfinished_hours[0]['finished_duration_hours'];
        $response['project_duration'] = $getfinished_hours[0]['project_duration'];
        $response['start_datetime'] = $getfinished_hours[0]['start_datetime'];
        $response['end_datetime'] = $getfinished_hours[0]['end_datetime'];
        echo json_encode($response);
    }

    public function getavailablehours() {
        $project_id = $this->input->post('project_id');
        $departments_id = $this->input->post('departments_id');
        $team_id = $_SESSION['user_departments_id'];
        $getestimatehours = $this->Mydb->custom_query("select time_duration from $this->project_teams_table where projects_id=$project_id and team_departments_id=$team_id");
        $estimated_hours = $getestimatehours[0]['time_duration'];
        $getusedhours = $this->Mydb->custom_query("select SUM(project_duration) as used_hours  from $this->tasks_table where projects_id=$project_id and departments_id=$team_id and status<>2");
        $teamasigned_hours = $getusedhours[0]['used_hours'];
        $available_hours = $estimated_hours - $teamasigned_hours;
        $response['available_hours'] = $available_hours;
        echo json_encode($response);
    }

    public function getavailable_hours() {
        $project_id = $this->input->post('project_id');
        $departments_id = $this->input->post('department_id');
        $team_id = $_SESSION['user_departments_id'];
        $getestimatehours = $this->Mydb->custom_query("select time_duration from $this->project_teams_table where projects_id=$project_id and team_departments_id=$departments_id");
        $estimated_hours = $getestimatehours[0]['time_duration'];
        $getusedhours = $this->Mydb->custom_query("select SUM(project_duration) as used_hours  from $this->tasks_table where projects_id=$project_id and departments_id=$departments_id and status<>2");
        $teamasigned_hours = $getusedhours[0]['used_hours'];
        $available_hours = $estimated_hours - $teamasigned_hours;
        $response['available_hours'] = $available_hours;
        echo json_encode($response);
    }

    private function load_module_info() {
        $data = array();
        $data ['module_label'] = $this->module_label;
        $data ['module_labels'] = $this->module_labels;
        $data ['module'] = $this->module;
        return $data;
    }

}
