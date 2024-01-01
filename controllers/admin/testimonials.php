<?php

// Authorizing admin
//$admin = admin_logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Dashboard";


$context = [
    'company'=> $company,
    'title'=> $title,
    //'admin'=> $admin,
];

admin_view('testimonials', $context);