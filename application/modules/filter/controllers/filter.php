<?php 

Class filter extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	public function index()
	{
		$this->load->view('header_view');
		$this->load->view('navbar_view');
		$this->load->view('sidebar_view');
		$this->load->view('filter_top_button_view');
		$this->load->view('filter_view');
		$this->load->view('modal/filter_modal_edit');
		$this->load->view('footer_view');
		
		
	}	

	
}
