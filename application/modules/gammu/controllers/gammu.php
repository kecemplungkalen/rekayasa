<?php 

Class Gammu extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();		
		$this->load->model('Gammu_Model');
		$this->load->model('Phones_Model');
		$this->load->module('add_process');
	}
	
	public function index($id=false)
	{
		if($id)
		{
			//$proses = false;
			$data = $this->Gammu_Model->get($id);
			if($data)
			{
				// jaga -jaga jika lomncat atau delay
				if($data->Processed == 'true')
				{
					$ambil_lain = $this->Gammu_Model->get_inbox('1','0');
					if($ambil_lain)
					{
						//tambahkan ke aplikasi
						$proses = $this->add_process->index($ambil_lain);
						if($proses)
						{
							$set = array('Processed' => 'true');
							$sukses = $this->Gammu_Model->update($ambil_lain->ID,$set);
							return $sukses;
						}
						
					}
				}
				else
					{
						//lets gow//
						// tambahkan ke aplikasi 
						$this->add_process->index($data);
						$set = array('Processed' => 'true');
						$sukses = $this->Gammu_Model->update($id,$set);
						if($sukses)
						{
							return true;
						}
						/* dipakai kalau proses API sudah jalan 
						$proses = $this->add_process->index($data);
						if($proses)
						{
							$set = array('Processed' => 'true');
							$sukses = $this->Gammu_Model->update($id,$set);
							return $sukses;
						}
						*/
					}
			}
		}
		return false;	
	}
	

	
}
