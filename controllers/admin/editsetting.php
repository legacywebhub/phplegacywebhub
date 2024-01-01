<?php

// Authorizing admin
//$admin = admin_logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Edit Setting";

// Authenticating view
if (!isset($_GET['id'])) {
    // Redirect if no setting id passed
    redirect("settings");
} else {
    try {
        $id = intval($_GET['id']);
        $matching_settings = query_fetch("SELECT * FROM company WHERE id = $id LIMIT 1");

        if (empty($matching_settings)) {
            // Redirect if no matching user
            redirect("settings");
        } else {
            // Else return user
            $setting = $matching_settings[0];
        }
    } catch (Exception) {
        redirect("settings");
    }
}

// Handling edit setting request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    // Declaring DB variables as PHP array
    $data = [];
    $data['id'] = intval($setting['id']);
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
        $query = "UPDATE company SET name = :name, domain = :domain, address = :address, email1 = :email1, email2 = :email2, phone1 = :phone1, phone2 = :phone2, whatsapp_link = :whatsapp_link, facebook_link = :facebook_link, instagram_link = :instagram_link, x_link = :x_link, thread_link = :thread_link, youtube_link = :youtube_link, linkedin_link = :linkedin_link WHERE id = :id LIMIT 1";
        $query = query_db($query, $data);
        $message = "Company setting was successfully updated";
        $message_tag = "success";
        redirect('settings', $message, $message_tag);
    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect("editsetting?id=".$setting['id'], $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'company'=> $company,
    'setting'=> $setting,
    'title'=> $title,
];

admin_view('editsetting', $context);