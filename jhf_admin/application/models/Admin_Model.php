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
        
        // public function add_products($data) {
        //     return $this->db->insert('product', $data);
        // }
        
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

        public function update_products($id, $data) {
            $this->db->where('id', $id);
            return $this->db->update('product', $data);
        }
        
        public function delete_products($id) {
             $this->db->delete('product', array('id' => $id));
             return true;
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
        
    }
?>