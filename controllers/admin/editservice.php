<?php

// Authorizing admin
$admin = admin_logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Edit Service";

// Authenticating view
if (!isset($_GET['id'])) {
    // Redirect if no service id passed
    redirect("services");
} else {

    try {
        $id = intval($_GET['id']);
        $matching_services = query_fetch("SELECT * FROM services WHERE id = $id LIMIT 1");

        if (empty($matching_services)) {
            // Redirect if no matching service
            redirect("services");
        } else {
            // Else return service
            $service = $matching_services[0];
        }
    } catch (Exception) {
        redirect("services");
    }
}

// Handling add service request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    // Checking if Admin is superuser
    if ($admin['is_superuser'] == 0) {
        redirect("services", "Sorry.. You don't have such privilege", "danger");
    }

    // Declaring DB variables as PHP array
    $data = [
        'id' => intval($service['id']),
        'service' => sanitize_input($_POST['service'])
    ];
    
    try {
        $query = "UPDATE services SET service = :service WHERE id = :id LIMIT 1";
        $query = query_db($query, $data);
        $message = "Service was successfully updated";
        $message_tag = "success";
        redirect('services', $message, $message_tag);
    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect('editservice', $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin,
    'service'=> $service
];

admin_view('editservice', $context);