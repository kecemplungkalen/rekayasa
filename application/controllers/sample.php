<?php

Class Sample extends CI_Controller{
	function index(){
		$this->load->helper('ussd_helper');
		
		var_dump(ussd_number('*123#',0));
	}
}
