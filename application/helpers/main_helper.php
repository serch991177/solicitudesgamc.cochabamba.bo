<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('login')){
	function login()
	{
		$CI =& get_instance();
      exit($CI->load->view('general/login/login', null, TRUE));   
	}
}