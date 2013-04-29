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

	}
	
	public function index()
	{
		/// data dari sms gateway 	
		//$data = $_POST;
		//if(is_array($data))
		//{
			//$number = $data['number'];
			//$isisms = $data['isi_sms'];
			$number = '+62819678420';
			$isi_sms = 'REG 123 coba Saja xxxXXX';
			
			
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
						$valid = false;
						$valid_array = false;
						foreach($tmp as $t)
						{
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
												$valid = 'true';
											}else
												{
													$valid = 'false';
												}
										break;
										case 'start_with' :
											if(preg_match('/^'.$t->regex_data.'/',$value_filter))
											{
												$valid = 'true';
											}else
												{
													$valid = 'false';
												}
										break;
										case 'regex' : 
											if(preg_match($t->regex_data,$value_filter))
											{
												$valid = 'true';
											}else
												{
													$valid = 'false';
												}
										break;
									}
									
								}else
								{
									$fr = $this->Filter_Regex_Model->get($t->id_filter_regex);
									if(preg_match($fr->regex_value,$value_filter))
									{
										$valid = 'true';
									}else
										{
											$valid = 'false';
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
													$valid = 'true';
												}else
													{
														$valid = 'false';
													}
											break;
											case 'start_with' :
												if(preg_match('/^'.$t->regex_data.'/',$number))
												{
													$valid = 'true';
												}else
													{
														$valid = 'false';
													}
											break;
											case 'regex' : 
												if(preg_match($t->regex_data,$number))
												{
													$valid = 'true';
												}else
													{
														$valid = 'false';
													}
											break;
										}
										
									}else
									{
										//sementara sama dengan regex
										if(preg_match($t->regex_data,$value_filter))
										{
											$valid = 'true';
										}else
											{
												$valid = 'false';
											}
									}
								}
							$temp[] =$valid;
						}
						$valid_array = $temp;
						//var_dump($valid_array);
					}
					
					$coba_data[] = $valid_array;
				}
				var_dump($coba_data);
				//$id_filter = $temp;
			}
			
			//filter pesan 
			
			//$filter_detail = $this->Filter_Detail_Model->gets_by_col();
			
			
			/*$address_book = $this->address_book_model->cari('number',$number);
			if($address_book)
			{
				
				
				
				
			}
			else
			{
				//tambah ke phone book tambah ke group no group 
				//$tambah_address_book = array('first_name' => $number,'number' => $number); 
				//$this->
			}
			*/
			
			
		//}
		
		
		//di return langsung  
		
	}	
	
	
	public function post_data_api()
	{
		/*
		 * test saja 
		$data = array('number' => '+62819678420' , 'isi_sms' => 'test saja Loh.. :-)'); 
		$return = $this->curl->simple_post('http://localhost/rekayasa/add_process',$data);
		
		echo $return;
		*/
	}
	
}
