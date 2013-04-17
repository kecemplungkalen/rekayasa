<?php 

Class Label extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	public function index()
	{
		$this->load->view('header_view');
		$this->load->view('navbar_view');
		$this->load->view('sidebar_view');
		$this->load->view('label_top_button_view');
		$this->load->view('modal/label_modal_edit');

		$this->load->view('additional_label_view');
		$this->load->view('footer_view');
		
		
	}	
	public function system()
	{
		$this->load->view('header_view');
		$this->load->view('navbar_view');
		$this->load->view('sidebar_view');
		$this->load->view('label_system_top_button_view');
		$this->load->view('modal/label_system_modal_edit');

		$this->load->view('system_label_view');
		$this->load->view('footer_view');
		
		
	}	
	
	
}

