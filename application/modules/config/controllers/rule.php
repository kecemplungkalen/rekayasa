<?php 

Class Rule extends MY_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->module('message');
		$this->load->module('gammu');
		$this->load->module('gammu/phones');
		$this->load->model('Config_Modem_Model');
		$this->load->model('Config_Rule_Model');
		$this->load->model('Smsc_Name_Model');
		$this->load->model('Smsc_Model');
		$this->load->model('Address_Book_Model');
		$this->load->model('Operator_Number_Model');
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
				$getrule = $this->Config_Rule_Model->get_by('id_smsc_name',$get_id_addr->id_smsc);
				if($getrule)
				{
					// dapat limit juga
					$phone_id = $this->Config_Modem_Model->get($getrule->id_config_modem);
					if($phone_id)
					{						
						// waktu limit  
						$temp['limit_time'] = $phone_id->time_sending_limit;
						$temp['limit_send'] = $phone_id->sending_limit;
						$temp['phoneID'] = $phone_id->phoneID;
					}
				}
				else
				{
					$getdefault = $this->Config_Modem_Model->get_by('default','1');
					if($getdefault)
					{
						// dapat limit juga 
						$temp['limit_time'] = $getdefault->time_sending_limit;
						$temp['limit_send'] = $getdefault->sending_limit;
						$temp['phoneID'] = $getdefault->phoneID;
					}
				}
			}
			else
			{
				$id_user = $this->session->userdata('id_user');
				$temp['id_smsc'] = false;
				$last_name = '';
				$email = false;
				//$id_user = false;
				$ins_addr = array(
				'first_name' => $number,
				'number' => $number,
				'email' => '0',
				'create_date' => time(),
				'last_update' => time(),
				'id_user' => $id_user		
				);
				$last_id = $this->Address_Book_Model->add($ins_addr);
				if($last_id)
				{
					$temp['id_address_book'] = $last_id;
					// ini karena males update  model
					$cari_op = $this->Operator_Number_Model->gets();
					if($cari_op)
					{	
						foreach($cari_op as $co)
						{
							if(preg_match('/^\\'.$co->operator_number.'/',$number))
							{
								$up = array('id_smsc' => $co->id_smsc_name);
								$this->Address_Book_Model->update($last_id,$up);
								$temp['id_smsc'] = $co->id_smsc_name;
							}
						}
						
					}

				}
				
				$getrule = $this->Config_Rule_Model->get_by('id_smsc_name',$temp['id_smsc']);
				if($getrule)
				{
					$phone_id = $this->Config_Modem_Model->get($getrule->id_config_modem);
					if($phone_id)
					{
						// dapat limit juga
						$temp['limit_time'] = $phone_id->time_sending_limit;
						$temp['limit_send'] = $phone_id->sending_limit;						 
						$temp['phoneID'] = $phone_id->phoneID;
					}					
					
				}
				else
				{
					$getdefault = $this->Config_Modem_Model->get_by('default','1');
					if($getdefault)
					{
						// dapat limit juga
						$temp['limit_time'] = $getdefault->time_sending_limit;
						$temp['limit_send'] = $getdefault->sending_limit;						 
						$temp['phoneID'] = $getdefault->phoneID;
					}
				}
	
			}
			
			$cekmod = $this->phones->cek_phoneID($temp['phoneID']);
			if($cekmod)
			{
				return $temp;	
			}
			 
		}
		return false; 
	}
	
	
	
	
	
} 
