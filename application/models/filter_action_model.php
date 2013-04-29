<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Filter_Action_Model extends CI_model{
	
	
	public function add($data=false)
	{
		if(is_array($data))
		{
			$this->db->insert('filter_action',$data);
			log_message('error' ,$this->db->last_query());
			$insert_id = $this->db->insert_id();
			if($insert_id)
			{
				return $insert_id;
			}
		}
		return false;
	}
	
	public function gets_by_col($kolom=false,$value=false)
	{
		if($kolom && $value)
		{
			$this->db->where($kolom,$value);
			$this->db->order_by('order','asc');
			$gets = $this->db->get('filter_action');
			if($gets->num_rows() > 0)
			{
				return $gets->result();
			}
		}
		return false;	
		
	}
	
}
