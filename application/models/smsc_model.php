<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Smsc_Model extends CI_model{

	public function get($id_smsc=false)
	{
		if($id_smsc)
		{
			$this->db->where('id_smsc',$id_smsc);
			$data = $this->db->get('smsc');
			if($data->num_rows() > 0)
			{
				$row = $data->row();
				return $row;
				
			}
		}
		return false;
	}

	
	
}
