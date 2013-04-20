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
				$html .='<input type="checkbox" id="group_'.$g->id_groupname .'" value="'.$g->id_groupname .'">' . $g->nama_group;
				$html .='</label>';	
				$html .='</div>';

			}
			
		}
		
		echo $html;
		
	}
	
	
	public function get_count()
	{
		$html = false;
		$data = $this->Group_Model->get_count();
		if($data)
		{
			foreach($data as $d)
			{
				$html .='<tr>';	
				$html .='<td><input type="checkbox" value="'.$d->id_group.'"></td>';	
				$html .='<td>'.$d->nama_group.'</td>';
				$html .='<td>'.$d->jml.'</td>';
				$html .='</tr>';

			}
			
		}
		echo $html;
	}
}
