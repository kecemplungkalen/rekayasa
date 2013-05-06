<?php 

Class Rule extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->module('message');
		$this->load->module('gammu');
		$this->load->model('Config_Modem_Model');
		$this->load->model('Config_Rule_Model');
		$this->load->model('Smsc_Name_Model');
		$this->load->model('Smsc_Model');
		$this->load->model('Address_Book_Model');
	}
	
	function get()
	{
		$rule = $this->Config_Rule_Model->gets();
		if($rule)
		{
			$temp = false;
			$tmp = false;
			foreach($rule as $r)
			{
				$temp['id_config_rule']= $r->id_config_rule;
				$operator = $this->Smsc_Name_Model->get($r->id_smsc_name);
				if($operator)
				{
					$temp['smsc_name'] = $operator->operator_name;
				}
				$modem = $this->Config_Modem_Model->get($r->id_config_modem);
				if($modem)
				{
					$temp['nama_modem'] = $modem->nama_modem;
				}
				$tmp[] = $temp;
			}
			return $tmp;
		}
		return false;
	}
	
	public function config_rule_modal()
	{
		$data['operator'] = $this->Smsc_Name_Model->gets();
		$data['modem'] = $this->Config_Modem_Model->gets();
		$this->load->view('modal/config_rule_modal_view',$data);
	}

	public function edit_config_rule_modal()
	{
		$id_config_rule = $this->input->get('id_config_rule');
		$data['edit'] = $this->Config_Rule_Model->get($id_config_rule);
		$data['operator'] = $this->Smsc_Name_Model->gets();
		$data['modem'] = $this->Config_Modem_Model->gets();
		$this->load->view('modal/edit_config_rule_modal_view',$data);
	}
	
	function hapus_rule()
	{
		$value = $this->input->post('value');
		if($value)
		{
			for($i=0;$i < count($value);$i++)
			{
				$del = $this->Config_Rule_Model->delete($value[$i]);
			}
			echo 'true';
		}else
		echo 'false';
	}
	
	function add()
	{
		$id_smsc_name = $this->input->post('id_smsc_name');
		$id_config_modem = $this->input->post('id_config_modem');
		if($id_smsc_name && $id_config_modem)
		{
			$add = $this->Config_Rule_Model->add($id_smsc_name,$id_config_modem);
			if($add)
			{
				echo 'true';
			}
		}else
		echo 'false';
	}
	
	
	function edit_rule()
	{
		$id_config_rule = $this->input->post('id_config_rule');
		$id_smsc_name = $this->input->post('id_smsc_name');
		$id_config_modem = $this->input->post('id_config_modem');
		if($_POST)
		{
			$data = array('id_smsc_name' => $id_smsc_name,'id_config_modem' => $id_config_modem);
			$update = $this->Config_Rule_Model->update($id_config_rule,$data);
			if($update)
			{
				echo 'true';
			}
			
		}else
		echo 'false';
		
	}
	public function sending_rule($number=false)
	{
		// number 
		// cek di group jika ada 
		// group 
		// cek config rule 
		// jika tidak cari modem default 
		// modem
		if($number)
		{
			$phoneID =false;
			$temp =false;
			$tmp = false;
				$get_id_addr = $this->Address_Book_Model->get_where('number',$number);
				if($get_id_addr)
				{
					$temp['id_address_book'] = $get_id_addr->id_address_book;
					$temp['id_smsc'] = $get_id_addr->id_smsc;
					$get_smsc = $this->Smsc_Model->get($get_id_addr->id_smsc);

					if($get_smsc)
					{
						$getrule = $this->Config_Rule_Model->get_by('id_smsc_name',$get_smsc->smsc_name);
						if($getrule)
						{
							
							$phone_id = $this->Config_Modem_Model->get($getrule->id_config_modem);
							if($phone_id)
							{
								$temp['phoneID'] = $phone_id->phoneID;
								
							}
							
						}
						else
							{
								$getdefault = $this->Config_Modem_Model->get_by('default','1');
								if($getdefault)
								{
									$temp['phoneID'] = $getdefault->phoneID;
								}
							}
					}
				}

			return $temp; 
		}
		return false; 
	}
	
	
	
	
	
} 
