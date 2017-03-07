<?php
/**************************
Project Name	: POS
Created on		: 18 Feb, 2016
Last Modified 	: 18 Feb, 2016
Description		: Page contains common query methods
***************************/
if (!defined('BASEPATH')) exit('No direct gscript access allowed');
class Mydb extends CI_Model 
{
    function __construct() 
    {
        parent::__construct();
       
    }
	/* Method used to insert details into database  */
    function insert($table, $data) {
	
        $this->db->insert($table, $data);
		
        return $this->db->insert_id();
    }
    /* Method used to insert details into database  */
    function insert_batch($table, $data) {
    
    	$this->db->insert_batch($table, $data);
    
    	return $this->db->insert_id();
    }
    /* Method used to update details into database  */
    function update($table, $where, $data) {
        $this->db->where($where);
        $this->db->update($table, $data);
        $this->db->insert_id();
		return $this->db->affected_rows();
    }
    /* Method used to delete details from database  */
    function delete($table, $where)
    {
    	$this->db->where($where);
    	$this->db->delete($table);
    }
    /* Method used to get single record from database  */
    function get_record($select, $table, $where=null) 
    {
	
      	$this->db->select($select);
        if ($where) 
        {
           $this->db->where($where);
        }
        $query = $this->db->get($table, 1);
		//echo $this->db->last_query();
		$result = $query->row_array();
        return $result;
    }
    /* Method used to get all records from database  */
    function get_all_records($select, $table, $where=null, $limit = '', $offset = '', $order = '',$like='', $groupby = '', $join='') 
    {
        $this->db->select($select);
		if($where)
		{
			$this->db->where($where);
		}
		
		if($groupby)
		{
			$this->db->group_by($groupby);
		}
        if (is_array($order)) 
        {
            foreach ($order as $key => $value) 
            {
                $this->db->order_by($key, $value);
            }
        }
        if (is_array($like)) 
        {
        	$this->db->like($like);
        }
        if ($limit) 
        {
            $query = $this->db->get($table, $limit, $offset);
        } 
        else 
        {
            $query = $this->db->get($table);
        }
		
		$result = $query->result_array();
		//echo $this->db->last_query();exit;
        return $result;
    }
    
    function get_all_join_records($select, $table, $where=null, $limit = '', $offset = '', $order = '',$like='', $groupby = '', $join='') 
    {
    	
        $this->db->select($select);
		if($where)
		{
			$this->db->where($where);
		}
		if($join)
		{
			if(count($join['table']) == 1) {
				$this->db->join($join['table'], $join['on'], $join['opt']);	
			} else {
				for($i=0;$i<count($join['table']);$i++) {
					$this->db->join($join['table'][$i], $join['on'][$i], $join['opt'][$i]);	
				}
			}
		}
		
		if($groupby)
		{
			$this->db->group_by($groupby);
		}
        if (is_array($order)) 
        {
            foreach ($order as $key => $value) 
            {
                $this->db->order_by($key, $value);
            }
        }
        if (is_array($like)) 
        {
        	$this->db->like($like);
        }
        if ($limit) 
        {
            $query = $this->db->get($table, $limit, $offset);
        } 
        else 
        {
            $query = $this->db->get($table);
        }
		
		$result = $query->result_array();
        //echo '<pre>';print_r($result);exit;
		//echo $this->db->last_query();exit;
        return $result;
    }
    
       ###### get number of rows ######
    function get_num_rows($select, $table, $where, $limit = '', $offset = '', $order = '',$like='')
    {
	
    	$this->db->select($select);
    	$this->db->where($where);
    	if (is_array($order))
    	{
    		foreach ($order as $key => $value)
    		{
    			$this->db->order_by($key, $value);
    		}
    	}
    	if(is_array($like))
    	{
    		$this->db->like($like);
    	}
    	$query = $this->db->get($table);
    	$result = $query->num_rows();
    	//echo $this->db->last_query();exit;
    	return $result;
    }
    
    function get_num_join_rows($select, $table, $where, $limit = '', $offset = '', $order = '',$like='',$groupby='', $join='')
    {
	
    	$this->db->select($select);
    	if($join)
		{
			if(count($join['table']) == 1) {
				$this->db->join($join['table'], $join['on'], $join['opt']);	
			} else {
				for($i=0;$i<count($join['table']);$i++) {
					$this->db->join($join['table'][$i], $join['on'][$i], $join['opt'][$i]);	
				}
			}
		}
    	$this->db->where($where);
    	if (is_array($order))
    	{
    		foreach ($order as $key => $value)
    		{
    			$this->db->order_by($key, $value);
    		}
    	}
    	if($groupby)
    	{
    		$this->db->group_by($groupby);
    	}
    	if(is_array($like))
    	{
    		$this->db->like($like);
    	}
    	$query = $this->db->get($table);
    	$result = $query->num_rows();
    	return $result;
    }
    
    ####### update record using where in #########
    function update_where_in($table, $field, $where, $data, $wherearray = '') {
    	if($wherearray){
    		$this->db->where($wherearray);
    	}
    	$this->db->where_in($field, $where);
    	$this->db->update($table, $data);
    	//echo $this->db->last_query();exit;
		return $this->db->affected_rows();
    }
    
    
    ####### Delete records using where in ########
    function delete_where_in($table, $field, $where, $wherearray = '') {
    	if($wherearray){
    		$this->db->where($wherearray);
    	}
    	$this->db->where_in($field, $where);
    	$this->db->delete($table);
    }
    
    ####### custom query bilder  ########
    function custom_query($query) {
    	if($query != "")
    	{   
    		$result = $this->db->query($query);
    		$result_value= $result->result_array();
    		return $result_value;
    	}
    }
    
    
    ####### custom query bilder  ########
    function custom_query_single($query) {
    	if($query != "")
    	{
    		$result = $this->db->query($query);
    		$result_value= $result->row_array();
    		return $result_value;
    	}
    }
    ####### print value ########
	
    function print_query() {
    	return $this->db->last_query();
    }  
    

}
