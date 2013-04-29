<?php 

Class Dashboard extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->module('message');

	}
	
	public function index()
	{
		$this->message->index('inbox');		
	}	

}
