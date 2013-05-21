<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Phones_Model extends CI_Model{

	public function get_active()
	{
		$this->gammu = $this->load->database('gammu',true); 

		//$date = date("Y-m-d H:i:s");
		//$this->gammu->where('TimeOut >','NOW()');
		//$phone = $this->gammu->get('phones');
		$phone = $this->gammu->query('select * from phones where TimeOut > NOW()');
		if($phone->num_rows() > 0)
		{
			return $phone->result();
		}
		return false;
	}
	
	public function get($imei=false)
	{
		$this->gammu = $this->load->database('gammu',true); 
		
		if($imei)
		{
			$this->gammu->where('IMEI',$imei);
			$row = $this->gammu->get('phones');
			if($row->num_rows() > 0)
			{
				return $row->row();
			}
		}			
		return false;
	}
	
	public function get_kol($kolom=false,$value=false)
	{
		$this->gammu = $this->load->database('gammu',true); 
		
		if($kolom && $value)
		{
			$this->gammu->where($kolom,$value);
			$row = $this->gammu->get('phones');
			if($row->num_rows() > 0)
			{
				return $row->row();
			}
		}			
		return false;
	}
	
	public function where_kol($where=false)
	{
		$this->gammu = $this->load->database('gammu',true); 
		
		if($where)
		{
			$this->gammu->where($where);
			$row = $this->gammu->get('phones');
			if($row->num_rows() > 0)
			{
				return $row->row();
			}
		}			
		return false;
	}
	

}
