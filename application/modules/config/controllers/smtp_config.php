<?php 
Class Smtp_config extends MY_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Config_smtp_model');
		$this->load->helper('phpmailer');
	}
	
	function save()
	{
		if(is_array($_POST))
		{
			$id_config_smtp = $this->input->post('id_config_smtp');
			$host = $this->input->post('host');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$port = $this->input->post('port');
			$ssl = $this->input->post('ssl');
			$where = array(
			'id_config_smtp' => $id_config_smtp
			);
			$data = array(
			'host' => $host,
			'username' => $username,
			'password' => $password,
			'port' => $port,
			'ssl' => $ssl
			);
			$update = $this->Config_smtp_model->update($where,$data);
			if($update)
			{
				echo 'true';
			}
			else
			{
				echo 'false';
			}
		}
		
	}
	
	function test()
	{
		$test_email = 0;
		if(is_array($_POST))
		{
			$id_config_smtp = $this->input->post('id_config_smtp');
			$host = $this->input->post('host');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$port = $this->input->post('port');
			$ssl = $this->input->post('ssl');
			
			$config = new  StdClass();
			$config->host = $host;
			$config->username = $username;
			$config->password = $password;
			$config->port = $port;
			$config->ssl = $ssl;
	
			$parameter_email = new  StdClass();
			$parameter_email->from = $username;
			$parameter_email->from_name = 'smtp test';
			$parameter_email->to = $username;
			$parameter_email->message = 'Testing SMS SMTP';
			$parameter_email->subject = 'Rekayasa SMS Management System';
			
			$test_email = send_email($config,$parameter_email);
		}
		
		echo $test_email;
	}
	
}
