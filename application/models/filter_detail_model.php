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
	
}
