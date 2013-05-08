<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Operator_Number_Model extends CI_model{
	
	public function get($data=false)
	{
		if($data)
		{
			$this->db->where($data);
			$get = $this->db->get('operator_number');
			if($get->num_rows() > 0)
			{
				return $get->row();
			}
		}
		return false;
	}

	public function gets($data=false)
	{
		if($data)
		{
			$this->db->where($data);
		}
		$get = $this->db->get('operator_number');
		if($get->num_rows() > 0)
		{
			return $get->result();
		}
		else
		return false;
	}
	
	
}
