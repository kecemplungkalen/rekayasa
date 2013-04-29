<?php 

Class Message extends MX_Controller{
	
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
		$remap = false;
		$sub=false;
		if(!$keyword)
		{
			//ambil id label  
			$get_label_id = $this->Labelname_Model->get_label_id($label);
			if($get_label_id)
			{
				$total = false;
				//ambil data label
				$data_id = $this->label_model->get_id_inbox($get_label_id->id_labelname);
				if($data_id)
				{
					foreach($data_id as $di)
					{
						$id_inbox[] = $di->id_inbox;
					}
					$data = $this->message_model->get_inbox($id_inbox,$jumlah,$mulai,$keyword=false);
					if($data)
					{
						$isi=false;
						$remap=false;
						foreach($data as $da)
						{
							$isi['read_status'] = $da->read_status;
							$isi['id_inbox'] = $da->id_inbox;
							$isi['number'] = $da->number;
							$isi['total'] = $da->total;
							$isi['content'] = substr($da->content,0,50);
							$isi['recive_date'] = $da->recive_date;
							$isi['id_address_book'] = $da->id_address_book;
							$isi['first_name'] = $da->first_name;
							$isi['last_name'] = $da->last_name;
							$data_label = $this->label_model->get_by_id_inbox($da->id_inbox);
							$sub_data=false;
							if($data_label)
							{
								
								foreach($data_label as $dl)
								{
									
									if($dl->additional != 0)
									{
										$sub['id_label'] = $dl->id_label;
										$sub['name'] = $dl->name;
										$sub['color'] = $dl->color;
										$sub_data[] = $sub; 

									}
								}
							}
							$isi['label'] = $sub_data;
							$remap[] = $isi;
						}
						
					}
					if($keyword)
					{
						$data_total = $this->message_model->get_inbox($id_inbox,0,0,$keyword);
					}
					else
					{
						$data_total = $this->message_model->get_inbox($id_inbox);
					}
					if($data_total)
					{
						$total = count($data_total);
					}

				}
				$has = array('remap' => $remap,'total' => $total);
				return $has;
			}
		}
		else
		{
			$data_id = $this->inbox_model->gets();
			if($data_id)
			{
				foreach($data_id as $di)
				{
					$id_inbox[] = $di->id_inbox;					
				}
				$data = $this->message_model->get_inbox($id_inbox,$jumlah,$mulai,$keyword);
				if($data)
				{
					$isi=false;
					$remap=false;
					foreach($data as $da)
					{
						$isi['read_status'] = $da->read_status;
						$isi['id_inbox'] = $da->id_inbox;
						$isi['number'] = $da->number;
						$isi['total'] = $da->total;
						$isi['content'] = substr($da->content,0,50);
						$isi['recive_date'] = $da->recive_date;
						$isi['id_address_book'] = $da->id_address_book;
						$isi['first_name'] = $da->first_name;
						$isi['last_name'] = $da->last_name;
						$data_label = $this->label_model->get_by_id_inbox($da->id_inbox);
						$sub_data=false;
						if($data_label)
						{
							
							foreach($data_label as $dl)
							{
								
								if($dl->additional != 0)
								{
									$sub['id_label'] = $dl->id_label;
									$sub['name'] = $dl->name;
									$sub['color'] = $dl->color;
									$sub_data[] = $sub; 

								}
							}
						}
						$isi['label'] = $sub_data;
						$remap[] = $isi;
					}
					
				}
				if($keyword)
				{
					$data_total = $this->message_model->get_inbox($id_inbox,0,0,$keyword);
				}
				else
				{
					$data_total = $this->message_model->get_inbox($id_inbox);
				}
				if($data_total)
				{
					$total = count($data_total);
				}
			}
			$has = array('remap' => $remap,'total' => $total);
			return $has;
		}
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

