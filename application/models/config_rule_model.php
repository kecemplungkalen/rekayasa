<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Config_Rule_Model extends CI_model{
	
	public function add($id_smsc_name=false,$id_config_modem=false)
	{
		if($id_smsc_name && $id_config_modem)
		{
			$data = array('id_smsc_name' => $id_smsc_name,'id_config_modem' => $id_config_modem);
			$this->db->insert('config_rule',$data);
			$last_id = $this->db->insert_id();
			if($last_id)
			{
				return $last_id;
			}
			
		}
		return false;
	}
	
	public function gets()
	{
		$data = $this->db->get('config_rule');
		if($data->num_rows() > 0)
		{
			return $data->result();
		}else
		return false;
	}
	
	
	public function get($id_config_rule=false)
	{
		if($id_config_rule)
		{
			$this->db->where('id_config_rule',$id_config_rule);
			$get = $this->db->get('config_rule');
			if($get->num_rows() > 0)
			{
				return $get->row();
			}
		}
		return false;
		
	}
	
	public function delete($id_config_rule=false)
	{
		if($id_config_rule)
		{
			$this->db->where('id_config_rule',$id_config_rule);
			$del = $this->db->delete('config_rule');
			if($del)
			{
				return true;
			}
		}
		return false;
	}
	
	public function get_by($kolom=false,$value=false)
	{
		if($kolom && $value)
		{
			$this->db->where($kolom,$value);
			$get = $this->db->get('config_rule');
			if($get->num_rows() > 0)
			{
				return $get->row();
			}
		}
		return false;
	}
	
	public function update($id_config_rule=false,$data=false)
	{
		if($id_config_rule && $data)
		{
			$this->db->where('id_config_rule',$id_config_rule);
			$update = $this->db->update('config_rule',$data);
			if($update)
			{
				return true;
			}
		}
		return false;
	}
}
