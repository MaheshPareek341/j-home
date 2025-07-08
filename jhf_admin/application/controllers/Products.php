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
	
	// public function edit_products($id){
	//     $data['page_name'] = "Edit Products";
	//     $data['products'] = $this->Admin_Model->get_products_by_id($id);
	// 	$this->load->view('productsEdit',$data);
	// }

    public function edit_products($id) {
        // Load the model
        $this->load->model('Admin_Model');

        // Fetch product and images
        $data = $this->Admin_Model->get_product_by_id($id);

        if ($data === false) {
            $this->session->set_flashdata('message', 'Product not found.');
            $this->session->set_flashdata('message_type', 'error');
            redirect(base_url('products'));
        }

        // Prepare data for the view
        $view_data = [
            'product' => $data['product'],
            'product_images' => $data['images']
        ];

        // Load the edit view
        $this->load->view('productsEdit', $view_data);
    }

    public function save_products() {
        $filePath = realpath($_SERVER['DOCUMENT_ROOT'] . '/j-home/images/product/');
        $config['upload_path'] = $filePath;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['overwrite'] = true;
        $this->upload->initialize($config);

        $images = [];
        $errors = [];

        // Prepare product data for product table
        $product_data = [
            'name' => $this->input->post('product_name'),
            'item_code' => $this->input->post('item_code'),
            'size' => $this->input->post('size'),
            'material' => $this->input->post('material'),
            'finish' => $this->input->post('finish'),
            'category' => $this->input->post('category'),
        ];

        // Handle multiple image uploads
        if (!empty($_FILES['images']['name'][0])) {
            $files = $_FILES['images'];
            $file_count = count($files['name']);

            // Process each file
            for ($i = 0; $i < $file_count; $i++) {
                if (!empty($files['name'][$i])) {
                    // Generate unique prefix (timestamp + random string)
                    $unique_prefix = date('YmdHis') . '_' . uniqid();
                    $file_ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
                    $config['file_name'] = $unique_prefix . '.' . $file_ext;
                    $this->upload->initialize($config);

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

        // Save product data and images
        if ($this->Admin_Model->add_products($product_data, $images)) {
            $this->session->set_flashdata('message', 'Product and images saved successfully!');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Failed to save product. ' . implode(', ', $errors));
            $this->session->set_flashdata('message_type', 'error');
        }

        redirect(base_url() . 'products');
    }
	
	//  public function update_products($id) {
    //     // Get POST data
    //    $data = array(
    //         'name'=>$this->input->post('name'),
           
    //     );
        
    //     $filePath = realpath($_SERVER['DOCUMENT_ROOT'].'/newweb/images/products/'); //'./assets/uploads/';
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
    //             $data['image'] = $upload_data['file_name'];
        
    //       }
    //     }
     
    //     // Update data
    //     if ($this->Admin_Model->update_products($id, $data)) {
    //         $this->session->set_flashdata('message', 'Products updated successfully!');
    //         $this->session->set_flashdata('message_type', 'success');
    //     } else {
    //         $this->session->set_flashdata('message', 'Failed to update products.');
    //         $this->session->set_flashdata('message_type', 'error');
    //     }

    //     // Redirect to list page
    //     redirect(base_url().'products');
    // }

    // public function update_products($id) {
    //     // Get POST data
    //     $data = array(
    //         'name' => $this->input->post('name'),
    //         'item_code' => $this->input->post('item_code'),
    //         'size' => $this->input->post('size'),
    //         'material' => $this->input->post('material'),
    //         'finish' => $this->input->post('finish')
    //     );

    //     // Handle removed images
    //     $removed_images = $this->input->post('removed_images');
    //     $removed_images = $removed_images ? json_decode($removed_images, true) : array();

    //     // Handle new image uploads
    //     $filePath = FCPATH . 'uploads/products/';
    //     $config['upload_path'] = $filePath;
    //     $config['allowed_types'] = 'gif|jpg|png|jpeg';
    //     $config['max_size'] = 2048; // 2MB max size
    //     $config['overwrite'] = false;

    //     $this->upload->initialize($config);
    //     $new_images = array();

    //     if (!empty($_FILES['images']['name'][0])) {
    //         $files = $_FILES['images'];
    //         $count = count($_FILES['images']['name']);

    //         for ($i = 0; $i < $count; $i++) {
    //             $_FILES['image']['name'] = $files['name'][$i];
    //             $_FILES['image']['type'] = $files['type'][$i];
    //             $_FILES['image']['tmp_name'] = $files['tmp_name'][$i];
    //             $_FILES['image']['error'] = $files['error'][$i];
    //             $_FILES['image']['size'] = $files['size'][$i];

    //             if ($this->upload->do_upload('image')) {
    //                 $upload_data = $this->upload->data();
    //                 $new_images[] = $upload_data['file_name'];
    //             } else {
    //                 $this->session->set_flashdata('message', $this->upload->display_errors());
    //                 $this->session->set_flashdata('message_type', 'error');
    //                 redirect(base_url('products/edit/' . $id));
    //             }
    //         }
    //     }

    //     // Update product and images
    //     if ($this->Admin_Model->update_products($id, $data, $removed_images, $new_images)) {
    //         $this->session->set_flashdata('message', 'Product updated successfully!');
    //         $this->session->set_flashdata('message_type', 'success');
    //     } else {
    //         $this->session->set_flashdata('message', 'Failed to update product.');
    //         $this->session->set_flashdata('message_type', 'error');
    //     }

    //     // Redirect to products list
    //     redirect(base_url('products'));
    // }

    public function update_products($id) {
        // Load form validation library
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Product Name', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('item_code', 'Item Code', 'required|alpha_numeric');
        $this->form_validation->set_rules('size', 'Size', 'required');
        $this->form_validation->set_rules('material', 'Material', 'required');
        $this->form_validation->set_rules('finish', 'Finish', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', validation_errors());
            $this->session->set_flashdata('message_type', 'error');
            redirect(base_url('products/edit/' . $id));
        }

        // Prepare product data
        $product_data = [
            'name' => $this->input->post('name'),
            'item_code' => $this->input->post('item_code'),
            'size' => $this->input->post('size'),
            'material' => $this->input->post('material'),
            'finish' => $this->input->post('finish'),
            'category' => $this->input->post('category'),
        ];

        // Handle removed images
        $removed_images = $this->input->post('removed_images');
        $removed_images = $removed_images ? json_decode($removed_images, true) : [];

        // Handle new image uploads
        $filePath = FCPATH . 'Uploads/products/';
        if (!is_dir($filePath)) {
            mkdir($filePath, 0755, true);
        }

        $config['upload_path'] = $filePath;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2048; // 2MB limit
        $config['overwrite'] = false;
        $this->upload->initialize($config);

        $new_images = [];
        $errors = [];

        if (!empty($_FILES['images']['name'][0])) {
            $files = $_FILES['images'];
            $file_count = count($files['name']);

            if ($file_count > 5) {
                $errors[] = 'Maximum 5 images allowed.';
            } else {
                for ($i = 0; $i < $file_count; $i++) {
                    if (!empty($files['name'][$i])) {
                        $unique_prefix = date('YmdHis') . '_' . uniqid();
                        $file_ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
                        $config['file_name'] = $unique_prefix . '.' . $file_ext;
                        $this->upload->initialize($config);

                        $_FILES['image'] = [
                            'name' => $files['name'][$i],
                            'type' => $files['type'][$i],
                            'tmp_name' => $files['tmp_name'][$i],
                            'error' => $files['error'][$i],
                            'size' => $files['size'][$i]
                        ];

                        if ($this->upload->do_upload('image')) {
                            $upload_data = $this->upload->data();
                            if (getimagesize($upload_data['full_path'])) {
                                $new_images[] = $upload_data['file_name'];
                            } else {
                                $errors[] = 'Invalid image file: ' . $files['name'][$i];
                            }
                        } else {
                            $errors[] = $this->upload->display_errors('', '') . ' for ' . $files['name'][$i];
                        }
                    }
                }
            }
        }

        // Update product and images
        if (empty($errors) && $this->Admin_Model->update_products($id, $product_data, $removed_images, $new_images)) {
            $this->session->set_flashdata('message', 'Product updated successfully!');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Failed to update product: ' . implode(', ', $errors));
            $this->session->set_flashdata('message_type', 'error');
        }

        redirect(base_url('products'));
    }
    
    public function delete_products($id) {
        // Fetch product by ID
        $product = $this->Admin_Model->get_products_by_id($id);
        if (!$product) {
            $this->session->set_flashdata('message', 'Product not found.');
            $this->session->set_flashdata('message_type', 'error');
            redirect(base_url() . 'products');
        }

        // Fetch associated images
        $images = $this->Admin_Model->get_product_images($id);

        // Delete image files from filesystem
        $basePath = $_SERVER['DOCUMENT_ROOT'] . '/j-home/images/product/';
        foreach ($images as $image) {
            $imagePath = $basePath . $image['image'];
            if (!empty($image['image']) && file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Attempt to delete the product and its images
        if ($this->Admin_Model->delete_products($id)) {
            $this->session->set_flashdata('message', 'Product and associated images deleted successfully!');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Failed to delete product or images.');
            $this->session->set_flashdata('message_type', 'error');
        }

        // Redirect back to the products list
        redirect(base_url() . 'products');
    }
	
	 
}