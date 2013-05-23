<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Gammu_Outbox_Multipart_Model extends CI_model{
	
	// gammu model 
	
	function add($data=false)
	{
		$this->gammu = $this->load->database('gammu',true); 
		
		if($data)
		{
			$this->gammu->insert('outbox_multipart',$data);
			$last_id = $this->gammu->insert_id();
			if($last_id)
			{
				return $last_id;
			}
			
		}
		return false;
		
	}

	function get($data=false)
	{
		$this->gammu = $this->load->database('gammu',true); 
		
		if($data)
		{
			$this->gammu->where($data);
			$res = $this->gammu->get('outbox_multipart');
			if($res->num_rows() > 0)
			{
				return $res->row();
			}
			
		}
		return false;
		
	}
	
	function gets($data=false)
	{
		$this->gammu = $this->load->database('gammu',true); 
		
		if($data)
		{
			$this->gammu->where($data);
			$res = $this->gammu->get('outbox_multipart');
			if($res->num_rows() > 0)
			{
				return $res->result();
			}
			
		}
		return false;
	}
	
	function gets_all()
	{
		$this->gammu = $this->load->database('gammu',true); 
		
		$res = $this->gammu->get('outbox_multipart');
		if($res->num_rows() > 0)
		{
			return $res->result();
		}
		return false;
	}
	
	
}
