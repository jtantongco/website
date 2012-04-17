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
		$this->load->spark('example-spark/1.0.0'); # Don't forget to add the version!
		//$this->load->spark('codeigniter-payments/0.1.4');
		$this->example_spark->printHello(); # echo's "Hello from the example spark!"
		$this->renderTemp_noData('welcome/welcome', 'Welcome to my site!');
	}
	
	public function about(){
		$this->renderTemp_noData('welcome/about', 'About me!');
	}
	
	public function blog(){
		$this->load->model('blogs_model');
		
		$offset = $this->uri->segment(3);
		
		$base_url = site_url('welcome/blog');
		$per_page = 3;
		$uri_segment = 3;
		
		$this->blogs_model->order_by( 'created', 'DESC' );
		$this->blogs_model->limit($per_page, $offset);
		$queryResult = $this->blogs_model->get_all();
		$count = $this->blogs_model->count_all();
		
		$data = $this->paginated_data($offset,$count,$base_url,$per_page,$uri_segment,$queryResult,'articles');
		
		$this->renderTemp_data('welcome/blog', 'Where Jeremiah\'s word seems legit', $data);
	}
	
	public function services(){
		$this->renderTemp_noData('welcome/services', 'What Jeremiah can do (Kinda...) ');
	}
	
	public function members(){
		$this->renderTemp_noData('welcome/members', 'Come on in!');
	}
	
	public function contact(){
		$this->form_validation->set_rules('name'	,'name',	'required');
		$this->form_validation->set_rules('email'	,'email',	'required');
		$this->form_validation->set_rules('subject'	,'subject',	'required');
		$this->form_validation->set_rules('message'	,'message',	'required');
		
		if($this->form_validation->run() === FALSE){
			$this->renderTemp_noData('welcome/contact', 'Contact Me!');
		} else {
			$this->load->helper('email');
			/* Old way -> refactor to more modern method in CI documentation -> URL: http://codeigniter.com/user_guide/libraries/email.html
			send_email(	$email, 
						'Welcome to the Worksheet Management System', 
						'This is your confirmation hash: '. $hash .
						'Please visit this link to confirm your account: ' . 
						site_url('sessions/verify/'.$new_uid.'/'.$hash) );
			*/
			$email = 'jtantongco@gmail.com';
			send_email(	$email,
						'Message from '.$this->input->post('email').' : '.$this->input->post('subject'),
						$this->input->post('message')
			);
			
			$data['check'] = 'Message sent! Jeremiah will be in contact with you soon!';
			$this->renderTemp_data( 'welcome/welcome', 'Welcome to my site!', $data);
		}
	}
	
	public function help(){
		$this->renderTemp_noData('welcome/help', 'Help/FAQ - Your questions answered!');
	}
	
	public function under_construction(){
		$this->renderTemp_noData('welcome/under_construction','Website being built: Come back soon!');
	}
		
	//Helper methods
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
		$data['offset'] 		= $offset;
		//or statically set to a field in data like paginated_results?
		$data[$queriedItems]	= $queryResult; 
		
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