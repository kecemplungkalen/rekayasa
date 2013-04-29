<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Filter_Model extends CI_model{
	
	
	public function add($nama_filter=false,$id_delimiter=false)
	{
		if($nama_filter && $id_delimiter)
		{
			$data = array('filter_name' => $nama_filter,'id_delimiter' => $id_delimiter);
			$this->db->insert('filter',$data);
			$insert_id = $this->db->insert_id();
			if($insert_id)
			{
				return $insert_id;
			}
		}
		return false;
	}
	
	public function gets_by($perpage=false,$start=false,$keyword=false)
	{

		if($keyword)
		{
			$data = array('filter_name' => $keyword);
			$this->db->or_like($data);
		}
		if($perpage)
		{
			$result = $this->db->get('filter',$perpage,$start);
		}
		else
		{
			$result = $this->db->get('filter');
		}
		if($result->num_rows() > 0)
		{
			return $result->result();
		}else
		{
			return false;
		}
		
	}
	
	public function gets($status=false)
	{
		if($status)
		{
			$this->db->where('status',$status);
		}
		$data = $this->db->get('filter');
		if($data->num_rows() > 0)
		{
			return $data->result();
		}
	}
	
	public function update($id_filter=false,$data=false)
	{
		if($id_filter && $data)
		{
			$this->db->where('id_filter',$id_filter);
			$update = $this->db->update('filter',$data);
			if($update)
			{
				return true;
			}
			
		}
		return false;
	}
	
	public function delete($id_filter=false)
	{
		if($id_filter)
		{
			$this->db->where('id_filter',$id_filter);
			$del = $this->db->delete('filter');
			if($del)
			{
				return true;
			}
			
		}
		return false;
	}
	
}
