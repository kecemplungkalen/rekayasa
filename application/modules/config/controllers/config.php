<?php 

Class Config extends MX_Controller{
	
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
		$this->load->view('config_top_view');
		$this->load->view('config_content_tab_view');
		$this->load->view('config_modem_view');
		$this->load->view('config_rule_view');
		$this->load->view('config_user_view');
		$this->load->view('config_content_end_tab_view');
		$this->load->view('footer_view');
	}
	
	public function config_modem_modal()
	{
		$this->load->view('modal/config_modem_modal_view');
	}
	
	public function edit_config_modem_modal()
	{
		$this->load->view('modal/edit_config_modem_modal_view');
	}
	
	public function config_rule_modal()
	{
		$this->load->view('modal/config_rule_modal_view');
	}

	public function edit_config_rule_modal()
	{
		$this->load->view('modal/edit_config_rule_modal_view');
	}
}
