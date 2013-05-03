<?php 

Class Dashboard_data extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('inbox_model');
		$this->load->model('Address_Book_Model');
		$this->load->model('label_model');
		$this->load->model('Labelname_Model');
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
	
	public function read_sms_modal()
	{
		$number = $this->input->get('number');
		$label = $this->input->get('label');
		$data = false;
		if($number && $label)
		{
			$data['data'] = $this->read_sms($number,$label);
		}
		$this->load->view('modal/read_sms_modal_view',$data);
	}
	
	function read_sms($number=false,$label=false)
	{
		// label dipakai untuk masa depan saja 
		if($number && $label)
		{
			$temp = false;
			$tmp = false;
			$label = false;
			$unread = false;
			$mark = false;
			$sms = $this->inbox_model->gets_where('number',$number);
			if($sms)
			{

				foreach($sms as $isi)
				{
					//cek label
					//$tmp['label'] = false; 
					$label_sms = $this->label_model->get_by_id_inbox($isi->id_inbox);
					if($label_sms)
					{
						$lb = false;
						$lbtem = false;
						foreach($label_sms as $ls)
						{
							$label = $this->Labelname_Model->get($ls->id_labelname);
							if($label)
							{
								$lb['name'] = $label->name;
								$lb['color'] = $label->color;
								$lbtem[] = $lb;
							} 
						}
						// dapat label sms 
						$tmp['label'] =  $lbtem;
					}
					//
					$tmp['recive_date'] = $isi->recive_date;
					$tmp['content'] = $isi->content;
					//cek phonebook 
					$has_address = $this->Address_Book_Model->get($isi->id_address_book);
					if($has_address)
					{
						$tmp['first_name'] = $has_address->first_name;
						$tmp['last_name'] = $has_address->last_name;
					}
					$tmp['number'] = $isi->number;
					$tmp['read_status'] = $isi->read_status;
					if($isi->read_status != '1')
					{
						$up = array('read_status' => '1');
						$this->inbox_model->update($isi->id_inbox,$up);
						//$unread = $isi->id_inbox;
					}
					//$mark[] = $unread;
					$tmp['tempat'] = $label;
					$temp[]=$tmp;
				}
				return $temp;
				
			}
		}
		return false;
	}

}
