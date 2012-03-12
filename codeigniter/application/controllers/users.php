<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {
	public function index(){
		$this->renderTemp_noData('users/index','User Functions');
	}
	
	public function start_page(){
		$data['user_name'] = $this->session->userdata('user_name');
		$accountType = $this->session->userdata('aid');
		switch ($accountType) {
			case 0: //General user
				$this->renderTemp_data(		'templates/LI_starter',
											'General User start page',
											$data);
				break;
			default:
				redirect('/sessions/log_in/','refresh');
		}
	}
	/*
	public function edit(){
		$uid = $this->session->userdata('uid');
		$row = $this->users_model->get($uid);
		
		$data['row'] = $row;
		
		// Need the same callback functions as session
		$this->form_validation->set_rules('password',		'password',			'required');
		$this->form_validation->set_rules('password_conf',	'password_conf',	'required');
		$this->form_validation->set_rules('email',			'email',			'required');
		$this->form_validation->set_rules('birthday',		'birthday',			'required');
		$this->form_validation->set_rules('country',		'country',			'required');
		
		if($this->form_validation->run() === FALSE){
			$this->renderTemp_data(	'users/edit', 
									'Edit your user data!', 
									$data);
		} else {
			$data = array(
				'email'				=> $this->input->post('email'),
				'password'			=> $this->input->post('password'),
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
			if($this->users_model->update($uid,$data)){
				$data['message'] = 'Your changes have been reflected in the Database. Enjoy the system.';
				$this->renderTemp_data('templates/success', 'Successfully edited your data!', $data);
			} else {
				$data['messsage'] = 'The Database could not update itself. Please try again.';
				$this->renderTemp_data('templates/error','Failed to edit your data',$data);
			}
		}
	}
	
	public function deactivate(){
		$email_uid = $this->uri->segment(3);
		$email_hash = $this->uri->segment(4);
		$uid = $this->session->userdata('uid');
		
		/*
		$query = $this->db->get_where('users', array('uid' => $uid));
		$row = $query->row_array();
		$db_hash = $row['conf_hash'];
		*/
		/*
		//UIDs match
		if($uid == $email_uid){
			$query = $this->users_model->get($uid);
			$db_hash = $query->conf_hash;
			//conf_hashes  match
			if($email_hash == $db_hash) {
				$data = array( 'active' => 0 );
				if($this->users_model->update($uid,$data)){
					$this->session->unset_userdata('loggedin');
					$data['title'] = 'Account successfully deactivated!'; 
					$this->load->view('templates/header',$data);
					$this->load->view('users/deactivate_success');
					$this->load->view('templates/footer');
				} else {
					$data['message'] = 'The changes could not be committed to the Database.';
					$this->renderTemp_data('users/deactivate_fail','Error: Failed to Deactivate account!', $data);
				}
			} else {
				$data['message'] = 'The qualification keys in the URL do not match.';
				$this->renderTemp_data('users/deactivate_fail','Error: Failed to Deactivate account!', $data);
			}
		} else {	
			$data['message'] = 'The account that is logged in is not the the same as the account being deleted.
								Please ensure that the account being deleted is logged in.';
			$this->renderTemp_data('users/deactivate_fail','Error: Failed to Deactivate account!', $data);
		}
	}
	
	public function deactivate_conf(){
		$this->load->helper('email');
		$this->load->helper('security');
		
		$uid = $this->session->userdata('uid');
		
		$hash_length = 15;
		$salt = date("m.d.y").$this->input->post('user_name');
		$hash = substr(do_hash($salt), 0, $hash_length);
		
		$data = array('conf_hash' => $hash);
		
		$this->users_model->update($uid,$data);
		
		$query = $this->users_model->get($uid);
		$db_hash = $query->conf_hash;
		$db_email = $query->email;
		
		/*
		$query = $this->db->get_where('users',array('uid' => $uid));
		$row = $query->row_array();
		$db_hash = $row['conf_hash'];
		$email = $row['email'];
		*/
		//To be removed eventually:
		//$db_email = 'jtantongco@gmail.com';
		//End remove
		/*
		send_email(	$db_email, 
					'Deactivation from Datapi systems',
					'This is to confirm that you would like to deactivate your account with us. </br>
					Please visit the following link: </br>' .
					site_url('users/deactivate/'.$uid.'/'.$db_hash));
		
		$data['email'] = $db_email;
		$this->renderTemp_data(	'users/deactivation_email.php',
									'Deactivation email sent',
									$data);
	}
	
	public function view_cart(){
		$this->form_validation->set_rules('action','action','required');
		
		$num = $this->input->post('num_rows');
		for($i = 1; $i <= $num; $i++){
			$this->form_validation->set_rules(	$i.'_qty',
												'#'.$i.' quantity',
												'required');
		}
		
		if($this->form_validation->run() === FALSE){
			$this->renderTemp_noData('users/view_cart','View your cart!');
		} elseif($this->input->post('action') == 'checkout') { //BUY
			//BUY CASE NEEDS TO BE REDONE to reflect redone buying processing
			$id = $this->session->userdata('uid');
			$transactionsData = array(
									'uid'	 =>	$id,
									'amount' => $this->cart->format_number($this->cart->total())
									);  
			$tid = $this->transactions_model->insert($transactionsData);
				
			foreach($this->cart->contents() as $items){
				$wsid = $items['id'];
				$purchaseData = array(
									'wsid' 	=> 	$wsid,
									'uid'	=>	$id,
									'tid'	=>	$tid
									);
				$this->purchases_model->insert($purchaseData);
			}
			
			$this->renderTemp_noData('users/buy_cart_success','Buy cart!');
			$this->cart->destroy();			
		} else { //Edit case:
			for($i = 1; $i <= $num; $i++){
				$rowid = $this->input->post($i.'_rowid');
				$newQty = $this->input->post($i.'_qty');
				$cartData = array(
								'rowid'	=> $rowid, 
								'qty'	=> $newQty
								);
				$this->cart->update($cartData);
			}
			
			$this->renderTemp_noData('users/edit_cart_success','Edit Cart!');
		}
	}
	
	public function test(){
		$data['check'] = 'Check!';
		$data['cross'] = 'Cross!';
		$data['notice'] = 'Notice!';
		$this->renderTemp_data('users/test','TEST headers page',$data);
		
				/*
		$src = 'http://datapi.com/jtantongco/scripts/popUpMagnifier/PosterT.jpg';
		$caption = "Gore Shade yea!";
		$id = "imgBlueScoop1";
		$width = "150";
		$height = "113";
		
		$this->load->library('Img_magnifier');
		$this->img_magnifier->render_script();
		$this->img_magnifier->render_popImg($src,$caption,$id,$width,$height);
		*/
		/*
		//Must be here since cannot call load library from inside view
		//$this->load->library('Img_magnifier');
		
		//$this->renderTemp_noData('users/testb.php', 'OH MY GOD');
		*/
		/*
		$this->load->library('Doc_generator');
		$imgs = array(	"http://datapi.com/jtantongco/images/StGeorgeLogo.jpg",
						"http://datapi.com/jtantongco/images/StGeorgeBanner.jpg");
		echo $this->doc_generator->generatePDF(13,1,$imgs);	
		*/
		
		//Seems to work if only sheets_model
		// sheets_model and classes_model don't work if they are both done no matter what order called in
		// confirm the top line before asking for help though
		// refactor name to be course if there is time
		/*
		$this->load->model('sheets_model');
		$this->load->model('classes_model');
		
		echo 'Lets get it started </br>';
		
		//works next line is commented
		//$where = array('uid' => 13);
		$queryResult2 = $this->sheets_model->get_many_by('uid', 13);
		//$queryResult =  $this->classes_model->get_many_by('teacher_id', 18);
		$offset = 0;
		$count = count($queryResult2);
		$base_url = site_url('users/test');
		$uri_segment = 3;
		$per_page = 3;
		
		
		echo 'Maximum Virgil </br>';
		
		$data2 = $this->paginated_data($offset,$count,$base_url,$per_page,$uri_segment,$queryResult2,'sheets');
		print_r($data2);
		echo '</br>';
		echo '</br>';
		echo '</br>';
		echo '</br>';
		/*
		$data = $this->paginated_data($offset,$count,$base_url,$per_page,$uri_segment,$queryResult,'classes');
		print_r($data);
		echo '</br>';
		*/
	//}
}