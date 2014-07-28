<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('url', 'uuid'));
		$this->load->library('session');
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
			$this->auth_model->set_url();
			redirect('/auth');
		}
	}

	/**
	 * Set URL.
	 * 
	 * @access public
	 * @return void
	 */
	public function set_url() {
		$cookie = array(
			'name'   => 'url',
			'value'  => '/' . uri_string(),
			'expire' => intval($this->config->item('csrf_expire')),
			'path'   => '/auth'
		);
		$this->input->set_cookie($cookie);
	}

	/**
	 * Get URL.
	 * 
	 * @access public
	 * @return string
	 */
	public function get_url() {
		return $this->input->cookie($this->config->item('cookie_prefix') . 'url', TRUE);
	}

	/**
	 * Auth generator.
	 * 
	 * Return FALSE if not user generated.
	 * Return TRUE or array of data if user generated.
	 * 
	 * @access public
	 * @param string $user
	 * @param string $pass
	 * @return boolean|array
	 */
	public function auth_gen($user, $pass) {
		$salt = hash('sha1', uuidgen());
		$pass = encrypt_pass($pass, $salt);
	}

	/**
	 * Encrypt pass.
	 * 
	 * @access private
	 * @param string $pass
	 * @param string $salt
	 * @return string
	 */
	private function encrypt_pass($pass, $salt) {
		return hash('sha512', $pass . $salt);
	}
}

/* End of file auth_model.php */
/* Location: ./application/models/auth_model.php */