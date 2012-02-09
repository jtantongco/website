<?php
class Users_model extends MY_Model {
	
	public function __construct()
	{
		$this->_table = 'users';
		$this->primary_key = 'uid';
		$this->load->database();
	}
}