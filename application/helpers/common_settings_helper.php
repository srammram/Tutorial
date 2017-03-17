<?php 
/**************************
 Project Name	: POS
Created on		: 18 Feb, 2016
Last Modified 	: 18 Feb, 2016
Description		:  this file contains common setting for admin and client panel..
***************************/

/* get Language label */
if (! function_exists ( 'get_label' )) {
	function get_label($label = null) {
		$CI = & get_instance ();
		return ucfirst ( $CI->lang->line ( $label ) );
	}
}

/* get current date */
if (! function_exists ( 'current_date' )) {
	function current_date() {
		return date ( "Y-m-d H:i:s" );
	}
}

/* get ip address */
if (! function_exists ( 'get_ip' )) {
	function get_ip() {
		return $_SERVER ['REMOTE_ADDR'];
	}
}

/* Put Start symbol */
if (! function_exists ( 'get_required' )) {
	function get_required() {
		return '<span class="required_star">*</span>';
	}
}

/* get error tag */
if(!function_exists('get_error_tag'))
{
	function get_error_tag($label=null,$alert_class)
	{
		return '<div class="alert fresh-color '.$alert_class.'" role="alert">'.$label.'</div>';
	}
}
/*On or Off form autocomplet value*/
if (! function_exists ( 'form_autocomplte' )) {
	function form_autocomplte() {
		/* If development mode is enabled */
		return 'on';
	}
}


/* form size  */
if (! function_exists ( 'get_form_size' )) {
	function get_form_size() {
		return 4;
	}
}


/* get date format unique format */
if (! function_exists ( "get_date_formart" )) {
	function get_date_formart($date, $format = "") {
		$format = ($format != "") ? $format : "d-m-Y";
		if ($date == "0000:00:00 00:00:00" || $date == "0000:00:00" || $date == NULL) {
			return "N/A";
		} else {
			return date ( $format, strtotime ( $date ) );
		}
	}
}

/* Function used to encode value */
if (! function_exists ( 'encode_value' )) {
	function encode_value($value = '') {
		if ($value != '') {
			return str_replace ( '=', '', base64_encode ( $value ) );
		}
	}
}
/* Function used to decode for encoded value */
if (! function_exists ( 'decode_value' )) {
	function decode_value($value = '') {
		if ($value != '') {
			return base64_decode ( $value );
		}
	}
}

/* Get user key */
if(!function_exists('get_random_key'))
{
	function get_random_key($length = 20, $table=null, $field_name=null,$type='alnum')
	{
		$CI =& get_instance();
		$CI->load->helper('string');
		if($table ==""){
		 return random_string($type,$length);
		 }else {
		$randomkey = random_string($type,$length);
		$getdata = $CI->Mydb->get_record(array($field_name),$table,array($field_name =>trim($randomkey)));
		return $userkey = (!empty($getdata) ? get_random_key() : $randomkey); 
	  }
	}
}

/* Get Notification Count */
if(!function_exists('get_notification_count'))
{
	function get_notification_count(){
		$CI =& get_instance();
		$notification = $CI->Mydb->custom_query("SELECT n.id, n.message, n.from_id, n.to_id, n.notification_type, n.created_on FROM notification AS n WHERE n.to_id='".get_session_value('user_id')."' AND n.status='1'");
		return $notification;
	}
}

/* Get Notification Insert */
if(!function_exists('create_notification'))
{
	function create_notification($notiy_msg, $notiy_from, $notiy_to, $notiy_type){
		$CI =& get_instance();
		$insert_array = array(
			'message' => $notiy_msg,
			'from_id' => $notiy_from,
			'to_id' => $notiy_to,
			'notification_type' => $notiy_type,
			'created_on' => current_date(),
			'created_ip' => ip2long(get_ip()),
			'status' => '1'
		); 
		$notification = $CI->Mydb->insert("notification", $insert_array);
		return $notification;
	}
}

/* Get Notification Update */
if(!function_exists('update_notification'))
{
	function update_notification($notiy_id, $notiy_to){
		$CI =& get_instance();
		$update_array = array(
			'created_on' => current_date(),
			'created_ip' => ip2long(get_ip()),
			'status' => '0'
		); 
		$notification = $CI->Mydb->update("notification", array('id'=> $notiy_id, 'to_id' => $notiy_to), $update_array);
		return $notification;
	}
}


/* Get Notification Timing */
if(!function_exists('humanTiming'))
{
	function humanTiming ($time)
	{
	
		$time = time() - $time; // to get the time since that moment
		$time = ($time<1)? 1 : $time;
		$tokens = array (
			31536000 => 'year',
			2592000 => 'month',
			604800 => 'week',
			86400 => 'day',
			3600 => 'hour',
			60 => 'minute',
			1 => 'second'
		);
		foreach ($tokens as $unit => $text) {
			if ($time < $unit) continue;
			$numberOfUnits = floor($time / $unit);
			return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
		}
	}
}
/* chek ajax request .. skip to direct access... */
if (! function_exists ( 'check_ajax_request' )) {
	function check_ajax_request() {
		$CI = & get_instance ();
		if ((! $CI->input->is_ajax_request ())) {	
			redirect ( admin_url () );
			return false;
		}
	}
}
/* Check Ajax Request in Front end  forms */
if (! function_exists ( 'form_check_ajax_request' )) {
	function form_check_ajax_request() {
		$CI = & get_instance ();
		if ((! $CI->input->is_ajax_request ())) {	
			redirect ( frontend_url() );
			return false;
		}
	}
}
/* cretae bcrypt password... */
if (! function_exists ( 'do_bcrypt' )) {
	function do_bcrypt($password = null) {
		$CI = &get_instance ();
		$CI->load->library ( 'bcrypt' );
		return $CI->bcrypt->hash_password ( $password );
	}
}

/* Compare bcrypt password... */
if (! function_exists ( 'check_hash' )) {
	function check_hash($password = null, $stored_hash=null) {
		$CI = &get_instance ();
		$CI->load->library ( 'bcrypt' );
		if ($CI->bcrypt->check_password ( $password, $stored_hash )) {
			return 'Yes';
			// Password does match stored password.
		} else {
			return 'No';
			// Password does not match stored password.
		}
	}
}

/*  function used to get session values */
if (! function_exists ( 'get_session_value' )) {
	function get_session_value($sess_name) {
		$CI = & get_instance ();
		return  $CI->session->userdata($sess_name);
	}
}

/*  this function used to removed  unwanted chars  */
if ( ! function_exists('post_value'))
{
	function post_value($post_data=null)
	{    $CI =& get_instance();

	if($CI->input->post($post_data)){

		$data= addslashes(trim($CI->input->post($post_data)));
	}else{

		$data= addslashes(trim($CI->input->get($post_data)));
	}
	return $data;
	}
}

/* this function used to generate generate GUID */
function GUID()
{
	if (function_exists('com_create_guid') === true)
	{
		return trim(com_create_guid(), '{}');
	}

	return sprintf('%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535));
}

/* this function used provide clean putput value...*/
if (! function_exists ( 'output_value' )) {
	function output_value($value = null) {
		return ($value == '') ? "N/A" : ucfirst(stripslashes ( $value ));
	}
}


/* this method used to set Session URL */
if (! function_exists ( 'set_sessionurl' )) {
	function set_sessionurl($data) {
		$CI = & get_instance ();
		$protocol = 'http';
		$re = $protocol . '://' . $_SERVER ['HTTP_HOST'] . $_SERVER ['REQUEST_URI'];
		$CI->session->set_userdata ( $data, $re );
	}
}

/*  $this method used to load pagination config..  */
if ( ! function_exists('pagination_config'))
{
	function pagination_config($uri_string,$total_rows,$limit,$uri_segment,$num_links=2)
	{
		$CI = & get_instance ();
		$CI->load->library('pagination');
		$config = array();
		$config['full_tag_open'] = '<nav><ul class="pagination pagination-sm">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['first_tag_open'] = $config['last_tag_open']   = $config['next_tag_open']  = $config['prev_tag_open'] = 	$config['num_tag_open'] =  '<li>';
		$config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close']  = $config['prev_tag_close'] =   $config['num_tag_close'] =  '</li>';
		$config['next_link'] = '&gt;';
		$config['prev_link'] = '&lt;';
		$config['cur_tag_open']  = '<li class="active"> <a>';
		$config['cur_tag_close'] = "</li> </a>";
		$config['num_links'] = $num_links; 
		$config['base_url'] = $uri_string;
		$config['uri_segment'] = $uri_segment;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		return $config;
	}
}

/* this method used to show records count */
if ( ! function_exists('show_record_info'))
{
	function show_record_info($total_rows,$start,$end)
	{
		if(($start+$end) > $total_rows) {
			$end = $total_rows;
		} else {
			$end = $start+$end;
		}

		 return ((int)$total_rows== 0 ? " ": 'Showing <b>'.($start+1).'</b> to<b> '.$end.'</b> of <b> '.$total_rows.' </b>entries');
	}
}	

/* this method used to get loading image */
if(!function_exists('loading_image'))
{
	function loading_image($class=null)
	{
		return  '<img src="'.load_lib("theme/images/loading_icon_default.gif").'" alt="loading.."  class="'.$class.'"/>';
	}
}



/* Get Admin Status dropdown */
if (! function_exists ( 'get_status_dropdown' )) {
	function get_status_dropdown($selected = null, $addStatus=array()) {

		$status	=	array (
				' ' => get_label('select_status'),
				'A' => 'Activate',
				'I' => 'Deactivate',
		);
		if(!empty($addStatus)){
			$status	=	$status + $addStatus;
		}
		return form_dropdown ( 'status', $status, $selected, 'class="" id="status"' );
	}
}


/* this method used to create client logo check user folder nameexists**/
if (!function_exists('create_folder')) {
	function create_folder($folder_name) {

		$src = FCPATH.'media/default/*';
		$dst = FCPATH.'media/'.$folder_name.'/';
		$command = exec( "cp -r $src $dst" );
			
	}

}
/* Color Code */
if (!function_exists('random_color_part')) {

    function random_color_part() {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }

}
if (!function_exists('random_color')) {

    function random_color() {
        return random_color_part() . random_color_part() . random_color_part();
    }

}
/* Get Log History Insert */
if(!function_exists('log_history'))
{
	function log_history($log_msg, $log_from, $log_to){
		$CI =& get_instance();
		$insert_array = array(
			'message' => $log_msg,
			'from_user' => $log_from,
			'to_user' => $log_to,
			'created_ip' => ip2long(get_ip()),
			'status' => '1'
		); 
		$history = $CI->Mydb->insert("log_history", $insert_array);
		return $history;
	}
}


