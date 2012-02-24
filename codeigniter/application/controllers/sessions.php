<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sessions extends CI_Controller {
	public function log_in(){
		$this->form_validation->set_rules('user_name'	,'user_name',	'required');
		$this->form_validation->set_rules('password'	,'password',	'required');
		
		if($this->form_validation->run() === FALSE){
			$this->renderTemp_noData(	'sessions/log_in', 
										'Log in to the Worksheet Management System');
		} else {
			$user_data = $this->users_model->get_by('user_name',$this->input->post('user_name'));
			if(!empty($user_data)){
				if($user_data->active == 1 && $user_data->acc_confirmation == 1){
					if($user_data->password == $this->input->post('password')){
						//successful log in
						//build session
						$session_data = array(
							'user_name' => $user_data->user_name,
							'uid'		=> $user_data->uid,
							'aid'		=> $user_data->aid,
							'loggedin'	=> TRUE
						);
						$this->session->set_userdata($session_data);
						//update last logged in
						$data = array(
							'last_login' =>  date("Y-m-d H:m:s")
						);
						$this->users_model->update($user_data->uid, $data);
						//display account appropriate start page
						
						$data['title'] = 'Welcome to the Worksheet Management System!';
						$data['name'] = $user_data->user_name;
						switch ($user_data->aid) {
							case 0: //General user
								$this->load->view('templates/LI_header', $data);
								$this->load->view('templates/LI_starter', $data);
								$this->load->view('templates/LI_footer');
								break;
							case 1: //Teacher
								$this->load->view('templates/LI_header_teacher',$data);
								$this->load->view('templates/LI_starter_teacher', $data);
								$this->load->view('templates/LI_footer_teacher');
								break;			
							case 2: //School
								$this->load->view('templates/LI_header_school',$data);
								$this->load->view('templates/LI_starter_school', $data);
								$this->load->view('templates/LI_footer_school');
								break;
							case 3: //Admin
								$this->load->view('templates/LI_header_admin',$data);
								$this->load->view('templates/LI_starter_admin', $data);
								$this->load->view('templates/LI_footer_admin');
								break;
							default:
								redirect('/sessions/log_in/','refresh');
						}
					} else {
						//Password doesn't match
						$data = array('reason' => 'Incorrect password or account name.');
						$this->renderTemp_data(	'sessions/log_in_fail',
												'Incorrect password or account name.',
												$data);
					}
				} else {
					//Account not active or confirmed yet
					$data = array('reason' => 'Your account is not active or has not been confirmed yet!');
					$this->renderTemp_data(	'sessions/log_in_fail',
											'Your account is not active or has not been confirmed yet!',
											$data);
				}
			} else {
				//Account not found
				$data = array('reason' => 'Your account was not found!');
				$this->renderTemp_data(	'sessions/log_in_fail',
										'Your account was not found!',
										$data);
			}
		}
	}
	
	public function __construct(){
		//controller wide specific loads are to be put here
	}
	
	public function log_in(){
		$this->load->view('welcome_message');
	}
	
	
	public function log_out(){
		$this->session->unset_userdata('loggedin');
		//$this->cart->destroy();
		//above destroys the cart as well
		//above will only kcik user out but save his session data
		//below will destroy user data
		//$this->session->sess_destroy();
		$this->renderTemp_noData(	'sessions/log_out',
									'Logged out of the Worksheet System');
	}
	
	public function sign_up(){
		$this->form_validation->set_rules('user_name',		'user_name',		'required');
		$this->form_validation->set_rules('password',		'password',			'required');
		$this->form_validation->set_rules('password_conf',	'password_conf',	'required');
		$this->form_validation->set_rules('email',			'email',			'required');
		$this->form_validation->set_rules('birthday',		'birthday',			'required');
		$this->form_validation->set_rules('country',		'country',			'required');
		
		/*Need several callback checks
		1) secondary password field, check that matches with first password -> pass
		2) call back that valid email was passed in
			-> STUB TO BE USED IN VALID EMAIL:
			if(!(valid_email($email))){
				$email = 'spam@spam.com';
			};
		3) user_name is unique
		4) valid country
		5) valid state/province for given country
		6) valid postal code?
		7) valid birthday
			a) filter nonsense dates out
			b) age filter reject if too young?
		8) valid phone number
		9) valid cell phone number
		*/
		
		if($this->form_validation->run() === FALSE){
			$this->renderTemp_noData(	'sessions/sign_up', 
										'Register as a new user of the Worksheet Management System!');
		} else {
			$this->load->helper('security');
			$this->load->helper('email');
			
			$user_name = 	$this->input->post('user_name');
			$email = 		$this->input->post('email');
			
			$hash_length = 15;
			$salt = date("m.d.y").$this->input->post('user_name');
			$hash = substr(do_hash($salt), 0, $hash_length);
			
			$data = array(
				'email'				=> $email,
				'user_name' 		=> $user_name,
				'password'			=> $this->input->post('password'),
				'conf_hash'			=> $hash,
				'last_updated' 		=> date("Y-m-d H:m:s"),
				'first_name'		=> $this->input->post('first_name'),
				'last_name'			=> $this->input->post('last_name'),
				'home_phone'		=> $this->input->post('home_phone'),
				'cell_phone'		=> $this->input->post('cell_phone'),
				'gender'			=> $this->input->post('gender'),
				'birthday'			=> $this->input->post('birthday'),
				'address'			=> $this->input->post('address'),
				'city'				=> $this->input->post('city'),
				'province_state'	=> $this->input->post('province_state'),
				'postal_code'		=> $this->input->post('postal_code'),
				'country'			=> $this->input->post('country'),
				'profile_picture'	=> $this->input->post('profile_picture')
			);
			
			$new_uid = $this->users_model->insert($data);
			
			//To be removed
			$email = 'jtantongco@gmail.com';
			//
			
			send_email(	$email, 
						'Welcome to the Worksheet Management System', 
						'This is your confirmation hash: '. $hash .
						'Please visit this link to confirm your account: ' . 
						site_url('sessions/verify/'.$new_uid.'/'.$hash) );
			
			$this->renderTemp_noData('sessions/sign_up_success','Successfully Registered!');
		}
	}
	
	public function verify(){
		$id = $this->uri->segment(3);
		$email_hash = $this->uri->segment(4);
		
		$query = $this->db->get_where('users', array('uid' => $id));
		if(!empty($query)){
			$row = $query->row_array();
			$db_hash = $row['conf_hash'];
			
			if($email_hash == $db_hash){
				$data = array(
					'acc_confirmation' => 1,
					'active' => 1
				);
				if($this->users_model->update($id,$data)){
					$this->renderTemp_noData(	'sessions/verify_success',
												'Successfully verified the account');
				} else {
					$this->renderTemp_noData(	'sessions/verify_fail',
												'Failed to verify the account');
				}
			} else {
				$this->renderTemp_noData('sessions/verify_fail', 'Failed to verify the account');
			}
		} else {
			$this->renderTemp_noData('sessions/verify_fail', 'Failed to verify the account');
		}
	
	public function not_allowed(){
		$this->renderTemp_noData('sessions/not_allowed', 'Your privileges are Insufficient');
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