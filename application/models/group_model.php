<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Group_Model extends CI_model{

	
	public function gets_by($kolom=false,$value=false)
	{
		if($kolom && $value)
		{
			$this->db->where($kolom,$value);
			$data = $this->db->get('group');
			if($data->num_rows() > 0)
			{
				return $data->result();
			}
		}
		return false;
	}
	
	public function get_count()
	{
		$this->db->select('id_group,nama_group,count(id_address_book) as jml');
		$this->db->join('groupname','groupname.id_groupname=group.id_groupname');
		$this->db->group_by('group.id_groupname');
		$data = $this->db->get('group');
		if($data->num_rows() > 0)
		{
			return $data->result();
		}
		else
		return false;
		
	}
	
	
}
