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
	
	
	public function get_inbox($data=false,$perpage=0,$start=0,$keyword=false)
	{
		if(is_array($data))
		{ //count(inbox.id_inbox)
			$this->db->select('inbox.thread,max(inbox.id_inbox) as id_inbox,inbox.number,recive_date,count(inbox.thread) as total,max(content) as content,address_book.id_address_book,min(read_status) as read_status,first_name,last_name');
			$this->db->join('address_book','address_book.id_address_book=inbox.id_address_book','left');
			$this->db->where_in('id_inbox',$data);
			if($keyword)
			{
				$key = array(
				'inbox.content' => $keyword,
				'address_book.first_name' => $keyword,
				'address_book.last_name' => $keyword,
				'address_book.number' => $keyword,
				'address_book.email' => $keyword
				);
				$this->db->or_like($key);
			}
			//$this->db->group_by('address_book.id_address_book');
			$this->db->group_by('inbox.thread');
			$this->db->order_by('recive_date','desc');
			$this->db->order_by('id_inbox','desc');
			if($perpage)
			{
				$content = $this->db->get('inbox',$perpage,$start);
			}
			else
			{
				//total row
				$content = $this->db->get('inbox');
			}
			log_message('error' ,$this->db->last_query());
			if($content->num_rows() > 0)
			{
				return $content->result();
			}
		}
		return false;
		
	}
	

}
