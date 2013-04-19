<?php 

Class Message extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('message_model');
		$this->load->model('label_model');
		$this->load->model('Labelname_Model');
	}
	
	public function index($label)
	{
		$view=false;
		$sub=false;
		if($label)
		{
			$get_label_id = $this->Labelname_Model->get_label_id($label);
			if($get_label_id)
			{
				$data_id = $this->label_model->get_id_inbox($get_label_id->id_labelname);
				if($data_id)
				{
					foreach($data_id as $di)
					{
						$id_inbox[] = $di->id_inbox;
					}
					$data = $this->message_model->get_inbox($id_inbox);
					if($data)
					{
						foreach($data as $da)
						{
							$isi['read_status'] = $da->read_status;
							$isi['id_inbox'] = $da->id_inbox;
							$isi['number'] = $da->number;
							$isi['total'] = $da->total;
							$isi['content'] = $da->content;
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

						$view['data'] = $remap;

					}
					
				}
				
			}
			

			$side['baku'] = $this->sidebar_baku();
			$side['add'] =  $this->sidebar_adt();
			$this->load->view('header_view');
			$this->load->view('navbar_view');
			$this->load->view('sidebar_view',$side);
			$this->load->view('inbox/top_button_view');
			$this->load->view('dashboard/dashboard_view',$view);
			//$this->load->view('modal/address_modal_edit');
			//$this->load->view('modal/address_modal_group');
			$this->load->view('footer_view');
		
		}else
		echo 'labelnya?';
	}
	
	
	public function sidebar_adt()
	{
		$addt = $this->Labelname_Model->get_add();
		if($addt)
		{
			$tem=false;
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

