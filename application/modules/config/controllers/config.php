<?php 

Class Config extends MY_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->module('message');
		$this->load->module('config/modem');
		$this->load->module('config/rule');
		$this->load->module('config/user');
	}

	public function index()
	{
		$side['baku'] = $this->message->sidebar_baku();
		$side['add'] =  $this->message->sidebar_adt();		
		$modem['data'] = $this->modem->get_data_modem();
		$rule['rule'] = $this->rule->get(); 
		$user['data'] = $this->user->get();
		$tab['config_modem'] = $this->load->view('config_modem_view',$modem,true);
		$tab['config_rule'] = $this->load->view('config_rule_view',$rule,true);
		$tab['config_user'] = $this->load->view('config_user_view',$user,true);
		$tab['config_api'] = $this->load->view('config_api_view','',true);
		$data['navbar'] = $this->load->view('navbar_view','',true);
		$data['sidebar'] = $this->load->view('sidebar_view',$side,true);
		$data['top_button'] = $this->load->view('config_top_view','',true);
		$data['content'] = $this->load->view('config_content_tab_view',$tab,true);

		$this->load->view('header_view');
		//$this->load->view('config_content_end_tab_view');
		$this->load->view('body_view',$data);
		$this->load->view('footer_view');
	}
	

	public function edit_config_modem_modal()
	{
		$this->load->view('modal/edit_config_modem_modal_view');
	}
	


	
}
