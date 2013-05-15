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
		//[0][id_user] = 
		$data = $_POST;
		
		//log_message('error','error  data : '. print_r($data,true));
		//var_dump($data);
		if(is_array($data))
		{
			$sta = false;
			$recive_date = false;
			$thread = false;
			$address_book = false;
			for($i=0;$i < count($data);$i++)
			{
				$id_user = $data[$i]['id_user'];
				$cari_thread = array('number' => $data[$i]['number'],'status_archive' => '0','is_delete !=' => '1','id_user' => $id_user); 
				$data_thread = $this->inbox_model->arr_wheres($cari_thread);
				if($data_thread)
				{
					$thread = $data_thread[0]->thread;
				}
				else
				{
					$thread = mt_rand();
				}
				
				// cari rule
				$phoneID = $this->rule->sending_rule($data[$i]['number']);
				//log_message('error','error phone ID data : '. print_r($phoneID,true));
				#cek di rule modem ofline atau online 
				if($phoneID)
				{
					$recive_date = time();
					$read_status = '1';
					
					// data label 
					if(isset($phoneID['id_address_book']))
					{
						$id_address_book = $phoneID['id_address_book'];
					}
					
					$insert = array(
					'id_user' => $id_user,
					'id_address_book' => $id_address_book,
					'number' => $data[$i]['number'],
					'thread' => $thread,
					'recive_date' => $recive_date,
					'content' => $data[$i]['text'],
					'read_status' => $read_status,
					'last_update' => $recive_date,
					'status_archive' => '0'
					);
					$id_inbox = $this->inbox_model->add($insert);
					
					if($id_inbox)
					{
						// labelin sent atau 2
						$id_labelname = '2';
						$this->label_model->add($id_inbox,$id_labelname);
					
						$push = $this->outbox->push_outbox($data[$i]['number'],$data[$i]['text'],$phoneID['phoneID']);
						if($push)
						{
							//return true;
							$sta = true;
						}
					}

				}

			}
			$sta = $sta && $sta;
			if($sta)
			{
				echo 'true';
			}else
			{
				echo 'false'; 
			}			
		}
		
		//return false;
	}
	
} 
