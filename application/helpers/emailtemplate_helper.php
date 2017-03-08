<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**************************
Project Name	: CarBuysg
Created on		: Feb 2, 2016
Last Modified 	: Feb 2, 2016
Description		: Page contains Email related functions 
***************************/

/* this function used to common email helper */
if(!function_exists('send_email'))
{
	function send_email($to_email_address,$template_slug,$chk_arr = array(),$rep_arr =array(),$attach_file=array(),$path='',$subject='',$cc='', $html_template = 'electtv_email_template')
	{
		
		 $CI =  & get_instance();
		 $template_table = "email_setting";
		 
     	 $query = "SELECT from_email , reply_to, name, subject, email_content, email_variables FROM  $template_table WHERE slug = '".$template_slug."'";
         $result = $CI->Mydb->custom_query_single($query);
         //echo $CI->Mydb->print_query();
        
         if(!empty($result))
         {
         	
         	/* get basic mail config values */
           	   $to_email = ($to_email_address == '')? $CI->config->item('to_email', 'siteSettings') : $to_email_address;
           	   $from_email = ($result['from_email'] == '') ? $CI->config->item('from_email', 'siteSettings') : $result['from_email'] ;
           	   $site_title = ucfirst(get_label('site_title'));
           	   $subject = !empty($subject) ? $subject: $result['subject'];
           	   $email_content = $result['email_content'];
           	 
           	   /* merge contents */
           	/* echo "<pre>";
           	   print_r($chk_arr);
           	   print_r($rep_arr);*/
           	  
           	   $chk_arr1 = array('[LOGOURL]','[BASEURL]','[COPY-CONTENT]','[ADMIN-EMAIL]','[SITE-TITLE]','[SITEURL]');
           	   $rep_array2 = array(skin_url()."images/email_logo.jpg",base_url(),'© 2017 Elect Tv. All rights reserved.',$CI->config->item('from_email', 'siteSettings'),get_label('site_title'),BASE_URL());
           	   $final_chk_arr = array_merge($chk_arr,$chk_arr1);
           	   $final_rep_arr = array_merge($rep_arr,$rep_array2);
           	 /* print_r($chk_arr1);
           	   print_r($rep_array2);
           	   print_r($final_chk_arr);
           	   print_r($final_rep_arr);*/

           	    $message1 = str_replace($final_chk_arr, $final_rep_arr, $email_content);

           	   
			
	           $datas = array('CONTENT' => $message1 );
	           $CI->load->library(array('parser','email'));
	           $message = $CI->parser->parse($html_template, $datas,true);
	          
			  	
	           /* mail part */
	          
				if($result['settings_mail_from_smtp']==1)
				{
	            	$config['smtp_host']	= $result['settings_smtp_host'];	  
	                $config['smtp_user']	= $result['settings_smtp_user'];	
	                $config['smtp_pass']	= $result['settings_smtp_pass'];	
	                $config['smtp_port']	= $result['settings_smtp_port']; 
	                $config['mailpath'] 	= $result['settings_mailpath'];
	                $config['protocol'] 	= 'smtp';
	            }
	            else{
	               	$config['protocol'] 	= 'sendmail';
	            }  
	           
	         
	             $config['charset'] 		= 'iso-8859-1';
	             $config['wordwrap'] 	= TRUE;
	             $config['charset'] 		= "utf-8";
	             $config['mailtype'] 	= "html";
	             $config['newline'] 		= "\r\n";
	            
	             $CI->email->initialize($config);
	             $CI->email->from($from_email,$site_title);
	             $CI->email->to($to_email);
	             if(!empty($cc))
	             {
					 $CI->email->cc($cc);
				 }
	             $CI->email->subject($subject);
	             $CI->email->message($message);
	             if(!empty($attach_file) && !empty($path))
	             {
				  foreach($attach_file as $row)	 
				  {
					  
					  if($row!='')
					  {
						 
					   $CI->email->attach($path.$row);
				      }
				  }
	            
			     }
			    
	             $email_status = $CI->email->send();
	             if($email_status)
	             {
	                return 1;
	             }
	             else
	             {
	               	return 0;
	             }
               	
                 
         } 
	}
}




