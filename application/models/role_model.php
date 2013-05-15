<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Role_Model extends CI_model{

	function gets()
	{
		$get = $this->db->get('role');
		if($get->num_rows() > 0)
		{
			return $get->result();
		}
		else
		return false;
	}
	
	function get($data=false)
	{
		if($data)
		{
			$this->db->where($data);
			$res = $this->db->get('role');
			if($res)
			{
				return $res->row();
			}
			
		}
		return false;
	}
}
