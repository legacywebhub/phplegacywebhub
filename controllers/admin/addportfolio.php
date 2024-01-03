<?php

// Authorizing admin
$admin = admin_logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Add Portfolio";
$services = query_fetch("SELECT * FROM services");


// Handling add portfolio request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    // Storing the Portfolio first to attach images to

    // How to uniquely identify this portfolio
    $title = sanitize_input($_POST['title']);

    // Declaring DB variables as PHP array
    $data = [
        'service_id' => sanitize_input($_POST['service']),
        'title' => $title,
        'description' => sanitize_input($_POST['description']),
        'repo_link' => sanitize_input($_POST['repo_link']),
        'website' => sanitize_input($_POST['website']),
        'client' => sanitize_input($_POST['client'])
    ];
    
    try {
        $query = "INSERT INTO portfolios (title, service_id, description, repo_link, website, client) 
        VALUES (:title, :service_id, :description, :repo_link, :website, :client)";
        $query = query_db($query, $data);

        // Uploading portfolio images
        if (!empty($_FILES['portfolio_images'])) {
            $portfolio_id = query_fetch("SELECT id FROM portfolios WHERE title = '$title' ORDER BY id DESC LIMIT 1")[0]['id'];
            $uploaded_images = handle_multiple_image($_FILES['portfolio_images'], 'portfolios');

            if ($uploaded_images['status'] == "success" || $uploaded_images['status'] == "partial") {

                // Saving each image to DB
                foreach ($uploaded_images['images'] as $image) {
                    $query = "INSERT INTO portfolio_images (portfolio_id, image) VALUES (:portfolio_id, :image)";
                    $query = query_db($query, ['portfolio_id'=>intval($portfolio_id), 'image'=>$image]);
                }
                $message = "Portfolio and ". $uploaded_images['total_uploaded'] ." image was uploaded successfully";
                $message_tag = "success";
                redirect('portfolios', $message, $message_tag);
            } else {
                $message = "Portfolio was uploaded successfully without images";
                $message_tag = "success";
                redirect('portfolios', $message, $message_tag);
            }
        }

    } catch(Exception $error) {

        $message = "Error while saving data: $error";
        $message_tag = "danger";

    }
    redirect('addportfolio', $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin,
    'services'=> $services
];

admin_view('addportfolio', $context);