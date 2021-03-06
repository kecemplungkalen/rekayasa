<?php 

Class Send_api extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		//$this->load->library('curl');
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
		$this->load->module('send');
		$temp = false;
		$data = $_POST;
		$res = '-1';
		log_message('error',' response kiriman'.print_r($data,true));

		if(is_array($data))
		{
			$initIP = $_SERVER['REMOTE_ADDR'];
			## cek usrname 
			if(isset($data['user']))
			{
				$val = array('username' => $data['user'],'status' => '1');
				$get_user = $this->User_Model->get($val);
				log_message('error',' getuser '.print_r($get_user,true));
				if($get_user)
				{
					if(isset($data['key']))
					{
						if($data['key'] == $get_user->api_key)
						{
							$dataip = array('id_user' => $get_user->id_user,'ip_restriction' => $initIP);
							$cekIP = $this->Ip_Restriction_Model->get($dataip);
							log_message('error','REMOTE_ADDR  '.print_r($initIP,true));
							log_message('error',' cek Ip  '.print_r($cekIP,true));
							if($cekIP)
							{
								if($cekIP->ip_restriction == $initIP)
								{
									log_message('error',' Masuk Ma berow ');

									$temp[] = array('number' => $data['number'],'text' => $data['content'],'id_user' => $get_user->id_user);  
									$this->session->set_userdata('bypass',true);
									$postsend = $this->send->local_send($temp);
									$this->session->unset_userdata('bypass');
									log_message('error',' tempo  '.print_r($temp,true));
									log_message('error',' postsend '.print_r($postsend,true));
									if($postsend)
									{
										$res = '1';
									}
								}
							}
						}
					}				
				}
			}
		}
		
		echo $res;
	} 

}
