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
        $this->project_teams_table = 'project_teams';
        $this->load->library('common');
        $this->load->helper('download');
        $this->email_table = 'email_setting';
        $this->media_history_table = 'media_history';
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
            if ($method !== 'download_files') {
                $this->index($method, $args);
            } else if ($method == 'download_files') {
                $this->download_files($method, $args);
            }
        }
    }

    public function index() {
        $data = $this->load_module_info();
        $projectdetails = $this->Mydb->custom_query("select * from $this->projects_table where status<>2");

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
            $pro_start = $this->input->post('pro_start') != '' ? $this->input->post('pro_start') : '';
            $pro_finished = $this->input->post('pro_finished') != '' ? $this->input->post('pro_finished') : '';
            $pro_duration = $this->input->post('pro_duration') != '' ? $this->input->post('pro_duration') : '';
            $pro_team = $proteam;
            $mediafiles = $this->input->post('mediaFiles');
            $insert_array = array('project_name' => $pro_title,
                'project_slug' => url_title($pro_title, '-', TRUE),
                'project_description' => $pro_description,
                'project_type_status' => $pro_type,
                'project_during_hours' => $pro_duration,
                'project_start_date' => $pro_start,
                'project_finished_date' => $pro_finished,
                'project_team' => $pro_team,
                'project_file' => $mediafiles != '' ? implode('|*|', $mediafiles) : '',
                'created_on' => current_date(),
                'created_ip' => ip2long(get_ip()),
                'status' => 1
            );



            $insert_id = $this->Mydb->insert($this->projects_table, $insert_array);
            if ($insert_id):
                $session_datas = array('pms_err' => '0', 'pms_err_message' => 'New Project has been successfully added');
                $this->session->set_userdata($session_datas);
                if ($_SESSION['user_id'] == 1):
                    $getmanagerdetails = $this->Mydb->custom_query("select id from $this->login_table where user_type_id=4");
                    foreach ($getmanagerdetails as $userdet):
                        $notiy_msg = stripslashes($pro_title) . ' Project has been added';
                        $notiy_from = $_SESSION['user_id'];
                        $notiy_to = $userdet['id'];
                        $notiy_type = '1';
                        $notification = create_notification($notiy_msg, $notiy_from, $notiy_to, $notiy_type);
                    endforeach;
                else:
                    $notiy_msg = stripslashes($pro_title) . ' Project has been added';
                    $notiy_from = $_SESSION['user_id'];
                    $notiy_to = '1';
                    $notiy_type = '1';
                    $notification = create_notification($notiy_msg, $notiy_from, $notiy_to, $notiy_type);
                endif;
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

    public function upload_files() {
        if (!empty($_FILES['file']['name']) && isset($_FILES ['file'] ['name'])) {
//            $create_user_doc_name = url_title(substr($pro_title, 0, 10), '-', TRUE) . '-project-' . $_FILES['pro_file']['name'];
            $doc_image = $this->common->upload_image('file', 'project/', '');
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

    public function get_upload_images() {
        echo $this->input->get('project_id');
    }

    public function update() {
        $data = $this->load_module_info();
        $edit_id = $this->input->post('edit_id');
        $pro_title = $this->input->post('pro_title');
        $pro_description = $this->input->post('pro_description');
        $pro_type = $this->input->post('pro_type');
        $pro_start = $this->input->post('pro_start') != '' ? $this->input->post('pro_start') : '';
        $pro_finished = $this->input->post('pro_finished') != '' ? $this->input->post('pro_finished') : '';
        $pro_duration = $this->input->post('pro_duration') != '' ? $this->input->post('pro_duration') : '';
        $pro_team = $this->input->post('pro_team') != '' ? implode(',', $this->input->post('pro_team')) : '';
        $mediafiles = $this->input->post('mediaFiles') != '' ? $this->input->post('mediaFiles') : '';

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
            'project_file' => implode('|*|', $mediafiles),
        );

        $update_id = $this->Mydb->update($this->projects_table, array('id' => $edit_id), $update_array);
        if ($update_id) {
            $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Project has been successfully updated');
            $this->session->set_userdata($session_datas);
            if ($_SESSION['user_id'] == 1):
                $getmanagerdetails = $this->Mydb->custom_query("select id from $this->login_table where user_type_id=2");
                foreach ($getmanagerdetails as $userdet):
                    $notiy_msg = stripslashes($pro_title) . ' Project has been updated';
                    $notiy_from = $userdet['id'];
                    $notiy_to = '1';
                    $notiy_type = '1';
                    create_notification($notiy_msg, $notiy_from, $notiy_to, $notiy_type);
                endforeach;
            else:
                $notiy_msg = stripslashes($pro_title) . ' Project has been updated';
                $notiy_from = $_SESSION['user_id'];
                $notiy_to = '1';
                $notiy_type = '1';
                create_notification($notiy_msg, $notiy_from, $notiy_to, $notiy_type);
            endif;
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

    public function changestatus_fromteam() {
        $project_id = $this->input->post('project_id');
        $getprojectdetails = $this->Mydb->custom_query("select * from $this->projects_table where id=$project_id");
        $team_details = $this->Mydb->custom_query("select name,id from $this->departments_table where status=1");
        $data['records'] = $getprojectdetails;
        $data['team_details'] = $team_details;
        $data['project_id'] = $project_id;
        $body = $this->load->view($this->folder . 'changestatus_forteam', $data);
        echo $body;
    }

    public function change_project_status() {
        $edit_id = $this->input->post('edit_id');
        $finished_hours = $this->input->post('finished_hours') != '' ? $this->input->post('finished_hours') : 0;
        $update_array = array('status' => $this->input->post('change_status'));
        $update_id = $this->Mydb->update($this->project_teams_table, array('id' => $edit_id), $update_array);
        if ($update_id) {
            $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Project Status has been successfully added');
            $this->session->set_userdata($session_datas);
            redirect(frontend_url() . 'projects/assigned_teamprojects');
        } else {
            $session_datas = array('pms_err' => '0', 'pms_err_message' => 'Project Status cannot be  added');
            $this->session->set_userdata($session_datas);
            redirect(frontend_url() . 'projects/assigned_teamprojects');
        }
    }

    public function assign_projects() {
        $project_id = $this->input->post('project_id');
        $getprojectdetails = $this->Mydb->custom_query("select * from $this->projects_table where id=$project_id");
        $data['records'] = $getprojectdetails;
        $data['project_id'] = $project_id;
        $project_team = explode(',', $getprojectdetails[0]['project_team']);
        foreach ($project_team as $proteam):
            $getteamname = $this->Mydb->custom_query("select name,id,slug from $this->departments_table where id=$proteam");
            $project_team_name[] = $getteamname[0]['name'];
            $departemnt_id = $getteamname[0]['id'];
            $gettldetails = $this->Mydb->custom_query("select user_name,id from $this->login_table where user_type_id=5 and user_departments_id=$departemnt_id and status=1");
            $tl_details[] = $gettldetails;
        endforeach;
        $getdepartments = $this->Mydb->custom_query("select name,id,slug from $this->departments_table where status=1");
        $data['project_team_name'] = $project_team_name;
        $data['departments'] = $getdepartments;
        $data['tl_details'] = $tl_details;
        $body = $this->load->view($this->folder . 'asignproject', $data);
        echo $body;
    }

    public function assigned_projects() {
        $project_id = $this->input->post('project_id');
        $getprojectdetails = $this->Mydb->custom_query("select * from $this->projects_table where id=$project_id");
        $data['records'] = $getprojectdetails;
        $data['project_id'] = $project_id;
        $project_team = explode(',', $getprojectdetails[0]['project_team']);
        foreach ($project_team as $proteam):
            $getteamname = $this->Mydb->custom_query("select name,id,slug from $this->departments_table where id=$proteam");
            $project_team_name[] = $getteamname[0]['name'];
            $departemnt_id = $getteamname[0]['id'];
            $gettldetails = $this->Mydb->custom_query("select user_name,id from $this->login_table where user_type_id=5 and user_departments_id=$departemnt_id and status=1");
            $tl_details[] = $gettldetails;
        endforeach;
        $getdepartments = $this->Mydb->custom_query("select name,id,slug from $this->departments_table where status=1");
        $getassigneddetails = $this->Mydb->custom_query("select t1.*,t2.user_name from $this->project_teams_table t1 LEFT JOIN $this->login_table t2 ON t2.id=t1.team_tl_id where projects_id=$project_id and t1.status=1");
        $data['project_team_name'] = $project_team_name;
        $data['project_team_details'] = $getassigneddetails;
        $data['departments'] = $getdepartments;
        $data['tl_details'] = $tl_details;
        $body = $this->load->view($this->folder . 'asignedproject', $data);
        echo $body;
    }

    public function assigned_teamprojects() {
        $data = $this->load_module_info();
        $user_id = $_SESSION['user_id'];
        $getprojectdetails = $this->Mydb->custom_query("select t1.*,t2.project_name,t2.project_slug,t2.project_description from $this->project_teams_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id where t1.team_tl_id=$user_id and t1.status<>2");

        $data['get_assigned_project_details'] = $getprojectdetails;
        $this->layout->display_frontend($this->folder . 'assigned_team_project', $data);
    }

    public function asingnteam_byproject() {
        $project_id = $this->input->post('project_id');
        $team_duration_hours = $this->input->post('team_duration_hours');
        $select_team_tl = $this->input->post('select_team_tl');
        $countteamtl = count($select_team_tl);
        $getprojectdetails = $this->Mydb->custom_query("select project_name from $this->projects_table where id=$project_id");
        for ($i = 0; $i < $countteamtl; $i++) {
            $tlid = $select_team_tl[$i];
            $duration_hours = $team_duration_hours[$i];
            $getdepartment = $this->Mydb->custom_query("select user_departments_id from $this->login_table where id=$tlid");
            $insert_array = array('team_tl_id' => $tlid,
                'team_departments_id' => $getdepartment[0]['user_departments_id'],
                'projects_id' => $project_id,
                'time_duration' => $duration_hours,
                'created_by' => $_SESSION['user_id'],
                'created_at' => current_date(),
                'created_ip' => ip2long(get_ip()),
                'status' => 1);
            $insert_id = $this->Mydb->insert($this->project_teams_table, $insert_array);

            $notiy_msg = stripslashes($getprojectdetails[0]['project_title']) . ' Project has been asigned your team';
            $notiy_from = $_SESSION['user_id'];
            $notiy_to = $tlid;
            $notiy_type = 2;
            create_notification($notiy_msg, $notiy_from, $notiy_to, $notiy_type);
        }
        if ($insert_id):
            $update_array = array('status' => 5);
            $updateproject = $this->Mydb->update($this->projects_table, array('id' => $project_id), $update_array);
            $response = "<div class='alert alert-success'>Your details has been successfully added.</div>";
        else:
            $response = "<div class='alert alert-danger'>Your details hasn't added. Please try again</div>";
        endif;
        echo $response;
    }

    function convertNumber($number) {
        list($integer, $fraction) = explode(".", (string) $number);

        $output = "";

        if ($integer{0} == "-") {
            $output = "negative ";
            $integer = ltrim($integer, "-");
        } else if ($integer{0} == "+") {
            $output = "positive ";
            $integer = ltrim($integer, "+");
        }

        if ($integer{0} == "0") {
            $output .= "zero";
        } else {
            $integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
            $group = rtrim(chunk_split($integer, 3, " "), " ");
            $groups = explode(" ", $group);

            $groups2 = array();
            foreach ($groups as $g) {
                $groups2[] = convertThreeDigit($g{0}, $g{1}, $g{2});
            }

            for ($z = 0; $z < count($groups2); $z++) {
                if ($groups2[$z] != "") {
                    $output .= $groups2[$z] . convertGroup(11 - $z) . (
                            $z < 11 && !array_search('', array_slice($groups2, $z + 1, -1)) && $groups2[11] != '' && $groups[11]{0} == '0' ? " and " : ", "
                            );
                }
            }

            $output = rtrim($output, ", ");
        }

        if ($fraction > 0) {
            $output .= " point";
            for ($i = 0; $i < strlen($fraction); $i++) {
                $output .= " " . convertDigit($fraction{$i});
            }
        }

        return $output;
    }

    function convertGroup($index) {
        switch ($index) {
            case 11:
                return " decillion";
            case 10:
                return " nonillion";
            case 9:
                return " octillion";
            case 8:
                return " septillion";
            case 7:
                return " sextillion";
            case 6:
                return " quintrillion";
            case 5:
                return " quadrillion";
            case 4:
                return " trillion";
            case 3:
                return " billion";
            case 2:
                return " million";
            case 1:
                return " thousand";
            case 0:
                return "";
        }
    }

    function convertThreeDigit($digit1, $digit2, $digit3) {
        $buffer = "";

        if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0") {
            return "";
        }

        if ($digit1 != "0") {
            $buffer .= convertDigit($digit1) . " hundred";
            if ($digit2 != "0" || $digit3 != "0") {
                $buffer .= " and ";
            }
        }

        if ($digit2 != "0") {
            $buffer .= convertTwoDigit($digit2, $digit3);
        } else if ($digit3 != "0") {
            $buffer .= convertDigit($digit3);
        }

        return $buffer;
    }

    function convertTwoDigit($digit1, $digit2) {
        if ($digit2 == "0") {
            switch ($digit1) {
                case "1":
                    return "ten";
                case "2":
                    return "twenty";
                case "3":
                    return "thirty";
                case "4":
                    return "forty";
                case "5":
                    return "fifty";
                case "6":
                    return "sixty";
                case "7":
                    return "seventy";
                case "8":
                    return "eighty";
                case "9":
                    return "ninety";
            }
        } else if ($digit1 == "1") {
            switch ($digit2) {
                case "1":
                    return "eleven";
                case "2":
                    return "twelve";
                case "3":
                    return "thirteen";
                case "4":
                    return "fourteen";
                case "5":
                    return "fifteen";
                case "6":
                    return "sixteen";
                case "7":
                    return "seventeen";
                case "8":
                    return "eighteen";
                case "9":
                    return "nineteen";
            }
        } else {
            $temp = convertDigit($digit2);
            switch ($digit1) {
                case "2":
                    return "twenty-$temp";
                case "3":
                    return "thirty-$temp";
                case "4":
                    return "forty-$temp";
                case "5":
                    return "fifty-$temp";
                case "6":
                    return "sixty-$temp";
                case "7":
                    return "seventy-$temp";
                case "8":
                    return "eighty-$temp";
                case "9":
                    return "ninety-$temp";
            }
        }
    }

    function convertDigit($digit) {
        switch ($digit) {
            case "0":
                return "zero";
            case "1":
                return "one";
            case "2":
                return "two";
            case "3":
                return "three";
            case "4":
                return "four";
            case "5":
                return "five";
            case "6":
                return "six";
            case "7":
                return "seven";
            case "8":
                return "eight";
            case "9":
                return "nine";
        }
    }

    public function view_assigned_project() {
        $project_id = $this->input->post('project_id');
        $getproject_team_details = $this->Mydb->custom_query("select t1.*,t3.user_name,t2.project_name,t2.project_slug,t2.project_description,t2.project_file from $this->project_teams_table t1 LEFT JOIN $this->projects_table t2 ON t2.id=t1.projects_id LEFT JOIN $this->login_table t3 ON t3.id=t1.created_by where t1.id='$project_id'");
        $data['records'] = $getproject_team_details;
        $body = $this->load->view($this->folder . 'asigned_view_project', $data);
        echo $body;
    }

    public function download_files($fileName = NULL) {
        if ($fileName) {
            $file = FCPATH . 'media/project/' . $fileName;
            // check file exists    
            if (file_exists($file)) {
                // get file content
                $data = file_get_contents($file);
                //force download
                force_download($fileName, $data);
            } else {
                // Redirect to base url
                redirect(frontend_url() . 'projects/assigned_teamprojects');
            }
        }
    }

    public function downloadfiles() {
        $fileName = $this->input->post('filename');
        $file_path = FCPATH . 'media/project/' . $fileName;
//        echo $file_path;
        $this->_push_file($file_path, $fileName);
    }

    function _push_file($path, $name) {
        $this->load->helper('download');
        // make sure it's a file before doing anything!
        if (is_file($path)) {
            // required for IE
            if (ini_get('zlib.output_compression')) {
                ini_set('zlib.output_compression', 'Off');
            }

            // get the file mime type using the file extension
            $this->load->helper('file');
            $mime = get_mime_by_extension($path);
            // Build the headers to push out the file properly.
            header('Pragma: public');     // required
            header('Expires: 0');         // no cache
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($path)) . ' GMT');
            header('Cache-Control: private', false);
            header('Content-Type: ' . $mime);  // Add the mime type from Code igniter.
            header('Content-Disposition: attachment; filename="' . basename($name) . '"');  // Add the file name
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($path)); // provide file size
            header('Connection: close');
            readfile($path); // push it out
            exit();
        }
    }

    private function load_module_info() {
        $data = array();
        $data ['module_label'] = $this->module_label;
        $data ['module_labels'] = $this->module_labels;
        $data ['module'] = $this->module;
        return $data;
    }

}
