<?php 

Class Label extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->module('message');
		$this->load->model('Labelname_Model');
	}
	
	public function index()
	{
		$keyword = $this->input->get('keyword');
		if($keyword)
		{
			$side['baku'] = $this->message->sidebar_baku();
			$side['add'] =  $this->message->sidebar_adt();
			$this->load->view('header_view');
			$this->load->view('navbar_view');
			$this->load->view('sidebar_view',$side);
			$this->load->view('label_top_button_view');
			//$this->load->view('modal/label_modal_edit');

			//$data['data'] = $this->Labelname_Model->get_add();
			$result = $this->search_label($keyword);
			if($result)
			{
				$data['data'] = $result;
			}else
			{
				$data['data']  = 'data tidak ditemukan';
			}
			$this->load->view('additional_label_view',$data);
			$this->load->view('footer_view');
		}else
		{
			$side['baku'] = $this->message->sidebar_baku();
			$side['add'] =  $this->message->sidebar_adt();
			$this->load->view('header_view');
			$this->load->view('navbar_view');
			$this->load->view('sidebar_view',$side);
			$this->load->view('label_top_button_view');
			//$this->load->view('modal/label_modal_edit');

			$data['data'] = $this->Labelname_Model->get_add();
			$this->load->view('additional_label_view',$data);
			$this->load->view('footer_view');

		}
		
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
		
		$data['data'] = $this->Labelname_Model->gets_system_label();
		$this->load->view('system_label_view',$data);
		$this->load->view('footer_view');
		
		
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
	
	function search_label($keyword=false)
	{
		if($keyword)
		{
			$res = $this->Labelname_Model->cari($keyword);
			if($res)
			{
				return $res;
			}
		}
		return false;
	}
	
	
	
}

