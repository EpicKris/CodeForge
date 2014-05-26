<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library(array('session'));
	}

	/**
	 * Verify user.
	 * 
	 * Return FALSE if user not verified.
	 * Return TRUE or array to set session userdata if user verified.
	 * 
	 * @access public
	 * @param string $user
	 * @param string $pass
	 * @return boolean|array
	 */
	public function verify_user($user, $pass) {
		
	}

	/**
	 * Verify session.
	 * 
	 * @access public
	 * @return void
	 */
	public function verify_session() {
		if ($this->session->userdata('user') === FALSE) {
			redirect('/auth');
		}
	}
}

/* End of file auth_model.php */
/* Location: ./application/models/auth_model.php */