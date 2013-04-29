<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class label_model extends CI_model{
	
	/*
	select * from label 
	join labelname on label.id_labelname=labelname.id_labelname 
	where label.id_inbox='1';
	*/
	
	public function get_by_id_inbox($id_inbox=false)
	{
		if($id_inbox)
		{
			$this->db->join('labelname','label.id_labelname=labelname.id_labelname');
			$this->db->where('id_inbox',$id_inbox);
			$data = $this->db->get('label');
			if($data->num_rows() > 0)
			{
				return $data->result();
			}	
		}
		return false;
	}
	
	
	public function get_id_inbox($id_labelname=false)
	{
		if($id_labelname)
		{
			$this->db->where('id_labelname',$id_labelname);
			$data = $this->db->get('label');
			if($data->num_rows() > 0)
			{
				return $data->result();
			}
			
		}
		return false;
	}
	
	public function get_label_inbox()
	{
		
		$this->db->join('labelname','labelname.id_labelname=label.id_labelname');
		$this->db->join('inbox','inbox.id_inbox=label.id_inbox');
		$this->db->where('read_status','0');
		$data = $this->db->get('label');
		if($data->num_rows() > 0)
		{
			return $data->result();
		}
		else
		return false;
		
	}
	
	public function count_unread($id_labelname=false)
	{
		if($id_labelname)
		{
			$this->db->where('label.id_labelname',$id_labelname);
			$this->db->where('inbox.read_status','0');
			$this->db->join('label','label.id_inbox=inbox.id_inbox','right');
			$count = $this->db->count_all_results('inbox');
			if($count)
			{
				return $count;
			}
		}
		return false;
	}
	
	public function add($id_inbox=false,$id_labelname=false)
	{
		if($id_inbox && $id_labelname)
		{
			$data = array('id_inbox' => $id_inbox,'id_labelname' => $id_labelname);
			$this->db->insert('label',$data);
			$insert_id = $this->db->insert_id();
			if($insert_id)
			{
				return $insert_id;
			}
		}
		return false;
	}
	
	public function delete($id_label=false)
	{
		if($id_label)
		{
			$this->db->where('id_label',$id_label);
			$delete = $this->db->delete('label');
			if($delete)
			{
				return $id_label;
			}
		}
		return false;
	}
	
	public function delete_by($kolom=false,$value=false)
	{
		if($kolom && $value)
		{
			$this->db->where($kolom,$value);
			$delete = $this->db->delete('label');
			if($delete)
			{
				return true;
			}
		}
		return false;
	}
	
	
	public function set_archive($id_inbox=false)
	{
		if($id_inbox)
		{
			$this->db->where('id_inbox',$id_inbox);
			$this->db->where('id_labelname','1');
			$data = $this->db->get('label');
			if($data->num_rows() > 0)
			{
				return $data->row();
			}
		}
		return false;
	}

}
