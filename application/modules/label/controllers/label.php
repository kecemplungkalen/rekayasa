<?php 

Class Label extends MY_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->module('message');
		$this->load->model('Labelname_Model');
		$this->load->model('Label_List_Model');
		$this->load->model('Filter_Model');
		$this->load->model('Filter_Action_Model');
	}
	
	public function index($start=0)
	{
		$side['baku'] = $this->message->sidebar_baku();
		$side['add'] =  $this->message->sidebar_adt();
		$data['sidebar'] = $this->load->view('sidebar_view',$side,true);
		$data['navbar'] = $this->load->view('navbar_view','',true);
		$data['top_button'] = $this->load->view('label_top_button_view','',true);
	
		# define search key value
		$keyword = false;
		if($this->input->post('keyword')){
			if($this->input->post('keyword') != ''){
				$keyword = $this->input->post('keyword');
			}
		}
		$perpage = 5 ;
		$view['data'] = $this->data_label($perpage,$start,$keyword);
		//total row 
		if($keyword)
		{
			$total = $this->Labelname_Model->get_add($perpage=false,$start=false,$keyword);
		}
		else
		{
			$total = $this->Labelname_Model->get_add();
		}
		
		$view['paging'] = $this->paging(count($total),$perpage);
		
		if($this->input->post('reload'))
		{
			$this->load->view('additional_label_view',$view);
		}
		else
		{
			$this->load->view('header_view');
			$data['content'] = $this->load->view('additional_label_view',$view,true);
			$this->load->view('body_view',$data);
			$this->load->view('footer_view');
		}
	}	

	function data_label($perpage=false,$start=false,$keyword=false)
	{

		$label_list = $this->Labelname_Model->get_add($perpage,$start,$keyword);
		$tmp = false;
		if($label_list)
		{
			$tmp = false;
			$temp =false;
			$ret = false;
			foreach($label_list as $llist)
			{
				$filter = false;
				$nama_filter = false;
				$temp['filter'] = false;
				$temp['id_labelname'] = $llist->id_labelname;
				$filter = $this->Filter_Action_Model->get_advance($llist->id_labelname);
				if($filter)
				{
					$nama_filter = $this->Filter_Model->get($filter->id_filter);
					if($nama_filter)
					{
						$temp['filter'] = $nama_filter->filter_name;
					}
				}
				$temp['color'] = $llist->color;
				$temp['last_recive'] = $this->Label_List_Model->get_last_message($llist->id_labelname,1);
				$temp['name'] = $llist->name;
				$tmp[] = $temp;
			}
			$ret['data'] = $tmp;
		}
		return $tmp;
	}

	public function system()
	{
		$side['baku'] = $this->message->sidebar_baku();
		$side['add'] =  $this->message->sidebar_adt();
		
		$this->load->view('header_view');
		$data['navbar'] = $this->load->view('navbar_view','',true);
		$data['sidebar'] = $this->load->view('sidebar_view',$side,true);
		$data['top_button'] = $this->load->view('label_system_top_button_view','',true);
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
			$view['data'] = $tmp;

		}
		
		$data['content'] = $this->load->view('system_label_view',$view,true);
		$this->load->view('body_view',$data);
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
			echo 'true';
		}
		else
		echo 'false';
		
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
				echo 'true';
			}
			else 
			{
				echo 'false';
			}
		}else
		{
			$update = $this->Labelname_Model->update_label_system($id_labelname,$color);
			if($update)
			{
				echo 'true';
			}else
			{
				echo 'false';
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

