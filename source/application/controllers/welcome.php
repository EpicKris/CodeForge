<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Index page for welcome controller.
	 * 
	 * Maps to the following URL: example.com
	 * 
	 * @access public
	 * @return void
	 */
	public function index() {
		$this->load->view('welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */