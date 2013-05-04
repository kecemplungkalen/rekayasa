 <?php 

Class Outbox extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();		
		$this->load->model('Gammu_Outbox_Multipart_Model');
		$this->load->model('Gammu_Outbox_Model');
		$this->load->module('add_process');
	}
	
	
	//add tabel outbox dan outbox multipart gammu
	public function push_outbox($number=false,$isi_pesan=false,$phoneID=false)
	{
		if($number && $isi_pesan && $phoneID)
		{
			//masukkan data sms ke database gammu
			$jumlahSMS = ceil(strlen($isi_pesan)/153);
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
						$data = array('DestinationNumber' => $number,'UDH' => $udh,'TextDecoded' => $sentText, 'MultiPart' => 'true' , 'CreatorID' => $phoneID ,'SenderID' => $phoneID);
						$insert_id = $this->Gammu_Outbox_Model->insert($data); 
					}else
					{
						
						//$this->outbox_multipart_model->add('UDH, TextDecoded, ID, SequencePosition');
						$data = array('UDH' => $udh, 'TextDecoded' => $sentText,'ID' => $insert_id ,'SequencePosition' => $i);
						$this->Gammu_Outbox_Multipart_Model->add($data); // bikin outbox_multipart_model
					}
				}
			}
			else
			{
				
				$data = array('DestinationNumber' => $number,'TextDecoded' => $isi_pesan, 'CreatorID' => $phoneID ,'SenderID' => $phoneID);						
				$this->Gammu_Outbox_Model->insert($data);
			}
		}
		return false;
	}
	
}