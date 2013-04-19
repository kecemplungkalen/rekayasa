<?php 

Class Message extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('message_model');
		$this->load->model('label_model');
	}
	
	public function index($label)
	{

		if($label)
		{
			$data =$this->message_model->getlabel($label);
			if($data)
			{
				foreach($data as $dt)
				{
					$isi['id_inbox'] = $dt->id_inbox;
					$isi['total'] = $dt->total;
					$isi['id_user'] = $dt->id_user;
					$isi['recive_date'] = $dt->recive_date;
					$isi['content'] = $dt->content;
					$isi['read_status'] = $dt->read_status;
					$isi['id_address_book'] = $dt->id_address_book;
					$isi['first_name'] = $dt->first_name;
					$isi['last_name'] = $dt->last_name;
					$isi['number'] = $dt->number;
					$isi['email'] = $dt->email;
					//$isi['create_date'] = $dt->create_date;
					//$isi['last_update'] = $dt->last_update;
					$data_label = $this->label_model->get_by_id_inbox($dt->id_inbox);
					if($data_label)
					{
						foreach($data_label as $dl)
						{
							$sub['id_label'] = $dl->id_label;
							$sub['name'] = $dl->name;
							$sub['color'] = $dl->color;
							$sub['additional'] = $dl->additional;
							$sub_data[] = $sub; 
						}
					}
					$isi['label'] = $sub_data;
					//$isi['id_label'] = $id_label;
					//$isi['id_labelname'] = $dt->id_labelname;
					//$isi['name'] = $name;
					//$isi['color'] = $color;
					//$isi['additional'] = $additional;
					$remap[] = $isi;
					
				}
				
				$view['data'] = $remap;
				
			}
			
			
			
			
					
			$this->load->view('header_view');
			$this->load->view('navbar_view');
			$this->load->view('sidebar_view');
			$this->load->view('inbox/top_button_view');
			$this->load->view('dashboard/dashboard_view',$view);
			//$this->load->view('modal/address_modal_edit');
			//$this->load->view('modal/address_modal_group');
			$this->load->view('footer_view');
		
		}else
		echo 'labelnya?';
	}
		

	
	
}

