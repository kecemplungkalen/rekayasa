<?php 

Class Message extends MY_Controller{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('message_model');
		$this->load->model('label_model');
		$this->load->model('Labelname_Model');
		$this->load->model('inbox_model');
	}
	
	public function index($label=false,$start=0)
	{
		$view=false;
		$top['list_label'] = $this->Labelname_Model->get_add();
		$top['label'] = $label;
		$side['baku'] = $this->sidebar_baku();
		$side['add'] =  $this->sidebar_adt();
		$data['navbar'] = $this->load->view('navbar_view','',true);
		$data['top_button'] = $this->load->view('top_button_view',$top,true);
		$data['sidebar'] = $this->load->view('sidebar_view',$side,true);
		# define search key value
		$keyword = false;
		if($this->input->post('keyword'))
		{
			if($this->input->post('keyword') != ''){
				$keyword = $this->input->post('keyword');
			}
		}
		//seting coba data perpage pagina
		$perpage = 10;
		$isi = $this->tampil_data($label,$perpage,$start,$keyword);
		//var_dump($isi);
		if($isi['remap'])
		{
			$view['data'] = $isi['remap'];
		}
		$total_rows = false;
		if($isi['total'])
		{
			$total_rows = $isi['total'];
		}
		$view['paging'] = $this->paging($label,$total_rows,$perpage);
		$view['lbl'] = $label;
		if($this->input->post('reload'))
		{
			$this->load->view('dashboard/dashboard_view',$view);
		}
		else
		{
			$this->load->view('header_view');
			$data['content'] = $this->load->view('dashboard/dashboard_view',$view,true);
			$this->load->view('body_view',$data);			
			$this->load->view('footer_view');
		}
		
	
	}
	
	
	
	function paging($label=false,$total_rows=false,$perpage=false)
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url().'message/'.$label;
		$config['per_page'] = $perpage;
		$config['total_rows'] = $total_rows;
		$config['uri_segment'] = $this->uri->total_segments();
		$this->pagination->initialize($config); 
		return $this->pagination->create_links();

	}
	
	
	
	public function tampil_data($label=false,$jumlah=0,$mulai=0,$keyword=false)
	{
		// dipakai untuk next level
		//$id_user = $this->session->userdata('id_user');
		$remap = false;
		$sub=false;
		$total = false;
		//ambil id label  
		$get_label_id = $this->Labelname_Model->get_label_id($label);
		$data_tampil1 = false;
		$thread = false;
		$where = false;
		$ambil_isi = false;
		if($get_label_id)
		{
			//$data_inbox = false;
			if(!$keyword)
			{
				
				if($get_label_id->id_labelname == '4')
				{
					$data = array('is_delete' => '1');
					$data_inbox = $this->inbox_model->arr_wheres_group($data,'thread');
					//var_dump('Di Trash? ' ,$data_inbox);
					if($data_inbox)
					{
						foreach($data_inbox as $di)
						{
							$thread[] = $di->thread;
							## dipake untuk next level 
							//$where = array('is_delete ' => '1','inbox.id_user' => $id_user);
							$where = array('is_delete ' => '1');
						}
						
					}	
				}
				elseif($get_label_id->id_labelname == '5')
				{
					$data_inbox = $this->label_model->gets_where('id_labelname', $get_label_id->id_labelname);
					$id_inbox = false;
					if($data_inbox)
					{
						foreach($data_inbox as $datin)
						{
							$id_inbox[] = $datin->id_inbox;
						}
						
						// cari thread wher in 
						$get = $this->inbox_model->get_in_where($id_inbox);

						if($get)
						{
							foreach($get as $g)
							{
								if($g->is_delete == '2')
								{
									$thread[] = $g->thread;
									// dipakai untuk next level
									//$where = array('is_delete' => '2','inbox.id_user' => $id_user);
									$where = array('is_delete' => '2');
								}		
							}							
						}	
					}
				}
				else
				{
					$data_inbox = $this->label_model->gets_where('id_labelname', $get_label_id->id_labelname);
					$id_inbox = false;
					if($data_inbox)
					{
						foreach($data_inbox as $datin)
						{
							$id_inbox[] = $datin->id_inbox;
						}
						
						// cari thread wher in 
						$get = $this->inbox_model->get_in_where($id_inbox);

						if($get)
						{
							foreach($get as $g)
							{
								$thread[] = $g->thread;
								// dipakai untuk next level
								//$where = array('is_delete' => '0','inbox.id_user' => $id_user);
								$where = array('is_delete' => '0');
							}							
						}	
					}
				}
				// get data 
				$ambil_isi = $this->message_model->get_by_thread($thread,$jumlah,$mulai,$where,$keyword);
				$allres  = $this->message_model->get_by_thread($thread,0,0,$where,false);

			}
			else
			{
				// disini jika ada keyword
				$word = false;
				if(preg_match('/^from:/',$keyword))
				{
					$word = preg_replace('/^from:/','',$keyword);
					$in_tag = 'from';
					$notsend = $this->label_model->gets_where('id_labelname', '2');
					if($notsend)
					{
						foreach($notsend as $ns)
						{
							$id_inbox[]=$ns->id_inbox;
						}
					}
					$thr = $this->inbox_model->get_notin('id_inbox',$id_inbox);
					if($thr)
					{
						foreach($thr as $thc)
						{
							$thread[] = $thc->thread;
						}
						
					}
					$key = array(
					'address_book.first_name' => $word,
					'address_book.last_name' => $word
					);
					$ambil_isi = $this->message_model->get_by_thread($thread,$jumlah,$mulai,$where,$key);
					$allres  = $this->message_model->get_by_thread($thread,0,0,false,$key);
				}
				elseif(preg_match('/^to:/',$keyword))
				{
					$word = preg_replace('/^to:/','',$keyword);
					$in_tag = 'to';
					$data_inbox = $this->label_model->gets_where('id_labelname', '2');
					if($data_inbox)
					{
						foreach($data_inbox as $datin)
						{
							$id_inbox[] = $datin->id_inbox;
						}
					}
					$get = $this->inbox_model->get_in_where($id_inbox);
					if($get)
					{
						foreach($get as $g)
						{
							$thread[] = $g->thread;
						}
						
					}
					$key = array(
					'address_book.first_name' => $word,
					'address_book.last_name' => $word
					);
					$ambil_isi = $this->message_model->get_by_thread($thread,$jumlah,$mulai,$where,$key);
					$allres  = $this->message_model->get_by_thread($thread,0,0,false,$key);
				}
				elseif(preg_match('/^num:/',$keyword))
				{
					$word = preg_replace('/^num:/','',$keyword);
					$in_tag = 'num';
					$data_inbox =  $this->inbox_model->gets();
					if($data_inbox)
					{
						foreach($data_inbox as $datin)
						{
							$id_inbox[] = $datin->id_inbox;
						}
					}
					$get = $this->inbox_model->get_in_where($id_inbox);
					if($get)
					{
						foreach($get as $g)
						{
							$thread[] = $g->thread;
						}
						
					}
					$key = array(
					'inbox.number' => $word
					);
					$ambil_isi = $this->message_model->get_by_thread($thread,$jumlah,$mulai,$where,$key);
					$allres  = $this->message_model->get_by_thread($thread,0,0,false,$key);
				}
				elseif(preg_match('/^label:/',$keyword))
				{
					$word = preg_replace('/^label:/','',$keyword);
					$in_tag = 'label';
					$getlabel = $this->Labelname_Model->get_label_id($word);
					if($getlabel)
					{
						$data_inbox = $this->label_model->gets_where('id_labelname', $getlabel->id_labelname);
						if($data_inbox)
						{
							foreach($data_inbox as $datin)
							{
								$id_inbox[] = $datin->id_inbox;
							}
						}
						$get = $this->inbox_model->get_in_where($id_inbox);
						if($get)
						{
							foreach($get as $g)
							{
								$thread[] = $g->thread;
							}
							
						}					

					}
					$ambil_isi = $this->message_model->get_by_thread($thread,$jumlah,$mulai,$where=false,false);
					//$jum_peruser = array('inbox.id_user' => $id_user);
					$allres  = $this->message_model->get_by_thread($thread,0,0,false);
				}
				else
				{
					$word = $keyword;
					$data_inbox = $this->inbox_model->gets();
					if($data_inbox)
					{
						foreach($data_inbox as $datin)
						{
							$id_inbox[] = $datin->id_inbox;
						}
					}
					$get = $this->inbox_model->get_in_where($id_inbox);
					if($get)
					{
						foreach($get as $g)
						{
							$thread[] = $g->thread;
						}
						
					}
					$key = array(
					'inbox.content' => $word,
					'address_book.first_name' => $word,
					'address_book.last_name' => $word,
					'inbox.number' => $word,
					'address_book.email' => $word
					);	
					$ambil_isi = $this->message_model->get_by_thread($thread,$jumlah,$mulai,$where,$key);
					$jum_peruser = array('inbox.id_user' => $id_user);
					$allres  = $this->message_model->get_by_thread($thread,0,0,$jum_peruser,$key);
				}

			}
			// disini saja 	
			//var_dump($thread);
			$ret = false;
			$gt_content = false;
			$isi = false;
			$ambil_label = false;
			$balike = false;
			if($ambil_isi)
			{
				foreach($ambil_isi as $dtam)
				{
					$isi['first_name'] = $dtam->first_name;	
					$isi['last_name'] = $dtam->last_name;	
					$gt_content = $this->inbox_model->get($dtam->id_inbox);
					if($gt_content)
					{
						$isi['content'] = substr($gt_content->content,0,20);
						
					}
					
					$isi['number'] = $dtam->number;
					$isi['total'] = $dtam->total;
					$isi['thread'] = $dtam->thread;
					// ambil label total 
					$arr  = array('thread' => $isi['thread']);
					$ambil_label = $this->inbox_model->arr_wheres($arr);
					$id_inb= false;
					$datanya = false;
					//var_dump($ambil_label);
					
					if($ambil_label)
					{
						foreach($ambil_label as $alb)
						{
							$id_inb[] = $alb->id_inbox;			
						}
						//id _inbox aray group labelname di label
						//var_dump($id_inb); 
						$iki_id = $this->message_model->group_labelname($id_inb);
						$iki_id_labelname=false;
						if($iki_id)
						{
							foreach($iki_id as $ikiid)
							{												
								$iki_id_labelname[] = $ikiid->id_labelname;
							}
						}
						$iki_data_labelname = $this->message_model->labelname_data($iki_id_labelname);
						$sub_data = false;
						if($iki_data_labelname)
						{
							$sub = false;
							foreach($iki_data_labelname as $idln)
							{
								$sub['id_labelname'] = $idln->id_labelname;
								$sub['name'] = $idln->name;
								$sub['color'] = $idln->color;
								$sub_data[] = $sub; 
							}
						}
						$isi['label'] = $sub_data;
						
						//$datanya = $this->label_model->search_in('id_inbox',$id_inb);
					}
					
					$isi['read_status'] = $dtam->read_status;
					$isi['recive_date'] = $dtam->recive_date;
					$remap[] = $isi;
					$total = false;
				}
				if($allres){
				$total = count($allres);
				}
				$ret = array('remap' => $remap,'total' => $total);
			}
			return $ret;
		}
		return false;
	}
	
	
	
	
	
	
	public function sidebar_adt()
	{
		$tem=false;
		$addt = $this->Labelname_Model->get_add();
		if($addt)
		{

			foreach($addt as $adt)
			{
				$count = $this->label_model->count_unread($adt->id_labelname);
				if($count)
				{
					$add['count'] = $count;
				}else
				{
					$add['count'] = false;
				} 
				$add['name'] = $adt->name;
				$add['color'] = $adt->color;
				$tem[] = $add;
			}
		}
		return $tem;
	}
	
	public function sidebar_baku()
	{
		$baku = $this->Labelname_Model->get_baku();
		if($baku)
		{
			$b=false;
			foreach($baku as $bk)
			{
				$count = $this->label_model->count_unread($bk->id_labelname);
				if($count)
				{
					$c['count'] = $count;
				}else
				{
					$c['count'] = false;
				} 
				$c['name'] = $bk->name;
				$c['color'] = $bk->color;
				$b[] = $c;
			}
		}
		return $b;
	}
	
	

	
	

	
}

