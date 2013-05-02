<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Smsc_Name_Model extends CI_model{

	
	public function get($id_smsc_name=false)
	{
		if($id_smsc_name)
		{
			
			$this->db->where('id_smsc_name',$id_smsc_name);
			$get = $this->db->get('smsc_name');
			if($get->num_rows() > 0)
			{
				return $get->row();
			}
		}
		return false;
		
	}
	
	public function gets()
	{
		$get = $this->db->get('smsc_name');
		if($get->num_rows() > 0)
		{
			return $get->result();
		}
		else
		return false;
		
	}

}
