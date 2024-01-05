<?php

// Authorizing admin
$admin = admin_logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Comments";

if (isset($_GET['search'])) {
    // If a service was searched
    $search = intval($_GET['search']);
    $comments = paginate("SELECT * FROM comments WHERE post_id = $search", 15);
} else {
    // Else return all comment
    $comments = paginate("SELECT * FROM comments ORDER BY id DESC", 15);
}

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin,
    'comments'=> $comments
];

admin_view('comments', $context);