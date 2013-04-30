<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Group_Model extends CI_model{

	public function add($id_address_book=false,$id_groupname=false,$id_user=false)
	{
		if($id_address_book && $id_groupname)
		{
			$data = array(
			'id_address_book' => $id_address_book,
			'id_user' => $id_user,
			'id_groupname' => $id_groupname
			);
			$this->db->insert('group',$data);
			$id = $this->db->insert_id();
			if($id)
			{
				return $id;
			}
		}
		return false;
	}
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
		$this->db->select('groupname.id_groupname,nama_group,count(id_address_book) as jml,groupname.color');
		$this->db->join('groupname','groupname.id_groupname=group.id_groupname','right');
		$this->db->group_by('group.id_groupname');
		$this->db->order_by('group.id_address_book');
		$data = $this->db->get('group');
		if($data->num_rows() > 0)
		{
			return $data->result();
		}
		else
		return false;
		
	}
	
	public function delete($kolom=false,$value=false)
	{
		if($kolom && $value)
		{
			$this->db->where($kolom,$value);
			$del = $this->db->delete('group');
			if($del)
			{
				return true;
			}
		}
		return false;
	}
}
