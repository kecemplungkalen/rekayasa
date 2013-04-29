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
	
	public function gets($status=false)
	{
		if($status)
		{
			$this->db->where($status,1);
		}
		$data = $this->db->get('filter');
		if($data->num_rows() > 0)
		{
			return $data->result();
		}
	}
	
}
