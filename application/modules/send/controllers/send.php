<?php 
Class Send extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->module('config/rule');
		$this->load->module('gammu/outbox');
		$this->load->model('inbox_model');
		$this->load->model('label_model');
	}
	
	
	public function index()
	{
		//[0][number] = 'nomor'
		//[0][text] = 'isi textnya'
		$data = $_POST;
		if(is_array($data))
		{
			$recive_date = false;
			for($i=0;$i < count($data);$i++)
			{
				$phoneID = $this->rule->sending_rule($data[$i]['number']);
				if($phoneID)
				{
					$id_user = '1'; //sementara bos
					$recive_date = time();
					$read_status = '1';
					
					// data label 
					$insert = array(
					'id_user' => $id_user,
					'id_address_book' => $phoneID['id_address_book'],
					'recive_date' => $recive_date,
					'content' => $data[$i]['text'],
					'read_status' => $read_status,
					'last_update' => $recive_date
					);
					$id_inbox = $this->inbox_model->add($insert);
					
					if($id_inbox)
					{
						// labelin outbox atau 3
						$id_labelname = '3';
						$this->label_model->add($id_inbox,$id_labelname);
					}
					
					/*tambah ke proses input tabel outbox gammu
					 * array(3) { ["id_address_book"]=> string(2) "11" ["id_smsc"]=> string(1) "5" ["phoneID"]=> string(10) "RumahwebXL" }
					 * 
					 */ 
					$push = $this->outbox->push_outbox($data[$i]['number'],$data[$i]['text'],$phoneID['phoneID']);
					if($push)
					{
						return true;
					}
				}
			}			
		}
		return false;
	}
	
} 
