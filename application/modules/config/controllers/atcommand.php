<?php 

Class Atcommand extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('ussd_helper');
	}
	
	function getcommand()
	{
		$data = $_POST;
		if(is_array($data))
		{
			echo ussd_number($data['param'],$data['port']);

		}
		else
		return FALSE;
	}
	
}
