<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class inbox_model extends CI_model{
	

	public function add($data=false)
	{
		if(is_array($data))
		{
			$this->db->insert('inbox',$data);
			$id = $this->db->insert_id();
			if($id)
			{
				return $id;
			}
		}
		return false;
		
	}
	
	public function get($id_inbox=false) 
	{
		if($id_inbox)
		{
			$this->db->where('id_inbox',$id_inbox);
			$data = $this->db->get('inbox');
			if($data->num_rows() > 0)
			{
				$row = $data->row();
				return $row;
			}
		}
		return false;
		
	}
	
	public function gets()
	{
		$data = $this->db->get('inbox');
		if($data->num_rows() > 0)
		{
			return $data->result();
		}
		return false;
	}
	
	public function gets_where($kolom=false,$data=false)
	{
		if($kolom && $data)
		{
			$this->db->where($kolom,$data);
			$data = $this->db->get('inbox');
			if($data->num_rows() > 0)
			{
				return $data->result();
			}
		}
		return false;
	}
	
	public function delete($id_inbox=false)
	{
		if($id_inbox)
		{
			$this->db->where('id_inbox',$id_inbox);
			$delete = $this->db->delete('inbox');
			if($delete)
			{
				return true;
			}
		}
		return false;
	}
	
	public function update($id_inbox=false,$data=false)
	{
		if($id_inbox && $data)
		{
			$this->db->where('id_inbox',$id_inbox);
			$update = $this->db->update('inbox',$data);
			if($update)
			{
				return true;
			}
		}
		return false;
	}

}
