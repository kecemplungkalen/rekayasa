<?php 
Class User extends MY_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Role_Model');
		$this->load->model('User_Model');
	}
	
	
	
	function add_user_modal()
	{
		$data['role'] = $this->Role_Model->gets();
		$this->load->view('modal/add_config_user_modal_view',$data);
	}
	
	function get()
	{
		$tmp = false;
		$gets = $this->User_Model->gets();
		if($gets)
		{
			$temp=false;
			foreach($gets as $ge)
			{
				$temp['id_user'] = $ge->id_user;
				$temp['username'] = $ge->username;
				$data = array('id_role' => $ge->level);
				$role = $this->Role_Model->get($data);
				if($role)
				{
					$temp['level'] = $role->level;
				}
				$temp['api'] = $ge->api;
				$tmp[] = $temp;
			}
			return $tmp;
		}
		return false;
	}
	
} 
