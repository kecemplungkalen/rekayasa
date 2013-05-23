<?php 
Class Send extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->module('gammu/outbox');
		$this->load->model('inbox_model');
		$this->load->model('label_model');
	}

	
	//public function index()
	//{
		//return false;
		////[0][number] = 'nomor'
		////[0][text] = 'isi textnya'
		////[0][id_user] = 
		////log_message('error','error  data : '. print_r($data,true));
		////var_dump($data);
		//if(is_array($data))
		//{
			//$sta = false;
			//$recive_date = false;
			//$thread = false;
			//$address_book = false;
			//for($i=0;$i < count($data);$i++)
			//{
				//$id_user = $data[$i]['id_user'];
				//$cari_thread = array('number' => $data[$i]['number'],'status_archive' => '0','is_delete !=' => '1','id_user' => $id_user); 
				//$data_thread = $this->inbox_model->arr_wheres($cari_thread);
				//if($data_thread)
				//{
					//$thread = $data_thread[0]->thread;
				//}
				//else
				//{
					//$thread = mt_rand();
				//}
				
				//// cari rule
				//$phoneID = $this->rule->sending_rule($data[$i]['number']);
				////log_message('error','error phone ID data : '. print_r($phoneID,true));
				//#cek di rule modem ofline atau online 
				//if($phoneID)
				//{
					
					///*
					 //* 
					 //* 
					 //*  ambil status modem 
					 //* 	ambil waktu kirim 
					 //* 	ambil jumlah dalam 1 jam ( gammu ) 
					 //* 	kurangi waktu sekarang 
					 //* 	set semuanya 
					 //* 	kirim by set 
					 //* 
					 //* 
					 //*/
					//$recive_date = time();
					//$read_status = '1';
					
					//// data label 
					//if(isset($phoneID['id_address_book']))
					//{
						//$id_address_book = $phoneID['id_address_book'];
					//}
					
					//$insert = array(
					//'id_user' => $id_user,
					//'id_address_book' => $id_address_book,
					//'number' => $data[$i]['number'],
					//'thread' => $thread,
					//'recive_date' => $recive_date,
					//'content' => $data[$i]['text'],
					//'read_status' => $read_status,
					//'last_update' => $recive_date,
					//'status_archive' => '0'
					//);
					//$id_inbox = $this->inbox_model->add($insert);
					
					//if($id_inbox)
					//{
						//// labelin sent atau 2
						//$id_labelname = '2';
						//$this->label_model->add($id_inbox,$id_labelname);
					
						//$push = $this->outbox->push_outbox($data[$i]['number'],$data[$i]['text'],$phoneID['phoneID']);
						//if($push)
						//{
							//$sta = true;
						//}
					//}

				//}

			//}
			//$sta = $sta && $sta;
			//if($sta)
			//{
				//echo 'true';
			//}else
			//{
				//echo 'false'; 
			//}			
		//}
		
		////return false;
	//}
	
	function local_send($data=FALSE)
	{
		$this->load->module('config/rule');
		//$data = $_POST;
		//log_message('error','error  data : '. print_r($data,true));
		//var_dump($data);
		//return false;
		////[0][number] = 'nomor'
		////[0][text] = 'isi textnya'
		////[0][id_user] = 
				
		if(is_array($data))
		{
			$sta = false;
			$recive_date = false;
			$thread = false;
			$address_book = false;
			for($i=0;$i < count($data);$i++)
			{
				/*
				 * 
				 *  cari thread 
				 */
				 
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
				#cek di rule modem ofline atau online 				
				$phoneID = $this->rule->sending_rule($data[$i]['number']);
				//log_message('error','error phone ID data : '. print_r($phoneID,true));
				if($phoneID)
				{
					///*
					 //* 
					 //* 
					 //*  	ambil status modem 
					 //* 	ambil waktu kirim 
					 //* 	ambil jumlah dalam 1 jam ( gammu ) 
					 //* 	kurangi waktu sekarang 
					 //* 	set semuanya 
					 //* 	kirim by set 
					 //* 
					 //* 
					 //*/
					
					// masukkan ke database gammu 
					
					$limit_time = $phoneID['limit_time'];
					$limit_send = $phoneID['limit_send'];
					$slotID = $phoneID['phoneID'];
					// ambil waktu antrian 
					$cek_limit = $this->cek_data($slotID,$limit_time,$limit_send);
					if($cek_limit)
					{
						// dapat waktu antrian 
						$push = $this->outbox->push_outbox($data[$i]['number'],$data[$i]['text'],$phoneID['phoneID'],$cek_limit);
						if($push)
						{
							$sta = true;
						}
					}
					
	
					
					// masuk ke database rekayasa
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
					}
				}

			}
			$sta = $sta && $sta;
			if($sta)
			{
				//echo 'true';
				return true;
			}else
			{
				//echo 'false'; 
				return false;
			}			
		}
		
	}
	
	/*
	 * cek status limit modem 
	 * return generate waktu kirim 
	 * 
	 */
	
	function cek_data($slotID=FALSE,$limit_time=FALSE,$limit_send=FALSE)
	{
		$this->load->model('gammu/sentitems_model');
		$this->load->model('gammu/gammu_outbox_model');
		$this->load->model('gammu/gammu_outbox_multipart_model');
		$this->load->model('Config_Modem_Model');		
		if($slotID)
		{
			if($limit_time != '0')
			{
				$time_antri = false;
				$jumlahAntrian = 0;
				$jumlahDikirim = 0;
				$jumlah_total = 0;
				// cek data outbox status jumlah antrian 
				// cek waktu antrian 
				$time_antri = date('Y-m-d H:i:s',(time() + $limit_time));
				$data = array(
				'SenderID' => $slotID,
				'SendingDateTime >' => date('Y-m-d H:i:s') 
				);
				$data_outbox = $this->gammu_outbox_model->gets($data);
				if($data_outbox)
				{
					$antrian_multipart = 0;
					$data_multipart = $this->gammu_outbox_multipart_model->gets_all();
					if($data_multipart)
					{
						$antrian_multipart = count($data_multipart);
					}
					
					$antrian_outbox = count($data_outbox);
					$jumlahAntrian = $antrian_multipart + $antrian_outbox;
				}
				
				// cek jumlah perngiriman dalam limit 
				$cekcurrent = array(
				'SenderID' => $slotID,
				'SendingDateTime > ' => date('Y-m-d H:i:s',(time() - $limit_time))
				);
				
				$jumlah_dalam_limit = $this->sentitems_model->gets($cekcurrent);
				if($jumlah_dalam_limit)
				{
					$jumlahDikirim = count($jumlah_dalam_limit);
				}
				
				$jumlah_total = $jumlahAntrian + $jumlahDikirim;
				$return = false;
				if($jumlah_total >= $limit_send)
				{
					
					$where = array('phoneID' => $slotID);
					$updatean = array('total_unsend' => $jumlahAntrian,'total_send' => $jumlahDikirim,'status_sending' => 'pending');
					$update = $this->Config_Modem_Model->update_where($where,$updatean);
					if($update)
					{
						return date('Y-m-d H:i:s',(time() + $limit_time));
					}
				}
				else
				{
					$where = array('phoneID' => $slotID);
					$updatean = array('status_sending' => 'ready');
					$update = $this->Config_Modem_Model->update_where($where,$updatean);
					if($update)
					{
						return date('Y-m-d H:i:s',time());
					}
				}
			}
			else
			{
				return date('Y-m-d H:i:s',time());
			}
		}
		return FALSE;
	}
} 
