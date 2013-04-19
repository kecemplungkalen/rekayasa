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
		$this->load->view('modal/address_modal_edit');
		$this->load->view('modal/address_modal_group');
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
	
}

