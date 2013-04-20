<?php 

Class Address extends MX_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->module('message');
		$this->load->model('Address_Book_Model');
		$this->load->model('Smsc_Model');
		$this->load->model('Group_Model');
		$this->load->model('Groupname_Model');
		$this->load->model('inbox_model');

	}

	public function index()
	{
		$keyword = $this->input->get('keyword');
		if($keyword)
		{
			$side['baku'] = $this->message->sidebar_baku();
			$side['add'] =  $this->message->sidebar_adt();
			$this->load->view('header_view');
			$this->load->view('navbar_view');
			$this->load->view('sidebar_view',$side);
			$this->load->view('address_top_button_view');


			$data['data'] = $this->ambil_list();

			$this->load->view('address_view',$data);
			$this->load->view('footer_view');
			
		}else
		{
			$side['baku'] = $this->message->sidebar_baku();
			$side['add'] =  $this->message->sidebar_adt();
			$this->load->view('header_view');
			$this->load->view('navbar_view');
			$this->load->view('sidebar_view',$side);
			$this->load->view('address_top_button_view');


			$data['data'] = $this->ambil_list();

			$this->load->view('address_view',$data);
			$this->load->view('footer_view');

		}
		

	}	


	public function ambil_list()
	{
		$list = $this->Address_Book_Model->gets();
		//var_dump($list);

		if($list)
		{
			$temp = false;
			$smscname = false;
			$rec = false;
			foreach($list as $li)
			{
				$temp['id_address_book'] = $li->id_address_book;
				$temp['first_name'] = $li->first_name;
				$temp['last_name'] = $li->last_name;
				$temp['number'] = $li->number;
				$smscname = $this->Smsc_Model->get($li->id_smsc);
				if($smscname)
				{
					$temp['operator'] = $smscname->smsc_name;
				}
				else
				{
					$temp['operator'] = false;
				}

				$group = $this->Group_Model->gets_by('id_address_book',$li->id_address_book);
				if($group)
				{
					$rem = false;
					foreach($group as $g)
					{
						$detail = $this->Groupname_Model->get($g->id_groupname);
						$rem[] = $detail->nama_group;
					}

					$temp['group'] = $rem;
				}
				else
				{
					$temp['group'] = false;
				}

				$last_mess = $this->inbox_model->gets_where('id_address_book',$li->id_address_book);
				if($last_mess)
				{
					$date=false;
					foreach($last_mess as $lm)
					{
						$date = $lm->recive_date;
					}
					$temp['last_message'] = $date; 
				}else
				{
					$temp['last_message'] = false; 
				}
				
				$rec[] = $temp;
			}
			return $rec;
		}
	}



	public function get_address_book_detail_php($id_address_book=false)
	{
		$detail = $this->Address_Book_Model->get($id_address_book);
		if($detail)
		{
			$res = false;
			$temp = false;	
			$group = $this->Group_Model->gets_by('id_address_book',$id_address_book);
			if($group)
			{
				foreach($group as $g)
				{
					$grouname = $this->Groupname_Model->get($g->id_groupname);
					$temp['id_groupname'] = $g->id_groupname;
					$temp['nama_group'] = $grouname->nama_group;
					$res[] = $temp;
				}				
			}

			$data = array('id_address_book'=> $id_address_book,
			'first_name' => $detail->first_name,
			'last_name' => $detail->last_name,
			'number' => $detail->number,
			'email' => $detail->email,
			'group' => $res); 
			return $data;
		}
		return false;

	}

	public function tambah_address()
	{
		$id_user = 1;
		$number = $this->input->post('number');
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$email = $this->input->post('email');
		$group = $this->input->post('group');
		$last_id = $this->Address_Book_Model->add($number,$first_name,$last_name,$email,$id_user);
		if($last_id)
		{
			for($i=0;$i < count($group);$i++)
			{
				$this->Group_Model->add($last_id,$group[$i],$id_user);
			}
			return true;
		}
		else 
		return false;
		
		
	}
	
	public function update_address()
	{
		
		$id_user = 1;
		$id_address_book = $this->input->post('id_address_book');
		$number = $this->input->post('number');
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$email = $this->input->post('email');
		$group = $this->input->post('group');
		/*
		$update = $this->Address_Book_Model->update($number,$first_name,$last_name,$email,$id_user);
		if($update)
		{
			$group = $this->Group_Model->gets_by('id_address_book',$id_address_book)
			if($group)
			{
				foreach($group as $g)
				{
					
				}	
			}
			
		}
		
		
		for($i=0;$i < count($group);$i++)
			{
				$this->Group_Model->add($last_id,$group[$i],$id_user);
			}
			return true;
		else 
		return false;
		*/
		

		var_dump($_POST);
	}
	
	public function address_search($keyword=false)
	{
		//$this->Address_Book_Model->
		
	}
	
	public function hapus_address()
	{
		$id_address_book = $this->input->post('id');
		if($id_address_book)
		{
			for($i=0;$i < count($id_address_book);$i++)
			{
				$this->Address_Book_Model->delete($id_address_book[$i]);
			}
		}
	}
	
	public function add_address()
	{
		$data['group'] = $this->Groupname_Model->gets();
		$this->load->view('modal/address_modal_add',$data);
	}

	public function group_manage()
	{
		$data['group'] = $this->Group_Model->get_count();
		$this->load->view('modal/address_modal_group',$data);

	}
	public function edit_address($id_address_book=false)
	{
		if($id_address_book)
		{
			$data['group'] = $this->Groupname_Model->gets();
			$data['address'] = $this->get_address_book_detail_php($id_address_book);
			$this->load->view('modal/address_modal_edit',$data);
		}
	}
	
	

}
