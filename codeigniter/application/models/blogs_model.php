<?php
class Blogs_model extends MY_Model {
	
	public function __construct()
	{
		$this->_table = 'blog';
		$this->primary_key = 'bid';
		$this->load->database();
	}
}