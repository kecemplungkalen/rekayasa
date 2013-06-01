<?php 

Class Add_process extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('curl');
		$this->load->model('Filter_Model');
		$this->load->model('Filter_Detail_Model');
		$this->load->model('Filter_Action_model');
		$this->load->model('Filter_Delimiter_Model');
		$this->load->model('Filter_Regex_Model');
		$this->load->model('inbox_model');
		$this->load->model('label_model');
		$this->load->model('Smsc_Model');
		$this->load->model('Address_Book_Model');
		$this->load->model('Operator_Number_Model');
		$this->load->model('Blacklist_Model');
		$this->load->model('User_Model');

	}
	
	/*
	 *  Song From Distance
	 * 	THC
	 */
	
	function index($data=false)
	{
		/// data dari sms gateway
		log_message('error','data dari sms gateway'.print_r($data,true)); 	
		if($data)
		{
			$count = 0;
			$number = $data->SenderNumber;
			$isi_sms = $data->TextDecoded;
			$smsc = $data->SMSCNumber;
			$recive_date = strtotime($data->ReceivingDateTime);  
			
			// cari dimana 
			$id_user = false;
			$password = false;
			$apikey = false;
			$getuser = false;
			# ambil level 1 dan API 1
			$ussr = array('status' => '1','level' => '1','api' => '1');
			$getuser = $this->User_Model->get($ussr);
			log_message('error','Ambil Data User => '.print_r($getuser,true)); 	
			if($getuser)
			{
				$id_user = $getuser->id_user;
			}

			
			//cek di address 
			$id_address_book = false;
			$address_book = $this->Address_Book_Model->get_where('number',$number);
			log_message('error','Cek Di Adress Book => '.print_r($address_book,true)); 	
			if($address_book)
			{
				$id_address_book = $address_book->id_address_book;
			}
			else
			{
				//tambah ke phone book tambah ke group no group 
				$data_smsc = false;
				$id_smsc = $this->Smsc_Model->get_by_col('smsc_number',$smsc);
				if($id_smsc)
				{
					// kolom id_smsc isinya smsc_name.id_smsc_name 
					//$data = array('id_smsc' => $id_smsc->smsc_name);
					
					//$this->Address_Book_Model->update($id_address_book,$data);
					$data_smsc = $id_smsc->smsc_name;
				}
				else // jika tidak ada di database smsc ambil di data operator number
				{
					
					$data_op = $this->Operator_Number_Model->gets();
					if($data_op)
					{
						foreach($data_op as $dp)
						{
							if(preg_match('/^\\'.$dp->operator_number.'/',$number))
							{
								//$data = array('id_smsc' => $dp->id_smsc_name);
								//$this->Address_Book_Model->update($id_address_book,$data);
								$data_smsc = $dp->id_smsc_name;
							}
						}
						
					}
					
				}					

				
				$addarr = array(
				
				'first_name' => $number,
				'number' => $number,
				'create_date' => time(),
				'last_update' => time(),
				'id_smsc' => $data_smsc,
				'id_user' => $id_user
				);
				
				$tambah_address_book = $this->Address_Book_Model->add($addarr);
				log_message('error',' tambah address=> '.print_r($tambah_address_book,true));

				if($tambah_address_book)
				{
					$id_address_book = $tambah_address_book;
				
				}
			}
			
			
			//cek tread
			$thread = mt_rand();;
			$cari = array('number' => $number,'status_archive' => '0','is_delete ' => '0');
			//$insert_labelname = false;
			$cek_thread = $this->inbox_model->arr_wheres($cari);
			$id_inbox_ar = false; 				
			
			if($cek_thread) // thread sudah pernah dibuat 
			{
				$thread = $cek_thread[0]->thread;
				//ambil label sebelumnya

				//ambil id_inbox berdasarkan thread  (wafer 1)
				$comot_id_inbox = $this->inbox_model->gets_where('thread',$thread);
				$cil = false;
				$col = false;
				if($comot_id_inbox)
				{
					foreach($comot_id_inbox as $comot)
					{
						$cil[] = $comot->id_inbox;
					}
					// dapa id inbox array 
					
					

					//log_message('error',' comot id labelname => '.print_r($comot_id_labelname,true));
					//log_message('error',' comot id labelname => '.print_r($comot_id_labelname,true));
					//ambil id nama label di label (wafer 2);
					
					// cari label dengan id inbox 
				}
				$id_inbox_ar = $cil;
			}
			
			//log_message('error',' Insert labelname  => '.print_r($insert_labelname,true));

			// cek di blacklist
			$black = array('blacklist_number' => $number);
			$cek_spam = $this->Blacklist_Model->get($black);
			
			log_message('error',' Cek Spam  => '.print_r($cek_spam,true));

			if($cek_spam)
			{
				$id_inbox = false;
				$input_inbox = array(
				'id_user' => $id_user,
				'thread ' => $thread ,
				'id_address_book' => $id_address_book,
				'recive_date' => $recive_date,
				'number' => $number,
				'content'=> $isi_sms,
				'last_update' => time(),
				'read_status' => '0', // unread 
				'status_archive' => '0'
				);	
				$data_id_inbox = $this->inbox_model->add($input_inbox); // kita dapat id_inbox
				if($data_id_inbox)
				{
					$id_inbox = $data_id_inbox;
				
				}
				$where = array('id_inbox' => $id_inbox);
				$data = array('is_delete' => '2');
				$this->inbox_model->update_where($where,$data);
				$this->label_model->add($id_inbox,'5');
				
				return true;
			}
			else
			{
				//insert ke tabel inbox mark unread 
				
				/// bukan spam 

				$id_inbox = false;
				$input_inbox = array(
				'id_user' => $id_user,
				'thread ' => $thread ,
				'id_address_book' => $id_address_book,
				'recive_date' => $recive_date,
				'number' => $number,
				'content'=> $isi_sms,
				'last_update' => time(),
				'read_status' => '0', // unread
				'status_archive' => '0'
				);
				
				// push inbox //
				$data_id_inbox = $this->inbox_model->add($input_inbox); // kita dapat id_inbox
				
				if($data_id_inbox)
				{
					$id_inbox = $data_id_inbox;
				
				}
				
				/*
				 * /sendmail /
				 * 
				 */
				$this->load->module('config/email_konf');
				$this->email_konf->mail_konf($input_inbox);
				
				
				// tambah ke label inbox 
				$id_label_inbox = $this->label_model->add($id_inbox,'1');
				
				//$comot_id_labelname = $this->label_model->search_in('id_inbox',$id_inbox_ar);
				//log_message('error',' comot id labelname => '.print_r($comot_id_labelname,true));
				//$insert_labelname = false;
				
				//if($comot_id_labelname)
				//{
					//$lbl_name = false;
					//foreach($comot_id_labelname as $id_labelname)
					//{
						//// sementara tunggu revisi
						//if($id_labelname->id_labelname != '1' && $id_labelname->id_labelname != '2' && $id_labelname->id_labelname != '3' && $id_labelname->id_labelname != '4' && $id_labelname->id_labelname != '5')
						//{
							//$cekd = array('id_inbox' => $id_inbox,'id_labelname' => $id_labelname->id_labelname);
							//$dicek = $this->label_model->getswhere($cekd);
							//if(!$dicek)
							//{
								//$this->label_model->add($id_inbox,$id_labelname->id_labelname);
							//}
							//// langsung di tambah label 
						//}
					//}
					
				//}
				
				// tambahkan semua label thread sebelumnya kecuali sent (wafer 3)
				//if($insert_labelname)
				//{
					
					//for($i=0;$i<count($insert_labelname);$i++)
					//{
						
						//$this->label_model->add($id_inbox,$insert_labelname[$i]['id_labelname']);
					//}
				//}
				
				//ambil filter aktif
				$data_filter = $this->Filter_Model->gets('1');
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
						log_message('error','data logika penyaringan'.print_r($logika,true)); 	
						log_message('error','data get user dari atas'.print_r($getuser,true)); 	
						if($logika)
						{
							$this->filter_action($df->id_filter,$recive_date,$number,$id_inbox,$id_label_inbox,$isi_sms,$getuser);
						}
						
					} // end ambil filter by id and proses 
				} // end ambil data filter
				
				// balikin ke gammu biar ndak berat
				return true;
			}
			//$filter_detail = $this->Filter_Detail_Model->gets_by_col();
		}
		return false;
		//di return langsung  
	}	
	
	function filter_action($id_filter=false,$recive_date=false,$number=false,$id_inbox=false,$id_label_inbox=false,$isi_sms=false,$getuser=false)
	{
		log_message('error','action mode => '.print_r($getuser,true));
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
					if($getuser)
					{
						$this->post_data_api($act->api_post,$act->api_error_email,$recive_date,$number,$isi_sms,$getuser);
					}
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
	
	/*
	function saring($id_filter=false,$number=false,$isi_sms=false,$delimiter=false)
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
			$data_isisms = false;
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
								if(isset($data_isisms[$t->word-1]))
								{
									if(strtoupper($t->regex_data) == strtoupper($data_isisms[$t->word-1]))
									{
										$valid = true;
									}
								}
							break;
							case 'start_with' :
								if(isset($data_isisms[$t->word-1]))
								{
									if(preg_match('/^'.$t->regex_data.'/',$data_isisms[$t->word-1]))
									{
										$valid = true;
									}
								}
							break;
							case 'regex' : 
								if(isset($data_isisms[$t->word -1]))
								{
									if(preg_match('/'.$t->regex_data.'/',$data_isisms[$t->word -1]))
									{
										$valid = true;
									}
								}
							break;
						}
						
					}
					else
					{
						if(isset($data_isisms[$t->word -1]))
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
									if(preg_match('/'.$t->regex_data.'/',$number))
									{
										$valid = true;
									}
								break;
							}
							
						}else
						{
							//sementara sama dengan regex
							if(preg_match('/'.$t->regex_data.'/',$data_isisms[$t->word -1]))
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
	*/

	function saring($id_filter=false,$number=false,$isi_sms=false,$delimiter=false)
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
			$data_isisms = false;
			
			
			$data_isisms = explode($delimiter,preg_replace('/['.$delimiter.']+/',$delimiter,$isi_sms));
			
			log_message('error','Add_process/saring sms mentah : '.print_r(preg_replace('/['.$delimiter.']+/',$delimiter,$isi_sms),true));
			log_message('error','Add_process/saring : '.print_r($data_isisms,true));
			$ambil_total = array('id_filter' => $id_filter);
			$jumlah_filter_word = $this->Filter_Detail_Model->gets($ambil_total ,'word');
			// totalnya 
			$jum_word = count($jumlah_filter_word);

			foreach($tmp as $t)
			{
				//$value_filter = ;
				$valid = false;
				//jika messages
				if($t->type_filter == 'messages')
				{
					if($t->type_regex != 'type')
					{
						switch($t->type_regex)
						{
							case '=' :
							
								if(isset($data_isisms[$t->word-1]))
								{
									//set to strtoupper
									if($jum_word-1 == $t->word-1)
									{
										$dumay = false;
										for($j=$t->word-1; $j < count($data_isisms); $j++){
											if($dumay){
												$dumay .= ' '.$data_isisms[$j];
											}else{
												$dumay = $data_isisms[$j];
											}
										}
										if(strtoupper($t->regex_data) == strtoupper($dumay))
										{
											$valid = true;
										}											
									}
									else
									{
										if(strtoupper($t->regex_data) == strtoupper($data_isisms[$t->word-1]))
										{
											$valid = true;
										}
									}
								}
							break;
							case 'start_with' :
								if(isset($data_isisms[$t->word-1]))
								{
									if($jum_word-1 == $t->word-1)
									{
										$dumay = false;
										for($j=$t->word-1; $j < count($data_isisms); $j++){
											if($dumay){
												$dumay .= ' '.$data_isisms[$j];
											}else{
												$dumay = $data_isisms[$j];
											}
										}
										if(preg_match('/^'.$t->regex_data.'/',$dumay))
										{
											$valid = true;
										}										
									}
									else
									{
										if(preg_match('/^'.$t->regex_data.'/',$data_isisms[$t->word-1]))
										{
											$valid = true;
										}
										
									}
								}
							break;
							case 'regex' : 
								if(isset($data_isisms[$t->word -1]))
								{
									if($jum_word-1 == $t->word-1)
									{
										$dumay = false;
										for($j=$t->word-1; $j < count($data_isisms); $j++){
											if($dumay){
												$dumay .= ' '.$data_isisms[$j];
											}else{
												$dumay = $data_isisms[$j];
											}
										}
										if(preg_match('/'.$t->regex_data.'/',$dumay))
										{
											$valid = true;
										}
									}
									else
									{
										if(preg_match('/'.$t->regex_data.'/',$data_isisms[$t->word -1]))
										{
											$valid = true;
										}															
									}			
								}
							break;
						}
						
					}
					else
					{
						if(isset($data_isisms[$t->word -1]))
						{
							
							if($jum_word-1 == $t->word-1)
							{
								$dumay = false;
								for($j=$t->word-1; $j < count($data_isisms); $j++){
									if($dumay){
										$dumay .= ' '.$data_isisms[$j];
									}else{
										$dumay = $data_isisms[$j];
									}
								}
								$fr = $this->Filter_Regex_Model->get($t->id_filter_regex);
								if(preg_match($fr->regex_value,$dumay))
								{
									$valid = true;
								}								
							}
							else          
							{
								$fr = $this->Filter_Regex_Model->get($t->id_filter_regex);
								if(preg_match($fr->regex_value,$data_isisms[$t->word -1]))
								{
									$valid = true;
								}								
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
									if(preg_match('/'.$t->regex_data.'/',$number))
									{
										$valid = true;
									}
								break;
							}
							
						}else
						{
							//sementara sama dengan regex
							if(preg_match('/'.$t->regex_data.'/',$data_isisms[$t->word -1]))
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
							$logika = $logika && $valid_array[$i]['status'];
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
							$logika = $logika || $valid_array[$i]['status'];
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

	public function post_data_api($url_api=false,$report_email=false,$recive_date=false,$number=false,$data_sms=false,$getuser=false)
	{
		/**
		 * 
		 * <?xml version="1.0" encoding="UTF-8"?><xml><result><resultCode>-1</resultCode><resultMsg>Add confirmation failed</resultMsg></result></xml>
		 * **/
		log_message('error',' URL API => '.print_r($url_api,true));

		if($url_api)
		{
			$data_api = array(
			'message' => $data_sms, // Kontent SMS 
			'username' => $getuser->username,// usname user level tertinggi 
			'password' => $getuser->password, // password user level tertinggi 
			'tanggal' => $recive_date, // tanggal konfirmasi (sms diterima di mesin) 
			'key' => $getuser->api_key, // Api key user tertinggi 
			'number' => $number // password user tertinggi 
			);
			
			$respons = $this->curl->simple_post($url_api,$data_api);
			log_message('error',' response dari curl => '.print_r($respons,true));
			if($respons)
			{
				$res = simplexml_load_string($respons);
				$str = $res->result->resultCode;
				$resultMsg = $res->result->resultMsg;
				$statusres = sprintf($str);
				$msg = sprintf($resultMsg);
				if($statusres == '1')
				{
					return TRUE;
				}
				else
				{
					// send email report ke $report_email
					$this->load->model('Config_smtp_model');
					$config = $this->Config_smtp_model->get();
					if($config)
					{
						$parameter_email = new  StdClass();
						$parameter_email->from = $config->username;
						$parameter_email->from_name = 'Rumahweb SMS Gateway';
						$parameter_email->to = $report_email;
						$parameter_email->message = 'Error = '.$msg.' Failure API Data ='.$number.', Content =>'.$data_sms.', Post To URL API = '.$url_api;
						$parameter_email->subject = 'Failure => From API';
						$send = send_email($config,$parameter_email);
						if($send == '1')
						{
							return TRUE;
						}
					}
				}
			}
			else
			{
				// send email report ke $report_email
				$this->load->model('Config_smtp_model');
				$config = $this->Config_smtp_model->get();
				if($config)
				{
					$parameter_email = new  StdClass();
					$parameter_email->from = $config->username;
					$parameter_email->from_name = 'Rumahweb SMS Gateway';
					$parameter_email->to = $report_email;
					$parameter_email->message = 'Error Failure API DOWN Data ='.$number.', Content =>'.$data_sms.', Post To URL API = '.$url_api.' IS DOWN..';
					$parameter_email->subject = 'Failure => API Is Down';
					$send = send_email($config,$parameter_email);
					if($send == '1')
					{
						return TRUE;
					}
				}
			}

		}
		return FALSE;

	}
	
}
