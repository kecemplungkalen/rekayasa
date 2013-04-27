<?php 

Class Label extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->module('message');
		$this->load->model('Labelname_Model');
		$this->load->model('Label_List_Model');
	}
	
	public function index($start=0)
	{
		$reload =false;
		if($this->input->post('reload')){
			$reload=true;
		}
		$data['reload'] = $reload;
		

		if(!$data['reload']){
		$side['baku'] = $this->message->sidebar_baku();
		$side['add'] =  $this->message->sidebar_adt();
		$this->load->view('header_view');
		$this->load->view('navbar_view');
		$this->load->view('sidebar_view',$side);
		$this->load->view('label_top_button_view');
		}

		# define search key value
		$keyword = false;
		if($this->input->post('keyword')){
			if($this->input->post('keyword') != ''){
				$keyword = $this->input->post('keyword');
			}
		}
		$perpage = 5 ;
				
		$data['data'] = $this->data_label($perpage,$start,$keyword);
		//reload
		
		//total row 
		if($keyword)
		{
			$total = $this->Labelname_Model->get_add($perpage=false,$start=false,$keyword);
		}
		else
		{
			$total = $this->Labelname_Model->get_add();
		}
		$data['paging'] = $this->paging(count($total),$perpage);
		$this->load->view('additional_label_view',$data);
		
		if(!$data['reload']){
			$this->load->view('footer_view');
		}
	}	

	function data_label($perpage=false,$start=false,$keyword=false)
	{
		$tmp = false;
		$temp =false;

		$label_list = $this->Labelname_Model->get_add($perpage,$start,$keyword);
		if($label_list)
		{
	
			foreach($label_list as $llist)
			{
				$temp['id_labelname'] = $llist->id_labelname;
				$temp['color'] = $llist->color;
				$temp['last_recive'] = $this->Label_List_Model->get_last_message($llist->id_labelname,1);
				$temp['name'] = $llist->name;
				$tmp[] = $temp;
			}
			$data['data'] = $tmp;
		}
		return $tmp;
	}

	public function system()
	{
		$side['baku'] = $this->message->sidebar_baku();
		$side['add'] =  $this->message->sidebar_adt();
		
		$this->load->view('header_view');
		$this->load->view('navbar_view');
		$this->load->view('sidebar_view',$side);
		$this->load->view('label_system_top_button_view');
		//$this->load->view('modal/label_system_modal_edit');
		$label_list = $this->Labelname_Model->gets_system_label();
		if($label_list)
		{
			$tmp = false;
			$temp =false;

			foreach($label_list as $llist)
			{
				$temp['id_labelname'] = $llist->id_labelname;
				$temp['color'] = $llist->color;
				$temp['last_recive'] = $this->Label_List_Model->get_last_message($llist->id_labelname);
				$temp['name'] = $llist->name;
				$tmp[] = $temp;
			}
			$data['data'] = $tmp;

		}
		$this->load->view('system_label_view',$data);
		$this->load->view('footer_view');
		
		
	}	
	
	
	function paging($total_rows=false,$perpage=false)
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url().'label/index/';
		$config['per_page'] = $perpage;
		$config['total_rows'] = $total_rows;
		$config['uri_segment'] = $this->uri->total_segments();
		$this->pagination->initialize($config); 
		return $this->pagination->create_links();

	}
	
	
	public function edit_system_label($id_labelname=false)
	{
		if($id_labelname)
		{
			$data['label'] = $this->Labelname_Model->get($id_labelname);
			$this->load->view('modal/label_system_modal_edit',$data);
		}
	}
	
	public function edit_additional_label($id_labelname=false)
	{
		if($id_labelname)
		{
			$data['label'] = $this->Labelname_Model->get($id_labelname);
			$this->load->view('modal/label_modal_edit',$data);
		}
	}
	
	public function add_additional_label()
	{
		$this->load->view('modal/label_modal_add');
	}
	
	public function edit_ceklabel($id_labelname=false)
	{
		$name = $this->input->post('edit_label_name');
		if($id_labelname)
		{
			$cek = $this->Labelname_Model->cek_edit_label($id_labelname,$name);
			if($cek)
			{
				echo 'false';
			}
			else
			{
				echo 'true';
			}
		}
		else
		{
			return false;
		}
	}
	
	public function add_ceklabel()
	{
		$name = $this->input->post('add_label_name');
		if($name)
		{
			$res = $this->Labelname_Model->cek($name);
			if($res)
			{
				echo 'false';
			}
			else
			{
				echo 'true';
			}
			
		}
	}
	
	public function add_label()
	{
		$name = $this->input->post('add_label_name');
		$color = $this->input->post('radio1');
		$add_label = $this->Labelname_Model->add($name,$color);
		if($add_label)
		{
			return $add_label;
		}
		else
		return false;
		
	}
	public function edit_label()
	{
		$id_labelname = $this->input->post('id_labelname');
		$name = $this->input->post('edit_label_name');
		$color = $this->input->post('radio1');
		if($name)
		{
			$update = $this->Labelname_Model->update($id_labelname,$name,$color);
			if($update)
			{
				return true;
			}
			else 
			{
				return false;
			}
		}else
		{
			$update = $this->Labelname_Model->update_label_system($id_labelname,$color);
			if($update)
			{
				return true;
			}else
			{
				return false;
			}	
		}
	}
	
	
	public function hapus_label()
	{
		$id_labelname = $this->input->post('id');
		if($id_labelname)
		{
			for($i=0;$i < count($id_labelname);$i++)
			{
				$this->Labelname_Model->delete($id_labelname[$i]);
			}
		}
	}
	
}

