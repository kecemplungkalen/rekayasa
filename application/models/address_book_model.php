<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Address_Book_Model extends CI_model{

	public function get($id_address_book=false)
	{
		if($id_address_book)
		{
			$this->db->where('id_address_book',$id_address_book);
			$data = $this->db->get('address_book');
			if($data->num_rows() > 0)
			{
				$row = $data->row();
				return $row;
			}
		}
		return false;
	}
	
	public function gets($perpage=0,$start=0,$keyword=false)
	{
		if($keyword)
		{

			$this->db->or_like($keyword);
		}
		if($perpage)
		{
			$data = $this->db->get('address_book',$perpage,$start);

		}
		else
		{
			$data = $this->db->get('address_book');
		}
		if($data->num_rows() > 0)
		{
			$result = $data->result();
			return $result;
		}else
		return false;
	
	}
	
	//public function add($number=false,$first_name=false,$last_name=false,$email=false,$id_user=false)
	//{
		//if($number && $first_name)
		//{
			//$cerate_date=;
	function add($data=false)
	{
		if($data)
		{
			//$cerate_date=;
			
			//$data = array(
			//'first_name' => $first_name,
			//'last_name' => $last_name,
			//'number' => $number,
			//'email' => $email,
			//'create_date' => time(),
			//'last_update' => time(),
			//'id_user' => $id_user
			//);
			$this->db->insert('address_book',$data);
			$last_id = $this->db->insert_id();
			if($last_id)
			{
				return $last_id;
			}
		}
		return false;
	}
	
	public function get_where($kolom=false,$data=false)
	{
		if($kolom && $data)
		{
			$this->db->where($kolom,$data);
			$data = $this->db->get('address_book');
			if($data->num_rows() > 0)
			{
				$row = $data->row();
				return $row;
			}
		}
		return false;
		
	}
	
	public function gets_where($kolom=false,$data=false)
	{
		if($kolom && $data)
		{
			$this->db->where($kolom,$data);
			$data = $this->db->get('address_book');
			if($data->num_rows() > 0)
			{
				return $data->result();
			}
		}
		return false;
	}
	
	public function delete($id_address_book=false)
	{
		if($id_address_book)
		{
			$this->db->where('id_address_book',$id_address_book);
			$del = $this->db->delete('address_book');
			if($del)
			{
				return true;
			}
		}
		return false;
	}
	
	public function search($keyword=false,$perpage=false,$start=false)
	{
		if($keyword)
		{
			$data = array(
				'first_name' => $keyword,
				'last_name' => $keyword,
				'number' => $keyword
				);
			$this->db->or_like($data);
			if($keyword && $perpage)
			{
				$res = $this->db->get('address_book',$perpage,$start);			
			}
			else
			{
				$res = $this->db->get('address_book');
			}
				
				if($res->num_rows() > 0)
				{
					return $res->result();
				}
		}
		return false;
	}
	
	public function update($id_address_book=false,$data=false)
	{
		// $data = array 
		if($id_address_book && $data)
		{
			$this->db->where('id_address_book',$id_address_book);
			$update = $this->db->update('address_book',$data);
			if($update)
			{
				return true;
			}
		}
		return false;
	}
	

}
