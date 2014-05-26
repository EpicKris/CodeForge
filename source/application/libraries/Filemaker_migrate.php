<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filemaker_migrate {

	private $CI;

	/**
	 * Fields.
	 * 
	 * @var array
	 * @access public
	 */
	private $fields;

	/**
	 * Forge fields.
	 * 
	 * @var array
	 * @access private
	 */
	private $forge_fields;

	/**
	 * Fields count.
	 * 
	 * @var int
	 * @access private
	 */
	private $fields_count;

	/**
	 * Table.
	 * 
	 * @var string
	 * @access private
	 */
	private $table;

	public function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->database();
		$this->CI->load->dbforge();
		$this->CI->load->helper('file');
	}

	/**
	 * Add field.
	 * 
	 * @access public
	 * @param array $fields
	 * @return void
	 */
	public function add_field($fields) {
		$this->fields_count = count($fields);

		foreach($fields as $field => $value) {
			$value = array_merge_recursive(array(
				'null' => TRUE
			), $value);

			switch($field) {
				case 'index':
					$field = 'filemaker_index';
					break;
				case 'match';
					$field = 'filemaker_match';
					break;
			}

			$fields_safe[$field] = $value;
		}

		unset($this->fields);
		unset($this->forge_fields);

		$i = 0;
		foreach($fields_safe as $field => $value) {
			$this->fields[$i] = $field;
			$this->forge_fields[$field] = $value;
			$i++;
		}

		$this->CI->dbforge->add_field($this->forge_fields);
	}

	/**
	 * Create table.
	 * 
	 * @access public
	 * @param string $table
	 * @return void
	 */
	public function create_table($table) {
		$this->title = $table;

		$this->CI->dbforge->drop_table($table);
		$this->CI->dbforge->create_table($table);
	}

	/**
	 * Drop table.
	 * 
	 * @access public
	 * @param string $table
	 * @return void
	 */
	public function drop_table($table) {
		$this->CI->dbforge->drop_table($table);
	}

	/**
	 * Import.
	 * 
	 * @access public
	 * @param string $path
	 * @return void
	 */
	public function import($path) {
		$first = TRUE;
		foreach ($this->forge_fields as $field => $value) {
			if ($first) {
				$fields = '';
				$first = FALSE;
			} else {
				$fields .= ', ';
			}
			$fields .= '@filemaker_' . $field;
		}

		$first = TRUE;
		foreach ($this->forge_fields as $field => $value) {
			if ($first) {
				$set_fields = '';
				$first = FALSE;
			} else {
				$set_fields .= ', ';
			}

			switch($this->forge_fields[$field]['type']) {
				case 'DATE':
					$set_fields .= $field . ' = IF(STR_TO_DATE(REPLACE(@fm_' . $field . ', \'/\', \'-\'), \'%m-%d-%Y\'), STR_TO_DATE(REPLACE(@fm_' . $field . ', \'-\', \'/\'), \'%m/%d/%Y\'), IF(STR_TO_DATE(@fm_' . $field . ', \'%r\'), STR_TO_DATE(@fm_' . $field . ', \'%r\'), NULL))';
					break;
				case 'TIMESTAMP':
					$set_fields .= $field . ' = IF(TIMESTAMP(STR_TO_DATE(@fm_' . $field . ', \'%m/%d/%Y %r\')), TIMESTAMP(STR_TO_DATE(@fm_' . $field . ', \'%m/%d/%Y %r\')), IF(TIMESTAMP(STR_TO_DATE(@fm_' . $field . ', \'%%r\')), TIMESTAMP(STR_TO_DATE(@fm_' . $field . ', \'%r\')), NULL))';
					break;
				default:
					$set_fields .= $field . ' = NULLIF(@fm_' . $field . ', \'\')';
					break;
			}
		}

		$sql = 'SET SESSION sql_mode = \'ALLOW_INVALID_DATES\'';

		$query = $this->CI->db->query($sql);

		$sql = 'LOAD DATA INFILE \'' . $path . '\' INTO TABLE ' . $this->title . ' FIELDS TERMINATED BY \',\' ENCLOSED BY \'"\' ESCAPED BY \'"\' LINES TERMINATED BY \'\\r\' (' . $fields . ')';
		if ($set_fields !== '') $sql .= ' SET ' . $setFields;

		$query = $this->CI->db->query($sql);

		$sql = 'SET SESSION sql_mode = \'TRADITIONAL\'';

		$query = $this->CI->db->query($sql);
	}
}

/* End of file Filemaker_migrate.php */
/* Location: ./application/libraries/Filemaker_migrate.php */