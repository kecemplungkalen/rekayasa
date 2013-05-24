<?php 

Class Dashboard_data extends MY_Controller{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('inbox_model');
		$this->load->model('Address_Book_Model');
		$this->load->model('label_model');
		$this->load->model('Labelname_Model');
		$this->load->model('Blacklist_Model');
	}
	
	function get_addr()
	{
		$keyword = $this->input->post('query');
		$dataresult = $this->Address_Book_Model->search($keyword);
		$data = false;
		if($dataresult)
		{
			foreach($dataresult as $res)
			{
				$data[] = array(
				'id_address_book' => $res->id_address_book,
				'first_name' => $res->first_name,
				'last_name' => $res->last_name,
				'number' => $res->number
				);
				
			}
			echo json_encode($data);
		}
		else
		return false;
		
	}
	function remove_from_trash()
	{
		$thread = $this->input->post('thread');
		$dummy = false;
		if($thread)
		{
			if(is_array($thread))
			{
				for($i=0;$i < count($thread) ;$i++)
				{
					$where = array('thread' => $thread[$i]);
					$data = array('is_delete' => '0');
					$remove_tash = $this->inbox_model->update_where($where,$data);
					if($remove_tash)
					{
						$dummy = true;
					}
					
				}
				$dummy = $dummy && $dummy;
			}
			else
			{
				$where = array('thread' => $thread);
				$data = array('is_delete' => '0');
				$remove_tash = $this->inbox_model->update_where($where,$data);
				if($remove_tash)
				{
					$dummy = true;
				}			
			}
		}
		if($dummy)
		{
			echo 'true';
			
		}else
		{
			echo 'false';
		}
		
	}
	function hapus_message()
	{
		//thread label yg di remove  
		
		$thread = $this->input->post('id');
		if($thread)
		{	
			if(is_array($thread))
			{
				$stat = false;
				for($i=0;$i < count($thread); $i++)
				{
					$where = array('thread'=>$thread[$i]);
					$data = array('is_delete' => '1');
					$update = $this->inbox_model->update_where($where,$data);
					if($update)
					{
						
						$stat = true;
					} 
					
				}
				$jum = $stat && $stat;
				if($jum)
				{
					echo 'true';
				}
			}
			else
			{
				$stat = false;
				$where = array('thread' => $thread);
				$data = array('is_delete' => '1');
				$update = $this->inbox_model->update_where($where,$data);
				if($update)
				{
					
					$stat = true;
				} 
				if($stat)
				{
					echo 'true';
				}
				
			}
		}
		else
		echo 'false';
		
	}
	
	function apply_label()
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
	
	function hapus_label()
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
	
	function set_archive()
	{
		// ganti thread 
		
		$thread = $this->input->post('thread');
		if($thread)
		{
			if(is_array($thread))
			{
				$ret = false;
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
								$del = $this->label_model->delete($id_label->id_label);
								if($del)
								{
									$ret = true;
								}
							}
							
						}
						
					}
				}
				$ret = $ret && $ret;
				if($ret)
				{
					echo 'true';
				}
				else
				{
					echo 'false';
				}
			}
			else
			{
				$data = array('thread' => $thread,'status_archive' => '0');
				$get = $this->inbox_model->arr_wheres($data);
				$ret = false;
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
							$del = $this->label_model->delete($id_label->id_label);
							if($del)
							{
								$ret = true;
							}
						}
						
					}
					
				}
				$ret = $ret && $ret;
				if($ret)
				{
					echo 'true';
				}
				else
				{
					echo 'false';
				}
			}
		}
		
	}
	
	
	function modal_body($thread=false,$label=false)
	{
		$thread = $this->input->get('thread');
		$label = $this->input->get('label');
		$data = false;
		
		
		if($thread && $label)
		{
			$data['data'] = $this->read_sms($thread,$label);
			$data['thread'] = $thread;
		}
		$data['list_label'] = $this->Labelname_Model->get_add();
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
			$data['thread'] = $thread;
		}
		$data['list_label'] = $this->Labelname_Model->get_add();
		$data['pbk'] = $this->Address_Book_Model->gets();
		$this->load->view('modal/read_sms_modal_view',$data);
	}
	
	function read_sms($thread=false,$label=false)
	{
		if($thread && $label)
		{
			$temp = false;
			$tmp = false;
			//$id_user = $this->session->userdata('id_user');
			$unread = false;
			$mark = false;
			$where = false;
			switch($label)
			{
				case 'trash' :
				//$where = array('is_delete =' => '1','inbox.id_user' => $id_user);
				$where = array('is_delete =' => '1');
				break;
				case 'spam' :
				//$where = array('is_delete =' => '2','inbox.id_user' => $id_user);
				$where = array('is_delete =' => '2');
				break;
				default :
				//$where = array('is_delete =' => '0','inbox.id_user' => $id_user);
				$where = array('is_delete =' => '0');
				break;
			}
			
			$sms = $this->inbox_model->gets_where('thread',$thread,$where);

			if($sms)
			{

				foreach($sms as $isi)
				{
					$tmp['is_delete'] = $isi->is_delete;
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
								$lb['id_labelname'] = $ls->id_labelname;
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
						$tmp['id_address_book'] = $has_address->id_address_book;
						$tmp['first_name'] = $has_address->first_name;
						$tmp['last_name'] = $has_address->last_name;
					}
					
					$tmp['number'] = $isi->number;
					if($isi->send_status)
					{
						$tmp['send_status'] = $isi->send_status;
					}
					$tmp['read_status'] = $isi->read_status;
					if($isi->read_status != '1')
					{
						$up = array('read_status' => '1');
						$this->inbox_model->update($isi->id_inbox,$up);
					}

					$temp[]=$tmp;
				}
				return $temp;
				
			}
		}
		return false;
	}
	
	function remove_blacklist()
	{
		$thread = $this->input->post('thread');
		if($thread)
		{
			if(is_array($thread))
			{
				
				$number = false;
				$status = false;
				for($i=0;$i < count($thread);$i++)
				{
					$data = array('thread' => $thread[$i]);
					$get_id = $this->inbox_model->arr_wheres($data);
					if($get_id)
					{
						// number
						$number = $get_id[0]->number;
						foreach($get_id as $gid)
						{
							// update id inbox
							$dwhere = array('id_inbox' => $gid->id_inbox,'id_labelname' => '5');
							$this->label_model->delete_where($dwhere);
							
						}
						$del = array('blacklist_number' => $number);
						$delete = $this->Blacklist_Model->delete($del);
						if($delete)
						{
							$id = array('thread' => $thread[$i]);
							$set = array('is_delete' => '0'); 
							$this->inbox_model->update_where($id,$set);
							$status = true;
						}
					}	
				}
				$status = $status  && $status ;
				if($status)
				{
					echo 'true';
				}
				else
				{
					echo 'false';
				}
			}
			else
			{
				$number = false;
				$status = false;
				$data = array('thread' => $thread);
				$get_id = $this->inbox_model->arr_wheres($data);
				if($get_id)
				{
					// number
					$number = $get_id[0]->number;
					foreach($get_id as $gid)
					{
						// update id inbox
						$dwhere = array('id_inbox' => $gid->id_inbox,'id_labelname' => '5');
						$this->label_model->delete_where($dwhere);
						
					}
					$del = array('blacklist_number' => $number);
					$delete = $this->Blacklist_Model->delete($del);
					if($delete)
					{
						$id = array('thread' => $thread);
						$set = array('is_delete' => '0'); 
						$this->inbox_model->update_where($id,$set);
						$status = true;
					}
				}	
				if($status)
				{
					echo 'true';
				}
				else
				{
					echo 'false';
				}				
			}			
		}
		else
		return false;
	}
	
	function mark_spam()
	{
		$thread = $this->input->post('thread');
		if($thread)
		{
			if(is_array($thread))
			{
				$id_inbox = false;
				$status = false;
				$number = false;
				for($i=0;$i<count($thread);$i++)
				{
					$data = array('thread' => $thread[$i]);
					$getspam = $this->inbox_model->arr_wheres($data);
					if($getspam)
					{
						$number = $getspam[0]->number;
						$tmp = false;
						foreach($getspam as $ges)
						{
							// tambah label spam ke label 
							$this->label_model->add($ges->id_inbox,'5');
						}
						$colok = array('blacklist_number' => $number);
						$last_id = $this->Blacklist_Model->add($colok);
						if($last_id)
						{
							//update inbox is delete = 2 
							$where = array('thread' => $thread[$i]);
							$mark = array('is_delete' => '2');
							$this->inbox_model->update_where($where,$mark);
							$status = true;
						}
						
					}
				}
				$status = $status  && $status ;
				if($status)
				{
					echo 'true';
				}
				else
				{
					echo 'false';
				}
			}
			else
			{
				$id_inbox = false;
				$status = false;
				$number = false;
				
				$data = array('thread' => $thread);
				$getspam = $this->inbox_model->arr_wheres($data);
				if($getspam)
				{
					$number = $getspam[0]->number;
					$tmp = false;
					foreach($getspam as $ges)
					{
						// tambah label spam ke label 
						$this->label_model->add($ges->id_inbox,'5');
					}
					
					$colok = array('blacklist_number' => $number);
					$last_id = $this->Blacklist_Model->add($colok);
					if($last_id)
					{
						//update inbox is delete = 2 
						$where = array('thread' => $thread);
						$mark = array('is_delete' => '2');
						$this->inbox_model->update_where($where,$mark);
						$status = true;
					}
					
				}

				if($status)
				{
					echo 'true';
				}
				else
				{
					echo 'false';
				}

			}
		}
		else
		return false;
		
	}
	function mark_unread()
	{
		$thread = $this->input->post('thread');
		$status = false;
		if($thread)
		{
			
			for($i=0;$i < count($thread);$i++)
			{
				$where = array('thread' => $thread[$i]);
				$data = array('read_status' => '0');
				$datath = $this->inbox_model->update_where($where,$data);
				if($datath)
				{
					$status = true;
				}
				
			}
			$status = $status && $status;
		}
		if($status)
		{
			echo 'true';
		}
		else
		{
			echo 'false';
		}
	}
	
	function compose_sms()
	{
		$this->load->model('Groupname_Model');
		
		$data['data'] = $this->Groupname_Model->gets();
		$this->load->view('modal/compose_sms_modal_view',$data);
	}
	
	function cekmodem()
	{
		$this->load->model('gammu/phones_model');
		$now = date('Y-m-d H:i:s');
		$where = array('TimeOut < ' => $now);
		$cekphone = $this->phones_model->where_kols($where);
		$tmp=false;
		if($cekphone)
		{
			foreach($cekphone as $chk)
			{
				$tmp[] =$chk->ID;
			}
			return $tmp;	
		} 
		return false;		
	}

}
