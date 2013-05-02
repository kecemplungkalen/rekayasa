<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Gammu_Outbox_Model extends CI_model{
	
	// gammu model 
	
	public function insert($data=false)
	{
		$this->gammu = $this->load->database('gammu',true); 
		if($data)
		{
			$this->gammu->insert('outbox',$data);
			$last_id = $this->gammu->insert_id();
			if($last_id)
			{
				return $last_id;
			}
		}
		return false;
	}
	
	
}
