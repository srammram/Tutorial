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
	$ninja_user  = $this->ci->session->userdata("user_id");		
	($ninja_user =="")? redirect(frontend_url()) : ''; 
}	



}
 
/* End of file authentication.php */
/* Location: ./application/libraries/authentication.php */
