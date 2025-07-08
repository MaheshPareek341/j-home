<?php

require_once __DIR__ . '/../controllers/ContactController.php';

$routes = [
    '/contact-us' => ['ContactController', 'index'],
    '/contact-submit' => ['ContactController', 'submit'],
];