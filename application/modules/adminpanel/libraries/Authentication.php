<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Authentication
{
protected $ci;

public function __construct()
 {
	$this->ci =& get_instance();
 }
	
/*  Master adminpanel authenticaion */
function admin_authentication()
{  
	$ninja_admin  = $this->ci->session->userdata("nc_admin_id");		
	($ninja_admin =="")? redirect(admin_url()) : ''; 
}	



}
 
/* End of file authentication.php */
/* Location: ./application/libraries/authentication.php */
