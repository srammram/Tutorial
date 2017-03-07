<?php
/**************************
Project Name	: POS
Created on		: 19 Feb, 2016
Last Modified 	: 25 Feb, 2016
Description		: Page contains company add edit and delete functions..

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class User extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->module = "user";
		$this->module_label = get_label ( 'user_module_label' );
		$this->module_labels = get_label ( 'user_module_label' );
		$this->folder = "user/";
		$this->table = "users";
		$this->referral_table = "referral";
		$this->login_history_table ="afsys_user_login_history";
		$this->load->library ( 'common' );
		$this->load->library('email');
		$this->primary_key = 'user_id';
	}
	
	/* this method used to list all company . */
	public function index() {
		
		$data = $this->load_module_info ();
		$user_id = get_session_value('current_user_id');
		$get_user_data = $this->Mydb->get_record (
							'user_id,user_name,user_username,user_password,user_email_address,user_profile_image,	   user_folder_name,user_credit_points,user_status,user_referral_id', 
							$this->table,
							array ($this->primary_key  => $user_id)
						);
		if($get_user_data !='' && !empty($get_user_data)){
			$data['user'] = $get_user_data;
			$session_datas = array( 'user_id'    		  => $get_user_data['user_id'],
									'user_name'    		  => $get_user_data['user_name'],
									'user_username'		  => $get_user_data['user_username'],
									'user_referral_code'  => $get_user_data['user_referral_id'],
									'user_credit_points'  => $get_user_data['user_credit_points'],
									'user_email_address'  => $get_user_data['user_email_address'],
									'user_profile_image'  => $get_user_data['user_profile_image'],
									'user_folder_name'    => $get_user_data['user_folder_name']
								  );
			$this->session->set_userdata($session_datas);
			$data['module_action'] = 'sendreferral'; 
			$this->layout->display_frontend ( $this->folder . $this->module . "-landing", $data );
			
		}else{
			redirect(frontend_url());
			
		}				
		
	}
	
	/* This method used to user login */
	public function login(){
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

				$check_details = $this->Mydb->get_record (
								'user_id,user_name,user_username,user_password,user_email_address,user_profile_image,	   user_folder_name,user_status', 
								$this->table,
								array ('user_username'  => $username)
								);
				
				if ($check_details)
				{
					if ($check_details['user_status'] == 'A'){
							
						$password_verify = check_hash($password,$check_details['user_password']);
							
						if($password_verify == "Yes")
						{
							$user_id = $check_details['user_id'];							
							$session_datas = array( 'current_user_id'     => $user_id);
							$this->session->set_userdata($session_datas);
							$user_points  =  $this->get_userPoints($user_id);
							$login_points = $this->config->item('login_points', 'siteSettings') ? $this->config->item('login_points', 'siteSettings'):10;
							$total_points = $user_points + $login_points;
							$this->addUserpoints($total_points, $user_id);
							/* store last login details...*/
							$this->Mydb->insert($this->login_history_table,array('login_time'=>current_date(),'login_ip'=>get_ip(),'login_user_id'=>$user_id));
				
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
	/* This method used to new User Registration . */
	public function register($referral_code = '') {
		
		
		$data = $this->load_module_info ();
		$data['referral_code'] = $referral_code;
		/* form submit */
		if ($this->input->post ( 'action' ) == "Register") {
			form_check_ajax_request (); /* skip direct access */
			
			$this->form_validation->set_rules ( 'user_name', 'lang:user_name', 'required' );
			$this->form_validation->set_rules ( 'user_username', 'lang:user_username', 'required|min_length[' . get_label ( 'username_minlength' ) . ']|callback_username_exists' );
			$this->form_validation->set_rules ( 'user_password', 'lang:user_password', 'required' );
			$this->form_validation->set_rules ( 'user_email', 'lang:user_email', 'required|valid_email|valid_email|callback_email_exists' );
			$this->form_validation->set_rules ( 'user_profile_image', 'lang:user_profile_image', 'callback_validate_image' );
			
			if ($this->form_validation->run () == TRUE) {
				
				$password = do_bcrypt(post_value('user_password'));
				$guid = GUID ();
				/* Points Credit to Referral friend */
				$referred_by = $this->addReferral_points(post_value ( 'user_referral_id' ), post_value ( 'user_email' ) );
				/* create folder */
				$folder_name = get_random_key ( 50, $this->table, 'user_folder_name' );
				create_folder ( $folder_name );
				
				$folder_name = ($_SERVER ['HTTP_HOST'] == "localhost" || $_SERVER ['HTTP_HOST'] == "connect17:300") ? "dev_team" : $folder_name;
				
				/* upload image */
				$user_profile_image = "";
				if (isset ( $_FILES ['user_profile_image'] ['name'] ) && $_FILES ['user_profile_image'] ['name'] != "") {
					$user_profile_image = $this->common->upload_image ( 'user_profile_image', $folder_name . "/".get_label('user_folder_name') );
				}
				$new_user_points = $this->config->item('new_user_points', 'siteSettings') ? $this->config->item('new_user_points', 'siteSettings'):50;
				$insert_array = array (
						'user_name' => post_value ( 'user_name' ),
						'user_username' => post_value ( 'user_username' ),
						'user_email_address' => post_value ( 'user_email' ),
						'user_password' => $password,
						'user_info' => post_value ( 'user_info' ),
						'user_referral_id' => $guid,
						'user_credit_points' => $new_user_points,
						'user_referred_by' => $referred_by ? $referred_by :'',
						'user_folder_name' => $folder_name,
						'user_profile_image' => $user_profile_image,
						'user_status' => 'A',
						'user_created_on' => current_date (),
						'user_created_ip' => get_ip () 
				);
				
				$insert_id = $this->Mydb->insert ( $this->table, $insert_array );
				
				$session_datas = array('current_user_id' => $insert_id);
		
				$this->session->set_userdata($session_datas);
				$this->session->set_flashdata ( 'action_success', sprintf ( $this->lang->line ( 'success_message_regsiter' ), $this->module_label ) );
				$result ['status'] = 'success';
				
			} else {
				$result ['status'] = 'error';
				$result ['message'] = validation_errors ();
			}
			
			echo json_encode ( $result );
			exit ();
		}
		
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'add' ) . ' ' . $this->module_label;
		$data ['module_action'] = 'register' ;
		$this->load->view ( $this->folder . $this->module . '-add', $data );
	}
	
	/* this method used to update record info.. */
	public function edit($edit_id = NULL) {
		$data = $this->load_module_info ();
		$id = addslashes ( decode_value ( $edit_id ) );
		$response = array ();
		$record = $this->Mydb->get_record ( '*', $this->table, array (
				$this->primary_key => $id 
		) );
		(empty ( $record )) ? redirect ( frontend_url() . $this->module ) : '';
		
		if ($this->input->post ( 'action' ) == "edit") {
			form_check_ajax_request (); /* skip direct access */
			
			$this->form_validation->set_rules ( 'user_name', 'lang:user_name', 'required' );
			$this->form_validation->set_rules ( 'user_email', 'lang:user_email', 'required|valid_email|valid_email|callback_email_exists' );
			$this->form_validation->set_rules ( 'user_profile_image', 'lang:user_profile_image', 'callback_validate_image' );
			
			if ($this->form_validation->run () == TRUE) {
				
				$update_array = array (
						'user_name' => post_value ( 'user_name' ),
						'user_email_address' => post_value ( 'user_email' ),
						'user_info' => post_value ( 'user_info' ),						
						'user_updated_on' => current_date (),
						'user_updated_ip' => get_ip () 
				);
				
				/* upload image */
				if (isset ( $_FILES ['user_profile_image'] ['name'] ) && $_FILES ['user_profile_image'] ['name'] != "") {
					$user_profile_image = $this->common->upload_image ( 'user_profile_image', $record ['user_folder_name'] . "/".get_label('user_folder_name') );
					$image_arr = array (
							'user_profile_image' => $user_profile_image 
					);
					$update_array = array_merge ( $update_array, $image_arr );
				}
				
				$this->Mydb->update ( $this->table, array ($this->primary_key => $record ['user_id'] ), $update_array );
				
				$this->session->set_flashdata ( 'action_success', sprintf ( $this->lang->line ( 'success_message_edit' ), $this->module_label ) );
				$response ['status'] = 'success';
			} else {
				$response ['status'] = 'error';
				$response ['message'] = validation_errors ();
			}
			
			echo json_encode ( $response );
			exit ();
		}
		$data ['records'] = $record;
		/* Common labels */
		$this->module_label ="Profile";
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'edit' ) . ' ' . $this->module_label;
		$data ['module_action'] = 'edit/' . encode_value ( $record [$this->primary_key] );
		$this->layout->display_frontend ( $this->folder . $this->module . '-edit', $data );
	}
	/* Send the Referral Code */
	public function sendreferral(){
		
		$data = $this->load_module_info ();
		/* form submit */
		if ($this->input->post ( 'action' ) == "send_referral") {
			form_check_ajax_request (); /* skip direct access */
			
			$this->form_validation->set_rules ( 'friend_name[]', 'lang:friend_name', 'required' );
			$this->form_validation->set_rules ( 'friend_email[]', 'lang:friend_email', 'required|valid_email' );
			if ($this->form_validation->run () == TRUE) {
			$friend_names = $this->input->post('friend_name');	
			$friend_emails = $this->input->post('friend_email');
			
			$i= 0;
			$user_id = get_session_value('user_id');
			$email_count = array();
			$insert_array = array();
			
			foreach ($friend_emails as  $friend_email){
				/* Check if email exists or not in the table  */
				$check_email_exist = $this->Mydb->get_record ( 'ref_id', $this->referral_table, array (
				'ref_user_id' => get_session_value('user_id'),'ref_friend_email' => $friend_email
				) );
			
				if($check_email_exist['ref_id'] == '')
				{
					$from_name = $this->config->item('mail_from_name', 'siteSettings');
					$from_email = $this->config->item('from_email', 'siteSettings');
					$from_email = $this->config->item('from_email', 'siteSettings');
					$subject = $this->config->item('mail_subject', 'siteSettings');
					$this->email->from($from_email, $from_name);
					$this->email->to($friend_email);
					$this->email->subject($subject);
					$register_link = frontend_url('user/register/').get_session_value('user_referral_code');
					
					$message = '';
					$friend_name = $friend_names[$i];
					$referral_link = '<a href="'.$register_link.'">Click Here</a>';
					$messageContent = $this->config->item('email_template', 'siteSettings');
					$check_array = array('[FRIEND_NAME]','[CLICK_HERE]');
					$req_array = array($friend_name,$referral_link);
					$message = str_replace($check_array, $req_array, $messageContent); 
					$message_body = $this->email->message($message);

					$email_count[]= $this->email->send();

					$insert_array[] = array (
											'ref_user_id' => $user_id,
											'ref_friend_name' => $friend_names[$i],
											'ref_friend_email' => $friend_email,
											'ref_email_status' => '1',
											'ref_created_on' => current_date (),
											'ref_created_ip' => get_ip () 
										);
									
					
				}
				
				
				$i++;
				
			}
			$count_friends = count($insert_array); 
			if(	$count_friends != 0){
				$setting_referral_points = $this->config->item('referral_points', 'siteSettings') ? $this->config->item('referral_points', 'siteSettings'):20;
				$user_points 	=  $this->get_userPoints($user_id);
				$credit_points  = $count_friends * $setting_referral_points;
				$total_points	= $user_points + $credit_points;
				$this->addUserpoints($total_points, $user_id);
				
				$insert_id = $this->Mydb->insert_batch ( $this->referral_table, $insert_array );
				$this->session->set_flashdata ( 'action_success', sprintf ( $this->lang->line ( 'success_message_send_referral' ), $count_friends ) );
				$result ['status'] = 'success';
			}
			else
			{
				$this->session->set_flashdata ( 'action_error', sprintf ( $this->lang->line ( 'error_message_send_referral' ), $count_friends ) );
				$result ['status'] = 'error';
				
			}
			
			
			
				
			} else {
				$result ['status'] = 'error';
				$result ['message'] = validation_errors ();
			}
			
			echo json_encode ( $result );
			exit ();
		}
		
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'add' ) . ' ' . $this->module_label;
		$data ['module_action'] = 'register' ;
		$this->load->view ( $this->folder . $this->module . '-add', $data );
	}	
	/*Add Points to User when referral friend registration */
	public function addReferral_points($referral_id, $referred_email ){
		
		$query = "SELECT user.user_id as referred_by FROM  afsys_users as user 
				  LEFT JOIN afsys_referral as refer 
				  ON user.user_id = refer.ref_user_id WHERE user.user_referral_id = '$referral_id' OR refer.ref_friend_email = '$referred_email' GROUP BY user.user_id";
		$referred_user = $this->Mydb->custom_query ($query);
		foreach($referred_user as $referred)
		{
			$referred_by = $referred['referred_by'];
		}	
		if(!empty($referred_by) && $referred_by != '')
		{
			$user_points =  $this->get_userPoints($referred_by);
			$referred_points = $this->config->item('referred_user_register_points', 'siteSettings') ? $this->config->item('referred_user_register_points', 'siteSettings'):30;
			$credit_points = $user_points + $referred_points;
			
			$this->addUserpoints($credit_points, $referred_by);		
			
			return $referred_by;
		}else{
			return 0;
		}
		
			
	}
	/*Get User Credit Points */
	public function get_userPoints($user_id){
		$record = $this->Mydb->get_record ( 'user_credit_points as user_points', $this->table, array (
				$this->primary_key => $user_id 
		) );
		return $record['user_points'];
	}	
	/* Add points */
	public function addUserpoints($total_points, $user_id){
		
		$update_array = array (
							'user_credit_points' => $total_points,					
							'user_updated_on' => current_date (),
							'user_updated_ip' => get_ip () 
				);
		$this->Mydb->update ( $this->table, array ($this->primary_key => $user_id), $update_array);
	}
	/*get referral history */
	public function referralhistory(){
		$data = $this->load_module_info();
		$data['module_labels'] = "Referral history";	
		$this->layout->display_frontend ( $this->folder . $this->module . '-referralhistory', $data );
		
	}
	/* this method used list ajax listing... */
	function ajax_pagination($page = 0) {
		form_check_ajax_request (); /* skip direct access */
		$data = $this->load_module_info ();
		$like = array ();
		$where = array (
				'ref_user_id =' => get_session_value('user_id'),
				'ref_email_status !=' => ''
				
		); // array (" $this->primary_key !=" => '' );
		$order_by = array (
				'ref_id' => 'DESC' 
		);
		
		/* Search part start */
		
		if (post_value ( 'paging' ) == "") {
			$this->session->set_userdata ( $this->module . "_search_field", post_value ( 'search_field' ) );
			$this->session->set_userdata ( $this->module . "_search_value", post_value ( 'search_value' ) );
			
		}
		
		if (get_session_value ( $this->module . "_search_field" ) != "" && get_session_value ( $this->module . "_search_value" ) != "") {
			$like = array (
					get_session_value ( $this->module . "_search_field" ) => get_session_value ( $this->module . "_search_value" ) 
			);
		}
					
		// print_r($like); exit;
		
		$totla_rows = $this->Mydb->get_num_rows ('ref_id', $this->referral_table, $where, null, null, null, $like );
		
		/**
		 * * pagination part start **
		 */
		$admin_records = admin_records_perpage ();
		$limit = (( int ) $admin_records == 0) ? 25 : $admin_records;
		$offset = (( int ) $page == 0) ? 0 : $page; // ((int)$this->input->post('page') == 0 )? 0 : ($this->input->post('page') -1) * $limit;(int)$this->uri->segment(4);
		$uri_segment = $this->uri->total_segments ();
		$uri_string = frontend_url() . $this->module . "/ajax_pagination";
		$config = pagination_config ( $uri_string, $totla_rows, $limit, $uri_segment );
		$this->pagination->initialize ( $config );
		$data ['paging'] = $this->pagination->create_links ();
		$data ['per_page'] = $data ['limit'] = $limit;
		$data ['start'] = $offset;
		$data ['total_rows'] = $totla_rows;
		/**
		 * * pagination part end **
		 */
		
		$select_array = array (
				'ref_friend_name',
				'ref_friend_email',
				'ref_email_status',
				'ref_created_on',
				
		);
		$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->referral_table, $where, $limit, $offset, $order_by, $like );
		$active_page = $offset = (( int ) $this->input->post ( 'page' ) == 0) ? 1 : $this->input->post ( 'page' );
		// echo $qry = $this->db->last_query(); exit;
		$html = get_template ( $this->folder . '/' . $this->module . '-friend-ajax-list', $data );
		echo json_encode ( array (
				'status' => 'ok',
				'sd' => post_value ( 'status' ),
				'offset' => $offset,
				'active_page' => $active_page,
				'html' => $html 
		) );
		exit ();
	}
	/* this method used check email address or alredy exists or not */
	public function email_exists() {
		$email = $this->input->post ( 'user_email' );
		$edit_id = $this->input->post ( 'edit_id' );
		
		$where = array (
				'user_email_address' => trim ( $email ) 
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
					"user_id !=" => $edit_id 
			) );
		}
		
		$result = $this->Mydb->get_record ( '*', $this->table, $where );
		if (! empty ( $result )) {
			$this->form_validation->set_message ( 'email_exists', get_label ( 'user_email_exist' ) );
			return false;
		} else {
			return true;
		}
	}
	
	/* this method used check user name or alredy exists or not */
	public function username_exists() {
		$email = $this->input->post ( 'user_username' );
		$edit_id = $this->input->post ( 'edit_id' );
		
		$where = array (
				'user_username' => trim ( $email ) 
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
					"user_id !=" => $edit_id 
			) );
		}
		
		$result = $this->Mydb->get_record ( '*', $this->table, $where );
		if (! empty ( $result )) {
			$this->form_validation->set_message ( 'username_exists', get_label ( 'client_username_exist' ) );
			return false;
		} else {
			return true;
		}
	}
	
	/* this method used to to check validate image file */
	public function validate_image() {
		if (isset ( $_FILES ['user_profile_image'] ['name'] ) && $_FILES ['user_profile_image'] ['name'] != "") {
			if ($this->common->valid_image ( $_FILES ['user_profile_image'] ) == "No") {
				$this->form_validation->set_message ( 'validate_image', get_label ( 'upload_valid_image' ) );
				return false;
			}
		}
		
		return true;
	}
	
	/* this method used to clear all session values and reset search values */
	function refresh() {
		$this->session->unset_userdata ( $this->module . "_search_field" );
		$this->session->unset_userdata ( $this->module . "_search_value" );
		redirect ( frontend_url() . $this->module.'/referralhistory' );
	}
	
	/* this method used to common module labels */
	private function load_module_info() {
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		return $data;
	}
}
