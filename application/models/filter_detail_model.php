<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Filter_Detail_Model extends CI_model{
	
	
	function add($data=false)
	{
		if(is_array($data))
		{
			$this->db->insert('filter_detail',$data);
			$last_id = $this->db->insert_id();
			if($last_id)
			{
				return $last_id;
			}
		}
		return false;
	}
	
	function gets_by_col($kolom=false,$data=false)
	{
		if($kolom && $data)
		{
			$this->db->where($kolom,$data);
			$this->db->order_by('order','asc');
			$result = $this->db->get('filter_detail');
			if($result->num_rows() > 0)
			{
				return $result->result();
			}
		}
		return false;
	}
	
	function delete($data=FALSE)
	{
		if($data)
		{
			$this->db->where($data);
			$delete = $this->db->delete('filter_detail');
			if($delete)
			{
				return TRUE;
			}
		}
		return FALSE;
	}
	
	function gets($where=FALSE,$group=FALSE)
	{
		if($where)
		{
			$this->db->where($where);
			if($group)
			{
				$this->db->group_by($group);
			}
			$data = $this->db->get('filter_detail');
			if($data->num_rows() > 0)
			{
				return $data->result();
			}
			
		}
		return FALSE;
	}
	
	
}
