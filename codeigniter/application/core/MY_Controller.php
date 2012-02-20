<?php

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		/*
        if (!$this->session->userdata('loggedin')){
			redirect('/sessions/log_in/','refresh');
        } 
		*/
    }
	
	public function paginated_data($offset,$count,$base_url,$per_page,$uri_segment,$queryResult,$queriedItems){
		$config['base_url'] 	= $base_url;
		$config['total_rows'] 	= $count;
		$config['per_page'] 	= $per_page;
		$config['uri_segment'] 	= $uri_segment;
		
		if(is_numeric($offset)){
			$output = array_slice($queryResult, $offset, $config['per_page']);
		} else {
			$output = array_slice($queryResult, 0, $config['per_page']);
		}
		$this->pagination->initialize($config);
		
		$data['pagelinks'] 		= $this->pagination->create_links();
		$data['offset'] 		= $offset;
		//or statically set to a field in data like paginated_results?
		$data[$queriedItems]	= $output; 
		
		return $data;
	}
	
	public function renderTemp_noData($page,$title){
		$data['title'] = $title;
		$this->load->view('template/header',$data);
		$this->load->view($page);
		$this->load->view('template/footer');
	}
	
	public function renderTemp_data($page, $title, $data){
		$data['title'] = $title;
		$this->load->view('template/header',$data);
		$this->load->view($page, $data);
		$this->load->view('template/footer');
	}
}
