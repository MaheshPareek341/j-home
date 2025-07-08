<?php
class ContactController {
    public function index() {
        require_once __DIR__ . '/../views/contact-us.php';
    }

    public function submit() {
        // Handle form submission (e.g., save to DB or send email)
        echo "Form submitted!";
    }
}
