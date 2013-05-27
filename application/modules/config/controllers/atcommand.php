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
			$pulsa = ussd_number($data['param'],$data['port']);
			if($pulsa)
			{
				return $pulsa;
				
			}
		}
		return FALSE;
	}
	
}
