<?php

// Authorizing admin
$admin = admin_logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Add Setting";


// Handling add setting request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    // Checking if there is an existing record
    $record = query_fetch("SELECT * FROM company");
    if (count($record) > 0) {
        $message = "Record already exists";
        redirect('settings', $message, "danger");
    }

    // Declaring DB variables as PHP array
    $data = [];
    $data['name'] = sanitize_input($_POST['name']);
    $data['domain'] = sanitize_input($_POST['domain']);
    $data['address'] = sanitize_input($_POST['address']);
    $data['email1'] = sanitize_input($_POST['email1']);
    $data['email2'] = sanitize_input($_POST['email2']);
    $data['phone1'] = sanitize_input($_POST['phone1']);
    $data['phone2'] = sanitize_input($_POST['phone2']);
    $data['whatsapp_link'] = sanitize_input($_POST['whatsapp_link']);
    $data['facebook_link'] = sanitize_input($_POST['facebook_link']);
    $data['instagram_link'] = sanitize_input($_POST['instagram_link']);
    $data['x_link'] = sanitize_input($_POST['x_link']);
    $data['thread_link'] = sanitize_input($_POST['thread_link']);
    $data['youtube_link'] = sanitize_input($_POST['youtube_link']);
    $data['linkedin_link'] = sanitize_input($_POST['linkedin_link']);
    
    
    try {
        $query = "INSERT INTO company (name, domain, address, email1, email2, phone1, phone2, whatsapp_link, facebook_link, instagram_link, x_link, thread_link, youtube_link, linkedin_link) 
        VALUES (:name, :domain, :address, :email1, :email2, :phone1, :phone2, :whatsapp_link, :facebook_link, :instagram_link, :x_link, :thread_link, :youtube_link, :linkedin_link)";
        $query = query_db($query, $data);
        $message = "Company details was successfully uploaded";
        $message_tag = "success";
        redirect('settings', $message, $message_tag);
    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect('addsetting', $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin
];

admin_view('addsetting', $context);