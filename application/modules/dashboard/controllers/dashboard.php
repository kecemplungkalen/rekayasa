<?php 

Class Dashboard extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->module('message');
		$this->load->library('curl');

	}
	
	public function index()
	{
		$this->message->index('inbox');		
	}	
	
	public function insert()
	{
		$data = $_POST;
		$tmp = false;
		$temp = false;
		if(is_array($data))
		{
			if(isset($data['checkbox']))
			{
				$temp['number'] = $data['number_box'];
			}
			else
			{
				$temp['number'] = $data['number'];
			}
			$temp['text'] = $data['text'];
			
			$tmp[]= $temp;
			$ret = $this->curl->simple_post(base_url().'send/',$tmp);
			if($ret)
			{
				echo $ret;
			}
		}
		return false;

	}
	
}
