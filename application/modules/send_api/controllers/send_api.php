<?php 

Class Add_process extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('curl');
		$this->load->model('User_Model');
		$this->load->model('Ip_Restriction_Model');
	} 


	public function index()
	{
		/*
		 * ['key'] 
		 * ['user']
		 * ['number']
		 * ['content']
		 */
		
		$temp = false;
		$data = $_POST;
		if(is_array($data))
		{
			$initIP = $_SERVER['SERVER_ADDR'];
			## cek usrname 
			$val = array('username' => $data['user'],'status' => '1');
			$get_user = $this->User_Model->get($val);
			if($get_user)
			{
				if($data['key'] == $get_user->api_key)
				{
					$dataip = array('id_user' => $get_user->id_user,'ip_restriction' => $initIP);
					$cekIP = $this->Ip_Restriction_Model->get($dataip);
					if($cekIP)
					{
						$temp[] = array('number' => $data['number'],'text' => $data['content'],'id_user' => $get_user->id_user);  
						$postsend = $this->curl->simple_post(base_url().'send',$temp);
						if($postsend == 'true')
						{
							return true;
						}
					}
				}				
			}
		}
		return false;		
	} 

}
