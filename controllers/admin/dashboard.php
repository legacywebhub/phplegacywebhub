<?php

// Authorizing admin
//$admin = admin_logged_in();

// Appending extra admin details
/*
$admin += [
    'total_users'=> query_fetch("SELECT COUNT(*) AS total_users FROM users")[0]['total_users'],
    'total_services'=> query_fetch("SELECT COUNT(*) AS total_services FROM services")[0]['total_services'],
    'total_portfolio'=> query_fetch("SELECT COUNT(*) AS total_portfolio FROM portfolio")[0]['total_portfolio'],
    'total_testimonials'=> query_fetch("SELECT COUNT(*) AS total_testimonials FROM testimonials")[0]['total_testimonials'],     
    'total_post_categories'=> query_fetch("SELECT COUNT(*) AS total_post_categories FROM post_categories")[0]['total_post_categories'],
    'total_posts'=> query_fetch("SELECT COUNT(*) AS total_posts FROM posts")[0]['total_posts'],
    'total_properties'=> query_fetch("SELECT COUNT(*) AS total_properties FROM properties")[0]['total_properties'],
    'total_messages'=> query_fetch("SELECT COUNT(*) AS total_messages FROM messages")[0]['total_messages']
];
*/

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Dashboard";


$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin
];

admin_view('dashboard', $context);