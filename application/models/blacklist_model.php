<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Blacklist_Model extends CI_model{

	
	public function gets($data=false)
	{
		if($data)
		{
			$this->db->where($data);
			$gets = $this->db->get('blacklist');
			if($gets->num_rows() > 0)
			{
				return $gets->result();
			}
		}
		return false;
	}

	public function get($data=false)
	{
		if($data)
		{
			$this->db->where($data);
			$get = $this->db->get('blacklist');
			if($get->num_rows() > 0)
			{
				return $get->row();
			}
		}
		return false;
	}

	public function add($data=false)
	{
		if($data)
		{
			$this->db->insert('blacklist',$data);
			$last_id = $this->db->insert_id();
			if($last_id)
			{
				return $last_id;
			}
		}
		return false;
	}
	
	public function delete($data=false)
	{
		if($data)
		{
			$this->db->where($data);
			$del = $this->db->delete('blacklist');
			if($del)
			{
				return true;
			}
		}
		return false;
	}
	

}
