<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if ( ! $this->input->is_cli_request()) show_404('Cron', FALSE);

		set_time_limit(0);
	}

	/**
	 * Index for cron controller.
	 * 
	 * Maps to the following URL: example.com/cron
	 * 
	 * @access public
	 * @return void
	 */
	public function index() {
		
	}
}

/* End of file cron.php */
/* Location: ./application/controllers/cron.php */