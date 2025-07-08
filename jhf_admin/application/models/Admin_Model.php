<?php  
    class Admin_model extends CI_Model  
    {  
        function admin_login($username, $password)  
        {  
            $this->db->where('username', $username);  
            $this->db->where('password', $password);  
            $query = $this->db->get('admins');  
           
            if($query->num_rows() > 0)  
            {  
                return true;  
            }  
            else  
            {  
                return false;       
            }  
        }
        
        public function create_user($data) {
            return $this->db->insert('users', $data);
        }
        
        //******************************* CATEGORY ************************************************************
        
        function getAllCategories(){
            return $this->db->select("*")->get('category')->result();
        }
        
        public function add_category($data) {
            return $this->db->insert('category', $data);
        }
        
        public function update_category($id, $data) {
            $this->db->where('id', $id);
            return $this->db->update('category', $data);
        }
        
        public function delete_category($id) {
             $this->db->delete('category', array('id' => $id));
             $this->db->delete('sub_category', array('category_id' => $id));
             return true;
        }
        
        public function get_category_by_id($id) {
            return $this->db->get_where('category', ['id' => $id])->row_array();
        }
        
        
         
        //******************************* Sub CATEGORY ************************************************************
        
       
        function getAllSubCategories(){
            return $this->db->select('sub_category.*, category.id as category_id, category.name as category_name')
                            ->from('sub_category')
                            ->join('category', 'sub_category.category_id = category.id', 'left')
                            ->get()
                            ->result();
        }


        
        public function add_sub_category($data) {
            return $this->db->insert('sub_category', $data);
        }
        
        public function update_sub_category($id, $data) {
            $this->db->where('id', $id);
            return $this->db->update('sub_category', $data);
        }
        
        public function delete_sub_category($id) {
            return $this->db->delete('sub_category', array('id' => $id));
        }
        
        public function get_sub_category_by_id($id) {
            return $this->db->get_where('sub_category', ['id' => $id])->row_array();
        }
        
        
        
        
        
        
        
         //******************************* CATALOGS ************************************************************
        
        function getAllCatalogs(){
            return $this->db->select("*")->get('catalogs')->result();
        }
        
        public function add_catalogs($data) {
            return $this->db->insert('catalogs', $data);
        }
        
        public function update_catalogs($id, $data) {
            $this->db->where('id', $id);
            return $this->db->update('catalogs', $data);
        }
        
        public function delete_catalogs($id) {
             $this->db->delete('catalogs', array('id' => $id));
             return true;
        }
        
        public function get_catalogs_by_id($id) {
            return $this->db->get_where('catalogs', ['id' => $id])->row_array();
        }
        
        
        
        
        
        
        
        
        
        public function getAllProducts(){
            return $this->db->select("*")->get('product')->result();
        }

        public function add_products($product_data, $images) {
            // Start a transaction for data consistency
            $this->db->trans_start();

            // Insert product data into product table
            $this->db->insert('product', $product_data);
            $product_id = $this->db->insert_id();

            // Insert images into product_images table
            if (!empty($images)) {
                foreach ($images as $image) {
                    $image_data = [
                        'product_id' => $product_id,
                        'image' => $image
                    ];
                    $this->db->insert('product_images', $image_data);
                }
            }

            // Complete the transaction
            $this->db->trans_complete();

            // Return true if transaction was successful, false otherwise
            return $this->db->trans_status();
        }

        // public function update_products($id, $data) {
        //     $this->db->where('id', $id);
        //     return $this->db->update('product', $data);
        // }

        public function get_product_images($product_id) {
            $this->db->where('product_id', $product_id);
            $query = $this->db->get('product_images');
            return $query->result();
        }

        // Update product and images
        // public function update_products($id, $product_data, $removed_images, $new_images) {
        //     // Start a transaction
        //     $this->db->trans_start();

        //     // Update product data
        //     $this->db->where('id', $id);
        //     $this->db->update('product', $product_data);

        //     // Delete removed images
        //     if (!empty($removed_images)) {
        //         $this->db->where('product_id', $id);
        //         $this->db->where_in('image', $removed_images);
        //         $this->db->delete('product_images');

        //         // Delete image files from server
        //         foreach ($removed_images as $image) {
        //             $file_path = FCPATH . 'uploads/products/' . $image;
        //             if (file_exists($file_path)) {
        //                 unlink($file_path);
        //             }
        //         }
        //     }

        //     // Insert new images
        //     if (!empty($new_images)) {
        //         foreach ($new_images as $image) {
        //             $image_data = [
        //                 'product_id' => $id,
        //                 'image' => $image
        //             ];
        //             $this->db->insert('product_images', $image_data);
        //         }
        //     }

        //     // Complete the transaction
        //     $this->db->trans_complete();

        //     // Return true if transaction was successful
        //     return $this->db->trans_status();
        // }

        public function get_product_by_id($id) {
            // Fetch product data
            $this->db->select('*');
            $this->db->from('product');
            $this->db->where('id', $id);
            $query = $this->db->get();

            if ($query->num_rows() == 0) {
                log_message('error', 'Product not found for ID: ' . $id);
                return false;
            }

            $product = $query->row();

            // Fetch associated images
            $this->db->select('id, image');
            $this->db->from('product_images');
            $this->db->where('product_id', $id);
            $images_query = $this->db->get();
            $product_images = $images_query->result();

            return [
                'product' => $product,
                'images' => $product_images
            ];
        }

        public function update_products($id, $product_data, $removed_images, $new_images) {
            // Start a transaction
            $this->db->trans_start();

            // Update product data
            $this->db->where('id', $id);
            if (!$this->db->update('product', $product_data)) {
                log_message('error', 'Failed to update product ID ' . $id . ': ' . json_encode($product_data));
                $this->db->trans_rollback();
                return false;
            }

            // Delete removed images
            if (!empty($removed_images)) {
                $this->db->where('product_id', $id);
                $this->db->where_in('image', $removed_images);
                if (!$this->db->delete('product_images')) {
                    log_message('error', 'Failed to delete images for product ID ' . $id . ': ' . json_encode($removed_images));
                    $this->db->trans_rollback();
                    return false;
                }

                // Delete image files from server
                foreach ($removed_images as $image) {
                    $file_path = FCPATH . 'Uploads/products/' . $image;
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }
            }

            // Insert new images
            if (!empty($new_images)) {
                foreach ($new_images as $image) {
                    $image_data = [
                        'product_id' => $id,
                        'image' => $image
                    ];
                    if (!$this->db->insert('product_images', $image_data)) {
                        log_message('error', 'Failed to insert image for product ID ' . $id . ': ' . $image);
                        $this->db->trans_rollback();
                        return false;
                    }
                }
            }

            // Complete the transaction
            $this->db->trans_complete();
            return $this->db->trans_status();
        }
        
        // public function get_product_images($product_id) {
        //     $this->db->select('image');
        //     $this->db->from('product_images');
        //     $this->db->where('product_id', $product_id);
        //     $query = $this->db->get();
        //     return $query->result_array();
        // }

        public function delete_products($id) {
            // Start a transaction for data consistency
            $this->db->trans_start();

            // Delete associated images from product_images table
            $this->db->delete('product_images', array('product_id' => $id));

            // Delete product from product table
            $this->db->delete('product', array('id' => $id));

            // Complete the transaction
            $this->db->trans_complete();

            // Return true if transaction was successful, false otherwise
            return $this->db->trans_status();
        }
        
        public function get_products_by_id($id) {
            return $this->db->get_where('product', ['id' => $id])->row_array();
        }
        
        
        
        
        
        
        
        
        
        
        
        
        
        function getTotalCategoryCount(){
            return $this->db->from("category")->where('cat_status',1)->count_all_results();
        }
        
        function getTotalSongsCount(){
            return $this->db->from("songs")->where('song_status', 1)->count_all_results();
        }
        
        
        
        function getAllCommitee(){
            return $this->db->select("*")->get('commitee')->result();
        }
        
        public function add_commitee($data) {
            return $this->db->insert('commitee', $data);
        }
        
        public function update_commitee($id, $data) {
            $this->db->where('id', $id);
            return $this->db->update('commitee', $data);
        }
        
        public function delete_commitee($id) {
            return $this->db->delete('commitee', array('id' => $id));
        }
        
        public function get_commitee_by_id($id) {
            return $this->db->get_where('commitee', ['id' => $id])->row_array();
        }
        
      
        
        public function getAllGallery(){
            return $this->db->select("*")
                 ->from('gallery')
                 ->get()
                 ->result();
        }
        
        public function add_image($data) {
            return $this->db->insert('gallery', $data);
        }
        
        public function update_image($id, $data) {
            $this->db->where('id', $id);
            return $this->db->update('gallery', $data);
        }
        
        public function delete_image($id) {
            return $this->db->delete('gallery', array('id' => $id));
        }
        
        public function get_image_by_id($id) {
            return $this->db->get_where('gallery', ['id' => $id])->row_array();
        }

        
        public function update_user($id, $data) {
          
            $this->db->where('user_id', $id);
            return $this->db->update('users', $data);
        }
        
        public function delete_user($id) {
            return $this->db->delete('users', array('user_id' => $id));
        }
        
        public function get_user_by_id($user_id) {
            return $this->db->get_where('users', ['user_id' => $user_id])->row_array();
        }






        /**
     * Add a new contact form submission
     * @param array $data Contact data (name, email, subject, message)
     * @return bool True on success, false on failure
     */
    // public function add_contact($data) {
    //     // Start a transaction
    //     $this->db->trans_start();

    //     // Insert contact data
    //     $this->db->insert('contact_us', $data);

    //     // Check for database errors
    //     if ($this->db->error()['code']) {
    //         log_message('error', 'Failed to insert contact: ' . json_encode($data) . ' Error: ' . json_encode($this->db->error()));
    //         $this->db->trans_rollback();
    //         return false;
    //     }

    //     $contact_id = $this->db->insert_id();

    //     // Complete the transaction
    //     $this->db->trans_complete();

    //     // Log success
    //     log_message('debug', 'Contact added successfully, ID: ' . $contact_id);

    //     return $this->db->trans_status();
    // }

    public function add_contact($data) {
        try {
            // Insert data into the contacts table
            $data['created_at'] = date('Y-m-d H:i:s');
            return $this->db->insert('contacts', $data);
        } catch (Exception $e) {
            log_message('error', 'Failed to insert contact: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get all contact form submissions
     * @return array|bool Array of contact entries or false on error
     */
    public function get_all_contacts() {
        $this->db->select('id, name, email, subject, message');
        $this->db->from('contact_us');
        $this->db->order_by('id', 'DESC'); // Latest first
        $query = $this->db->get();

        // Check for database errors
        if ($this->db->error()['code']) {
            log_message('error', 'Database error in get_all_contacts: ' . json_encode($this->db->error()));
            return false;
        }

        return $query->result();
    }

    /**
     * Get a single contact by ID
     * @param int $id Contact ID
     * @return object|bool Contact object or false if not found
     */
    public function get_contact_by_id($id) {
        // Sanitize ID
        $id = (int)$id;

        $this->db->select('id, name, email, subject, message');
        $this->db->from('contact_us');
        $this->db->where('id', $id);
        $query = $this->db->get();

        // Check for database errors
        if ($this->db->error()['code']) {
            log_message('error', 'Database error in get_contact_by_id for ID ' . $id . ': ' . json_encode($this->db->error()));
            return false;
        }

        // Check if contact exists
        if ($query->num_rows() == 0) {
            log_message('error', 'Contact not found for ID: ' . $id);
            return false;
        }

        return $query->row();
    }

    /**
     * Delete a contact by ID
     * @param int $id Contact ID
     * @return bool True on success, false on failure
     */
    public function delete_contact($id) {
        // Sanitize ID
        $id = (int)$id;

        // Start a transaction
        $this->db->trans_start();

        $this->db->where('id', $id);
        $this->db->delete('contact_us');

        // Check for database errors
        if ($this->db->error()['code']) {
            log_message('error', 'Failed to delete contact ID ' . $id . ': ' . json_encode($this->db->error()));
            $this->db->trans_rollback();
            return false;
        }

        // Complete the transaction
        $this->db->trans_complete();

        // Log success
        log_message('debug', 'Contact deleted successfully, ID: ' . $id);

        return $this->db->trans_status();
    }
        
    }
?>