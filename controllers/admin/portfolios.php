<?php

// Authorizing admin
$admin = admin_logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Dashboard";

if (isset($_GET['search'])) {
    // If a service was searched
    $search = $_GET['search'];
    $portfolios = paginate("SELECT * FROM portfolios WHERE name LIKE '$search'", 15);
} else {
    // Else return all portfolio
    $portfolios = paginate("SELECT * FROM portfolios ORDER BY id DESC", 15);
}

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin,
    'portfolios'=> $portfolios
];

admin_view('portfolios', $context);