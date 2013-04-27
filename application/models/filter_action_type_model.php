<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Filter_Action_Type_Model extends CI_model{
	
	
	public function gets()
	{
		$data = $this->db->get('filter_action_type');
		if($data->num_rows() > 0)
		{
			return $data->result();
		}
		else
		return false;
	}
	
}
