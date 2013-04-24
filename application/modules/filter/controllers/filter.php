<?php 

Class Filter extends MX_Controller{
	
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
		$this->load->view('filter_top_button_view');
		$this->load->view('filter_view');
		//$this->load->view('modal/filter_modal_edit');
		$this->load->view('footer_view');
		
		
	}
	
	public function add_filter_modal()
	{
		$this->load->view('modal/filter_modal_add');
	}	
	
	public function edit_filter_modal()
	{
		
	}
	
}
