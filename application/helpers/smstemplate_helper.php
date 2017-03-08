<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**************************
Project Name	: CarBuysg
Created on		: Feb 2, 2016
Last Modified 	: Feb 2, 2016
Description		: Page contains Email related functions 
***************************/

/* this function used to common sms helper */
if(!function_exists('send_sms')){
	function send_sms($sms_template_slug, $sms_chk_arr, $sms_rep_arr, $sms_phone, $sms_country_code){
		
		$CI=& get_instance();
		$template_table = "sms_setting";
		$query = "SELECT sms_content , sms_variable FROM  $template_table WHERE slug = '".$sms_template_slug."'";
		$result = $CI->Mydb->custom_query_single($query);
		$sms_content = $result['sms_content'];
		
		 if(!empty($result)){
			if($sms_country_code=='109'){
				$sms_feedid = '362094';
			}else{
				$sms_feedid = '362849';
			}
			$sms_message = str_replace($sms_chk_arr, $sms_rep_arr, $sms_content);
			$sms_msg = str_replace(" ", "%20", $sms_message);
			$gatewayURL = "http://bulkpush.mytoday.com/BulkSms/SingleMsgApi?feedid=".$sms_feedid."&username=8825812340&password=aadaa&To=".$sms_phone."&Text=".$sms_msg. "&senderid=''";
			
			$sms_ch = curl_init();
			curl_setopt($sms_ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($sms_ch, CURLOPT_URL, $gatewayURL);
			$sms_data = curl_exec($sms_ch);
			curl_close($sms_ch);
			$sms_xml = simplexml_load_string($sms_data);
			$sms_json = json_encode($sms_xml);
			
			$sms_obj = json_decode($sms_json, TRUE);
			
			if(!empty($sms_obj['MID']['ERROR']['ERROR']['CODE']))
			 {
				return 0;
			 }
			 else
			 {
				return 1;
			 }
			
		 }		
	}
}




