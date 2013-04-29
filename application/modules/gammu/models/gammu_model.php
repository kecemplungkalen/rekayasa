<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Gammu_Model extends CI_model{
	function __construct()
	{
		parent::__construct();		
		$this->gammu = $this->load->database('gammu',true); 
	}
	
	public function get_inbox()
	{
		$this->gammu->where('Processed','false');
		$this->gammu->order_by('ID','desc');
		$data = $this->gammu->get('inbox');
		if($data->num_rows() > 0)
		{
			return $data->row();
		}
	}
	
	public function get($id)
	{
		if($id)
		{
			$this->gammu->where('ID',$id);
			$get = $this->gammu->get('inbox');
			if($get->num_rows() > 0)
			{
				return $get->row();
			}
		}
		return false;
	}
	
	public function update($id=false,$data=false)
	{
		if($id && $data)
		{
			$this->db->where('ID',$id);
			$update = $this->db->update('inbox',$data);
			if($update)
			{
				return true;
			}
		}
		return false;
	}
	
	
}
