<?php

// Authorizing admin
$admin = admin_logged_in();

// Redirecting portfolio if id not provided
if (!isset($_GET['id'])) {
    redirect("portfolios");
} else {

    // Checking if Admin is superuser
    if ($admin['is_superuser'] == 0) {
        redirect("portfolios", "Sorry.. You don't have such privilege", "danger");
    }

    // Getting id
    $id = intval($_GET['id']);
    //  Checking for matching portfolios
    $matched_portfolios = query_fetch("SELECT * FROM portfolios WHERE id = $id LIMIT 1");

    // If a record exists
    if (!empty($matched_portfolios)) {
        // Deleting images connected to portfolio
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
        
        // Deleting portfolio finally from database
        query_fetch("DELETE FROM portfolios WHERE id = $id");
        // Redirect to portfolios page
        redirect("portfolios", "Portfolio successfully deleted", "success");
    }
    redirect("portfolios", "Invalid portfolio", "danger");
}