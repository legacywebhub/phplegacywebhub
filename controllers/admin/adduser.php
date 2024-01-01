<?php

// Authorizing admin
$admin = admin_logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Add User";

// Handling add user request
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    // Validating and determing DB insert values
    if ($_POST['password1'] != $_POST['password2']) {
        redirect('adduser', 'Passwords do not match', 'danger');
    } else {
        $password = sanitize_input($_POST['password2']);
    }

    if (intval($_FILES['profile_picture']['size']) > 10) {
        $uploaded_image = handle_image($_FILES['profile_picture'], 'users');

        if ($uploaded_image['status'] == "success") {
            $profile_pic = $uploaded_image['new_file_name'];
        } else {
            $profile_pic = null;
        }
    } else {
        $profile_pic = null;
    }

    $fullname = sanitize_input($_POST['fullname']);
    $username = sanitize_input($_POST['username']);
    $email = sanitize_input($_POST['email']);
    $role = sanitize_input($_POST['role']);
    $is_staff = sanitize_input($_POST['is_staff']);
    $is_superuser = sanitize_input($_POST['is_superuser']);

    // Declaring DB variables
    $data = [];
    $data['profile_pic'] = $profile_pic; 
    $data['fullname'] = $fullname;
    $data['username'] = $username;
    $data['email'] = $email;
    $data['role'] = $role;
    $data['password'] = password_hash($password, PASSWORD_DEFAULT);
    $data['is_staff'] = intval($is_staff);
    $data['is_superuser'] = intval($is_superuser);

    // Otherwise
    try {
        // Making and sending our query
        $sql = "INSERT INTO users (profile_pic, fullname, username, email, password, is_staff, is_superuser) VALUES (:profile_pic, :fullname, :username, :email, :password, :is_staff, :is_superuser)";
        $query = query_db($sql, $data);
        redirect('users', "User was successfully created", "success");
    } catch(Exception $error) {
        redirect('adduser', "Error while saving data", "danger");
    }
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin
];

admin_view('adduser', $context);