<?php 

Class Login extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('User_Model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in')){
			redirect(base_url().'dashboard', 'refresh');
		}
		$this->load->view('header_view');
		$this->load->view('login_view');
		$this->load->view('footer_view');			
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
				if($cek->status == '1')
				{
					
					$logsess = array('user_data' => $cek->username,'logged_in' => TRUE,'level' => $cek->level,'id_user' => $cek->id_user);
					$this->session->set_userdata($logsess);
					redirect(base_url().'dashboard','refresh');
				}
				else
				{
					$view['data'] = 'Warning Login Failed.!!!';
					$this->load->view('header_view');
					$this->load->view('login_view',$view);
					$this->load->view('footer_view');						
				}
			}
			else
			{
				$view['data'] = 'Warning Login Failed.!!!';
				$this->load->view('header_view');
				$this->load->view('login_view',$view);
				$this->load->view('footer_view');			
			}
		}
		else
		{
			$this->index();
		} 
	}
	
	function logoff()
	{
		$this->session->sess_destroy();
		redirect(base_url().'login','refresh');
	}
} 
