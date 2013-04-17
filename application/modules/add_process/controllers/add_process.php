<?php 

Class Add_process extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('curl');
	}
	
	public function index()
	{
		/// data dari sms gateway 	
		$data = $_POST;
		if(is_array($data))
		{
			$number = $data['number'];
			$isisms = $data['isi_sms'];
			
			$address_book = $this->address_book_model->cari('number',$number);
			if($address_book)
			{
				
			}
			else
			{
				//tambah ke phone book tambah ke group no group 
				//$tambah_address_book = array('first_name' => $number,'number' => $number); 
				//$this->
			}
		}
		
		
		//di return langsung  
		
	}	
	
	
	public function post_data()
	{
		/*
		 * test saja 
		$data = array('number' => '+62819678420' , 'isi_sms' => 'test saja Loh.. :-)'); 
		$return = $this->curl->simple_post('http://localhost/rekayasa/add_process',$data);
		
		echo $return;
		*/
	}
	
}
