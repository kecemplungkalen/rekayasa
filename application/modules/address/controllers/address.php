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
					foreach($last_mess as $lm)
					{
						$temp['last_message'] = $lm->recive_date;
					}
				}
				$rec[] = $temp;
			}
			return $rec;
		}
	}


	public function get_address_book_detail($id_address_book)
	{
		$detail = $this->Address_Book_Model->get($id_address_book);
		if($detail)
		{
			$group = $this->Group_Model->gets_by('id_address_book',$id_address_book);
			if($group)
			{
				$res = false;
				$temp = false;
				foreach($group as $g)
				{
					$grouname = $this->Groupname_Model->get($g->id_groupname);
					$temp['id_groupname'] = $g->id_groupname;
					$temp['nama_group'] = $grouname->nama_group;
				}
				$res[] = $temp;
			}

			$data = array('id_address_book'=> $id_address_book,
			'first_name' => $detail->first_name,
			'last_name' => $detail->last_name,
			'number' => $detail->number,
			'email' => $detail->email,
			'group' => $res); 
		}
		echo json_encode($data);

	}
<<<<<<< HEAD

=======
	
>>>>>>> 631bc4cadcc61f7b28788960558afcc2701ae44c
	public function get_address_book_detail_php($id_address_book=false)
	{
		$detail = $this->Address_Book_Model->get($id_address_book);
		if($detail)
		{
			$group = $this->Group_Model->gets_by('id_address_book',$id_address_book);
			if($group)
			{
				$res = false;
				$temp = false;
				foreach($group as $g)
				{
					$grouname = $this->Groupname_Model->get($g->id_groupname);
					$temp['id_groupname'] = $g->id_groupname;
					$temp['nama_group'] = $grouname->nama_group;
				}
				$res[] = $temp;
			}
<<<<<<< HEAD

=======
			
>>>>>>> 631bc4cadcc61f7b28788960558afcc2701ae44c
			$data = array('id_address_book'=> $id_address_book,
			'first_name' => $detail->first_name,
			'last_name' => $detail->last_name,
			'number' => $detail->number,
			'email' => $detail->email,
			'group' => $res); 
			return $data;
		}
		return false;
<<<<<<< HEAD

	}


=======
		
	}
	
	
>>>>>>> 631bc4cadcc61f7b28788960558afcc2701ae44c
	public function add_address()
	{
		$this->load->view('modal/address_modal_add');
	}

	public function group_manage()
	{
		$this->load->view('modal/address_modal_group');

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
