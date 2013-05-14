<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Blacklist_Model extends CI_model{

	public function all()
	{
		$data = $this->db->get('blacklist');
		if($data->num_rows() > 0)
		{
			return $data->result();
		}
		else
		return false;
	}
	
	public function gets($data=false)
	{
		if($data)
		{
			$this->db->where($data);
			$gets = $this->db->get('blacklist');
			if($gets->num_rows() > 0)
			{
				return $gets->result();
			}
		}
		return false;
	}

	public function get($data=false)
	{
		if($data)
		{
			$this->db->where($data);
			$get = $this->db->get('blacklist');
			if($get->num_rows() > 0)
			{
				return $get->row();
			}
		}
		return false;
	}

	public function add($data=false)
	{
		if($data)
		{
			$this->db->insert('blacklist',$data);
			$last_id = $this->db->insert_id();
			if($last_id)
			{
				return $last_id;
			}
		}
		return false;
	}
	
	public function delete($data=false)
	{
		if($data)
		{
			$this->db->where($data);
			$del = $this->db->delete('blacklist');
			if($del)
			{
				return true;
			}
		}
		return false;
	}
	
	function gets_list($limit=0,$start=0,$keyword=false)
	{
		$this->db->join('address_book','address_book.number = blacklist.blacklist_number');
		if($keyword)
		{
			$key = array(
			'first_name' => $keyword,
			'last_name' => $keyword,
			'number' => $keyword
			);
			$this->db->or_like($key);
		}
		if($limit)
		{
			$this->db->limit($limit,$start);
		}
		$res = $this->db->get('blacklist');
		if($res->num_rows() > 0)
		{
			return $res->result();
		}
		else
		return false;
	}

}
