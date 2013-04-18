<?php 

Class Dashboard_data extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('inbox_model');
		$this->load->model('address_book_model');
	}
	
	
	
	public function get_data_inbox()
	{
		$data_number = false;
		$c = 1;
		$number = false;
		$number1 = false;
		
		$data_inbox = $this->inbox_model->gets();
		if($data_inbox)
		{
			//var_dump($data_inbox);
			
			foreach($data_inbox as $di)
			{

				$data_book = $this->address_book_model->get_where('id_address_book',$di->id_address_book);
				if($data_book)
				{
					$number1[] = $data_book->number;
				}
			}
			$jumlah_num = array_count_values($number1);

			var_dump($jumlah_num);

		}

	}

}
