<?php 

Class Group extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->module('message');
		$this->load->model('Address_Book_Model');
		$this->load->model('Smsc_Model');
		$this->load->model('Group_Model');
		$this->load->model('Groupname_Model');
		$this->load->model('inbox_model');

	}
	
	
	public function get_group()
	{
		$html = false;
		$group = $this->Groupname_Model->gets();
		if($group)
		{
			foreach($group as $g)
			{
				$html .= '<div class="controls">';
				$html .='<label class="checkbox">';	
				$html .='<input type="checkbox" id="group_'.$g->id_groupname .'" value="'.$g->id_groupname .'" name="group">' . $g->nama_group;
				$html .='</label>';	
				$html .='</div>';

			}
			
		}
		
		echo $html;
		
	}
	
	public function hapus_group()
	{
		$id = $this->input->post('id');
		var_dump($id);
	}

	public function ceknumber()
	{
		$number = $this->input->post('number');
		$cek = $this->Address_Book_Model->get_where('number',$number);
		if($cek)
		{
			echo 'false';
		}
		else
		echo 'true'; 
	}
	
	
	public function show_group()
	{
		$id_groupname = $this->input->post('id_groupname');
		if($id_groupname)
		{
			$groupname = $this->Groupname_Model->get($id_groupname);
			if($groupname)
			{
				$data = array(
				'id_groupname' => $groupname->id_groupname,
				'nama_group' => $groupname->nama_group,
				'color'=> $groupname->color
				);
				echo json_encode($data);
			}
		}else
		return false;
	}
	
	public function cekgroup()
	{
		$nama_group = $this->input->post('group_name');
		if($nama_group)
		{
			$cek = $this->Groupname_Model->get_col('nama_group',$nama_group);
			if($cek)
			{
				echo 'false';
			}
			else
			{
				echo 'true';
			}
		}
	}
	
	public function add_group_name()
	{
		$html = false;
		$group_name = $this->input->post('group_name');
		$color = $this->input->post('radio1');
		$add = $this->Groupname_Model->add($group_name,$color);
		if($add)
		{
			$html .='<tr onclick="editgroup('.$add.');">';
			$html .='<td><input class="checkbox" id="id_group_'.$add.'" type="checkbox" name="id_group[]" value="'.$add.'" ></td>';	
			$html .= '<td>'.$group_name.'</td>' ;	
			$html .= '<td> 0 </td>' ;
			$html .= '<td><span class="label badge-'.$color.'">&nbsp;&nbsp;</span></td>' ;	
			$html .= '</tr>' ;	
			
			echo $html;
		}
	}
}


