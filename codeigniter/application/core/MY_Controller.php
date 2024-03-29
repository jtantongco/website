<?php

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('loggedin')){
			redirect('/sessions/log_in/','refresh');
        } 
    }
	
	public function paginated_data($offset,$count,$base_url,$per_page,$uri_segment,$queryResult,$queriedItems){
		$config['base_url'] 	= $base_url;
		$config['total_rows'] 	= $count;
		$config['per_page'] 	= $per_page;
		$config['uri_segment'] 	= $uri_segment;
		
		/* No longer necessary since I figured out how to use limit and offset from MY_Model
		if(is_numeric($offset)){
			$output = array_slice($queryResult, $offset, $config['per_page']);
		} else {
			$output = array_slice($queryResult, 0, $config['per_page']);
		}
		*/
		
		$this->pagination->initialize($config);
		
		$data['pagelinks'] 		= $this->pagination->create_links();
		print_r($data);
		$data['offset'] 		= $offset;
		//or statically set to a field in data like paginated_results?
		$data[$queriedItems]	= $queryResult; 
		
		return $data;
	}
	
	
	public function allowedToView($userAccountType, $requiredAccountTypes){
		//If user not in allowed userGroup
		if(!(in_array($userAccountType,$requiredAccountTypes))){
			redirect('/sessions/not_allowed/','refresh');
		}
	}
	
	/*
	//Redirects to not allowed page if not parent_uid is not a family owner of a family child has joined
	//Does nothing if child is a member of a 
	public function parent_allowedToView($child_uid,$parent_uid){
		$this->load->model('families_model');
		$this->load->model('join_family_model');
		
		if((!is_numeric($child_uid)) || (!is_numeric($parent_uid))){
			return false;
		}
		
		//get all families that child has joined
		$where = array(	'joiner' => $child_uid );
		$joinedFamilies = $this->join_family_model->get_many_by($where);
		
		$familyHeads = array();
		
		//get all the family heads of the families taht child has joined
		foreach($joinedFamilies as $joinedFamily){
			$family = $this->families_model->get($joinedFamily->family_id);
			array_push($familyHeads,$family->parent_id);
		}
		
		if(!(in_array($parent_uid,$familyHeads))){
			redirect('/sessions/not_allowed/','refresh');
		}
	}
	*/
	
	public function renderTemp_noData($page, $title) {
		$data['title'] = $title;
		$accountType = $this->session->userdata('aid');
		
		switch ($accountType) {
			case 0: 
				$this->load->view('templates/LI_header', $data);
				$this->load->view($page);
				$this->load->view('templates/LI_footer');
				break;
			default:
				redirect('/sessions/log_in/','refresh');
		}
	}
	
	public function renderTemp_data($page, $title, $data){
		$data['title'] = $title;
		$accountType = $this->session->userdata('aid');
		
		switch ($accountType) {
			case 0:
				$this->load->view('templates/LI_header', $data);
				$this->load->view('templates/LI_notice', $data);
				$this->load->view($page, $data);
				$this->load->view('templates/LI_footer');
				break;
			default:
				redirect('/sessions/log_in/','refresh');
		}
	}
}
