<?php 

Class Address extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	public function index()
	{
		$this->load->view('header_view');
		$this->load->view('navbar_view');
		$this->load->view('sidebar_view');
		$this->load->view('address_top_button_view');
		$this->load->view('address_view');
		$this->load->view('modal/address_modal_edit');
		$this->load->view('modal/address_modal_group');
		$this->load->view('footer_view');
		
		
	}	
	
	
}

