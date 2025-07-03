<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_404 extends CI_Controller {
	function __construct()
	{
		parent::__construct();		
		$this->config->load('application',TRUE);
	}


	public function index()
	{
		$this->load->view('404');
	}
}
