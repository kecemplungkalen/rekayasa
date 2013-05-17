<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Config_smtp_model extends CI_model{
	
	function update($where=FALSE,$data=FALSE)
	{
		if($where && $data)
		{
			$this->db->where($where);
			$up = $this->db->update('config_smtp',$data);
			if($up)
			{
				return TRUE;
			}
		}
		
		return FALSE;
	}
	
	function get()
	{
		$data = $this->db->get('config_smtp');
		if($data->num_rows() > 0)
		{
			return $data->row();
		}
		else
		return FALSE;
	}
	
}
