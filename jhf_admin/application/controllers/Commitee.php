<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commitee extends CI_Controller {
	function __construct()
	{
		parent::__construct();		
		$this->config->load('application',TRUE);
		$this->load->model('Admin_Model');
		if(!isset($this->session->userdata['is_admin_login'])) {	redirect(base_url()."cmsadmin/login");  }
	}


	public function index()
	{
	    $data['commitee'] = $this->Admin_Model->getAllCommitee();
	    $this->load->view('commiteeList',$data);
	}
	
	public function save_commitee(){
	  
	    $filePath = realpath($_SERVER['DOCUMENT_ROOT'].'/images/committee/'); //'./assets/uploads/';
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
            'email'=>$this->input->post('email'),
            'phone'=>$this->input->post('phone'),
            'image'=>$image,
            'members_type'=>$this->input->post('members_type'),
            'place'=>$this->input->post('place'),
            'designation'=>$this->input->post('designation'),
           
        );

        // Save data
        if ($this->Admin_Model->add_commitee($data)) {
            $this->session->set_flashdata('message', 'Commitee saved successfully!');
            $this->session->set_flashdata('message_type', 'success');
        } else {
             $this->session->set_flashdata('message', 'Failed to save commitee.');
            $this->session->set_flashdata('message_type', 'error');
        }
         redirect(base_url().'commitee');
       
	}
	
	public function add_commitee()
	{
	   $data['page_name'] = "Add Commitee Member";
		$this->load->view('commiteeAdd',$data);
	}
	
	public function edit_commitee($id){
	    $data['page_name'] = "Edit Commitee Member";
	    $data['commitee'] = $this->Admin_Model->get_commitee_by_id($id);
		$this->load->view('commiteeEdit',$data);
	}
	
	 public function update_commitee($id) {
        // Get POST data
       $data = array(
            'name'=>$this->input->post('name'),
            'email'=>$this->input->post('email'),
            'phone'=>$this->input->post('phone'),
            'members_type'=>$this->input->post('members_type'),
            'place'=>$this->input->post('place'),
            'designation'=>$this->input->post('designation'),
        );
        
        $filePath = realpath($_SERVER['DOCUMENT_ROOT'].'/images/committee/'); //'./assets/uploads/';
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
        if ($this->Admin_Model->update_commitee($id, $data)) {
            $this->session->set_flashdata('message', 'Commitee member updated successfully!');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Failed to update commitee member.');
            $this->session->set_flashdata('message_type', 'error');
        }

        // Redirect to list page
        redirect(base_url().'commitee');
    }
    
    public function delete_commitee($id) {
               // Attempt to delete the commitee
        if ($this->Admin_Model->delete_commitee($id)) {
            $this->session->set_flashdata('message', 'Commitee member deleted successfully!');
        } else {
            $this->session->set_flashdata('message', 'Failed to delete commitee member.');
        }

        // Redirect back to the commitee list
        redirect(base_url().'commitee');
    }
	
	 
}
