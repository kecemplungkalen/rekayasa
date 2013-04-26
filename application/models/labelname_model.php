<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Labelname_Model extends CI_model{
	
	


	public function get_label_id($label=false)
	{
		if($label)
		{
			$this->db->where('name',$label);
			$label = $this->db->get('labelname');
			if($label->num_rows() > 0)
			{
				$row = $label->row();
				return $row;
			}
			
		}
		return false;
	}
	
	public function gets()
	{
		$label = $this->db->get('labelname');
		if($label->num_rows() > 0 )
		{
			return $label->result();
		}
		else
		return false;
	}
	
	public function get_add()
	{
		//$this->db->join('label');
		$this->db->where('additional','1');
		$label = $this->db->get('labelname');
		if($label->num_rows() > 0 )
		{
			return $label->result();
		}
		else
		return false;
	} 
	
	public function get_baku()
	{
		//$this->db->join('label');
		$this->db->where('additional','0');
		$label = $this->db->get('labelname');
		if($label->num_rows() > 0 )
		{
			return $label->result();
		}
		else
		return false;
	}
	
	public function gets_system_label()
	{
		//join tabel filter join tabel inbox
		$this->db->where('additional','0');
		$label = $this->db->get('labelname');
		if($label->num_rows() > 0)
		{
			return $label->result();
		}
		else
		return false;
		
	} 
	
	public function get($id_labelname=false)
	{
		if($id_labelname)
		{
			$this->db->where('id_labelname',$id_labelname);
			$label = $this->db->get('labelname');
			if($label->num_rows() > 0)
			{
				return $label->row();
			}
		}
		return false;
	}
	
	public function cek_edit_label($id_labelname=false,$name=false)
	{
		if($id_labelname && $name)
		{
			$this->db->where('id_labelname !=',$id_labelname);
			$this->db->where('name',$name);
			$get = $this->db->get('labelname');
			if($get->num_rows() > 0)
			{
				return $get->row();
			}
		}
		return false;
	}
	
	public function update($id_labelname=false,$name=false,$color=false)
	{
		if($id_labelname  && $color)
		{
			$data = array(
			'name' => $name,
			'color' => $color
			);
			
			$update = $this->db->update('labelname',$data,array('id_labelname' => $id_labelname));
			if($update)
			{
				return true;
			}
		}
		return false;
	}
	
	public function update_label_system($id_labelname=false,$color=false)
	{
		if($id_labelname && $color)
		{
			$update = $this->db->update('labelname',array('color' => $color),array('id_labelname' => $id_labelname));
			if($update)
			{
				return true;
			}
		}
		return false;
	}
	
	public function cari($keyword=false)
	{
		if($keyword)
		{
			$this->db->like('name',$keyword);
			$res = $this->db->get('labelname');
			if($res->num_rows() > 0)
			{
				return $res->result();
			}
		}
		return false;
	}
	
	public function cek($name=false)
	{
		if($name)
		{
			$this->db->where('name',$name);
			$res = $this->db->get('labelname');
			if($res->num_rows() > 0)
			{
				return $res->result();
			}
		}
		return false;
	}
	
	public function add($name=false,$color=false)
	{
		if($name && $color)
		{
			$data = array(
			'name' => $name,
			'color' => $color,
			'additional' => '1'
			);
			$this->db->insert('labelname',$data);
			$insert_id = $this->db->insert_id();
			if($insert_id)
			{
				return $insert_id;
			}
		}
		return false;
	}
	
	public function delete($id_labelname=false)
	{
		if($id_labelname)
		{
			$this->db->where('id_labelname',$id_labelname);
			$delete = $this->db->delete('labelname');
			if($delete)
			{
				return true;
			}
		}
		return false;
	}
}
