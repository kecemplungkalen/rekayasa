<?php 
Class Modem extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Config_Modem_Model');
		$this->load->module('gammu/phones');

	}

	public function config_modem_modal()
	{
		$view = false;
		$modem = $this->phones->gets_phone();
		if($modem)
		{
			foreach($modem as $mod)
			{
				$temp['modem'] = $mod->ID;
				$temp['imei'] = $mod->IMEI;
				$data[] = $temp;
			}
			$view['id_phone'] = $data;
		}
		
		$this->load->view('modal/config_modem_modal_view',$view);
	}
	
	
	
	public function add_modem()
	{
		$default = 0;
		$status = 1;
		$nama_modem = $this->input->post('nama_modem');
		$phoneID = $this->input->post('phoneID'); 
		$number = $this->input->post('number');
		$default = $this->input->post('default');
		$data = array('nama_modem' => $nama_modem,'phoneID' => $phoneID,'number' => $number,'default' => $default,'status' =>$status);
		if($_POST)
		{
			$balik = $this->Config_Modem_Model->add($data);
			if($balik)
			{
				echo 'true';
			}
			else
			echo 'false';
		}
	}
	
	
	function get_data_modem()
	{

		$list = $this->Config_Modem_Model->gets();
		if($list)
		{
			$temp = false;
			$tmp = false;
			$now = false;
			foreach($list as $ls)
			{
				$tmp['id_config_modem'] = $ls->id_config_modem;
				$tmp['name'] = $ls->nama_modem;
				$tmp['phoneID'] = $ls->phoneID;
				$tmp['number'] = $ls->number;
				$tmp['default'] = $ls->default; // default?
				$det_gammu = $this->phones->get_kol($ls->phoneID);
				if($det_gammu)
				{
					$now = date("Y-m-d H:i:s");
					if($det_gammu->TimeOut > $now)
					{
						$tmp['status'] = $ls->status; //active?
						$tmp['signal'] = $det_gammu->Signal;
					}else
					{
						$tmp['status'] = '0'; //active?
						$tmp['signal'] = '0';
					}
					$tmp['sent'] = $det_gammu->Sent;
					$tmp['received'] = $det_gammu->Received;
				}
				
				$temp[] = $tmp;
			}
			return $temp;
		}
		return false;
	}
	
	function cek_nama_modem()
	{
		$nama_modem = $this->input->post('nama_modem');
		if($nama_modem)
		{
			$cek = $this->Config_Modem_Model->gets_by('nama_modem',$nama_modem);
			if($cek)
			{
				echo 'false';
			}else
			{
				echo 'true';
			}
		}
		
	}
	
	function hapus_modem()
	{
		$id_modem = $this->input->post('mod');
		if($id_modem)
		{
			for($i=0;$i<count($id_modem);$i++)
			{
				$this->Config_Modem_Model->delete($id_modem[$i]);
			}
			
			echo 'true';
		}
		return false;
		
	}
	
}
