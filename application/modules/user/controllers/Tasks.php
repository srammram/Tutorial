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

    public function index() {
        $data = $this->load_module_info();
        $user_id = $_SESSION['user_id'];
        $user_type_id = $_SESSION['user_type_id'];
        $user_departments_id = $_SESSION['user_departments_id'];
        if ($user_type_id == 5):
            $gettaskdetails = $this->Mydb->custom_query("select t1.*,t2.user_name as from_username,t4.user_name as to_user_name,t3.project_name,t3.project_description from $this->task_history_table t1 LEFT JOIN $this->login_table t2 ON t2.id=t1.from_user_id LEFT JOIN $this->login_table t4 ON t4.id=t1.to_user_id LEFT JOIN $this->projects_table t3 ON t3.id=t1.projects_id where (from_user_id=$user_id OR to_user_id=$user_id) AND t1.status<>3");
        elseif ($user_type_id == 6):
            $gettaskdetails = $this->Mydb->custom_query("select t1.*,t2.user_name as from_username,t4.user_name as to_user_name,t3.project_name,t3.project_description from $this->task_history_table t1 LEFT JOIN $this->login_table t2 ON t2.id=t1.from_user_id LEFT JOIN $this->login_table t4 ON t4.id=t1.to_user_id LEFT JOIN $this->projects_table t3 ON t3.id=t1.projects_id where (from_user_id=$user_id OR to_user_id=$user_id) AND t1.status<>3");
        else:
            $gettaskdetails = $this->Mydb->custom_query("select t1.*,t2.user_name as from_username,t4.user_name as to_user_name,t3.project_name,t3.project_description from $this->task_history_table t1 LEFT JOIN $this->login_table t2 ON t2.id=t1.from_user_id LEFT JOIN $this->login_table t4 ON t4.id=t1.to_user_id LEFT JOIN $this->projects_table t3 ON t3.id=t1.projects_id where t1.status<>3");
        endif;
        $data['task_details'] = $gettaskdetails;
        $this->layout->display_frontend($this->folder . 'manage-tasks', $data);
    }

    public function add() {
        $data = $this->load_module_info();
        $user_id = $_SESSION['user_id'];
        $user_type_id = $_SESSION['user_type_id'];
        $user_departments_id = $_SESSION['user_departments_id'];

        if ($user_type_id != 6) {
            $getprojectdetails = $this->Mydb->custom_query("select t1.*,t2.project_name,t2.project_slug,t2.project_description from $this->project_teams_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id where team_tl_id=$user_id and t1.status<>3");
            $getemployeedetails = $this->Mydb->custom_query("select id,user_name from $this->login_table where user_departments_id=$user_departments_id and user_type_id=6 and user_reporter_id=$user_id and status=1");
            $data['project_details'] = $getprojectdetails;
            $data['employee_details'] = $getemployeedetails;
            $this->layout->display_frontend($this->folder . 'add-tasks', $data);
        } else if ($user_type_id == 6) {
            $projects_id = $this->Mydb->custom_query("select DISTINCT(projects_id) as projects_id from $this->task_history_table where to_user_id=$user_id and status<>3");
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
        } else {
            $getprojectdetails = $this->Mydb->custom_query("select t1.*,t2.project_name,t2.project_slug,t2.project_description from $this->project_teams_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id where  t1.status<>3");
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
        if ($user_type_id != 6):
            $getprojectdetails = $this->Mydb->custom_query("select t1.*,t2.project_name,t2.project_slug,t2.project_description from $this->project_teams_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id where team_tl_id=$user_id");
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
            $gettask_details = $this->Mydb->custom_query("select task_title,id,task_id from $this->task_history_table where projects_id=$project_id and (from_user_id=$user_id or to_user_id=$user_id)");
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

    private function load_module_info() {
        $data = array();
        $data ['module_label'] = $this->module_label;
        $data ['module_labels'] = $this->module_labels;
        $data ['module'] = $this->module;
        return $data;
    }

}
