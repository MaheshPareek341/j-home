<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
	function __construct()
	{
		parent::__construct();		
		$this->config->load('application',TRUE);
		$this->load->model('Admin_Model');
		if(!isset($this->session->userdata['is_admin_login'])) {	redirect(base_url()."cmsadmin/login");  }
	}


	public function index()
	{
	    $data['products'] = $this->Admin_Model->getAllProducts();
	   
		$this->load->view('productsList',$data);
	}
	
	public function add_products()
	{
	   
	    $data['page_name'] = "Add Products";
		$this->load->view('productsAdd',$data);
	}
	
	public function edit_products($id){
	    $data['page_name'] = "Edit Products";
	    $data['products'] = $this->Admin_Model->get_products_by_id($id);
		$this->load->view('productsEdit',$data);
	}
	
	// public function save_products(){
	    
	//     $filePath = realpath($_SERVER['DOCUMENT_ROOT'].'/newweb/images/product/'); //'./assets/uploads/';
    //     $config['upload_path'] = $filePath;
    //     $config['allowed_types'] = 'gif|jpg|png|jpeg';
    //     $config['overwrite'] = true;
    //     $image = '';
    //     $this->upload->initialize($config);
        
    //     if (!empty($_FILES['image'])) {
        
    //       if (!$this->upload->do_upload('image')) {
         
    //            // errors
        
    //       } else {
        
    //            $upload_data = $this->upload->data();
    //             $image = $upload_data['file_name'];
        
    //       }
    //     }
	    
    //     $data = array(
    //         'name'=>$this->input->post('name'),
    //         'image'=>$image,
            
    //     );

    //     // Save data
    //     if ($this->Admin_Model->add_products($data)) {
    //         $this->session->set_flashdata('message', 'Products saved successfully!');
    //         $this->session->set_flashdata('message_type', 'success');
    //     } else {
    //          $this->session->set_flashdata('message', 'Failed to save products.');
    //         $this->session->set_flashdata('message_type', 'error');
    //     }
    //      redirect(base_url().'products');
       
	// }

     public function save_products() {
        $filePath = realpath($_SERVER['DOCUMENT_ROOT'] . '/newweb/images/product/');
        $config['upload_path'] = $filePath;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['overwrite'] = true;
        $this->upload->initialize($config);

        $images = [];
        $errors = [];

        // Handle multiple image uploads
        if (!empty($_FILES['images']['name'][0])) {
            $files = $_FILES['images'];
            $file_count = count($files['name']);

            // Process each file
            for ($i = 0; $i < $file_count; $i++) {
                if (!empty($files['name'][$i])) {
                    $_FILES['image'] = [
                        'name' => $files['name'][$i],
                        'type' => $files['type'][$i],
                        'tmp_name' => $files['tmp_name'][$i],
                        'error' => $files['error'][$i],
                        'size' => $files['size'][$i]
                    ];

                    if ($this->upload->do_upload('image')) {
                        $upload_data = $this->upload->data();
                        $images[] = $upload_data['file_name'];
                    } else {
                        $errors[] = $this->upload->display_errors();
                    }
                }
            }
        }

        // Prepare product data for product table
        $product_data = [
            'name' => $this->input->post('product_name'),
            'item_code' => $this->input->post('item_code'),
            'size' => $this->input->post('size'),
            'material' => $this->input->post('material'),
            'finish' => $this->input->post('finish')
        ];

        // Save data
        if ($this->Admin_Model->add_products($product_data, $images)) {
            $this->session->set_flashdata('message', 'Product saved successfully!');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Failed to save product. ' . implode(', ', $errors));
            $this->session->set_flashdata('message_type', 'error');
        }

        redirect(base_url() . 'products');
    }
	
	 public function update_products($id) {
        // Get POST data
       $data = array(
            'name'=>$this->input->post('name'),
           
        );
        
        $filePath = realpath($_SERVER['DOCUMENT_ROOT'].'/newweb/images/products/'); //'./assets/uploads/';
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
        if ($this->Admin_Model->update_products($id, $data)) {
            $this->session->set_flashdata('message', 'Products updated successfully!');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Failed to update products.');
            $this->session->set_flashdata('message_type', 'error');
        }

        // Redirect to list page
        redirect(base_url().'products');
    }
    
    public function delete_products($id) {
        
        $products = $this->Admin_Model->get_products_by_id($id);
        if (!$products) {
            $this->session->set_flashdata('message', 'Products not found.');
            $this->session->set_flashdata('message_type', 'error');
            redirect(base_url() . 'products');
        }
    
        // Define file paths
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/newweb/images/products/' . $products['image'];
    
        // Delete image file if it exists
        if (!empty($products['image']) && file_exists($imagePath)) {
            unlink($imagePath);
        }
        
        
               // Attempt to delete the products
        if ($this->Admin_Model->delete_products($id)) {
            $this->session->set_flashdata('message', 'Products deleted successfully!');
        } else {
            $this->session->set_flashdata('message', 'Failed to delete products.');
        }

        // Redirect back to the products list
        redirect(base_url().'products');
    }
	
	 
}