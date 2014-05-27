<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ldap_core {

	private $CI;

	/**
	 * Server.
	 * 
	 * @var string
	 * @access private
	 */
	private $server;

	/**
	 * Server search base.
	 * 
	 * @var string
	 * @access private
	 */
	private $server_dn;

	/**
	 * LDAP server connection.
	 * 
	 * @var mixed
	 * @access private
	 */
	private $ds;

	public function __construct() {
		$this->CI =& get_instance();

		if ( ! function_exists('ldap_connect')) {
			show_error('PHP LDAP is not loaded.');
			log_message('info', 'PHP LDAP not loaded');
		}

		$config = $this->CI->config->load('ldap', TRUE, TRUE);
		$config = $this->CI->config->item('ldap')['ldap'];

		if (isset($config['server'])) $this->server = $config['server'];
		if (isset($config['server_dn'])) $this->server_dn = $config['server_dn'];
	}

	/**
	 * Set server.
	 * 
	 * @access public
	 * @param string $server
	 * @return void
	 */
	public function set_server($server) {
		$this->server = $server;
	}

	/**
	 * Get server.
	 * 
	 * @access public
	 * @return string|boolean
	 */
	public function get_server() {
		if (isset($this->server)) return $this->server;

		return FALSE;
	}

	/**
	 * Set server DN.
	 * 
	 * @access public
	 * @param string $server_dn
	 * @return void
	 */
	public function set_server_dn($server_dn) {
		$this->server_dn = $server_dn;
	}

	/**
	 * Get server DN.
	 * 
	 * @access public
	 * @return string|boolean
	 */
	public function get_server_dn() {
		if (isset($this->server_dn)) return $this->server_dn;

		return FALSE;
	}

	/**
	 * Connect.
	 * 
	 * @access public
	 * @return void
	 */
	public function connect() {
		if ( ! $this->ds = ldap_connect($this->server)) {
			log_message('error', 'LDAP unable to connect to: ' . $this->server);
		}
	}

	/**
	 * Bind.
	 * 
	 * @access public
	 * @param string $user
	 * @param string $pass
	 * @return void
	 */
	public function bind($user, $pass) {
		$auth = @ldap_bind($this->ds, $user, $pass);

		if ($auth === FALSE) {
			return FALSE;
		}

		return $auth;
	}

	/**
	 * Get.
	 * 
	 * @access public
	 * @param string $filter
	 * @param string $attributes (default: FALSE)
	 * @return boolean
	 */
	public function get($filter, $attributes = FALSE) {
		if ( ! $attributes) {
			if ( ! $search = ldap_search($this->ds, $this->server_dn, $filter)) {
				log_message('error', 'LDAP unable to search: ' . $this->server_dn);
			}
		} else {
			if ( ! $search = ldap_search($this->ds, $this->server_dn, $filter, $attributes)) {
				log_message('error', 'LDAP unable to search: ' . $this->server_dn);
			}
		}

		$ldap = ldap_get_entries($this->ds, $search);

		if ($ldap['count'] === 0) return FALSE;

		return $ldap;
	}
}

/* End of file Ldap_core.php */
/* Location: ./application/libraries/Ldap_core.php */