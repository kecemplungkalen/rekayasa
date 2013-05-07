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
		//thread label yg di remove  
		
		$thread = $this->input->post('id');
		if($thread)
		{	$stat = false;
			for($i=0;$i < count($thread); $i++)
			{
				$where = array('thread'=>$thread[$i]);
				$data = array('is_delete' => '1');
				$update = $this->inbox_model->update_where($where,$data);
				if($update)
				{
					
					$stat = true;
				} 
				
				/*
				$get_id_inbox = $this->inbox_model->gets_where('thread' ,$thread[$i]);
				if($get_id_inbox)
				{
					foreach($get_id_inbox as $gid)
					{
						$data = array('id_labelname' => '1','id_inbox' => $gid->id_inbox);		
						$this->label_model->add($gid->id_inbox,'4');
					}
					$stat = true;
				}
				*/
				
			}
			$jum = $stat && $stat;
			if($jum)
			{
				echo 'true';
			}
		}
		else
		echo 'false';
		
	}
	
	public function apply_label()
	{
		$id_labelname = $this->input->post('id_label');
		$thread = $this->input->post('thread');
		$data = false;
		$sama  = false;
		$arr1 = false;
		for($i=0;$i < count($thread);$i++)
		{
			// ambil list id 
			//var_dump($thread);
			$id_pesan = $this->inbox_model->gets_where('thread',$thread[$i]);

			if($id_pesan)
			{
				
				$delete =false;
				foreach($id_pesan as $idp)
				{
					// dapat id inbox
					$delete = $this->label_model->delete_in($idp->id_inbox);
				// tambahkan label baru
					
					for($j=0;$j < count($id_labelname);$j++)
					{
						$data = $this->label_model->add($idp->id_inbox,$id_labelname[$j]);
						if($data)
						{
							//var_dump($data);
							$arr1=true;
						}
					}

				}
			}
		}

		$dumy = $arr1 && $arr1;
		if($dumy)
		{
			echo 'true';
		}else
		{
			echo 'false';
		}

		
	}
	
	public function hapus_label()
	{
		$thread = $this->input->post('thread');
		$id_labelname = $this->input->post('id_labelname');
		$get_data = $this->inbox_model->gets_where('thread',$thread);
		if($get_data)
		{
			
			foreach($get_data as $gd)
			{
				$data = array('id_inbox' => $gd->id_inbox,'id_labelname' => $id_labelname);
				$this->label_model->delete_where($data); 
			}
			echo 'true';
		}else
		echo 'false';
		
	}
	
	function get_label_thread()
	{
		$thread = $this->input->post('thread');
		if($thread)
		{
			for($i=0;$i < count($thread);$i++)
			{
				$result = $this->inbox_model->gets_where('thread',$thread[$i]);
				$cil= false;
				if($result)
				{
					$id_inbox_ar = false;
					foreach($result as $res)
					{
						$cil[] = $res->id_inbox;						
					}

					$id_inbox_ar = $cil;
					//ambil id nama label di label (wafer 2);
					$comot_id_labelname = $this->label_model->search_in('id_inbox',$id_inbox_ar);
					$insert_labelname = false;
					$lbl_name = false;
					if($comot_id_labelname)
					{
						$hasil = false;
						foreach($comot_id_labelname as $id_labelname)
						{
							$lbl_name[] = $id_labelname->id_labelname;
							
							//$insert_labelname[]= $lbl_name; // dapat id_labelname
						}
						$hasil = array_unique($lbl_name);
						$ret = array_values($hasil);
						echo json_encode($ret);
					}
				}
				
			}
			
		}
		return false;
	}
	
	public function set_archive()
	{
		// ganti thread 
		
		$thread = $this->input->post('thread');
		if($thread)
		{
			for($i=0;$i < count($thread); $i++)
			{
				$data = array('thread' => $thread[$i],'status_archive' => '0');
				$get = $this->inbox_model->arr_wheres($data);
				// dapat inbox
				if($get)
				{
					foreach($get as $g)
					{
						// set archive by  id inbox
						$up = array('status_archive' => '1');
						$this->inbox_model->update($g->id_inbox,$up); 
						// hapus di label
						$id_label = $this->label_model->set_archive($g->id_inbox);
						if($id_label)
						{
							$this->label_model->delete($id_label->id_label);
						}
						
					}
					
				}
			}
		}
		
	}
	
	
	public function modal_body($thread=false,$label=false)
	{
		//$thread = $this->input->get('thread');
		//$label = $this->input->get('label');
		$data = false;
		if($thread && $label)
		{
			$data['data'] = $this->read_sms($thread,$label);
		}
		$this->load->view('modal/read_sms_modal_body',$data);
	}
	
	public function read_sms_modal()
	{
		$thread = $this->input->get('thread');
		$label = $this->input->get('label');
		$data = false;
		if($thread && $label)
		{
			$data['data'] = $this->read_sms($thread,$label);
		}
		$this->load->view('modal/read_sms_modal_view',$data);
	}
	
	function read_sms($thread=false,$label=false)
	{
		// label dipakai untuk masa depan saja 
		if($thread && $label)
		{
			$temp = false;
			$tmp = false;
			$label = false;
			$unread = false;
			$mark = false;
			$sms = $this->inbox_model->gets_where('thread',$thread);
			if($sms)
			{

				foreach($sms as $isi)
				{
					$tmp['thread'] = $thread;
					$tmp['lbl'] = $label;
					$tmp['status_archive'] = $isi->status_archive;
					//cek label
					//$tmp['label'] = false; 
					$tmp['id_inbox'] = $isi->id_inbox;
					$label_sms = $this->label_model->get_by_id_inbox($isi->id_inbox);
					if($label_sms)
					{
						$lb = false;
						$lbtem = false;
						foreach($label_sms as $ls)
						{
							$lab = $this->Labelname_Model->get($ls->id_labelname);
							if($lab)
							{
								$lb['name'] = $lab->name;
								$lb['color'] = $lab->color;
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

					$temp[]=$tmp;
				}
				return $temp;
				
			}
		}
		return false;
	}

}
