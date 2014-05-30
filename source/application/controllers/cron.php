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
		$this->yearly();
	}

	/**
	 * Index for yearly cron controller.
	 * 
	 * Maps to the following URL: example.com/cron/yearly
	 * 
	 * Run once a year at midnight on the morning of January 1.
	 * 
	 * @access public
	 * @return void
	 */
	public function yearly() {
		$this->monthly();
	}

	/**
	 * Index for monthly cron controller.
	 * 
	 * Maps to the following URL: example.com/cron/monthly
	 * 
	 * Run once a month at midnight on the morning of the first day of the month.
	 * 
	 * @access public
	 * @return void
	 */
	public function monthly() {
		$this->weekly();
	}

	/**
	 * Index for weekly cron controller.
	 * 
	 * Maps to the following URL: example.com/cron/weekly
	 * 
	 * Run once a week at midnight on Sunday morning.
	 * 
	 * @access public
	 * @return void
	 */
	public function weekly() {
		$this->daily();
	}

	/**
	 * Index for daily cron controller.
	 * 
	 * Maps to the following URL: example.com/cron/daily
	 * 
	 * Run once a day at midnight.
	 * 
	 * @access public
	 * @return void
	 */
	public function daily() {
		$this->hourly();
	}

	/**
	 * Index for hourly cron controller.
	 * 
	 * Maps to the following URL: example.com/cron/hourly
	 * 
	 * Run once an hour at the beginning of the hour.
	 * 
	 * @access public
	 * @return void
	 */
	public function hourly() {
		
	}
}

/* End of file cron.php */
/* Location: ./application/controllers/cron.php */