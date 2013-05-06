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
	
	function get_in_where($data=false)
	{
		if($data)
		{
			$this->db->where_in('id_inbox',$data);
			$this->db->group_by('thread');
			$thread  = $this->db->get('inbox');
			if($thread->num_rows() > 0)
			{
				return $thread->result();
			}
		}	
		return false;
	}

	function gets_in_where($kolom=false,$data=false)
	{
		if($kolom && $data)
		{
			$this->db->where_in($kolom,$data);
			$this->db->group_by('thread');
			$thread  = $this->db->get('inbox');
			if($thread->num_rows() > 0)
			{
				return $thread->result();
			}
		}	
		return false;
	}
	
	public function arr_wheres($data=false)
	{
		$this->db->where($data);
		$result = $this->db->get('inbox');
		if($result->num_rows() > 0)
		{
			return $result->result();
		}
		return false;
	}

}
