<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {
	function __construct()
	{
		parent::__construct();		
		$this->config->load('application',TRUE);
		$this->load->model('Admin_Model');
		  $this->load->helper('form');
        $this->load->library('form_validation');
        	if(!isset($this->session->userdata['is_admin_login'])) {redirect(base_url()."admin/login");  }
	}


	public function index()
	{
	    $data['gallery'] = $this->Admin_Model->getAllGallery();
		$this->load->view('galleryList',$data);
	}
	
    public function save_image(){
	  
	    $filePath = realpath($_SERVER['DOCUMENT_ROOT'].'/images/gallery/'); //'./assets/uploads/';
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
        if ($this->Admin_Model->add_image($data)) {
            $this->session->set_flashdata('message', 'Image saved successfully!');
            $this->session->set_flashdata('message_type', 'success');
        } else {
             $this->session->set_flashdata('message', 'Failed to save image.');
            $this->session->set_flashdata('message_type', 'error');
        }
         redirect(base_url().'gallery');
       
	}
	
	public function add_image()
	{
	   $data['page_name'] = "Add Image";
		$this->load->view('imageAdd',$data);
	}
	
	public function edit_image($id){
	    $data['page_name'] = "Edit Image";
	    $data['images'] = $this->Admin_Model->get_image_by_id($id);
		$this->load->view('imageEdit',$data);
	}
	
	 public function update_image($id) {
        // Get POST data
       $data = array(
            'name'=>$this->input->post('name'),
          
        );
        
        $filePath = realpath($_SERVER['DOCUMENT_ROOT'].'/images/gallery/'); //'./assets/uploads/';
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
        if ($this->Admin_Model->update_image($id, $data)) {
            $this->session->set_flashdata('message', 'Image updated successfully!');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Failed to update image.');
            $this->session->set_flashdata('message_type', 'error');
        }

        // Redirect to list page
        redirect(base_url().'gallery');
    }
    
    public function delete_image($id) {
               // Attempt to delete the image
        if ($this->Admin_Model->delete_image($id)) {
            $this->session->set_flashdata('message', 'Image deleted successfully!');
        } else {
            $this->session->set_flashdata('message', 'Failed to delete image.');
        }

        // Redirect back to the commitee list
        redirect(base_url().'gallery');
    }
	
	 
}
