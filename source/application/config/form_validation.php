<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Form Validation
|--------------------------------------------------------------------------
*/
$config = array(
	'auth/index' => array(
		array(
			'field' => 'user',
			'label' => 'Username',
			'rules' => 'required'
		),
		array(
			'field' => 'pass',
			'label' => 'Password',
			'rules' => 'required'
		)
	),
	'auth/signup' => array(
		array(
			'field' => 'user',
			'label' => 'Username',
			'rules' => 'required'
		),
		array(
			'field' => 'pass1',
			'label' => 'Password',
			'rules' => 'required'
		),
		array(
			'field' => 'pass2',
			'label' => 'Password',
			'rules' => 'required'
		)
	)
);

/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */