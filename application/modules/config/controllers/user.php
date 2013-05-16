<?php 
Class User extends MY_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Role_Model');
		$this->load->model('User_Model');
		$this->load->model('Ip_Restriction_Model');
	}
	
	###Tambah User## #
	function add_user()
	{
		# cek data #
		$data = $_POST;
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$username = $this->input->post('username');
		$status = $this->input->post('status');
		$status_api = $this->input->post('status_api');
		$api_key = $this->input->post('api_key');
		$ip = $this->input->post('ip');
		$password = $this->input->post('password');
		$role = $this->input->post('role');
		$date = time();
		$last_id = false;
		$stat = false;
		if(is_array($data))
		{
			$add = array(
			'first_name' => $first_name,
			'last_name' => $last_name,
			'username' => $username,
			'password' => md5($password),
			'status' => $status,
			'create_date' => $date,
			'last_update' => $date,
			'level' => $role,
			'api' => $status_api,
			'api_key' => $api_key
			);
			$last_id = $this->User_Model->add($add);
		}
		if($last_id)
		{
			$ins = false;
			for($i=0;$i < count($ip);$i++)
			{
				$ins = array('id_user' => $last_id,'ip_restriction' => $ip[$i]);
				$add_ip = $this->Ip_Restriction_Model->add($ins);
				if($add_ip)
				{
					$stat= true;
				}
			}
			
		}
		
		$stat = $stat && $stat;
		if($stat)
		{
			echo 'true';
		}
		else
		{
			echo 'false';
		}
	}
	
	# edit user data #
	
	function edit_user()
	{
		//var_dump($_POST);
		$up = false;
		$stat = false;
		$password  = false;
		$id_user = $this->input->post('id_user');
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$username = $this->input->post('username');
		$status = $this->input->post('status');
		$status_api = $this->input->post('status_api');
		$api_key = $this->input->post('api_key');
		$ip = $this->input->post('ip');
		$pass = $this->input->post('password1');
		$role = $this->input->post('role');
		$date = time();

		
		if($id_user)
		{
			if($pass != '')
			{
				$password = $pass;
				$dat = array(
				'first_name' => $first_name,
				'last_name' => $last_name,
				'username' => $username,
				'password' => md5($password),
				'status' => $status,
				'last_update' => $date,
				'level' => $role,
				'api' => $status_api,
				'api_key' => $api_key
				);
			}
			else
			{
				$dat = array(
				'first_name' => $first_name,
				'last_name' => $last_name,
				'username' => $username,
				'status' => $status,
				'last_update' => $date,
				'level' => $role,
				'api' => $status_api,
				'api_key' => $api_key
				);
	
			}
			
			$where = array('id_user' => $id_user);
			$up = $this->User_Model->update($where,$dat);
		}
		
		
		if($up)
		{
			$hap = array('id_user' => $id_user);
			$dele = $this->Ip_Restriction_Model->delete($hap);
			if($dele)
			{
				$ins = false;
				for($i=0;$i < count($ip);$i++)
				{
					$ins = array('id_user' => $id_user,'ip_restriction' => $ip[$i]);
					$add_ip = $this->Ip_Restriction_Model->add($ins);
					if($add_ip)
					{
						$stat= true;
					}
				}			
			}
			$stat = $stat && $stat;
			if($stat)
			{
				echo 'true';
			}
			else
			{
				echo 'false';
			}
		}

	}
	
	
	## show modal add user ##
	function add_user_modal()
	{
		$data['role'] = $this->Role_Model->gets();
		$this->load->view('modal/add_config_user_modal_view',$data);
	}
	
	# show modal edit user #
	function edit_user_modal()
	{	$id_user = $this->input->post('id_user');
		if($id_user)
		{
			$data['user'] = false;
			$where = array('id_user'=> $id_user);
			$data_user = $this->User_Model->get($where);
			if($data_user)
			{
				$data['user'] = $data_user;
			}
			$gez = array('id_user' => $id_user);
			$data['ip'] = $this->Ip_Restriction_Model->gets($gez); 
			$data['role'] = $this->Role_Model->gets();
			$this->load->view('modal/edit_config_user_modal_view',$data);
		}
		else
		return false;
	}
	
	## view data ##
	function get()
	{
		$tmp = false;
		$gets = $this->User_Model->gets();
		if($gets)
		{
			$temp=false;
			foreach($gets as $ge)
			{
				$temp['id_user'] = $ge->id_user;
				$temp['username'] = $ge->username;
				$data = array('id_role' => $ge->level);
				$role = $this->Role_Model->get($data);
				if($role)
				{
					$temp['level'] = $role->level;
				}
				$temp['api'] = $ge->api;
				$tmp[] = $temp;
			}
			return $tmp;
		}
		return false;
	}
	
	
	# generate random #
	function _generate_key($chars = 32)
	{
		$letters = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		return substr(str_shuffle($letters), 0, $chars);
	}
	
	# function generate #
	function rand_key()
	{
		$get = $this->_generate_key();
		if($get)
		{
			echo $get;
		}
		else
		return false;
	}
	
	
	function cek($id_user=false)
	{
		$ceking = false;
		$username = $this->input->post('username');
		if($id_user)
		{
			$ceking = array('id_user != ' => $id_user,'username' => $username);
			$cek = $this->User_Model->get($ceking);
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
			$ceking = array('username' => $username);
			$cek = $this->User_Model->get($ceking);
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
} 
