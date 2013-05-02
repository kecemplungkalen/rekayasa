<?php 

Class Add_process extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('curl');
		$this->load->model('Filter_Model');
		$this->load->model('Filter_Detail_Model');
		$this->load->model('Filter_Action_model');
		$this->load->model('Add_Process_Model');
		$this->load->model('Filter_Delimiter_Model');
		$this->load->model('Filter_Regex_Model');
		$this->load->model('inbox_model');
		$this->load->model('label_model');
		$this->load->model('Smsc_Model');
		$this->load->model('Address_Book_Model');

	}
	
	public function index($data=false)
	{
		/// data dari sms gateway 	
		if($data)
		{
			$count = 0;
			$number = $data->SenderNumber;
			$isi_sms = $data->TextDecoded;
			$smsc = $data->SMSCNumber;
			$recive_date = strtotime($data->ReceivingDateTime);  
			$id_user = '1';
			//cek di address 
			$id_address_book = false;
			$address_book = $this->Address_Book_Model->get_where('number',$number);

			if($address_book)
			{
				$id_address_book = $address_book->id_address_book;
			}
			else
			{
				//tambah ke phone book tambah ke group no group 
				$tambah_address_book = $this->Address_Book_Model->add($number,$number,'','',$id_user);

				if($tambah_address_book)
				{
					$id_address_book = $tambah_address_book;
				
					$id_smsc = $this->Smsc_Model->get_by_col('smsc_number',$smsc);
					if($id_smsc)
					{
						$data = array('id_smsc' => $id_smsc->id_smsc);
						$this->Address_Book_Model->update($id_address_book,$data);
					}					
				}
			}
			//insert ke tabel inbox mark unread 
			$id_inbox = false;
			$input_inbox = array(
			'id_user' => $id_user,
			'id_address_book' => $id_address_book,
			'recive_date' => $recive_date,
			'number' => $number,
			'content'=> $isi_sms,
			'last_update' => time(),
			'read_status' => 0 );
			
			$data_id_inbox = $this->inbox_model->add($input_inbox); // kita dapat id_inbox
			if($data_id_inbox)
			{
				$id_inbox = $data_id_inbox;
			}
			// tambah ke label inbox 
			$id_label_inbox = $this->label_model->add($id_inbox,'1');
			//ambil filter aktif
			$data_filter = $this->Filter_Model->gets(1);
			if($data_filter)
			{
				//$data_isisms = false;
				$coba_data = false;
				$value_filter = false;
				$logika = false;
				
				$tmp = false;
				foreach($data_filter as $df)
				{
					//var_dump($count++);
					$delimiter = $this->Filter_Delimiter_Model->get($df->id_delimiter);
					
					$logika = $this->saring($df->id_filter,$number,$isi_sms,$delimiter->value_delimiter);
					if($logika)
					{
						$this->filter_action($df->id_filter,$id_inbox,$id_label_inbox,$isi_sms);
					}
					
				} // end ambil filter by id and proses 
				//	$coba_data[] = $valid_array;
			} // end ambil data filter
			
			return true;
			//$filter_detail = $this->Filter_Detail_Model->gets_by_col();
			
		}
		return false;
		//di return langsung  
		
	}	
	
	public function filter_action($id_filter=false,$id_inbox=false,$id_label_inbox=false,$isi_sms=false)
	{
		$action = $this->Filter_Action_model->gets_by_col('id_filter',$id_filter);
		if($action)
		{
			foreach($action as $act)
			{
				switch ($act->id_filter_action_type)
				{
					case '1' :
					//action tambah  label 
					$this->label_model->add($id_inbox,$act->id_label);
					break;
					
					case '2' :
					//action post api
					$this->post_data_api($act->api_post,$act->api_error_email,$isi_sms);
					break;
					
					case '3' :
					//action read status
					$mark_read = array('read_status' => '1');
					$this->inbox_model->update($id_inbox,$mark_read);
					break;
					
					case '4' :
					//action
					#set archive 
					$this->label_model->delete($id_label_inbox);
					//$this->set_archive();
					
					break;
				}
			}
			
		}

	}
	
	public function saring($id_filter=false,$number=false,$isi_sms=false,$delimiter=false)
	{
		
		$tmp = $this->Filter_Detail_Model->gets_by_col('id_filter',$id_filter);
		if($tmp)
		{
			$temp = false;
			$valid_array = false;
			$add_rule = false;
			$v = false;
			$word = false;
			//olah validasi 
			foreach($tmp as $t)
			{
				//$value_filter = ;
				$data_isisms = explode($delimiter,$isi_sms);
				$valid = false;
				//jika messages
				if($t->type_filter == 'messages')
				{
					if($t->type_regex != 'type')
					{
						switch($t->type_regex)
						{
							case '=' :
								if($data_isisms[$t->word-1])
								{
									if($t->regex_data == $data_isisms[$t->word-1])
									{
										$valid = true;
									}
								}
							break;
							case 'start_with' :
								if($data_isisms[$t->word-1])
								{
									if(preg_match('/^'.$t->regex_data.'/',$data_isisms[$t->word-1]))
									{
										$valid = true;
									}
								}
							break;
							case 'regex' : 
								if($data_isisms[$t->word -1])
								{
									if(preg_match($t->regex_data,$data_isisms[$t->word -1]))
									{
										$valid = true;
									}
								}
							break;
						}
						
					}else
					{
						if($data_isisms[$t->word -1])
						{
							$fr = $this->Filter_Regex_Model->get($t->id_filter_regex);
							if(preg_match($fr->regex_value,$data_isisms[$t->word -1]))
							{
								$valid = true;
							}
						}
					}					
				}else // jika number
					{
						if($t->type_regex != 'type')
						{
							switch($t->type_regex)
							{
								case '=' :
									if($t->regex_data == $number)
									{
										$valid = true;
									}
								break;
								case 'start_with' :
									if(preg_match('/^'.$t->regex_data.'/',$number))
									{
										$valid = true;
									}
								break;
								case 'regex' : 
									if(preg_match($t->regex_data,$number))
									{
										$valid = true;
									}
								break;
							}
							
						}else
						{
							//sementara sama dengan regex
							if(preg_match($t->regex_data,$data_isisms[$t->word -1]))
							{
								$valid = true;
							}
						}
					}
				$temp['status'] = $valid;
				$temp['addons'] = $t->add_rule;
				$v[] = $temp; 
			}
			$valid_array = $v;
			if($valid_array)
			{
				$logika=null;
				for($i=0; $i < count($valid_array); $i++)
				{
					if($valid_array[$i]['addons'] == 'and')
					{
						if(isset($logika))
						{
							$logika = $logika && $valid_array[$i+1]['status'];
						}
						else
						{
							$logika = $valid_array[$i]['status'] && $valid_array[$i+1]['status'];
						}
					}
					elseif($valid_array[$i]['addons'] == 'or')
					{
						if(isset($logika))
						{
							$logika = $logika || $valid_array[$i+1]['status'];
						}
						else
						{   
							$logika = $valid_array[$i]['status'] || $valid_array[$i+1]['status'];
						}
					}
					else{
						break;
					}
				}
				return $logika;
			}
		}
		return false;
	}
	
	public function post_data_api($url_api=false,$report_email=false,$data_sms=false)
	{
		if($url_api)
		{
			$respons = $this->curl->simple_post($url_api,$data_sms);
			if($respons)
			{
				return true;
			}
			else
			{
				// send email report ke $report_email
				
			}
			
			
		}
		/*
		 * test saja 
		$data = array('number' => '+62819678420' , 'isi_sms' => 'test saja Loh.. :-)'); 
		$return = $this->curl->simple_post('http://localhost/rekayasa/add_process',$data);
		
		echo $return;
		*/
	}
	
	
	public function test()
	{
		$temp['number'] = '+62819678420';
		$temp['text'] = 'Uye Maaaaaaaaaan.. Piye';
		$tmp[]= $temp;
		$return = $this->curl->simple_post('http://localhost/rekayasa/send',$tmp);
		echo $return;
	}

	
}
