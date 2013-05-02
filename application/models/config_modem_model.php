<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Config_Modem_Model extends CI_model{
	
	public function add($data)
	{
		if($data)
		{
			$this->db->insert('config_modem',$data);
			$last_id = $this->db->insert_id();
			if($last_id)
			{
				return $last_id;
			}
			
		}
		return false;
	}
	
	public function get($id_config_modem=false)
	{
		if($id_config_modem)
		{
			$this->db->where('id_config_modem',$id_config_modem);
			$data = $this->db->get('config_modem');
			if($data->num_rows() > 0)
			{
				return $data->row();
			}
		}
		return false;
	}
	
	public function gets_by($kolom=false,$value=false)
	{
		if($kolom && $value)
		{
			$this->db->where($kolom,$value);
			$get = $this->db->get('config_modem');
			if($get->num_rows() > 0 )
			{
				return $get->result();
			}
		}
		return false;
	}
	
	public function gets()
	{
		$all = $this->db->get('config_modem');
		if($all->num_rows() > 0)
		{
			return $all->result();
		}else
		return false;
	}
	
	public function delete($id_config_modem=false)
	{
		if($id_config_modem)
		{
			$this->db->where('id_config_modem',$id_config_modem);
			$del= $this->db->delete('config_modem');
			if($del)
			{
				return true;
			}
		}
		return false;
	}
	
}

