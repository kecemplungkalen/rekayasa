<?php 

Class Dashboard extends MY_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->module('message');
		$this->load->model('inbox_model');
		$this->load->model('label_model');
		$this->load->model('Address_Book_Model');
		//$this->load->library('curl');

	}
	
	public function index()
	{
		$this->message->index('inbox');		
	}	
	
	function dummy()
	{
		var_dump($_POST);
	}
	function insert()
	{
		//$this->load->model('Groupname_Model');
		$this->load->model('Group_Model');
		
		$this->load->module('send');
		#+6287838743087
		$data = $_POST;
		//var_dump($data);
		
		$tmp = false;
		$temp = false;
		if(is_array($data))
		{
			$status = false;
			if($data['checkbox'] == '1')
			{
				// ambil number di group
				if(isset($data['number_box']))
				{
					$numbox = $data['number_box'];
					if(is_array($numbox))
					{
						$tempz = false;
						for($i=0;$i<count($numbox);$i++)
						{
							$get_group = $this->Group_Model->gets_by('id_groupname',$numbox[$i]);
							
							if($get_group)
							{
								foreach($get_group as $gg)
								{
									$tempz[] = $gg->id_address_book;
								}
							}
						}
						$result = array_unique($tempz); // array unique 
						$numb = false;
						$data_number = $this->Address_Book_Model->gets_where_in('id_address_book',$result);
						$val = false;
						if($data_number)
						{
							$arr = false; 
							foreach($data_number as $dn)
							{
								$arr['number'] = $dn->number; ;
								$arr['text'] = $data['text'];
								$arr['id_user'] = $data['id_user'];
								$val[]= $arr;								
							}	
						}
						$ret = $this->send->local_send($val);
						if($ret)
						{
							if(isset($data['id_draft']))
							{
								$this->inbox_model->delete($data['id_draft']);
							}
							$status = true;
						}																	
					}
				}
				
			}
			else
			{
				if(is_array($data['number']))
				{
					$num = $data['number'];
					for($i=0;$i< count($num);$i++)
					{
						$temp['number'] = $num[$i];
						$temp['text'] = $data['text'];
						$temp['id_user'] = $data['id_user'];
						$tmp[]= $temp;
						$ret = $this->send->local_send($tmp);
						if($ret)
						{
							$status = true;
						}					
					}
				}
				else
				{
					$temp['number'] = $data['number'];
					$temp['text'] = $data['text'];
					$temp['id_user'] = $data['id_user'];
					$tmp[]= $temp;
					$ret = $this->send->local_send($tmp);
					if($ret)
					{
						if(isset($data['id_draft']))
						{
							$this->inbox_model->delete($data['id_draft']);
						}
						$status = true;
					}					
				}
			}
			$status = $status && $status;
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
		return false;

	}
	
	function save_draft()
	{
		$data = $_POST;
		$tmp = false;
		$temp = false;
		$id_address_book = 0;
		$thread = false;
		if(is_array($data))
		{
			$number = false;
			if(isset($data['checkbox']))
			{
				$temp['number'] = $data['number_box'];
			}
			else if(isset($data['number']))
			{
				$temp['number'] = $data['number'];
			}
			$temp['text'] = $data['text'];
			//$tmp[]= $temp;
			
			// cek number di address
			
			$ceknum = $this->Address_Book_Model->get_where('number',$temp['number']);
			if($ceknum)
			{
				$id_address_book = $ceknum->id_address_book;
			}
			
			if(isset($data['thread']))
			{
				$thread = $data['thread'];
			}
			else
			{
				$thread = mt_rand();
			}
			$id_user = $data['id_user'];
			$time = time();
			$add = array(
			'number' => $temp['number'],
			'content' => $temp['text'],
			'id_address_book' => $id_address_book,
			'thread' => $thread,
			'id_user' => $id_user,
			'read_status' => '0',
			'last_update' => $time,
			'recive_date' => $time
			);
			$draft = $this->inbox_model->add($add);
			if($draft)
			{
				$set = $this->label_model->add($draft,'3');
				if($set)
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
}
