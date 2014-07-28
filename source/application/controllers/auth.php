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
		$this->load->database();
		$this->load->helper('url');
		$this->load->library(array('form_validation', 'session'));
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
		if ($this->session->userdata('user') !== FALSE) redirect($this->auth_model->get_url());

		if ($this->form_validation->run() !== FALSE) {
			$this->result = $this->auth_model->verify_user($this->input->post('user'), $this->input->post('pass'));

			if ($this->result !== FALSE) {
				$this->session->set_userdata('user', $this->input->post('user'));
				if (is_array($this->result)) $this->session->set_userdata($this->result);

				redirect($this->auth_model->get_url());
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
		if ($this->session->userdata('user') !== FALSE) redirect($this->auth_model->get_url());

		$this->load->view('web/auth/signin');
	}

	/**
	 * Sign out page for auth controller.
	 * 
	 * Maps to the following URL: example.com/auth/signout
	 * 
	 * @access public
	 * @return void
	 */
	public function signout() {
		$this->session->sess_destroy();

		redirect('auth/signin');
	}

	/**
	 * Sign up page for auth controller.
	 * 
	 * Maps to the following URL: example.com/auth/signup
	 * 
	 * @access public
	 * @return void
	 */
	public function signup() {
		if ($this->form_validation->run() !== FALSE) {
			$this->auth_model->auth_gen($this->input->post('user'), $this->input->post('pass1'));
		}

		$this->load->view('web/auth/signup');
	}
}

/* End of file auth.php */
/* Location: ./application/helpers/auth.php */