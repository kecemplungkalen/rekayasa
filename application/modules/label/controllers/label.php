<?php 

Class Label extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->module('message');
	}
	
	public function index()
	{
		$side['baku'] = $this->message->sidebar_baku();
		$side['add'] =  $this->message->sidebar_adt();
		$this->load->view('header_view');
		$this->load->view('navbar_view');
		$this->load->view('sidebar_view',$side);
		$this->load->view('label_top_button_view');
		$this->load->view('modal/label_modal_edit');

		$this->load->view('additional_label_view');
		$this->load->view('footer_view');
		
		
	}	
	public function system()
	{
		$side['baku'] = $this->message->sidebar_baku();
		$side['add'] =  $this->message->sidebar_adt();
		
		$this->load->view('header_view');
		$this->load->view('navbar_view');
		$this->load->view('sidebar_view',$side);
		$this->load->view('label_system_top_button_view');
		$this->load->view('modal/label_system_modal_edit');

		$this->load->view('system_label_view');
		$this->load->view('footer_view');
		
		
	}	
	
	
}

