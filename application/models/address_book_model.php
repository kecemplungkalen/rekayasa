<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class address_book_model extends CI_model{

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
