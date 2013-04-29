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
	
}
