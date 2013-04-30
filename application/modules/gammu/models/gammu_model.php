<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Gammu_Model extends CI_model{

	
	public function get_inbox($limit=false,$offset=false)
	{
		$this->gammu = $this->load->database('gammu',true); 

		$this->gammu->where('Processed','false');
		$this->gammu->order_by('ID','desc');
		if($limit)
		{
			$data = $this->gammu->get('inbox',$limit,$offset);
		}else
		{
			$data = $this->gammu->get('inbox');
		}
		if($data->num_rows() > 0)
		{
			return $data->row();
		}
	}
	
	public function get($id=false)
	{
		$this->gammu = $this->load->database('gammu',true); 

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
		$this->gammu = $this->load->database('gammu',true); 
		if($id && $data)
		{
			$this->gammu->where('ID',$id);
			$update = $this->gammu->update('inbox',$data);
			if($update)
			{
				return true;
			}
		}
		return false;
	}
	
	
}
