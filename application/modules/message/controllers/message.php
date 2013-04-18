<?php 

Class Message extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('message_model');
	}
	
	public function index($label)
	{

		if($label)
		{
			$data =$this->message_model->getlabel($label);
			if($data)
			{
				$isi = new stdClass;
				foreach($data as $dt)
				{
					$inbox[] = $dt->id_inbox;
				}
				$isi->inbox = $inbox;
				var_dump($isi);
				
			}		
			$this->load->view('header_view');
			$this->load->view('navbar_view');
			$this->load->view('sidebar_view');
			$this->load->view('inbox/top_button_view');
			$this->load->view('dashboard/dashboard_view');
			//$this->load->view('modal/address_modal_edit');
			//$this->load->view('modal/address_modal_group');
			$this->load->view('footer_view');
		
		}else
		echo 'labelnya?';
	}
		

	
	
}

