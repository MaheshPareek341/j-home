<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trustees extends CI_Controller {
	function __construct()
	{
		parent::__construct();		
		$this->config->load('application',TRUE);
		$this->load->model('Admin_Model');
		if(!isset($this->session->userdata['is_admin_login'])) {	redirect(base_url()."cmsadmin/login");  }
	}


	public function index()
	{
	    $data['trustees'] = $this->Admin_Model->getAllTrustees();
	   
		$this->load->view('trusteesList',$data);
	}
	
	public function add_trustees()
	{
	   
	    $data['page_name'] = "Add Trustees";
		$this->load->view('trusteesAdd',$data);
	}
	
	public function edit_trustees($id){
	    $data['page_name'] = "Edit Trustees";
	    $data['trustees'] = $this->Admin_Model->get_trustees_by_id($id);
		$this->load->view('trusteesEdit',$data);
	}
	
	public function save_trustees(){
	    
	    $filePath = realpath($_SERVER['DOCUMENT_ROOT'].'/images/trustees/'); //'./assets/uploads/';
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
            'father_name'=>$this->input->post('father_name'),
            'dob'=>$this->input->post('dob'),
            'marriage_anniversary'=>$this->input->post('marriage_anniversary'),
            'mobile_number'=>$this->input->post('mobile_number'),
            'email'=>$this->input->post('email'),
            'address'=>$this->input->post('address'),
            'nominee'=>$this->input->post('nominee'),
            'relation'=>$this->input->post('relation'),
            'image'=>$image,
            'designation'=>$this->input->post('designation'),
        );

        // Save data
        if ($this->Admin_Model->add_trustees($data)) {
            $this->session->set_flashdata('message', 'Trustees saved successfully!');
            $this->session->set_flashdata('message_type', 'success');
        } else {
             $this->session->set_flashdata('message', 'Failed to save trustees.');
            $this->session->set_flashdata('message_type', 'error');
        }
         redirect(base_url().'trustees');
       
	}
	
	 public function update_trustees($id) {
        // Get POST data
       $data = array(
            'name'=>$this->input->post('name'),
            'father_name'=>$this->input->post('father_name'),
            'dob'=>$this->input->post('dob'),
            'marriage_anniversary'=>$this->input->post('marriage_anniversary'),
            'mobile_number'=>$this->input->post('mobile_number'),
            'email'=>$this->input->post('email'),
            'address'=>$this->input->post('address'),
            'nominee'=>$this->input->post('nominee'),
            'relation'=>$this->input->post('relation'),
            
            'designation'=>$this->input->post('designation'),
        );
        
        $filePath = realpath($_SERVER['DOCUMENT_ROOT'].'/images/trustees/'); //'./assets/uploads/';
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
        if ($this->Admin_Model->update_trustees($id, $data)) {
            $this->session->set_flashdata('message', 'Trustees updated successfully!');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Failed to update trustees.');
            $this->session->set_flashdata('message_type', 'error');
        }

        // Redirect to list page
        redirect(base_url().'trustees');
    }
    
    public function delete_trustees($id) {
               // Attempt to delete the trustees
        if ($this->Admin_Model->delete_trustees($id)) {
            $this->session->set_flashdata('message', 'Trustees deleted successfully!');
        } else {
            $this->session->set_flashdata('message', 'Failed to delete trustees.');
        }

        // Redirect back to the trustees list
        redirect(base_url().'trustees');
    }
	
	 
}
