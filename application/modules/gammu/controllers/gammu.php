<?php 

Class Gammu extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();		
		$this->load->model('Gammu_Model');
		$this->load->module('add_process');
	}
	
	public function index($id=false)
	{
		if($id)
		{
			
			$data = $this->Gammu_Model->get($id);
			if($data)
			{
				$data = $this->add_process->index($data);
				if($data)
				{
					$set = array('Processed' => 'true');
					$sukses = $this->Gammu_Model->update($id,$set);
					return $sukses;
				}
			}
		}
		return false;	
	}
	
	
}
