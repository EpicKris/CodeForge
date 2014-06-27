<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_model extends CI_Model {

	/**
	 * Last search's rows count.
	 * 
	 * @var int
	 * @access private
	 */
	private $rows_count;

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	/**
	 * Last search's rows count.
	 * 
	 * @access public
	 * @return int|boolean
	 */
	public function search_rows_count() {
		if (isset($this->rows_count)) return $this->rows_count;

		return FALSE;
	}

	/**
	 * Create rows in table.
	 * 
	 * @access private
	 * @param string $table
	 * @param array $data
	 * @return void
	 */
	private function create_items($table, $data) {
		return $this->db->insert_batch($table, $data);
	}

	/**
	 * Create row in table.
	 * 
	 * @access private
	 * @param string $table
	 * @param array $data
	 * @return int
	 */
	private function create_item($table, $data) {
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	/**
	 * Read rows in table.
	 * 
	 * @access private
	 * @param string $table
	 * @param int|boolean $limit (default: FALSE)
	 * @param int|boolean $offset (default: FALSE)
	 * @return array
	 */
	private function read_items($table, $limit = FALSE, $offset = FALSE) {
		$this->joins($table);

		if ( ! $limit) $query = $this->db->get($table);
		if ( ! $offset) $query = $this->db->get($table, $limit);
		$query = $this->db->get($table, $limit, $offset);

		return $query->result_array();
	}

	private function read_item($table, $id) {
		if ( ! $id) return FALSE;

		$this->joins($table);

		$query = $this->db->get_where($table, array($table . '.' . $this->table_id($table) => $id));

		return $query->row_array();
	}

	/**
	 * Update rows in table.
	 * 
	 * @access private
	 * @param string $table
	 * @param array $data
	 * @return void
	 */
	private function update_items($table, $data) {
		return $this->db->update_batch($table, $data, $table . '.' . $this->table_id($table));
	}

	/**
	 * Update row in table.
	 * 
	 * @access private
	 * @param string $table
	 * @param int $id
	 * @param array $data
	 * @return void
	 */
	private function update_item($table, $id, $data) {
		$this->db->where($table . '.' . $this->table_id($table), $id);
		return $this->db->update($table, $data);
	}

	/**
	 * Delete row in table.
	 * 
	 * @access private
	 * @param string $table
	 * @param int $id
	 * @return void
	 */
	private function delete_item($table, $id) {
		$this->db->where($table . '.' . $this->table_id($table), $id);
		return $this->db->delete($table);
	}

	/**
	 * Search rows in table.
	 * 
	 * @access private
	 * @param string $table
	 * @param array $data
	 * @param array $config (default: array())
	 * @return array
	 */
	private function search_items($table, $data, $config = array()) {
		$config = array_merge(array(
			'first'  => TRUE,
			'strict' => FALSE,
			'ands'   => FALSE
		), $config);

		$this->joins($table);

		foreach ($data as $field => $search) {
			$and = FALSE;
			if (is_array($config['ands'])) if (in_array($field, $config['ands'])) $and = TRUE;

			if (strpos($field, '.') === FALSE) $field = $table . '.' . $field;

			if (is_array($search)) {
				if ($config['strict']) {
					$this->search_build($field, $search, $and, $config['strict'], $config['first']);
				} else {
					foreach ($search as $search_item) {
						$this->search_build($field, $search_item, $and, $config['strict'], $config['first']);
						$config['first'] = FALSE;
					}
				}
			} else {
				$this->search_build($field, $search, $and, $config['strict'], $config['first']);
				$config['first'] = FALSE;
			}
		}

		$query = $this->db->get($table);
		$this->rows_count = $query->num_rows();

		return $query->result_array();
	}

	/**
	 * Rows count in table.
	 * 
	 * @access private
	 * @param string $table
	 * @return int
	 */
	private function rows_count_items($table) {
		$query = $this->db->get($table);

		return $query->num_rows();
	}

	/**
	 * Joins.
	 * 
	 * @access private
	 * @param string $table
	 * @return void
	 */
	private function joins($table) {
		switch($table) {
			
		}
	}

	/**
	 * Get table ID.
	 * 
	 * @access private
	 * @param string $table
	 * @return string|boolean
	 */
	private function table_id($table) {
		$table_ids = array();

		if (isset($table_ids['table'])) return $table_ids['table'];

		return FALSE;
	}

	/**
	 * Build the search.
	 * 
	 * @access private
	 * @param string $field
	 * @param string|array $search
	 * @param boolean $and
	 * @param boolean $strict
	 * @param boolean $first
	 * @return void
	 */
	private function search_build($field, $search, $and, $strict, $first) {
		if ($first || $and) {
			if (is_array($search)) {
				$this->db->where_in($field, $search);
			} else if ($strict) {
			    $this->db->where($field, $search);
			} else {
			    $this->db->like($field, $search);
			}
			return;
		}

		if (is_array($search)) {
			$this->db->where_in($field, $search);
		} else if ($strict) {
			$this->db->or_where($field, $search);
		} else {
			$this->db->or_like($field, $search);
		}
	}
}

/* End of file data_model.php */
/* Location: ./application/models/data_model.php */