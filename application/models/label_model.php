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
	
	
}
