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
	
	
	function get_group()
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
	
	function apply_group()
	{
		$id_address_book = $this->input->post('address');
		$group = $this->input->post('group');
		$id_user = '1';
		if($id_address_book && $group)
		{
			for($i=0;$i < count($id_address_book);$i++)
			{
				$hapus = $this->Group_Model->delete('id_address_book',$id_address_book[$i]);
				if($hapus)
				{
					for($j=0;$j < count($group);$j++)
					{
						$add = $this->Group_Model->add($id_address_book[$i],$group[$j],$id_user);
					}
				}
				
			}
			echo 'true';
		}
		return false;
	}
	
	function get_value_group()
	{
		$address_book = $this->input->get('address');
		if($address_book)
		{
			for($i=0;$i < count($address_book);$i++)
			{
				$result = $this->Group_Model->gets_by('id_address_book',$address_book[$i]);
				if($result)
				{
					$gr = false;
					foreach($result as $res)
					{
						$gr[] = $res->id_groupname;
						
					}
					echo json_encode($gr);
				}
				
			}
		}
		return false;
	}
	
	function hapus_group()
	{
		$id = $this->input->post('id');
		$dumy = false;
		if($id)
		{
			if(is_array($id))
			{
				$data = false;
				for($i=0;$i < count($id);$i++)
				{
					$data = array('id_groupname' => $id[$i]);
					$del = $this->Groupname_Model->delete($data);
					if($del)
					{
						$dumy = true;
					}
				}
				$dumy = $dumy && $dumy;
				if($dumy)
				{
					echo 'true';
					return true;
				}
			}
			else
			{
				$data = array('id_groupname' => $id[$i]);
				$del = $this->Groupname_Model->delete($data);
				if($del)
				{
					$dumy = true;
				}
				if($dumy)
				{
					echo 'true';
					return true;
				}				
			}
			
			
		}
		else
		echo 'false';
		return false;
		
	}

	function ceknumber()
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
	
	
	function show_group()
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
	
	function cekgroup()
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
	
	function add_group_name()
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
	
	function edit_cekgroup()
	{
		$nama_group = $this->input->post('input_nama_group');
		$id_groupname = $this->input->post('id_groupname');
		$cek = $this->Groupname_Model->cek_edit($id_groupname,$nama_group);
		if($cek)
		{
			echo 'false';
		}else
		echo 'true';
	}
	
	function update_group()
	{
		$id_groupname = $this->input->post('input_id_groupname');
		$nama_group = $this->input->post('input_nama_group');
		$color = $this->input->post('radio1');
		
		$update = $this->Groupname_Model->update($id_groupname,$nama_group,$color);
		if($update)
		{
			$getdata = $this->Group_Model->get_count();
			if($getdata)
			{
				$html = false;
				foreach($getdata as $g)
				{
					$html .='<tr onclick="editgroup('.$g->id_groupname .')">';
					$html .='<td><input class="checkbox" id="id_group_'.$g->id_groupname.'" type="checkbox" name="id_group[]" value="'.$g->id_groupname.'" ></td>' ;
					$html .='<td> '.$g->nama_group.'</td>'; 
					$html .='<td>'.$g->jml.'</td>'; 
					$html .='<td><span class="label badge-'.$g->color.'">&nbsp;&nbsp;</span></td>';
					$html .='</tr>';
				}
				echo $html;
			}
		}	
	}
}
