<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {

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
		$this->load->view('welcome/test');
		//$this->renderTemp_noData('welcome/welcome', 'Welcome to our site!');
	}
	
	public function under_construction(){
		$this->renderTemp_noData('welcome/under_construction','Website being built: Come back soon!');
	}
	
	public function help(){
		$this->renderTemp_noData('welcome/help', 'Help/FAQ - Your questions answered!');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */