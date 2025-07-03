<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->config->load('application',TRUE);
		$this->load->model('music_model');
	}

 
	public function index()
	{
	
		$from = 'songs';
		$cfrom = 'category';
		$select = '*';
		$where = '';
		$fwhere = 'featured_song != 0';
		$twhere = 'treanding_song != 0';
		$nwhere = 'new_release_song != 0';
		$tpwhere = 'top_song != 0';
		$data['category_data'] = $this->music_model->get_result($select,$cfrom,$where);
		$data['featured_data'] = $this->music_model->get_result($select,$from,$fwhere);
		$data['treanding_data'] = $this->music_model->get_result($select,$from,$twhere);
		$data['new_releases_data'] = $this->music_model->get_result($select,$from,$nwhere);
		$data['top_song_data'] = $this->music_model->get_result($select,$from,$tpwhere);
		$data['page_name'] = "Home";		
		$this->load->view('home',$data);
	}
	
	public function register()
	{
		$data['page_name'] = "Register";		
		$this->load->view('register',$data);
	}
	
	public function ambassador(){
	    $data['page_name'] = 'Ambassador';
	    $this->load->view('ambassador', $data);
	}
	
	public function movies(){
	    $data['page_name'] = 'Movies';
	    $select = '*';
		$where = '';
		$from = 'songs';
		$data['category_data'] = $this->music_model->getAllCategory();
		$data['movie_data'] = array();
		foreach($data['category_data'] as $categoryData){
		    $where = 'cat_id = '.$categoryData->cat_id;
		    $data['movie_data'][] = array(
		        'id' => $categoryData->cat_id,
    		    'name' => $categoryData->cat_name,
    		    'movie' => (array) $this->music_model->get_result($select,$from,$where)
		    );
		}
		 
		
	
		//$data['featured_data'] = $this->music_model->getAllSongs();
	//	$data['featured_data'] = $this->music_model->get_result($select,$from,$where);
	    $this->load->view('movies', $data);
	}
	
	public function details($url){
	    $from = 'songs';
		$select = '*';
		$where = "song_url = '$url'";
		$data['song_data'] = $this->music_model->get_result($select,$from,$where);
		$this->load->view('details',$data);
	}

}
