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
	
	public function index($start=0)
	{
		$side['baku'] = $this->message->sidebar_baku();
		$side['add'] =  $this->message->sidebar_adt();
		$data['navbar'] = $this->load->view('navbar_view','',true);
		$data['sidebar'] = $this->load->view('sidebar_view',$side,true);
		$data['top_button'] = $this->load->view('filter_top_button_view','',true);
				
		$keyword = false;
		if($this->input->post('keyword')){
			if($this->input->post('keyword') != ''){
				$keyword = $this->input->post('keyword');
			}
		}
		$perpage=5;
		//total row 
		if($keyword)
		{
			$total = $this->Filter_Model->gets_by($keyword);
		}
		else
		{
			$total = $this->Filter_Model->gets_by();
		}
		
		$view['data'] = $this->Filter_Model->gets_by($perpage,$start,$keyword);
		$view['paging'] = $this->paging(count($total),$perpage);
		if($this->input->post('reload'))
		{
			$this->load->view('filter_view',$view);
		}else
		{
			$data['content'] = $this->load->view('filter_view',$view,true);
			$this->load->view('header_view');		
			$this->load->view('body_view',$data);
			$this->load->view('footer_view');
		}
		
		
	}
	
	function paging($total_rows=false,$perpage=false)
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url().'filter/index/';
		$config['per_page'] = $perpage;
		$config['total_rows'] = $total_rows;
		$config['uri_segment'] = $this->uri->total_segments();
		$this->pagination->initialize($config); 
		return $this->pagination->create_links();

	}
	
	public function add_filter_modal()
	{
		$this->load->model('Filter_Delimiter_Model');
		$data['delimiter'] = $this->Filter_Delimiter_Model->gets();
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
		$id_delimiter = $this->input->post('delimiter');
		$id_filter = $this->Filter_Model->add($nama_filter,$id_delimiter);
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
			$filter_regex = $this->input->post('filter_regex');
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
			$insert_id_filter[] = $id_filter_detail;
			$filter_action_type = $this->input->post('filter_action_type');
			$label = $this->input->post('label');
			$api_post = $this->input->post('api_post');
			$api_error_email = $this->input->post('api_error_email');
			
			//insert per row pada filter action
			$action = false;
			$add = false;
			for($j=0;$j < count($filter_action_type);$j++)
			{
				//
				$action = array(
				'id_filter' => $id_filter,
				'id_filter_action_type' => $filter_action_type[$j],
				'id_label' => $label[$j],
				'api_post' => $api_post[$j],
				'api_error_email' => $api_error_email[$j],
				'order' => $j+1
				);
				
				$add = $this->Filter_Action_Model->add($action);
			}
			$insert_add[]=$add;
		}
		$balik = array('satu' => $insert_id_filter,'dua' => $insert_add );
		var_dump($balik);
	}
	
	public function switch_status()
	{
		$status = $this->input->post('status');
		$id_filter = $this->input->post('id_filter');
		if($status == 'enable')
		{
			$data = array('status' => '1');
			$update = $this->Filter_Model->update($id_filter,$data);
			if($update)
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
			$data = array('status' => '0');
			$update = $this->Filter_Model->update($id_filter,$data);
			if($update)
			{
				echo 'true';
			}
			else
			{
				echo 'false';
			}
		}
	}
	
	public function hapus_filter()
	{
		$id_filter = $this->input->post('id');
		if($id_filter)
		{
			$delete = $this->Filter_Model->delete($id_filter);
			if($delete)
			{
				echo 'true';
			}
		}
		echo 'true';
	}
	
	public function cek_nama_filter()
	{
		$nama_filter = $this->input->post('nama_filter');
		if($nama_filter)
		{
			$cek = $this->Filter_Model->get_by('filter_name',$nama_filter);
			if($cek)
			{
				echo 'false';
			}else{
				echo 'true';
			}
		}
		
	} 

}
