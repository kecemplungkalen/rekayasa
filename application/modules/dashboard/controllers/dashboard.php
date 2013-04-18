<?php 

Class Dashboard extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->module('message');

	}
	
	public function index()
	{
		/*
		$this->load->view('header_view');
		$this->load->view('navbar_view');
		$this->load->view('sidebar_view');
		$this->load->view('top_button_view');
		$this->load->view('dashboard/dashboard_view');
		$this->load->view('footer_view');
		*/
		$this->message->index('inbox');
		
	}	

}
