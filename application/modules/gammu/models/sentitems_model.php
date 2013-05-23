<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sentitems_model extends CI_Model{


	function get($data=FALSE)
	{
		$this->gammu = $this->load->database('gammu',true); 

		if($data)
		{
			$this->gammu->where($data);
			$row = $this->gammu->get('sentitems');
			if($row->num_rows() > 0)
			{
				return $row->row();
			}
		}
		return FALSE;
	}
	
	function gets_all()
	{
		$this->gammu = $this->load->database('gammu',true); 
		$data = $this->gammu->get('sentitems');
		if($data->num_rows() > 0)
		{
			return $data->result();
		}
		return FALSE;
	}
	
	function gets($data=FALSE)
	{
		$this->gammu = $this->load->database('gammu',true); 
		if($data)
		{
			$this->gammu->where($data);
			$gets = $this->gammu->get('sentitems');
			if($gets->num_rows() > 0)
			{
				return $gets->result();
			}
		}
		return FALSE;
	}
	
}
