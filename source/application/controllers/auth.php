<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * User verification result.
	 * 
	 * @var array|boolean
	 * @access private
	 */
	private $result;

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation', 'session');
		$this->load->model('auth_model');
	}

	/**
	 * Index page for auth controller.
	 * 
	 * Maps to the following URL: example.com/auth
	 * 
	 * @access public
	 * @return void
	 */
	public function index() {
		if ($this->session->userdata('user') !== FALSE) redirect('/');

		if ($this->form_validation->run() !== FALSE) {
			$this->result = $this->auth_model->verify_user($this->input->post('user'), $this->input->post('pass'));

			if ($this->result !== FALSE) {
				$this->session->set_userdata('user', $this->input->post('user'));
				if (is_array($this->result)) $this->session->set_userdata($this->result);

				redirect('/');
			}
		}

		$this->signin();
	}

	/**
	 * Sign in page for auth controller.
	 * 
	 * Maps to the following URL: example.com/auth/signin
	 * 
	 * @access public
	 * @return void
	 */
	public function signin() {
		if ($this->session->userdata('user') !== FALSE) redirect('/');

		$this->load->view('auth/signin');
	}

	/**
	 * Sign out for auth controller.
	 * 
	 * Maps to the following URL: example.com/auth/signout
	 * 
	 * @access public
	 * @return void
	 */
	public function signout() {
		$this->session->sess_destroy();

		redirect('/auth');
	}
}

/* End of file auth.php */
/* Location: ./application/helpers/auth.php */