<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	function __construct()
	{
		parent::__construct();		
		$this->config->load('application',TRUE);
		$this->load->model('Admin_Model');
		if(!isset($this->session->userdata['is_admin_login'])) {	redirect(base_url()."cmsadmin/login");  }
	}


	public function index()
	{
	    $data['categories'] = $this->Admin_Model->getAllCategories();
	   
		$this->load->view('categoryList',$data);
	}
	
	public function add_category()
	{
	   
	    $data['page_name'] = "Add Category";
		$this->load->view('categoryAdd',$data);
	}
	
	public function edit_category($id){
	    $data['page_name'] = "Edit Category";
	    $data['category'] = $this->Admin_Model->get_category_by_id($id);
		$this->load->view('categoryEdit',$data);
	}
	
	public function save_category(){
	    
	    $filePath = realpath($_SERVER['DOCUMENT_ROOT'].'/newweb/images/category/'); //'./assets/uploads/';
        $config['upload_path'] = $filePath;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['overwrite'] = true;
        $image = '';
        $this->upload->initialize($config);
        
        if (!empty($_FILES['image'])) {
        
          if (!$this->upload->do_upload('image')) {
         
               // errors
        
          } else {
        
               $upload_data = $this->upload->data();
                $image = $upload_data['file_name'];
        
          }
        }
	    
        $data = array(
            'name'=>$this->input->post('name'),
            'image'=>$image,
            
        );

        // Save data
        if ($this->Admin_Model->add_category($data)) {
            $this->session->set_flashdata('message', 'Category saved successfully!');
            $this->session->set_flashdata('message_type', 'success');
        } else {
             $this->session->set_flashdata('message', 'Failed to save category.');
            $this->session->set_flashdata('message_type', 'error');
        }
         redirect(base_url().'category');
       
	}
	
	 public function update_category($id) {
        // Get POST data
       $data = array(
            'name'=>$this->input->post('name'),
           
        );
        
        $filePath = realpath($_SERVER['DOCUMENT_ROOT'].'/newweb/images/category/'); //'./assets/uploads/';
        $config['upload_path'] = $filePath;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['overwrite'] = true;
        $image = '';
        $this->upload->initialize($config);
        
        if (!empty($_FILES['image'])) {
        
          if (!$this->upload->do_upload('image')) {
         
               // errors
        
          } else {
        
               $upload_data = $this->upload->data();
                $data['image'] = $upload_data['file_name'];
        
          }
        }
     
        // Update data
        if ($this->Admin_Model->update_category($id, $data)) {
            $this->session->set_flashdata('message', 'Category updated successfully!');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Failed to update category.');
            $this->session->set_flashdata('message_type', 'error');
        }

        // Redirect to list page
        redirect(base_url().'category');
    }
    
    public function delete_category($id) {
        
        $category = $this->Admin_Model->get_category_by_id($id);
        if (!$category) {
            $this->session->set_flashdata('message', 'Category not found.');
            $this->session->set_flashdata('message_type', 'error');
            redirect(base_url() . 'category');
        }
    
        // Define file paths
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/newweb/images/category/' . $category['image'];
    
        // Delete image file if it exists
        if (!empty($category['image']) && file_exists($imagePath)) {
            unlink($imagePath);
        }
        
        
               // Attempt to delete the category
        if ($this->Admin_Model->delete_category($id)) {
            $this->session->set_flashdata('message', 'Category deleted successfully!');
        } else {
            $this->session->set_flashdata('message', 'Failed to delete category.');
        }

        // Redirect back to the category list
        redirect(base_url().'category');
    }
	
	 
}