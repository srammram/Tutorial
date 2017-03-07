<?php 
/**************************
 Project Name	: POS
Created on		: 19 Feb, 2016
Last Modified 	: 24  Feb, 2016
Description		:  this file contains adminpanel helper function.
***************************/
/* get admin session  label */
if (! function_exists ( 'get_admin_id' )) {
	function get_admin_id() {
		$CI = & get_instance ();
		return  $CI->session->userdata('nc_admin_id');
	}
}

/* this method used to get admin records per page value */
if (! function_exists ( 'admin_records_perpage' )) {
	function admin_records_perpage() {
		$CI = & get_instance ();
		return 5;
	}
}

/* this function used to show output status */
if (!function_exists('show_status')) {
	function show_status($sts=null,$id) {

		return ($sts == "A" ? '<i class="fa fa-unlock status" title=" '.get_label('active').'" id='.encode_value($id).' data="Deactivate"></i>' : ($sts == "I" ? '<i class="fa fa-lock status" title="'.get_label('inactive').'"  id='.encode_value($id).' data="Activate"></i>' : '' )  );
	}
}

/* Get client category list    */
if(!function_exists('get_client_category'))
{
	function get_client_category($where='',$selected='',$extra='')
	{
		$CI=& get_instance();
		$where_array=($where=='')? array('cate_id !='=>'') :  $where ;
		$records=$CI->Mydb->get_all_records('cate_id,cate_name','client_categories',$where_array,'','',array('cate_name'=>"ASC"));
		$data=array(''=>get_label('select_category'));
		if(!empty($records))
		{
			foreach($records as $value)
			{
				$data[$value['cate_id']] = stripslashes($value['cate_name']);
			}
		}
		$extra=($extra!='')?  $extra : 'class="form-control" id="client_cate" ' ;
		 
		return  form_dropdown('client_cate',$data,$selected,$extra);
	}
}



