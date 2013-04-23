<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Groupname_Model extends CI_model{

	public function get($id_groupname=false)
	{
		if($id_groupname)
		{
			$this->db->where('id_groupname',$id_groupname);
			$data = $this->db->get('groupname');
			if($data->num_rows() > 0)
			{
				return $data->row();
			}
		}
		return false;
	}
	
	public function gets()
	{
		$get = $this->db->get('groupname');
		if($get->num_rows() > 0 )
		{
			return $get->result();
		}
		else
		return false;	
	}
	
	public function get_col($kolom=false,$value=false)
	{
		if($kolom && $value)
		{
			$this->db->where($kolom,$value);
			$data = $this->db->get('groupname');
			if($data->num_rows() > 0)
			{
				return $data->row();
			}
		}
		return false;
	}
	
	public function add($nama_group=false,$color=false)
	{
		if($nama_group && $color)
		{
			$data = array(
			'nama_group' => $nama_group ,
			'color'=> $color
			);
			$this->db->insert('groupname',$data);
			$insert_id = $this->db->insert_id();
			if($insert_id)
			{
				return $insert_id;
			}
		}
		return false;
	}
	
}
