<?php 

Class Dashboard extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->module('message');
		$this->load->model('inbox_model');
		$this->load->model('label_model');
		$this->load->library('curl');

	}
	
	public function index()
	{
		$this->message->index('inbox');		
	}	
	
	public function insert()
	{
		$data = $_POST;
		$tmp = false;
		$temp = false;
		if(is_array($data))
		{
			if(isset($data['checkbox']))
			{
				$temp['number'] = $data['number_box'];
			}
			else
			{
				$temp['number'] = $data['number'];
			}
			$temp['text'] = $data['text'];
			
			$tmp[]= $temp;
			$ret = $this->curl->simple_post(base_url().'send/',$tmp);
			if($ret)
			{
				echo $ret;
			}
		}
		return false;

	}
	
	function save_draft()
	{
		$data = $_POST;
		$tmp = false;
		$temp = false;
		if(is_array($data))
		{
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
			$thread = mt_rand();
			$time = time();
			$add = array(
			'number' => $temp['number'],
			'content' => $temp['text'],
			'thread' => $thread,
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
		return false;
	}
}
