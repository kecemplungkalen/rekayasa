<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Config_mail_model extends CI_model{
	
	
	function gets()
	{
		$get = $this->db->get('config_mail');
		if($get->num_rows() > 0)
		{
			foreach($get->result() as $dt){
				$data[$dt->config_name] = $dt->config_value;
			}
			return $data;
		}
		return FALSE;		
		
	}
	
	function update($data=false)
	{
		if(is_array($data))
		{
			if($this->db->update_batch('config_mail',$data,'config_name'))
			{
				return true;
			}
		}
		return false;
	}
	
}
