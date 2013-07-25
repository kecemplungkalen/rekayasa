<?php 
Class Email_konf extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
	}
	
	
	function save()
	{
		$data = false;
		$ret = '0';
		$temp['config_name'] = 'enable_mail_notification';
		$temp['config_value'] = $this->input->post('notification');
		$data[] = $temp;
		$temp['config_name'] = 'mailaddr';
		$temp['config_value'] = $this->input->post('mail');
		$data[] = $temp;
		if($data)
		{
			$ret = '1';
			$this->load->model('Config_mail_model');
			$up = $this->Config_mail_model->update($data);
			if($up)
			{
				$ret = '1';
			}
		}
		echo $ret;
	}
	
	function mail_konf($data)
	{
		$this->load->model('Config_smtp_model');
		$this->load->model('Config_mail_model');
		if(is_array($data))
		{
			$config_mail = $this->Config_mail_model->gets();
			if($config_mail)
			{
				// cek if enable 
				if($config_mail['enable_mail_notification'] == '1')
				{
					$smtp_conf = $this->Config_smtp_model->get();
					if($smtp_conf)
					{
						$this->load->helper('phpmailer');
						$parameter_email = new  StdClass();
						$parameter_email->from = $smtp_conf->username;
						$parameter_email->from_name = $data['number'];
						if(isset($data['gagal']))
						{
							$parameter_email->to = $data['report_email'];
							$parameter_email->message = $data['content'];
							$parameter_email->subject = 'SMS Failure Input Data From '.$data['number'];
						}
						else
						{
							$parameter_email->to = $config_mail['mailaddr'];
							$parameter_email->message = '<h2>SMS Management System </h2> <br> Isi SMS : <br> <strong>' .$data['content']. '</strong> <br>Waktu Diterima = <strong>'. date('Y-m-d H:i:s',$data['recive_date']) .'</strong>' ;
							$parameter_email->subject = 'SMS From '.$data['number'];
						}
						$sendmail = send_email($smtp_conf,$parameter_email);
						if($sendmail == '1')
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
