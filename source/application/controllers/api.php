<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	/**
	 * Request method.
	 * 
	 * @var string
	 * @access private
	 */
	private $request_method;

	public function __construct() {
		parent::__construct();

		$this->request_method = $this->input->server('REQUEST_METHOD');
	}
}

/* End of file api.php */
/* Location: ./application/controllers/api.php */