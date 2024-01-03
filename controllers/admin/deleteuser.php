<?php

// Authorizing admin
$admin = admin_logged_in();

// Redirecting user if id not provided
if (!isset($_GET['id'])) {
    redirect("users");
} else {

    // Checking if Admin is superuser or current logged in admin
    if ($id == $admin['id'] || $admin['is_superuser'] == 0) {
        redirect("users", "Sorry.. You don't have such privilege", "danger");
    }

    // Getting id
    $id = intval($_GET['id']);
    //  Checking for matching users
    $matched_users = query_fetch("SELECT * FROM users WHERE id = $id LIMIT 1");

    if (!empty($matched_users)) {
        $user = $matched_users[0];
        // Deleting user finally from database
        query_fetch("DELETE FROM users WHERE id = $id");
        redirect("users", "User successfully deleted", "success");
    }
    redirect("users", "Invalid user", "danger");
}