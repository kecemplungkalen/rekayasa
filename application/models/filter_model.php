<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Filter_Model extends CI_model{
	
	
	public function add($nama_filter=false)
	{
		if($nama_filter)
		{
			$data = array('filter_name' => $nama_filter);
			$this->db->insert('filter',$data);
			$insert_id = $this->db->insert_id();
			if($insert_id)
			{
				return $insert_id;
			}
		}
		return false;
	}
	
}
