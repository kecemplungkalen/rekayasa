<?php 

Class Dashboard_data extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('inbox_model');
		$this->load->model('address_book_model');
		$this->load->model('label_model');
	}
	
	
	
	public function hapus_message()
	{
		//id label yg di remove  
		
		//id inbox
		$id_inbox = $this->input->post('id');
		if($id_inbox)
		{
			for($i=0;$i < count($id_inbox); $i++)
			{
				//$this->inbox_model->delete($id_inbox[$i]);
				$delete = $this->label_model->delete_by('id_inbox',$id_inbox[$i]);
				if($delete)
				{
					$this->label_model->add($id_inbox[$i],'4');
				}
				
			}
		}
	}
	
	public function apply_label()
	{
		$id_labelname = $this->input->post('id_label');
		$id_pesan = $this->input->post('id_pesan');
		//var_dump($_POST);
		for($i=0;$i < count($id_pesan);$i++)
		{
			for($j=0;$j < count($id_labelname);$j++)
			{
				$data[] = $this->label_model->add($id_pesan[$i],$id_labelname[$j]);
			}
		}
		echo $data;
		//var_dump($id_pesan);
		
	}
	
	public function hapus_label()
	{
		$id_label = $this->input->post('id_label');
		if($id_label)
		{
			$delete = $this->label_model->delete($id_label);
			if($delete)
			{
				echo $delete;
			}
			else
			return false;
		}
	}
	
	public function set_archive()
	{
		$id_inbox = $this->input->post('id');
		if($id_inbox)
		{
			for($i=0;$i < count($id_inbox); $i++)
			{
				//$this->inbox_model->delete($id_inbox[$i]);
				$get = $this->label_model->set_archive($id_inbox[$i]);
				if($get)
				{
					$this->label_model->delete($get->id_label);
				}
				
			}
		}
		
	}

}
