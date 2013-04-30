<?php 

Class Config extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->module('message');
		$this->load->module('gammu');
		

	}

	public function index()
	{
		$side['baku'] = $this->message->sidebar_baku();
		$side['add'] =  $this->message->sidebar_adt();
		$this->load->view('header_view');
		$data['navbar'] = $this->load->view('navbar_view','',true);
		$data['sidebar'] = $this->load->view('sidebar_view',$side,true);
		$data['top_button'] = $this->load->view('config_top_view','',true);
		
		//var_dump($modem['data']);
		$tab['config_modem'] = $this->load->view('config_modem_view','',true);
		$tab['config_rule'] = $this->load->view('config_rule_view','',true);
		$tab['config_user'] = $this->load->view('config_user_view','',true);

		$data['content'] = $this->load->view('config_content_tab_view',$tab,true);
		//$this->load->view('config_content_end_tab_view');
		$this->load->view('body_view',$data);
		$this->load->view('footer_view');
	}
	
	public function config_modem_modal()
	{
		$modem = $this->gammu->get_phone();
		if($modem)
		{
			foreach($modem as $mod)
			{
				$temp['modem'] = $mod->ID;
				$temp['imei'] = $mod->IMEI;
				$data[] = $temp;
			}
			$view['id_phone'] = $data;
		}
		
		$this->load->view('modal/config_modem_modal_view',$view);
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
