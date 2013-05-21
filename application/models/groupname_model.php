<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Groupname_Model extends CI_model{

	function get($id_groupname=false)
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
	
	function gets()
	{
		$get = $this->db->get('groupname');
		if($get->num_rows() > 0 )
		{
			return $get->result();
		}
		else
		return false;	
	}
	
	function get_col($kolom=false,$value=false)
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
	
	function add($nama_group=false,$color=false)
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
	
	function cek_edit($id_groupname=false,$group_name=false)
	{
		if($id_groupname && $group_name)
		{
			$this->db->where('id_groupname !=',$id_groupname);
			$this->db->where('nama_group',$group_name);
			$cek = $this->db->get('groupname');
			if($cek->num_rows() > 0)
			{
				return $cek->row();
			}
			
		}
		return false;
		
	}
	
	function update($id_groupname=false,$nama_group=false,$color=false)
	{
		if($id_groupname && $nama_group && $color)
		{
			$data = array('nama_group' => $nama_group, 'color' => $color);
			$this->db->where('id_groupname',$id_groupname);
			$update = $this->db->update('groupname',$data);
			if($update)
			{
				return true;
			}
		}
		return false;
	}
	
	function delete($data=FALSE)
	{
		if($data)
		{
			$this->db->where($data);
			$del = $this->db->delete('groupname');
			if($del)
			{
				return TRUE;
			}
		}
		return FALSE;
	} 
	
}
