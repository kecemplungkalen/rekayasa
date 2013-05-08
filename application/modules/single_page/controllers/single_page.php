 <?php 

Class Single_page extends MX_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Address_Book_Model');
		$this->load->library('curl');		
	}
	
	public function index()
	{
		$this->load->view('header_view');
		$data['data'] = $this->Address_Book_Model->gets();
		$this->load->view('single_page_view',$data);
		$this->load->view('footer_view');
	}

	public function insert()
	{
		$data = $_POST;
		$tmp = false;
		$temp = false;
		if(is_array($data))
		{
			if(isset($data['checkbox']))
			{
				$temp['number'] = $data['number_box'];
			}
			else
			{
				$temp['number'] = $data['number'];
			}
			$temp['text'] = $data['text'];
			
			$tmp[]= $temp;
		}
		$ret = $this->curl->simple_post(base_url().'send',$tmp);
		echo  $ret;
	}
} 
