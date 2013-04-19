<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Group_Model extends CI_model{

	
	public function gets_by($kolom=false,$value=false)
	{
		if($kolom && $value)
		{
			$this->db->where($kolom,$value);
			$data = $this->db->get('group');
			if($data->num_rows() > 0)
			{
				return $data->result();
			}
		}
		return false;
	}
	
	
	
}
