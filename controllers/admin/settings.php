<?php

// Authorizing admin
$admin = admin_logged_in();

// Other variables
$settings = paginate("SELECT * FROM company ORDER BY id DESC", 15);
$company = $settings['result'][0];
$title = ucfirst($company['name'])." | Settings";


$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin,
    'settings'=> $settings
];

admin_view('settings', $context);