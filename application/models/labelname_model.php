<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Labelname_Model extends CI_model{
	
	


	public function get_label_id($label=false)
	{
		if($label)
		{
			$this->db->where('name',$label);
			$label = $this->db->get('labelname');
			if($label->num_rows() > 0)
			{
				$row = $label->row();
				return $row;
			}
			
		}
		return false;
	}
	
	public function gets()
	{
		$label = $this->db->get('labelname');
		if($label->num_rows() > 0 )
		{
			return $label->result();
		}
		else
		return false;
	}
	
	public function get_add()
	{
		//$this->db->join('label');
		$this->db->where('additional','1');
		$label = $this->db->get('labelname');
		if($label->num_rows() > 0 )
		{
			return $label->result();
		}
		else
		return false;
	} 
	
	public function get_baku()
	{
		//$this->db->join('label');
		$this->db->where('additional','0');
		$label = $this->db->get('labelname');
		if($label->num_rows() > 0 )
		{
			return $label->result();
		}
		else
		return false;
	} 
}
