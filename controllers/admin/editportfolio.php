<?php

// Authorizing admin
$admin = admin_logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Edit Portfolio";
$services = query_fetch("SELECT * FROM services");

// Authenticating view
if (!isset($_GET['id'])) {
    // Redirect if no portfolio id passed
    redirect("portfolios");
} else {
    try {
        $id = intval($_GET['id']);
        $matching_portfolios = query_fetch("SELECT * FROM portfolios WHERE id = $id LIMIT 1");

        if (empty($matching_portfolios)) {
            // Redirect if no matching portfolio
            redirect("portfolios");
        } else {
            // Else return portfolio
            $portfolio = $matching_portfolios[0];
        }
    } catch (Exception) {
        redirect("portfolios");
    }
}

// Handling add portfolio request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    // Checking if Admin is superuser
    if ($admin['is_superuser'] == 0) {
        redirect("portfolios", "Sorry.. You don't have such privilege", "danger");
    }

    // Storing the Portfolio first to attach images to

    // Declaring DB variables as PHP array
    $data = [
        'service_id' => sanitize_input($_POST['service']),
        'title' => sanitize_input($_POST['title']),
        'description' => sanitize_input($_POST['description']),
        'repo_link' => sanitize_input($_POST['repo_link']),
        'website' => sanitize_input($_POST['website']),
        'client' => sanitize_input($_POST['client'])
    ];
    
    try {
        // Updating portfolio record
        $query = "UPDATE portfolios SET title = :title, service_id = :service_id, description = :description, repo_link = :repo_link, website = :website, client = :client WHERE id = $id LIMIT 1";
        $query = query_db($query, $data);

        // Updating portfolio images
        if (!empty($_FILES['portfolio_images'])) {
            // Deleting previous portfolio images
            $portfolio_images = query_fetch("SELECT * FROM portfolio_images WHERE portfolio_id = $id");
            // Looping through all connected image
            foreach($portfolio_images as $portfolio_image) {
                $image_name = $portfolio_image['image'];
                // Creating link or path to the image file
                $filename = MEDIA_PATH.'portfolios/'.$image_name;

                if (file_exists($filename)) {
                    // Deleting image from media folder
                    unlink($filename);
                }
                // Deleting image record from database
                query_fetch("DELETE FROM portfolio_images WHERE image = '$image_name' LIMIT 1");
            }
            // Uploading new images
            $uploaded_images = handle_multiple_image($_FILES['portfolio_images'], 'portfolios');

            if ($uploaded_images['status'] == "success" || $uploaded_images['status'] == "partial") {

                // Saving each image to DB
                foreach ($uploaded_images['images'] as $image) {
                    $query = "INSERT INTO portfolio_images (portfolio_id, image) VALUES (:portfolio_id, :image)";
                    $query = query_db($query, ['portfolio_id'=>$id, 'image'=>$image]);
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
    'portfolio'=> $portfolio,
    'services'=> $services
];

admin_view('editportfolio', $context);