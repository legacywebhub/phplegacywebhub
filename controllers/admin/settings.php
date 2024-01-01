<?php

// Authorizing admin
//$admin = admin_logged_in();

// Other variables
$settings = paginate("SELECT * FROM company ORDER BY id DESC", 15);
$company = $settings[0];
$title = ucfirst($company['name'])." | Dashboard";


$context = [
    'company'=> $company,
    'title'=> $title,
    //'admin'=> $admin,
    'settings'=> $settings
];

admin_view('settings', $context);