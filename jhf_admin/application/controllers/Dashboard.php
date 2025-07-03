<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct()
	{
		parent::__construct();		
		$this->config->load('application',TRUE);
 		$this->load->model('Admin_Model');
		$this->load->library('session');
 		if (!isset($this->session->userdata['is_admin_login'])) { //Check user is_login
     		redirect(base_url()."admin/login"); 
 		}
	}

   
	public function index()
	{
	   
	   if(!isset($this->session->userdata['is_admin_login'])) { redirect('/'); }
	   // echo 'here'; exit;
		$data['page_name'] = "Dashboard";
	    
	   // $data['totalCategory'] = $this->Admin_Model->getTotalCategoryCount();
	   // $data['totalSongs'] = $this->Admin_Model->getTotalSongsCount();
	   //  $data['totalUsers'] = $this->Admin_Model->getTotalUsersCount();
	
        $this->load->view('dashboard',$data);
	}
}
