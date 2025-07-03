<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct()
	{
		parent::__construct();		
		$this->config->load('application',TRUE);
		$this->load->model('Admin_Model');
		$this->load->helper('form');
        $this->load->library('form_validation');
	}


	public function index()
	{
	   
		$this->load->view('login');
	}
	
	public function login()
	{
	   $this->load->view('login');
	}
	
	public function add_user(){
	    $full_name = $this->input->post('full_name');
        $email = $this->input->post('email');
        $phone_number = $this->input->post('phone_number');
        $telegram = $this->input->post('telegram');
        $twitter = $this->input->post('twitter');
        $instagram = $this->input->post('instagram');
        $wallet_address = $this->input->post('wallet_address');
        $data = array(
            'full_name'=>$full_name,
            'email'=>$email,
            'phone_number'=>$phone_number,
            'telegram'=>$telegram,
            'twitter'=>$twitter,
            'instagram'=>$instagram,
            'wallet_address'=>$wallet_address,
        );

        // Save data
        if ($this->Admin_Model->create_user($data)) {
            $this->session->set_flashdata('message', 'Users saved successfully!');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Failed to save users.');
            $this->session->set_flashdata('message_type', 'error');
        }
         redirect('https://mynetworkstate.com/register?msg=success');
       
	}
	
	function login_validation()  
      {  
          
           $this->load->library('form_validation');  
           $this->form_validation->set_rules('username', 'Username', 'required');  
           $this->form_validation->set_rules('password', 'Password', 'required');  
           if($this->form_validation->run())  
           {  
                //true  
                $username = $this->input->post('username');  
                $password = md5($this->input->post('password'));  
                //model function  
                // $this->load->model('main_model');  
                if($this->Admin_Model->admin_login($username, $password))  
                {  
                     $session_data = array(  
                          'username'     =>     $username,
                          'is_admin_login' => 1
                     );  
                     $this->session->set_userdata($session_data);  
                    redirect(base_url() . 'admin/dashboard');  
                }  
                else  
                {  
                     $this->session->set_flashdata('error', 'Invalid Username and Password');  
                     redirect(base_url() . 'admin/login');  
                }  
           }  
           else  
           {  
                //false  
                $this->login();  
           }  
      }  
      
      function logout()  
      {  
           $this->session->unset_userdata('username');  
            $this->session->unset_userdata('is_admin_login'); 
           redirect(base_url() . 'admin/login');  
      }  
     
    public function getAllUsers()
	{
	   
	    if(!isset($this->session->userdata['is_admin_login'])) { redirect('/'); }
	    $data['users'] = $this->Admin_Model->getAllUsers();
		$this->load->view('usersList',$data);
	}
	
	public function edit_user($user_id){
		$data['user'] = $this->Admin_Model->get_user_by_id($user_id);
		$this->load->view('userEdit',$data);
	}
	
	public function delete_user($id) {
               // Attempt to delete the user
        if ($this->Admin_Model->delete_user($id)) {
            $this->session->set_flashdata('message', 'User deleted successfully!');
             $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Failed to delete user.');
             $this->session->set_flashdata('message_type', 'error');
        }

        // Redirect back to the user list
        redirect(base_url().'admin/users');
    }
    
    public function update_user($user_id) {
        $this->form_validation->set_rules('full_name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        
         if ($this->form_validation->run() === FALSE) {
            // Validation failed, reload the form with error messages
            $this->session->set_flashdata('message', validation_errors());
            $this->session->set_flashdata('message_type', 'error');
            $this->edit_user($user_id);
        } else {
            // Prepare the updated data
            $data = array(
                'full_name'       => $this->input->post('full_name'),
                'email'     => $this->input->post('email'),
                'phone_number'        => $this->input->post('phone_number'),
                'telegram'          => $this->input->post('telegram'),
                'twitter'  => $this->input->post('twitter'),
                'instagram'        => $this->input->post('instagram'),
                'wallet_address'   => $this->input->post('wallet_address')
            );

            // Call the model to update the song
            if ($this->Admin_Model->update_user($user_id, $data)) {
                // Set success message
                $this->session->set_flashdata('message', 'User updated successfully!');
                $this->session->set_flashdata('message_type', 'success');
                redirect(base_url().'admin/users');
            } else {
                // Set failure message
                $this->session->set_flashdata('message', 'Failed to update user.');
                $this->session->set_flashdata('message_type', 'error');
                $this->edit_user($user_id); // Reload the form with error
            }
        }
    }
}
