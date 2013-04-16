<?php 

Class Mod_send extends MX_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('pbk_model');
		$this->load->model('slot_sim_model');
		$this->load->model('outbox_model');
		$this->load->model('outbox_multipart_model');
	}
	
	
	public function send_sms($id_pbk,$isi_pesan)
	{


		//cek data user 
		$id_pbk = $this->pbk_model->get($id_pbk);  // pbk model
		if($id_pbk)
		{
			
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
						var_dump($insert_id);
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
		
	}

}
 
