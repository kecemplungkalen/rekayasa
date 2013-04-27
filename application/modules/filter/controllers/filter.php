<?php 

Class Filter extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->module('message');
		$this->load->model('Labelname_Model');
		$this->load->model('Filter_Model');
		$this->load->model('Filter_Regex_Model');
		$this->load->model('Filter_Action_Type_Model');
		$this->load->model('Filter_Action_Model');
		$this->load->model('Filter_Detail_Model');

	}
	
	public function index()
	{
		$side['baku'] = $this->message->sidebar_baku();
		$side['add'] =  $this->message->sidebar_adt();
		$this->load->view('header_view');
		$this->load->view('navbar_view');
		$this->load->view('sidebar_view',$side);
		$this->load->view('filter_top_button_view');
		$this->load->view('filter_view');
		//$this->load->view('modal/filter_modal_edit');
		$this->load->view('footer_view');
		
		
	}
	
	public function add_filter_modal()
	{
		$data['label'] = $this->Labelname_Model->gets();
		$data['filter_regex'] = $this->Filter_Regex_Model->gets();
		$data['filter_action_type'] = $this->Filter_Action_Type_Model->gets();
		$this->load->view('modal/filter_modal_coba',$data);
	}	
	
	public function edit_filter_modal()
	{
		
	}
	
	public function add_filter()
	{
		$nama_filter = $this->input->post('nama_filter');
		$id_filter = $this->Filter_Model->add($nama_filter);
		if($id_filter)
		{
			//insert per row pada filter_detail
			$data = false;
			$input_type_filter = false;
			$input_word = false;
			$input_type_regex = false;
			$input_regex_data = false;
			$input_add_rule = false;
			$input_order = false;
			$input_filter_regex = false;
			$type_filter = $this->input->post('type_filter');
			$word = $this->input->post('word');
			$type_regex = $this->input->post('type_regex');
			$regex_data = $this->input->post('regex_data');
			$add_rule = $this->input->post('add_rule');
			for($i=0;$i < count($type_filter);$i++)
			{
				$input_type_filter = $type_filter[$i];
				//jik number ignor word	
				if($type_filter[$i] == 'number')
				{
					$input_word = '';
				}
				else
				{
					$input_word = $word[$i];
				}
				
				//jika type add filter_regex 
				if($type_regex[$i] == 'type')
				{
					
					$input_filter_regex = $filter_regex[$i];
				}
				else
				{
					$input_filter_regex = '';
				}
				
				$input_type_regex = $type_regex[$i];
				//regex_data
				$input_regex_data = $regex_data[$i];
				$input_add_rule = $add_rule[$i];
				$input_order = $i+1;
				
				// insert ke database 
				$data = array(
				'id_filter' => $id_filter,
				'type_filter' => $input_type_filter,
				'word' => $input_word,
				'type_regex' => $input_type_regex,
				'id_filter_regex' =>$input_filter_regex,
				'regex_data' => $input_regex_data,
				'add_rule' => $input_add_rule,
				'order' => $input_order
				);
				
				$id_filter_detail = $this->Filter_Detail_Model->add($data); 
				
			}
			
			$filter_action_type = $this->input->post('filter_action_type');
			$label = $this->input->post('label');
			$api_post = $this->input->post('api_post');
			$api_error_email = $this->input->post('api_error_email');
			
			//insert per row pada filter action
			$action = false;
			$add = false;
			for($j=0;$i < count($filter_action_type);$i++)
			{
				//
				$action = array(
				'id_filter' => $id_filter,
				'id_filter_action_type' => $filter_action_type[$i],
				'id_label' => $label[$i],
				'api_post' => $api_post[$i],
				'api_error_email' => $api_error_email,
				'order' => $i+1
				);
				
				$add = $this->Filter_Action_Model->add($action);
			}
			
		}
		
	} 

}
