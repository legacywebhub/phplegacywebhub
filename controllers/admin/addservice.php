<?php

// Authorizing admin
$admin = admin_logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Add Service";


// Handling add service request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    // Declaring DB variables as PHP array
    $data = [
        'service' => sanitize_input($_POST['service'])
    ];
    
    try {
        $query = "INSERT INTO services (service) VALUES (:service)";
        $query = query_db($query, $data);
        $message = "Service was successfully added";
        $message_tag = "success";
        redirect('services', $message, $message_tag);
    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect('addservice', $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin
];

admin_view('addservice', $context);