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
	
	public function index($data)
	{
		/// data dari sms gateway 	
		//$data = $_POST;		
		if(is_array($data))
		{
			
			//$number = $data['number'];
			//$isisms = $data['isi_sms'];
			
			
			
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
			'content'=> $isi_sms,
			'last_update' => time(),
			'read_status' => 0 );
			
			$data_id_inbox = $this->inbox_model->add($input_inbox); // kita dapat id_inbox
			if($data_id_inbox)
			{
				$id_inbox = $data_id_inbox;
			}
			// tambah ke label inbox 
			$this->label_model->add($id_inbox,'1');
			
			
			
			
			
			//ambil filter aktif
			$data_filter = $this->Filter_Model->gets(1);
			if($data_filter)
			{
				$id_filter = false;
				$coba_data = false;
				
				$tmp = false;
				foreach($data_filter as $df)
				{
					$df->id_filter;
					// pecah pesan 
					$delimiter = $this->Filter_Delimiter_Model->get($df->id_delimiter);
					//data aray sms
					$data_isisms = explode($delimiter->value_delimiter,$isi_sms);
					//ambil fiter detail
					$tmp = $this->Filter_Detail_Model->gets_by_col('id_filter',$df->id_filter);
					if($tmp)
					{
						$temp = false;
						$valid_array = false;
						$add_rule = false;
						$v = false;
						//olah validasi 
						foreach($tmp as $t)
						{
							$valid = false;
							//jika messages
							if($t->type_filter == 'messages')
							{
								$value_filter = $data_isisms[$t->word-1];
								var_dump($value_filter);
								if($t->type_regex != 'type')
								{
									switch($t->type_regex)
									{
										case '=' :
											if($t->regex_data == $value_filter)
											{
												$valid = true;
											}
										break;
										case 'start_with' :
											if(preg_match('/^'.$t->regex_data.'/',$value_filter))
											{
												$valid = true;
											}
										break;
										case 'regex' : 
											if(preg_match($t->regex_data,$value_filter))
											{
												$valid = true;
											}
										break;
									}
									
								}else
								{
									$fr = $this->Filter_Regex_Model->get($t->id_filter_regex);
									if(preg_match($fr->regex_value,$value_filter))
									{
										$valid = true;
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
										if(preg_match($t->regex_data,$value_filter))
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
						var_dump($logika);
						//proses
						if($logika)
						{
							//$df->id_filter
							$action = $this->Filter_Action_model->gets_by_col('id_filter',$df->id_filter);
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
										$this->set_archive();
										break;
									}
								}
								
							}

						}
						
						
						
					} // end ambil filter by id and proses 
					
					$coba_data[] = $valid_array;
				} // end ambil data filter

			}
			
			//filter pesan 
			
			//$filter_detail = $this->Filter_Detail_Model->gets_by_col();
			
			

			
		}
		
		
		
		//di return langsung  
		
	}	
	
	
	public function post_data_api($url_api=false,$report_email=false,$data_sms=false)
	{
		//if()
		//{
			
		//}
		/*
		 * test saja 
		$data = array('number' => '+62819678420' , 'isi_sms' => 'test saja Loh.. :-)'); 
		$return = $this->curl->simple_post('http://localhost/rekayasa/add_process',$data);
		
		echo $return;
		*/
	}
	
	
	public function set_archive()
	{
		
	}
	
}
