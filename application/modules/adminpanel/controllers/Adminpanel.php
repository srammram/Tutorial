<?php
/**************************
Project Name	: POS
Created on		: 18 Feb, 2016
Last Modified 	: 18 Feb, 2016
Description		: Page contains admin panel login and forgot password functions.

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Adminpanel extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->module = "adminpanel";
		$this->module_label = "adminpanel";
		$this->folder = "login/";
		$this->table = "master_admin";
		$this->login_history_table = "master_admin_login_history";
	}
	
	/* this method used to check login */
	public function index() {
		$data = array ();
		
		if ($this->input->post ( 'submit' ) == 'Login') 		// if ajax submit
		{
			$response = array ();
			$alert = "";
			$this->form_validation->set_rules ( 'username', 'Username', 'required|trim' );
			$this->form_validation->set_rules ( 'password', 'Password', 'required|min_length[' . PASSWORD_LENGHT . ']|trim' );
			if ($this->form_validation->run ( $this ) == TRUE) {
				
				$this->mysqli = new mysqli ( $this->db->hostname, $this->db->username, $this->db->password, $this->db->database );
				$password = $this->mysqli->real_escape_string ( trim ( $this->input->post ( 'password' ) ) );
				$username = $this->mysqli->real_escape_string ( trim ( $this->input->post ( 'username' ) ) );

				$check_details = $this->Mydb->get_record ('admin_id,admin_username,admin_password,admin_status', $this->table, array ('admin_username' => $username) );
				
				if ($check_details)
				{
					if ($check_details['admin_status'] == 'A'){
							
						$password_verify = check_hash($password,$check_details['admin_password']);
							
						if($password_verify == "Yes")
						{
							$session_datas = array('nc_admin_id' => $check_details['admin_id'],'nc_admin_name' => 'Admin' );
		
							$this->session->set_userdata($session_datas);
							
							/* store last login details...*/
							$this->Mydb->insert($this->login_history_table,array('login_time'=>current_date(),'login_ip'=>get_ip(),'login_admin_id'=>$check_details['admin_id']));
				
							echo json_encode ( array('status'=>'success') ); exit;
				
						}	else{
							$alert = 'acount_login_missmatch';
						}
					}
					else{
						$alert = 'account_disabled';
					}
				}
				else
				{
					$alert = 'acount_not_found';
						
				}
				
				$response ['status'] = 'error';
				$response ['message'] = get_label ( $alert );
				
				
				
			} else {
				$response ['status'] = 'error';
				$response ['message'] = validation_errors ();
			}
			echo json_encode ( $response ); exit;
		}
		$this->load->view ( $this->folder . '/login' );
	}
	
	/* this function used to destroy all admin session values */
	public function admin_logout() {
		
		$this->session->sess_destroy();
		
		redirect(admin_url());
	
	}
}
