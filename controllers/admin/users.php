<?php

// Authorizing admin
//$admin = admin_logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Dashboard";

if (isset($_GET['search'])) {
    // If a service was searched
    $search = $_GET['search'];
    $users = paginate("SELECT * FROM users WHERE name LIKE '$search'", 15);
} else {
    // Else return all user
    $users = paginate("SELECT * FROM users ORDER BY id DESC", 15);
}

$context = [
    'company'=> $company,
    'title'=> $title,
    //'admin'=> $admin,
    'users'=> $users
];

admin_view('users', $context);