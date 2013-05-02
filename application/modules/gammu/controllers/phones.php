<?php 
Class Phones extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Phones_Model');
	}
	
	public function gets_phone()
	{
		$phone = $this->Phones_Model->get_active();
		if($phone)
		{
			return $phone;
		}
		else
		return false;
	}
	
	function get($imei=false)
	{
		if($imei)
		{
			$get = $this->Phones_Model->get();
			if($get)
			{
				return $get;
			}
		}
		return false;
	}
	
	function get_kol($ID=false)
	{
		if($ID)
		{
			$get = $this->Phones_Model->get_kol('ID',$ID);
			if($get)
			{
				return $get;
			}
		}
		return false;
	}
}
