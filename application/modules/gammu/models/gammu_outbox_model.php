<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Gammu_Outbox_Model extends CI_model{
	
	// gammu model 
	
	function insert($data=false)
	{
		$this->gammu = $this->load->database('gammu',true); 
		if($data)
		{
			$this->gammu->insert('outbox',$data);
			$last_id = $this->gammu->insert_id();
			if($last_id)
			{
				//return $last_id;
				
				/*
				 * return array for cron and multipart 
				 */
				$ambil = array('ID' => $last_id);
				$ambilbalik = $this->get($ambil);
				if($ambilbalik)
				{
					$sendBack = array('ID' => $last_id,'InsertIntoDB' => $ambilbalik->InsertIntoDB);
					return $sendBack;
				}
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
			$last_id = $this->gammu->get('outbox');
			if($last_id->num_rows() > 0)
			{
				return $last_id->row();
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
			$last_id = $this->gammu->get('outbox');
			if($last_id->num_rows() > 0)
			{
				return $last_id->result();
			}
		}
		return false;
	}
	
	
}
