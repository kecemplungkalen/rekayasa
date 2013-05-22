<?php 

Class Send_limit extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Config_Modem_Model');		
	}
	
	function gets()
	{
		$data_modem = $this->Config_Modem_Model->gets();
		if($data_modem)
		{
			return $data_modem;
		}
		return FALSE;
	}
	
	function edit_send_limit_modal()
	{
		$id_config_modem =  $this->input->get('id_config_modem');
		if($id_config_modem)
		{
			$data = false;
			$config = $this->Config_Modem_Model->get($id_config_modem);
			if($config)
			{
				$data['data_modem'] = $config;
			}
			$this->load->view('modal/edit_config_sendlimit_modal_view',$data);
			
		}
	}
	
	function update_config_modem()
	{

		$where = array('id_config_modem' => $this->input->post('id_config_modem') , 'phoneID' => $this->input->post('phoneID'));
		$data = array('time_sending_limit' => $this->input->post('time_limit') ,'sending_limit' => $this->input->post('max_limit'));
		$up = $this->Config_Modem_Model->update_where($where,$data);
		if($up)
		{
			echo 'true';
		}
		else
		{
			echo 'false';
		}
	}
	
	function cek_limit($phoneID=FALSE)
	{
		
		
	}
	
	
}
