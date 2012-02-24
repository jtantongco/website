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
	
	/*
	public function allowedToView($userAccountType, $requiredAccountTypes){
		//If user not in allowed userGroup
		if(!(in_array($userAccountType,$requiredAccountTypes))){
			redirect('/sessions/not_allowed/','refresh');
		}
	}
	
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
	/*
	public function renderTemp_noData($page, $title) {
		$data['title'] = $title;
		$accountType = $this->session->userdata('aid');
		
		switch ($accountType) {
			case 0: //Students
				$this->load->view('templates/LI_header', $data);
				$this->load->view($page);
				$this->load->view('templates/LI_footer');
				break;
			case 1: //Teacher
				$this->load->view('templates/LI_header_teacher',$data);
				$this->load->view($page);
				$this->load->view('templates/LI_footer_teacher');
				break;			
			case 2: //Parent
				$this->load->view('templates/LI_header_parent',$data);
				$this->load->view($page);
				$this->load->view('templates/LI_footer_parent');
				break;
			case 3: //School
				$this->load->view('templates/LI_header_school',$data);
				$this->load->view($page);
				$this->load->view('templates/LI_footer_school');
				break;
			case 4: //Partner
				$this->load->view('templates/LI_header_partner',$data);
				$this->load->view($page);
				$this->load->view('templates/LI_footer_partner');
				break;
			case 5: //Admin
				$this->load->view('templates/LI_header_admin',$data);
				$this->load->view($page);
				$this->load->view('templates/LI_footer_admin');
				break;
			default:
				redirect('/sessions/log_in/','refresh');
		}
	}
	
	public function renderTemp_data($page, $title, $data){
		$data['title'] = $title;
		$accountType = $this->session->userdata('aid');
		
		switch ($accountType) {
			case 0: //Students
				$this->load->view('templates/LI_header', $data);
				$this->load->view($page, $data);
				$this->load->view('templates/LI_footer');
				break;
			case 1: //Teacher
				$this->load->view('templates/LI_header_teacher',$data);
				$this->load->view($page, $data);
				$this->load->view('templates/LI_footer_teacher');
				break;			
			case 2: //Parent
				$this->load->view('templates/LI_header_parent',$data);
				$this->load->view($page, $data);
				$this->load->view('templates/LI_footer_parent');
				break;
			case 3: //School
				$this->load->view('templates/LI_header_school',$data);
				$this->load->view($page, $data);
				$this->load->view('templates/LI_footer_school');
				break;
			case 4: //Partner
				$this->load->view('templates/LI_header_partner',$data);
				$this->load->view($page, $data);
				$this->load->view('templates/LI_footer_partner');
				break;
			case 5: //Admin
				$this->load->view('templates/LI_header_admin',$data);
				$this->load->view($page, $data);
				$this->load->view('templates/LI_footer_admin');
				break;
			default:
				redirect('/sessions/log_in/','refresh');
		}
	}
	*/
}
