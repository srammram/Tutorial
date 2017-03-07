<?php
/**************************
Project Name	: POS
Created on		: 19 Feb, 2016
Last Modified 	: 25 Feb, 2016
Description		: Page contains company add edit and delete functions..

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Company extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->authentication->admin_authentication ();
		$this->module = "company";
		$this->module_label = get_label ( 'clinet_module_label' );
		$this->module_labels = get_label ( 'clinet_module_labels' );
		$this->folder = "company/";
		$this->table = "clients";
		$this->load->library ( 'common' );
		$this->primary_key = 'client_id';
	}
	
	/* this method used to list all company . */
	public function index() {
		$data = $this->load_module_info ();
		
		$this->layout->display_admin ( $this->folder . $this->module . "-list", $data );
	}
	
	/* this method used list ajax listing... */
	function ajax_pagination($page = 0) {
		check_ajax_request (); /* skip direct access */
		$data = $this->load_module_info ();
		$like = array ();
		$where = array (
				'client_status !=' => 'D' 
		); // array (" $this->primary_key !=" => '' );
		$order_by = array (
				$this->primary_key => 'DESC' 
		);
		
		/* Search part start */
		
		if (post_value ( 'paging' ) == "") {
			$this->session->set_userdata ( $this->module . "_search_field", post_value ( 'search_field' ) );
			$this->session->set_userdata ( $this->module . "_search_value", post_value ( 'search_value' ) );
			$this->session->set_userdata ( $this->module . "_search_category", post_value ( 'client_cate' ) );
			$this->session->set_userdata ( $this->module . "_search_status", post_value ( 'status' ) );
		}
		
		if (get_session_value ( $this->module . "_search_field" ) != "" && get_session_value ( $this->module . "_search_value" ) != "") {
			$like = array (
					get_session_value ( $this->module . "_search_field" ) => get_session_value ( $this->module . "_search_value" ) 
			);
		}
		
		if (get_session_value ( $this->module . "_search_category" ) != "") {
			$where = array_merge ( $where, array (
					'client_category' => get_session_value ( $this->module . "_search_category" ) 
			) );
		}
		
		if (get_session_value ( $this->module . "_search_status" ) != "") {
			$where = array_merge ( $where, array (
					'client_status' => get_session_value ( $this->module . "_search_status" ) 
			) );
		}
		
		// print_r($like); exit;
		
		$totla_rows = $this->Mydb->get_num_rows ( $this->primary_key, $this->table, $where, null, null, null, $like );
		
		/**
		 * * pagination part start **
		 */
		$admin_records = admin_records_perpage ();
		$limit = (( int ) $admin_records == 0) ? 25 : $admin_records;
		$offset = (( int ) $page == 0) ? 0 : $page; // ((int)$this->input->post('page') == 0 )? 0 : ($this->input->post('page') -1) * $limit;(int)$this->uri->segment(4);
		$uri_segment = $this->uri->total_segments ();
		$uri_string = admin_url () . $this->module . "/ajax_pagination";
		$config = pagination_config ( $uri_string, $totla_rows, $limit, $uri_segment );
		$this->pagination->initialize ( $config );
		$data ['paging'] = $this->pagination->create_links ();
		$data ['per_page'] = $data ['limit'] = $limit;
		$data ['start'] = $offset;
		$data ['total_rows'] = $totla_rows;
		/**
		 * * pagination part end **
		 */
		
		$this->db->select ( 'client_categories.cate_name as category_name' );
		$this->db->join ( 'client_categories', 'client_categories.cate_id = clients.client_category', 'left' );
		$select_array = array (
				'client_id ',
				'client_name',
				'client_app_id',
				'client_email_address',
				'client_category',
				'client_status',
				'client_created_on' 
		);
		$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like );
		$active_page = $offset = (( int ) $this->input->post ( 'page' ) == 0) ? 1 : $this->input->post ( 'page' );
		// echo $qry = $this->db->last_query(); exit;
		$html = get_template ( $this->folder . '/' . $this->module . '-ajax-list', $data );
		echo json_encode ( array (
				'status' => 'ok',
				'sd' => post_value ( 'status' ),
				'offset' => $offset,
				'active_page' => $active_page,
				'html' => $html 
		) );
		exit ();
	}
	
	/* this method used to add company . */
	public function add() {
		$data = $this->load_module_info ();
		
		/* form submit */
		if ($this->input->post ( 'action' ) == "Add") {
			check_ajax_request (); /* skip direct access */
			
			$this->form_validation->set_rules ( 'client_name', 'lang:clinet_name', 'required' );
			$this->form_validation->set_rules ( 'client_username', 'lang:client_username', 'required|min_length[' . get_label ( 'client_username_minlength' ) . ']|callback_username_exists' );
			$this->form_validation->set_rules ( 'client_email', 'lang:client_email', 'required|valid_email|valid_email|callback_email_exists' );
			$this->form_validation->set_rules ( 'clinet_logo', 'lang:clinet_logo', 'callback_validate_image' );
			$this->form_validation->set_rules ( 'client_cate', 'lang:clinet_cate', 'required' );
			
			if ($this->form_validation->run () == TRUE) {
				
				$password = get_random_key ( 12 );
				$guid = GUID ();
				
				/* create folder */
				$folder_name = get_random_key ( 50, $this->table, 'client_folder_name' );
				create_folder ( $folder_name );
				
				$folder_name = ($_SERVER ['HTTP_HOST'] == "localhost" || $_SERVER ['HTTP_HOST'] == "connect17:300") ? "dev_team" : $folder_name;
				
				/* upload image */
				$client_logo = "";
				if (isset ( $_FILES ['clinet_logo'] ['name'] ) && $_FILES ['clinet_logo'] ['name'] != "") {
					$client_logo = $this->common->upload_image ( 'clinet_logo', $folder_name . "/".get_label('compnay_folder_name') );
				}
				
				$insert_array = array (
						'client_name' => post_value ( 'client_name' ),
						'client_username' => post_value ( 'client_username' ),
						'client_email_address' => post_value ( 'client_email' ),
						'client_password' => $password,
						'client_about_company' => post_value ( 'client_info' ),
						'client_category' => post_value ( 'client_cate' ),
						'client_app_id' => $guid,
						'client_folder_name' => $folder_name,
						'client_logo' => $client_logo,
						'client_status' => 'A',
						'client_created_on' => current_date (),
						'client_creatd_by' => get_admin_id (),
						'client_creatd_ip' => get_ip () 
				);
				
				$insert_id = $this->Mydb->insert ( $this->table, $insert_array );
				
				$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_add' ), $this->module_label ) );
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
		$data ['module_action'] = get_label ( 'add' );
		$this->layout->display_admin ( $this->folder . $this->module . '-add', $data );
	}
	
	/* this method used to update record info.. */
	public function edit($edit_id = NULL) {
		$data = $this->load_module_info ();
		$id = addslashes ( decode_value ( $edit_id ) );
		$response = array ();
		$record = $this->Mydb->get_record ( '*', $this->table, array (
				$this->primary_key => $id 
		) );
		(empty ( $record )) ? redirect ( admin_url () . $this->module ) : '';
		
		if ($this->input->post ( 'action' ) == "edit") {
			check_ajax_request (); /* skip direct access */
			
			$this->form_validation->set_rules ( 'client_name', 'lang:clinet_name', 'required' );
			$this->form_validation->set_rules ( 'client_email', 'lang:client_email', 'required|valid_email|valid_email|callback_email_exists' );
			$this->form_validation->set_rules ( 'clinet_logo', 'lang:clinet_logo', 'callback_validate_image' );
			$this->form_validation->set_rules ( 'client_cate', 'lang:clinet_cate', 'required' );
			
			if ($this->form_validation->run () == TRUE) {
				
				$update_array = array (
						'client_name' => post_value ( 'client_name' ),
						'client_email_address' => post_value ( 'client_email' ),
						'client_about_company' => post_value ( 'client_info' ),
						'client_category' => post_value ( 'client_cate' ),
						'client_updated_on' => current_date (),
						'client_updated_by' => get_admin_id (),
						'client_updtaed_ip' => get_ip () 
				);
				
				/* upload image */
				if (isset ( $_FILES ['clinet_logo'] ['name'] ) && $_FILES ['clinet_logo'] ['name'] != "") {
					$client_logo = $this->common->upload_image ( 'clinet_logo', $record ['client_folder_name'] . "/".get_label('compnay_folder_name') );
					$image_arr = array (
							'client_logo' => $client_logo 
					);
					$update_array = array_merge ( $update_array, $image_arr );
				}
				
				$this->Mydb->update ( $this->table, array ($this->primary_key => $record ['client_id'] ), $update_array );
				
				$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_edit' ), $this->module_label ) );
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
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'edit' ) . ' ' . $this->module_label;
		$data ['module_action'] = 'edit/' . encode_value ( $record [$this->primary_key] );
		$this->layout->display_admin ( $this->folder . $this->module . '-edit', $data );
	}
	
	/* this method used update multible actions */
	function action() {
		$ids = ($this->input->post ( 'multiaction' ) == 'Yes' ? $this->input->post ( 'id' ) : decode_value ( $this->input->post ( 'changeId' ) ));
		
		$ids = ($this->input->post ( 'changeId' ) != '') ? decode_value ( $this->input->post ( 'changeId' ) ) : $this->input->post ( 'id' );
		$postaction = $this->input->post ( 'postaction' );
		
		$response = array (
				'status' => 'error',
				'msg' => get_label ( 'something_wrong' ),
				'action' => '',
				'multiaction' => $this->input->post ( 'multiaction' ) 
		);
		
		/* Delete */
		if ($postaction == 'Delete' && ! empty ( $ids )) {
			// $this->Mydb->delete_where_in($this->table,'client_id',$ids,'');
			
			if (is_array ( $ids )) {
			} else {
				$this->Mydb->update ( $this->table, array (
						$this->primary_key => $ids 
				), array (
						"client_status" => 'D' 
				) );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
				
				// $this->Mydb->delete($this->table,'client_id',$ids,'');
			}
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Activation */
		if ($postaction == 'Activate' && ! empty ( $ids )) {
			$update_values = array (
					"client_status" => 'A',
					"client_updated_on" => current_date (),
					'client_updated_by' => get_admin_id (),
					'client_updtaed_ip' => get_ip () 
			);
			
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_labels );
			} else {
				
				$this->Mydb->update ( $this->table, array (
						$this->primary_key => $ids 
				), $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_label );
			}
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Deactivation */
		if ($postaction == 'Deactivate' && ! empty ( $ids )) {
			$update_values = array (
					"client_status" => 'I',
					"client_updated_on" => current_date (),
					'client_updated_by' => get_admin_id (),
					'client_updtaed_ip' => get_ip () 
			);
			
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_labels );
			} else {
				
				$this->Mydb->update ( $this->table, array (
						$this->primary_key => $ids 
				), $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_label );
			}
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		echo json_encode ( $response );
		exit ();
	}
	
	/* this method used check email address or alredy exists or not */
	public function email_exists() {
		$email = $this->input->post ( 'client_email' );
		$edit_id = $this->input->post ( 'edit_id' );
		
		$where = array (
				'client_email_address' => trim ( $email ) 
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
					"client_id !=" => $edit_id 
			) );
		}
		
		$result = $this->Mydb->get_record ( '*', $this->table, $where );
		if (! empty ( $result )) {
			$this->form_validation->set_message ( 'email_exists', get_label ( 'client_email_exist' ) );
			return false;
		} else {
			return true;
		}
	}
	
	/* this method used check user name or alredy exists or not */
	public function username_exists() {
		$email = $this->input->post ( 'client_username' );
		$edit_id = $this->input->post ( 'edit_id' );
		
		$where = array (
				'client_username' => trim ( $email ) 
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
					"client_id !=" => $edit_id 
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
		if (isset ( $_FILES ['clinet_logo'] ['name'] ) && $_FILES ['clinet_logo'] ['name'] != "") {
			if ($this->common->valid_image ( $_FILES ['clinet_logo'] ) == "No") {
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
		$this->session->unset_userdata ( $this->module . "_search_category" );
		$this->session->unset_userdata ( $this->module . "_search_status" );
		redirect ( admin_url () . $this->module );
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
