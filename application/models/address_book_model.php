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
	
	public function gets()
	{
		$data = $this->db->get('address_book');
		if($data->num_rows() > 0)
		{
			return $data->result();
		}
	
	}
	
	public function add($number=false,$first_name=false,$last_name=false,$email=false,$id_user=false)
	{
		if($number && $first_name && $email)
		{
			//$cerate_date=;
			
			$data = array(
			'first_name' => $first_name,
			'last_name' => $last_name,
			'number' => $number,
			'email' => $email,
			'create_date' => time(),
			'last_update' => time(),
			'id_user' => $id_user
			);
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
	

	

}
