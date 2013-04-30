<?php 

Class Gammu extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();		
		$this->load->model('Gammu_Model');
		$this->load->model('Phones_Model');
		$this->load->module('add_process');
	}
	
	public function index($id=false)
	{
		if($id)
		{
			//$proses = false;
			$data = $this->Gammu_Model->get($id);
			if($data)
			{
				
				if($data->Processed == 'true')
				{
					$ambil_lain = $this->Gammu_Model->get_inbox('1','0');
					if($ambil_lain)
					{
						//tambahkan ke aplikasi
						$proses = $this->add_process->index($ambil_lain);
						if($proses)
						{
							$set = array('Processed' => 'true');
							$sukses = $this->Gammu_Model->update($ambil_lain->ID,$set);
							return $sukses;
						}
						
					}
				}
				else
					{
						// tambahkan ke aplikasi 
						$proses = $this->add_process->index($data);
						//var_dump($proses);

						if($proses)
						{
							$set = array('Processed' => 'true');
							$sukses = $this->Gammu_Model->update($id,$set);
							return $sukses;
						}
					}
			}
		}
		return false;	
	}
	
	/*
	public function send_sms($id_pbk,$isi_pesan)
	{
		//masukkan data sms ke database gammu 
		$jumlahSMS = ceil(strlen($isi_pesan)/153);
		$namaslot = $this->slot_sim_model->get($id_pbk->SlotID);
	
		if($jumlahSMS > 1)
		{
			// pecah pesan
			$pesan = str_split($isi_pesan,153);
			
			//generate UDH 
			for($i=1;$i<=$jumlahSMS;$i++)
			{
				$udh = "050003CC".sprintf("%02s", $jumlahSMS).sprintf("%02s", $i);
				$sentText = $pesan[$i-1];
				if($i == 1)
				{
					//$insert_id = $this->outbox_model->add('DestinationNumber, UDH, TextDecoded, ID, MultiPart, CreatorID, SenderID'); // bikin outbox model
					$data = array('DestinationNumber' => $id_pbk->Number,'UDH' => $udh,'TextDecoded' => $sentText, 'MultiPart' => 'true' , 'CreatorID' => $namaslot->PhoneID ,'SenderID' => $namaslot->PhoneID);
					$insert_id = $this->outbox_model->insert($data); 
				}else
				{
					
					//$this->outbox_multipart_model->add('UDH, TextDecoded, ID, SequencePosition');
					$data = array('UDH' => $udh, 'TextDecoded' => $sentText,'ID' => $insert_id ,'SequencePosition' => $i);
					$this->outbox_multipart_model->add($data); // bikin outbox_multipart_model
				}
			}
		}
		else
		{
			if($namaslot)
			{
				$sender = $namaslot->PhoneID;
			}else
			{
				$sender = 'Unknown SMSC';
			}
			$data = array('DestinationNumber' => $id_pbk->Number,'TextDecoded' => $isi_pesan, 'CreatorID' => $sender ,'SenderID' => $sender);						
			$this->outbox_model->insert($data);
		}

	}
	*/
	
	public function get_phone()
	{
		$phone = $this->Phones_Model->get_active();
		if($phone)
		{
			return $phone;
		}
		else
		return false;
	}
	
	
}
