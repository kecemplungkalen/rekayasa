<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Phones_Model extends CI_Model{

	public function get_active()
	{
		$this->gammu = $this->load->database('gammu',true); 

		$date = date("Y-m-d H:i:s");
		$this->gammu->where('TimeOut >',$date);
		$phone = $this->gammu->get('phones');
		if($phone->num_rows() > 0)
		{
			return $phone->result();
		}
		else
		return false;
	}
	
	
	

}
