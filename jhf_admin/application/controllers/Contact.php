<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load required libraries and model
        $this->load->library(['session', 'form_validation']);
        $this->load->model('Admin_Model');
    }

    /**
     * Display and handle contact form submission
     */
    public function index() {
        $data['contacts'] = $this->Admin_Model->get_all_contacts();

        $this->load->view('contactList', $data);
    }


    // public function store() {
    //     // Handle form submission
    //     if ($this->input->method() === 'post') {
    //         // Set form validation rules
    //         $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|max_length[255]|trim|xss_clean');
    //         $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|xss_clean');
    //         $this->form_validation->set_rules('subject', 'Subject', 'required|min_length[3]|max_length[255]|trim|xss_clean');
    //         $this->form_validation->set_rules('message', 'Message', 'required|min_length[10]|trim|xss_clean');

    //         if ($this->form_validation->run() === FALSE) {
    //             // Validation failed, reload the form with errors
    //             $this->session->set_flashdata('message', validation_errors());
    //             $this->session->set_flashdata('message_type', 'error');
    //             $this->index(); // Reload the form view
    //         } else {
    //             // Prepare data for insertion
    //             $data = [
    //                 'name' => $this->security->xss_clean($this->input->post('name', TRUE)),
    //                 'email' => $this->security->xss_clean($this->input->post('email', TRUE)),
    //                 'subject' => $this->security->xss_clean($this->input->post('subject', TRUE)),
    //                 'message' => $this->security->xss_clean($this->input->post('message', TRUE))
    //             ];

    //             // Attempt to save data
    //             try {
    //                 if ($this->Admin_Model->add_contact($data)) {
    //                     $this->session->set_flashdata('message', 'Contact form submitted successfully!');
    //                     $this->session->set_flashdata('message_type', 'success');
    //                 } else {
    //                     $this->session->set_flashdata('message', 'Failed to submit contact form. Please try again.');
    //                     $this->session->set_flashdata('message_type', 'error');
    //                 }
    //             } catch (Exception $e) {
    //                 // Handle database or other errors
    //                 $this->session->set_flashdata('message', 'An error occurred: ' . $e->getMessage());
    //                 $this->session->set_flashdata('message_type', 'error');
    //             }

    //             redirect(base_url('contact-us'));
    //         }
    //     } else {
    //         // Handle non-POST requests
    //         redirect(base_url('contact-us'));
    //     }
    // }

    public function store() {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|max_length[255]|trim|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|xss_clean');
            $this->form_validation->set_rules('subject', 'Subject', 'required|min_length[3]|max_length[255]|trim|xss_clean');
            $this->form_validation->set_rules('message', 'Message', 'required|min_length[10]|trim|xss_clean');

            if ($this->form_validation->run() === FALSE) {
                echo json_encode([
                    'message' => validation_errors(),
                    'message_type' => 'error'
                ]);
                return;
            }

            $data = [
                'name' => $this->security->xss_clean($this->input->post('name', TRUE)),
                'email' => $this->security->xss_clean($this->input->post('email', TRUE)),
                'subject' => $this->security->xss_clean($this->input->post('subject', TRUE)),
                'message' => $this->security->xss_clean($this->input->post('message', TRUE))
            ];

            try {
                if ($this->Admin_Model->add_contact($data)) {
                    echo json_encode([
                        'message' => 'Contact form submitted successfully!',
                        'message_type' => 'success'
                    ]);
                } else {
                    echo json_encode([
                        'message' => 'Failed to submit contact form. Please try again.',
                        'message_type' => 'error'
                    ]);
                }
            } catch (Exception $e) {
                echo json_encode([
                    'message' => 'An error occurred: ' . $e->getMessage(),
                    'message_type' => 'error'
                ]);
            }
        } else {
            echo json_encode([
                'message' => 'Invalid request method.',
                'message_type' => 'error'
            ]);
        }
    }

    /**
     * List all contact submissions (admin view)
     */
    public function admin_list() {
        $data['contacts'] = $this->Admin_Model->get_all_contacts();

        if ($data['contacts'] === false) {
            $this->session->set_flashdata('message', 'Error fetching contact submissions.');
            $this->session->set_flashdata('message_type', 'error');
            $data['contacts'] = [];
        }

        $this->load->view('contact/index', $data);
    }

    /**
     * View a single contact submission (admin view)
     * @param int $id Contact ID
     */
    public function view($id) {
        $id = (int)$id;
        $data['contact'] = $this->Admin_Model->get_contact_by_id($id);

        if ($data['contact'] === false) {
            $this->session->set_flashdata('message', 'Contact not found.');
            $this->session->set_flashdata('message_type', 'error');
            redirect(base_url('contact/admin_list'));
        }

        $this->load->view('contact/view', $data);
    }

    /**
     * Delete a contact submission (admin action)
     * @param int $id Contact ID
     */
    public function delete($id) {
        $id = (int)$id;
        if ($this->Admin_Model->delete_contact($id)) {
            $this->session->set_flashdata('message', 'Contact deleted successfully.');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Failed to delete contact.');
            $this->session->set_flashdata('message_type', 'error');
        }

        redirect(base_url('contact/admin_list'));
    }
}