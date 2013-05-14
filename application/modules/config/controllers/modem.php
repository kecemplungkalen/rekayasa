<?php 
Class Modem extends MY_Controller{
	
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
		$temp = false;
		if($modem)
		{
			$data = false;
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
	
	
	function edit_config_modem_modal()
	{
		$id_config_modem = $this->input->get('id_config_modem');
		$detail = $this->Config_Modem_Model->get($id_config_modem);
		$view = false;
		if($detail)
		{
			$view['config'] = $detail;
		}
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
		
		$this->load->view('modal/edit_config_modem_modal_view',$view);
		
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
				if($default == '1')
				{
					$where = array('id_config_modem !=' => $balik,'default' => '1');
					$data = array('default' => '1');
					$this->Config_Modem_Model->update_where($where,$data);

				}
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
	
	function update_modem()
	{

		$data = $_POST;
		if($data)
		{
			$id_config_modem = $data['id_config_modem'];
			$nama_modem = $data['nama_modem'];
			$phoneID = $data['phoneID'];
			$number = $data['number'];
			if(isset($data['default']))
			{
				// remove other devault
				$where = array('id_config_modem !=' => $id_config_modem,'default' => '1');
				$data = array('default' => '0');
				$set = $this->Config_Modem_Model->update_where($where,$data);
				if($set)
				{
					$where = array('id_config_modem' => $id_config_modem);
					$data = array('default' => '1','nama_modem' => $nama_modem,'phoneID' => $phoneID,'number' => $number);
					$up = $this->Config_Modem_Model->update_where($where,$data);
				}				
			}
			else
			{
				$where = array('id_config_modem' => $id_config_modem);
				$data = array('default' => '0','nama_modem' => $nama_modem,'phoneID' => $phoneID,'number' => $number);
				$up = $this->Config_Modem_Model->update_where($where,$data);								
			}
			
			if($up)
			{
				echo 'true';
			}
			else
			{
				echo 'false';
			}
			
		}
		else
		return false;
	}
	
	function cek_edit($id_config_modem)
	{
		if($id_config_modem)
		{
			if($this->input->post('nama_modem'))
			{
				$nama_modem = $this->input->post('nama_modem');
				$data = array('id_config_modem !=' => $id_config_modem,'nama_modem' => $nama_modem);
				$get = $this->Config_Modem_Model->get_where($data);
				if($get)
				{
					echo 'false';
				}
				else
				{
					echo 'true';
				}
			}
			
			if($this->input->post('number'))
			{
				$number = $this->input->post('number');
				$data = array('id_config_modem !=' => $id_config_modem,'number' => $number);
				$get = $this->Config_Modem_Model->get_where($data);
				if($get)
				{
					echo 'false';
				}
				else
				{
					echo 'true';
				}			
			}
		}
		else
		return false;
	}
	
}
