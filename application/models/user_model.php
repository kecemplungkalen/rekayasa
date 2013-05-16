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
	
	function gets()
	{
		$get = $this->db->get('user');
		if($get->num_rows() > 0)
		{
			return $get->result();
		}else
		return false;
	}
	
	function add($data=false)
	{
		if($data)
		{
			$this->db->insert($data);
			$last_id = $this->db->insert_id();
			if($last_id)
			{
				return $last_id;
			}
		}
		return false;
	}
	
	function update($where=false,$data=false)
	{
		if($where && $data)
		{
			$this->db->where($where);
			$up = $this->db->update('user',$data);
			if($up)
			{
				return true;
			}
		}
		return false;
	} 
	
}
