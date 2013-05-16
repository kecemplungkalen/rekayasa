<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Ip_Restriction_Model extends CI_model{
	#ip_restriction
	
	
	function add($data=false)
	{
		if($data)
		{
			$this->db->insert('ip_restriction',$data);
			$last_id = $this->db->insert_id();
			if($last_id)
			{
				return $last_id;
			}
		}
		return false;
	}
	
	function gets($data=false)
	{
		if($data)
		{
			$this->db->where($data);
			$res = $this->db->get('ip_restriction');
			if($res->num_rows() > 0)
			{
				return $res->result();
			}
		}
		return false;
	}
	
	function delete($where=false)
	{
		if($where)
		{
			$this->db->where($where);
			$del = $this->db->delete('ip_restriction');
			if($del)
			{
				return true;
			}
		}
		return false;
	}
}
