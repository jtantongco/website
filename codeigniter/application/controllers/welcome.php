<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		//$this->load->view('welcome_message');
		$this->renderTemp_noData('welcome/welcome', 'Welcome to our site!');
	}
	
	public function under_construction(){
		$this->renderTemp_noData('welcome/under_construction','Website being built: Come back soon!');
	}
	
	public function help(){
		$this->renderTemp_noData('welcome/help', 'Help/FAQ - Your questions answered!');
	}

	//Helper methods
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
	
	public function renderTemp_noData($page, $title){
		$data['title'] = $title;
		$this->load->view('templates/header', $data);
		$this->load->view($page);
		$this->load->view('templates/footer');
	}
	
	public function renderTemp_data($page, $title, $data){
		$data['title'] = $title;
		$this->load->view('templates/header', $data);
		$this->load->view($page, $data);
		$this->load->view('templates/footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */