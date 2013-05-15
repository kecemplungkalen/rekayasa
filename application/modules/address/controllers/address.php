<?php 

Class Address extends MY_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->module('message');
		$this->load->model('Address_Book_Model');
		$this->load->model('Smsc_Model');
		$this->load->model('Smsc_Name_Model');
		$this->load->model('Group_Model');
		$this->load->model('Groupname_Model');
		$this->load->model('Blacklist_Model');
		$this->load->model('inbox_model');


	}

	public function index($start=0)
	{

		# define search key value
		$keyword = false;
		$key = false;
		if($this->input->post('keyword')){
			if($this->input->post('keyword') != ''){
				$keyword = $this->input->post('keyword');
				if(preg_match('/^name:/',$keyword))
				{
					$tag = preg_replace('/^name:/','',$keyword);
					$key = array(
					'first_name' => $tag,
					'last_name' => $tag  
					);
				}
				elseif(preg_match('/^num:/',$keyword))
				{
					$tag = preg_replace('/^num:/','',$keyword);
					$key = array(
					'number' => $tag 
					);
				}
				else
				{
					$key = array(
					'first_name' => $keyword,
					'last_name' => $keyword,
					'number' => $keyword
					);
				}
			}
		}
		$perpage = 10 ;
		$blacklist = false; 
		$side['baku'] = $this->message->sidebar_baku();
		$side['add'] =  $this->message->sidebar_adt();
		$data['navbar'] = $this->load->view('navbar_view','',true);
		$data['sidebar'] = $this->load->view('sidebar_view',$side,true);
		$top['data'] = $this->Groupname_Model->gets();
		$data['top_button'] = $this->load->view('address_top_button_view',$top,true);
		$isi['data'] = $this->ambil_list($perpage,$start,$key);
		$isi['paging'] = $this->paging($blacklist,$perpage,$key);
		if($this->input->post('reload'))
		{
			$this->load->view('address_data',$isi,false);

		}else
		{	
			$this->load->view('header_view');
			$data['content'] = $this->load->view('address_data',$isi,true);
			$this->load->view('body_view',$data);
			$this->load->view('footer_view');
		}
		
	}	
	
	function blacklist($start=0)
	{
		$keyword = false;
		$key = false;
		if($this->input->post('keyword')){
			if($this->input->post('keyword') != ''){
				$keyword = $this->input->post('keyword');
				if(preg_match('/^name:/',$keyword))
				{
					$tag = preg_replace('/^name:/','',$keyword);
					$key = array(
					'first_name' => $tag,
					'last_name' => $tag  
					);
				}
				elseif(preg_match('/^num:/',$keyword))
				{
					$tag = preg_replace('/^num:/','',$keyword);
					$key = array(
					'number' => $tag 
					);
				}
				else
				{
					$key = array(
					'first_name' => $keyword,
					'last_name' => $keyword,
					'number' => $keyword
					);
				}
			}
		}
		$perpage = 10 ;
		$blacklist = true; 
		$side['baku'] = $this->message->sidebar_baku();
		$side['add'] =  $this->message->sidebar_adt();
		$data['navbar'] = $this->load->view('navbar_view','',true);
		$data['sidebar'] = $this->load->view('sidebar_view',$side,true);
		$top['data'] = $this->Groupname_Model->gets();
		$data['top_button'] = $this->load->view('blacklist_top_button_view',$top,true);
		$isi['data'] = $this->ambil_blacklist($perpage,$start,$key);
		$isi['paging'] = $this->paging($blacklist,$perpage,$key);
		if($this->input->post('reload'))
		{
			$this->load->view('blacklist_data_view',$isi,false);

		}else
		{	
			$this->load->view('header_view');
			$data['content'] = $this->load->view('blacklist_data_view',$isi,true);
			$this->load->view('body_view',$data);
			$this->load->view('footer_view');
		}

	}
	
	
	function paging($blacklist=false,$perpage=false,$keyword=false)
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url().'address';
		$config['per_page'] = $perpage;
		if(!$blacklist)
		{
			if($keyword)
			{
				$total = $this->Address_Book_Model->gets(0,0,$keyword);
				$config['total_rows'] = count($total);
				$config['uri_segment'] = $this->uri->total_segments();
			}
			else
			{
				$total_rows = $this->Address_Book_Model->gets();			
				$config['total_rows'] = count($total_rows);
				$config['uri_segment'] = $this->uri->total_segments();
			}
		}
		else
		{
			if($keyword)
			{
				$total_rows = $this->Blacklist_Model->gets_list(0,0,$keyword);
				$config['total_rows'] = count($total_rows);
				$config['uri_segment'] = $this->uri->total_segments();
			}
			else
			{
				$total_rows = $this->Blacklist_Model->gets_list();
				$config['total_rows'] = count($total_rows);
				$config['uri_segment'] = $this->uri->total_segments();				
			}
		}
		$this->pagination->initialize($config); 
		return $this->pagination->create_links();

	}
	
	public function ambil_list($jumlah=0,$mulai=0,$keyword=false)
	{
		if($jumlah)
		{
			
			$list = $this->Address_Book_Model->gets($jumlah,$mulai,$keyword);
			//log_message('error','error paging data : '.count($list));

			if($list)
			{
				$temp = false;
				$smscname = false;
				$rec = false;
				$cek = false;
				foreach($list as $li)
				{
					$dat = array('blacklist_number' => $li->number);
					$cek = $this->Blacklist_Model->get($dat);
					if(!$cek)
					{
						$temp['id_address_book'] = $li->id_address_book;
						$temp['first_name'] = $li->first_name;
						$temp['last_name'] = $li->last_name;
						$temp['number'] = $li->number;
						$nama_operator = $this->Smsc_Name_Model->get($li->id_smsc);
						if($nama_operator)
						{
							$temp['operator'] = $nama_operator->operator_name;
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
								if($detail)
								{
									$rem[] = $detail->nama_group;
								}
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
				}
				return $rec;
			}
		}
		return false;

	}


	function ambil_blacklist($jumlah=0,$mulai=0,$keyword=false)
	{
		if($jumlah)
		{

			$temp = false;
			$get_list = $this->Blacklist_Model->gets_list($jumlah,$mulai,$keyword);
			if($get_list)
			{
				foreach($get_list as $get_in_addr)
				{
					$temp['id_address_book'] = $get_in_addr->id_address_book;
					$temp['first_name'] = $get_in_addr->first_name;
						
					$temp['last_name'] = $get_in_addr->last_name;
					
					$temp['number'] = $get_in_addr->number;
					$nama_operator = $this->Smsc_Name_Model->get($get_in_addr->id_smsc);
					if($nama_operator)
					{
						$temp['operator'] = $nama_operator->operator_name;
					}
					else
					{
						$temp['operator'] = false;
					}

					$group = $this->Group_Model->gets_by('id_address_book',$get_in_addr->id_address_book);
					if($group)
					{
						$rem = false;
						foreach($group as $g)
						{
							$detail = $this->Groupname_Model->get($g->id_groupname);
							if($detail)
							{
								$rem[] = $detail->nama_group;
							}
						}

						$temp['group'] = $rem;
					}
					else
					{
						$temp['group'] = false;
					}
					$last_mess = $this->inbox_model->gets_where('id_address_book',$get_in_addr->id_address_book);
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
		return false;
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
		$id_user = $this->session->userdata('id_user');
		$number = $this->input->post('number');
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$email = $this->input->post('email');
		$group = $this->input->post('group');
		// tambah addr
		/*
		 * 
			$data = array(
			'first_name' => $first_name,
			'last_name' => $last_name,
			'number' => $number,
			'email' => $email,
			'create_date' => time(),
			'last_update' => time(),
			'id_user' => $id_user
			);
		*/
		 
		$addr = array(
			'first_name' => $first_name,
			'last_name' => $last_name,
			'number' => $number,
			'email' => $email,
			'create_date' => time(),
			'last_update' => time(),
			'id_user' => $id_user		
		);
		
		//$last_id = $this->Address_Book_Model->add($number,$first_name,$last_name,$email,$id_user);
		$last_id = $this->Address_Book_Model->add($addr);
		if($last_id)
		{
			for($i=0;$i < count($group);$i++)
			{
				$this->Group_Model->add($last_id,$group[$i],$id_user);
			}
			echo 'true';
		}
		else 
		echo 'false';
		
		
	}
	
	public function update_address()
	{
		
		$id_user = 1;
		$id_address_book = $this->input->post('id_address_book');
		$number = $this->input->post('phone');
		$first_name = $this->input->post('firstname');
		$last_name = $this->input->post('lastname');
		$email = $this->input->post('email');
		$group = $this->input->post('group');
		
		$data = array('first_name' => $first_name,'last_name' => $last_name,'number' => $number,'email' => $email);
		$update = $this->Address_Book_Model->update($id_address_book,$data);
		if($update)
		{
			$hapus = $this->Group_Model->delete('id_address_book',$id_address_book);
			if($hapus)
			{
				if(isset($group))
				{
					for($i=0;$i < count($group);$i++)
					{
						$data = $this->Group_Model->add($id_address_book,$group[$i],$id_user);
					}
				}
				echo 'true';
			}
			
		}
		else
		echo 'false';
		
		//var_dump($_POST);
	}
	
	public function address_search($keyword=false,$perpage=false,$start=false)
	{
		$search = $this->Address_Book_Model->search($keyword,$perpage,$start);
		if($search)
		{
			$temp = false;
			$smscname = false;
			$rec = false;
			foreach($search as $li)
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
		return false;
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
