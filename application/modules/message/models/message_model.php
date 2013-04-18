 

<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class message_model extends CI_model{

//select ib.id_inbox,count(ib.id_inbox) as jml,ab.number,ib.content,ab.id_address_book 
//from inbox ib 
//join label l on l.id_inbox=ib.id_inbox 
//join address_book ab on ab.id_address_book=ib.id_address_book 
//join labelname lbn on lbn.id_labelname=l.id_labelname 
//where lbn.name='inbox' group by ab.id_address_book;

	
	public function getlabel($label=false)
	{
		if($label)
		{
			$this->db->select('inbox.id_inbox,count(inbox.id_inbox) as total ,inbox.id_user,recive_date,content,read_status,id_label,address_book.id_address_book,first_name,last_name,number,email, create_date ,address_book.last_update , labelname.id_labelname ,name ,color ,additional');
			
			$this->db->join('label','label.id_inbox=inbox.id_inbox');
			$this->db->join('labelname','labelname.id_labelname=label.id_labelname');
			$this->db->join('address_book','address_book.id_address_book=inbox.id_address_book');
			$this->db->where('labelname.name',$label);
			$this->db->group_by('address_book.id_address_book');
			$data = $this->db->get('inbox');
			if($data->num_rows() > 0)
			{
				return $data->result();
			}
		}
		return false;
	}
	
}
