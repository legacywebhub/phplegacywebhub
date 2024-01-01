<?php

// Authorizing admin
//$admin = admin_logged_in();
// || $admin['is_superuser'] == 0
// Authenticating view
if (!isset($_GET['id'])) {
    // Redirect if no user id passed
    redirect("users");
} else {
    try {
        $id = intval($_GET['id']);
        $matching_users = query_fetch("SELECT * FROM users WHERE id = $id LIMIT 1");

        if (empty($matching_users)) {
            // Redirect if no matching user
            redirect("users");
        } else {
            // Else return user
            $user = $matching_users[0];
        }
    } catch (Exception) {
        redirect("users");
    }
}

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Edit User";

// Handling edit user request
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    if (!empty($_POST['password1']) && !empty($_POST['password2'])) {
        if ($_POST['password1'] != $_POST['password2']) {
            redirect("edituser?id=$user_id", 'Passwords do not match', 'danger');
        } else {
            $user_password = password_hash(sanitize_input($_POST['password2']), PASSWORD_DEFAULT);
        }
    } else {
        $user_password = $user['password'];
    }

    if (!empty($_POST['fullname'])) {
        $user_fullname = sanitize_input($_POST['fullname']);
    } else {
        $user_fullname = $user['fullname'];
    }
    
    if (!empty($_POST['username'])) {
        $user_username = sanitize_input($_POST['username']);
    } else {
        $user_username = $user['username'];
    }
    
    if (!empty($_POST['email'])) {
        $user_email = sanitize_input($_POST['email']);
    } else {
        $user_email = $user['email'];
    }

    if (!empty($_POST['role'])) {
        $user_role = sanitize_input($_POST['role']);
    } else {
        $user_role = $user['role'];
    }

    if (isset($_POST['is_staff'])) {
        $user_is_staff = 1;
    } else {
        $user_is_staff = 0;
    }

    if (isset($_POST['is_superuser'])) {
        $user_is_superuser = 1;
    } else {
        $user_is_superuser = 0;
    }

    if (isset($_POST['is_blocked'])) {
        $user_is_blocked = 1;
    } else {
        $user_is_blocked = 0;
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

    // Declaring DB variables
    $data = [];
    $data['id'] = $user['id'];
    $data['profile_pic'] = $profile_pic;
    $data['fullname'] = $user_fullname;
    $data['username'] = $user_username;
    $data['email'] = $user_email;
    $data['role'] = $user_role;
    $data['password'] = $user_password;
    $data['is_staff'] = $user_is_staff;
    $data['is_superuser'] = $user_is_superuser;
    $data['is_blocked'] = $user_is_blocked;

    try {
        // Making and sending our query
        $sql = "UPDATE users SET profile_pic = :profile_pic, fullname = :fullname, username = :username, email = :email, role = :role, password = :password, is_staff = :is_staff, is_superuser = :is_superuser, is_blocked = :is_blocked WHERE id = :id LIMIT 1";
        $query = query_db($sql, $data);
        redirect('users', "User details was successfully updated", "success");
    } catch(Exception $error) {
        redirect("edituser?id=$user_id", "Unknown error occured", "danger");
    }
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'company'=> $company,
    'title'=> $title,
    //'admin'=> $admin,
    'user'=> $user,
];

admin_view('edituser', $context);