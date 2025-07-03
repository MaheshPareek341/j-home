<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogs extends CI_Controller {
	function __construct()
	{
		parent::__construct();		
		$this->config->load('application',TRUE);
		$this->load->model('Admin_Model');
		if(!isset($this->session->userdata['is_admin_login'])) {	redirect(base_url()."cmsadmin/login");  }
	}


	public function index()
	{
	    $data['catalogs'] = $this->Admin_Model->getAllCatalogs();
	   
		$this->load->view('catalogsList',$data);
	}
	
	public function add_catalogs()
	{
	   
	    $data['page_name'] = "Add Catalogs";
		$this->load->view('catalogsAdd',$data);
	}
	
	public function edit_catalogs($id){
	    $data['page_name'] = "Edit Catalogs";
	    $data['catalogs'] = $this->Admin_Model->get_catalogs_by_id($id);
		$this->load->view('catalogsEdit',$data);
	}
	
	public function save_catalogs(){
	    
	    $filePath = realpath($_SERVER['DOCUMENT_ROOT'].'/newweb/images/catalogs/');
        $pdfPath = realpath($_SERVER['DOCUMENT_ROOT'].'/newweb/images/catalogs/');
        
        $image = '';
        $pdf = '';
        
        // Upload Image
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = $filePath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['overwrite'] = true;
        
            $this->upload->initialize($config);
        
            if (!$this->upload->do_upload('image')) {
                // Handle errors
                $this->session->set_flashdata('message', 'Image upload failed: ' . $this->upload->display_errors());
                $this->session->set_flashdata('message_type', 'error');
                redirect(base_url().'catalogs');
            } else {
                $upload_data = $this->upload->data();
                $image = $upload_data['file_name'];
            }
        }
        
        // Upload PDF
        if (!empty($_FILES['pdf']['name'])) {
            $config['upload_path'] = $pdfPath;
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
        
            $this->upload->initialize($config);
        
            if (!$this->upload->do_upload('pdf')) {
                // Handle errors
                $this->session->set_flashdata('message', 'PDF upload failed: ' . $this->upload->display_errors());
                $this->session->set_flashdata('message_type', 'error');
                redirect(base_url().'catalogs');
            } else {
                $upload_data = $this->upload->data();
                $pdf = $upload_data['file_name'];
            }
        }
        
        // Save Data
        $data = array(
            'name' => $this->input->post('name'),
            'image' => $image,
            'pdf' => $pdf
        );
        
        if ($this->Admin_Model->add_catalogs($data)) {
            $this->session->set_flashdata('message', 'Catalogs saved successfully!');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Failed to save catalogs.');
            $this->session->set_flashdata('message_type', 'error');
        }
        
        redirect(base_url().'catalogs');

       
	}
	
	 public function update_catalogs($id) {
        // Get POST data
        $data = array(
            'name' => $this->input->post('name')
        );
        
        // Define upload paths
        $filePath = realpath($_SERVER['DOCUMENT_ROOT'] . '/newweb/images/catalogs/');
        $pdfPath = realpath($_SERVER['DOCUMENT_ROOT'] . '/newweb/images/catalogs/');
        
        $this->load->library('upload');
        
        // Upload Image
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = $filePath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['overwrite'] = true;
        
            $this->upload->initialize($config);
        
            if ($this->upload->do_upload('image')) {
                $upload_data = $this->upload->data();
                $data['image'] = $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('message', 'Image upload failed: ' . $this->upload->display_errors());
                $this->session->set_flashdata('message_type', 'error');
                redirect(base_url() . 'catalogs');
            }
        }
        
        // Upload PDF
        if (!empty($_FILES['pdf']['name'])) {
            $config['upload_path'] = $pdfPath;
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
        
            $this->upload->initialize($config);
        
            if ($this->upload->do_upload('pdf')) {
                $upload_data = $this->upload->data();
                $data['pdf'] = $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('message', 'PDF upload failed: ' . $this->upload->display_errors());
                $this->session->set_flashdata('message_type', 'error');
                redirect(base_url() . 'catalogs');
            }
        }
        
        // Update data in database
        if ($this->Admin_Model->update_catalogs($id, $data)) {
            $this->session->set_flashdata('message', 'Catalogs updated successfully!');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Failed to update catalogs.');
            $this->session->set_flashdata('message_type', 'error');
        }
        
        // Redirect to catalogs list page
        redirect(base_url() . 'catalogs');

    }
    
    public function delete_catalogs($id) {
        
        $catalog = $this->Admin_Model->get_catalogs_by_id($id);
        if (!$catalog) {
            $this->session->set_flashdata('message', 'Catalogs not found.');
            $this->session->set_flashdata('message_type', 'error');
            redirect(base_url() . 'catalogues');
        }
    
        // Define file paths
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/newweb/images/catalogs/' . $catalog['image'];
        $pdfPath = $_SERVER['DOCUMENT_ROOT'] . '/newweb/images/catalogs/' . $catalog['pdf'];
    
        // Delete image file if it exists
        if (!empty($catalog['image']) && file_exists($imagePath)) {
            unlink($imagePath);
        }
    
        // Delete PDF file if it exists
        if (!empty($catalog['pdf']) && file_exists($pdfPath)) {
            unlink($pdfPath);
        }
    
        // Delete catalog entry from database
        if ($this->Admin_Model->delete_catalogs($id)) {
            $this->session->set_flashdata('message', 'Catalogs deleted successfully!');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Failed to delete catalogs.');
            $this->session->set_flashdata('message_type', 'error');
        }
    
        redirect(base_url() . 'catalogs');
    
    
    }
	
	 
}