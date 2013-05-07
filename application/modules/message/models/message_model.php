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
			$this->db->select('inbox.thread,max(inbox.id_inbox) as id_inbox,inbox.number,recive_date,count(inbox.id_inbox) as total,max(content) as content,address_book.id_address_book,min(read_status) as read_status,first_name,last_name');
			$this->db->join('address_book','address_book.id_address_book=inbox.id_address_book','left');
			$this->db->where_in('inbox.id_inbox',$data);
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
			$this->db->group_by('inbox.thread');
			$this->db->order_by('inbox.last_update','desc');
			$this->db->order_by('inbox.recive_date','desc');
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
	
	function get_by_thread($thread=false,$perpage=0,$start=0,$keyword=false)
	{
		if($thread)
		{
			$this->db->select('max(inbox.id_inbox) as id_inbox,recive_date,min(read_status) as read_status,thread,count(id_inbox) as total, inbox.number,first_name,last_name');
			$this->db->join('address_book','address_book.id_address_book=inbox.id_address_book','left');			
			$this->db->where_in('thread',$thread);
			$this->db->group_by('thread');
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
			
			$this->db->order_by('recive_date','desc');
			
			if($perpage)
			{
				$data = $this->db->get('inbox',$perpage,$start);
			}
			else
			{
				$data = $this->db->get('inbox');
			}
			if($data->num_rows() > 0)
			{
				return $data->result();
			}
		}
		return false;
	}
	
	function group_labelname($id_inbox_aray=false)
	{
		if($id_inbox_aray)
		{
			$this->db->where_in('id_inbox',$id_inbox_aray);
			$this->db->group_by('id_labelname');
			$data = $this->db->get('label');
			if($data->num_rows() > 0)
			{
				return $data->result();
			}
		}
		return false;
	}
	
	function labelname_data($id_labelname=false)
	{
		if($id_labelname)
		{
			$this->db->where_in('id_labelname',$id_labelname);
			$res = $this->db->get('labelname');
			if($res->num_rows() > 0)
			{
				return $res->result();
			}
		}
		return false;
	}

}
