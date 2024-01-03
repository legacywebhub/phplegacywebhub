<?php

// Authorizing admin
$admin = admin_logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Dashboard";

if (isset($_GET['search'])) {
    // If a service was searched
    $search = $_GET['search'];
    $services = paginate("SELECT * FROM services WHERE service LIKE '$search'", 30);
} else {
    // Else return all services
    $services = paginate("SELECT * FROM services ORDER BY id DESC", 30);
}

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin,
    'services'=> $services
];

admin_view('services', $context);