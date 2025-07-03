<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_category extends CI_Controller {
	function __construct()
	{
		parent::__construct();		
		$this->config->load('application',TRUE);
		$this->load->model('Admin_Model');
		if(!isset($this->session->userdata['is_admin_login'])) {	redirect(base_url()."cmsadmin/login");  }
	}


	public function index()
	{
	    $data['sub_categories'] = $this->Admin_Model->getAllSubCategories();
	    $this->load->view('subCategoryList',$data);
	}
	
	public function add_sub_category()
	{
	   
	    $data['page_name'] = "Add Sub Category";
	    $data['categories'] = $this->Admin_Model->getAllCategories();
		$this->load->view('subCategoryAdd',$data);
	}
	
	public function edit_sub_category($id){
	    $data['page_name'] = "Edit Sub Category";
	    $data['categories'] = $this->Admin_Model->getAllCategories();
	    $data['sub_category'] = $this->Admin_Model->get_sub_category_by_id($id);
		$this->load->view('subCategoryEdit',$data);
	}
	
	public function save_sub_category(){
	    
	    $data = array(
            'name'=>$this->input->post('name'),
            'category_id'=>$this->input->post('category_id'),
            
        );

        // Save data
        if ($this->Admin_Model->add_sub_category($data)) {
            $this->session->set_flashdata('message', 'Sub Category saved successfully!');
            $this->session->set_flashdata('message_type', 'success');
        } else {
             $this->session->set_flashdata('message', 'Failed to save sub category.');
            $this->session->set_flashdata('message_type', 'error');
        }
         redirect(base_url().'sub_category');
       
	}
	
	 public function update_sub_category($id) {
        // Get POST data
       $data = array(
            'name'=>$this->input->post('name'),
             'category_id'=>$this->input->post('category_id'),
           
        );
        
        // Update data
        if ($this->Admin_Model->update_sub_category($id, $data)) {
            $this->session->set_flashdata('message', 'Sub Category updated successfully!');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Failed to update sub category.');
            $this->session->set_flashdata('message_type', 'error');
        }

        // Redirect to list page
        redirect(base_url().'sub_category');
    }
    
    public function delete_sub_category($id) {
               // Attempt to delete the sub category
        if ($this->Admin_Model->delete_sub_category($id)) {
            $this->session->set_flashdata('message', 'Sub Category deleted successfully!');
        } else {
            $this->session->set_flashdata('message', 'Failed to delete sub category.');
        }

        // Redirect back to the category list
        redirect(base_url().'sub_category');
    }
	
	 
}