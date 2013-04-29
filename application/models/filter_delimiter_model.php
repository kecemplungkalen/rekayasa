<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Filter_Delimiter_Model extends CI_model{
	
	
	public function gets()
	{
		$gets = $this->db->get('filter_delimiter');
		if($gets->num_rows() > 0)
		{
			return $gets->result();
		}
		else
		return false;
	}
	
	public function get($id_delimiter=false)
	{
		if($id_delimiter)
		{
			$this->db->where('id_delimiter',$id_delimiter);
			$row = $this->db->get('filter_delimiter');
			if($row->num_rows() > 0)
			{
				return $row->row();
			}
		}
		return false;
	}
	
}
