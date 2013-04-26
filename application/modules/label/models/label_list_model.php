<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Label_List_Model extends CI_model{
	
	

/*
 * select * from labelname 
 * join label on label.id_labelname=labelname.id_labelname 
 * join inbox on inbox.id_inbox=label.id_inbox 
 * where additional=1 
 * and labelname.id_labelname=7 
 * order by recive_date 
 * desc;
 */

	public function get_last_message($id_labelname=false)
	{
		if($id_labelname)
		{
			$this->db->join('label','label.id_labelname=labelname.id_labelname');
			$this->db->join('inbox','inbox.id_inbox=label.id_inbox');
			$this->db->where('labelname.id_labelname',$id_labelname);
			$this->db->order_by('recive_date','desc');
			$data = $this->db->get('labelname');
			if($data->num_rows() > 0)
			{
				$row = $data->row();
				return $row;
			}
		}
		return false;
	}
} 
