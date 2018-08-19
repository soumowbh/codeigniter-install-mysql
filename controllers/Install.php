<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Install extends CI_Controller  {
	
	function __construct()
	{
		parent::__construct();				
	}
	public function index()
	{
		$this->_remap();
	}	
	public function _remap()
	{		
		$this->load->view('install');		
	}
	
}