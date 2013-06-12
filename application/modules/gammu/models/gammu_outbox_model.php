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
				return $last_id;
				
				/*
				 * saya lupa return date buat apa 
				 */
				//$ambil = array('ID' => $last_id);
				//$ambilbalik = $this->get($ambil);
				//if($ambilbalik)
				//{
					//return $ambilbalik->InsertIntoDB;
				//}
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
