<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class User_Model extends CI_model{
	
	function get($where)
	{
		if($where)
		{
			$this->db->where($where);
			$get = $this->db->get('user');
			if($get->num_rows() > 0)
			{
				return $get->row();
			}
			
		}
		return false;
	}
	
}
