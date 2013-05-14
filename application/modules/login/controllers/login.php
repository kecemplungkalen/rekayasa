<?php 

Class Login extends MY_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('User_Model');
	}

	public function index($data=false)
	{
		if($data)
		{
			$view['data'] = $data;
			$this->load->view('header_view');
			$this->load->view('login_view',$view);
			$this->load->view('footer_view');			
		}
		else
		{
			$this->load->view('header_view');
			$this->load->view('login_view');
			$this->load->view('footer_view');			
		}
	}
	
	function user_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if($username && $password)
		{
			$data = array('username' => $username,'password' => md5($password));
			$cek = $this->User_Model->get($data);
			if($cek)
			{
				//echo 'true';
				$logsess = array('user_data' => $cek->username,'logged_in' => TRUE,'level' => $cek->level);
				$this->session->set_userdata($logsess);
				redirect(base_url().'dashboard');
			}
			else
			{
				$val = 'Warning Login Gagal.!!! ';
				$this->index($val);
			}
		} 
	}
	
	public function logoff()
	{
		$this->session->sess_destroy();
	}
} 
