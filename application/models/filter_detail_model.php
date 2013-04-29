<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Filter_Detail_Model extends CI_model{
	
	
	public function add($data=false)
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
	
	public function gets_by_col($kolom=false,$data=false)
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
	
}
