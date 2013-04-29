<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Filter_Regex_Model extends CI_model{
	
	
	public function gets()
	{
		$data = $this->db->get('filter_regex');
		if($data->num_rows() > 0)
		{
			return $data->result();
		}
		else
		return false;
	}
	
	public function get($id_filter_regex=false)
	{
		if($id_filter_regex)
		{
			$this->db->where('id_filter_regex',$id_filter_regex);
			$row = $this->db->get('filter_regex');
			if($row->num_rows() > 0)
			{
				return $row->row();
			}
		}
		return false;
	}
}
