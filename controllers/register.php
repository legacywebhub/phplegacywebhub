<?php

// Variables
$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($setting['name'])." | Register";

// Handling register request
if ($_SERVER["REQUEST_METHOD"]=="POST" && $_POST['csrf_token']===$_SESSION['csrf_token']) {

    $fullname = sanitize_input($_POST['fullname']);
    $username = sanitize_input($_POST['username']);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password1 = sanitize_input($_POST['password1']);
    $password2 = sanitize_input($_POST['password2']);
    $timezone = sanitize_input($_POST['timezone']);
    $ref = sanitize_input($_POST['ref']);


    // Validation
    if (empty($fullname)) {
        redirect('register', "Fullname cannot be blank or have spaces", 'danger');
    } else if (is_numeric($fullname)) {
        redirect('register', "Fullname cannot be numeric", 'danger');
    } else if (strlen($fullname) < 3 || strlen($fullname) > 60) {
        redirect('register', "Fullname cannot be less than 3 or more than 60 characters", 'danger');
    }

    if (empty($username) || ctype_space($username)) {
        redirect('register', "Username cannot be blank or have spaces", 'danger');
    } else if (is_numeric($username)) {
        redirect('register', "Username cannot be numeric", 'danger');
    } else if (!preg_match("/^[a-zA-Z]+$/", $username)) {
        redirect('register', "Username can only have letters and no spaces", 'danger');
    } else if (strlen($username) < 4 || strlen($username) > 15) {
        redirect('register', "Username cannot be less than 4 or more than 15 characters", 'danger');
    } else if (username_exists($username)) {
        redirect('register', "Username has already been used", 'danger');
    }

    if (!$email) {
        redirect('register', "Email is not valid", 'danger');
    } else if (strlen($email) > 60) {
        redirect('register', "Email cannot be more than 60 characters", 'danger');
    } else if (email_exists($email)) {
        redirect('register', "Email has already been used", 'danger');
    }

    if (empty($password1) || empty($password2)) {
        redirect('register', "Passwords cannot be empty", 'danger');
    } else if ($password1 != $password2) {
        redirect('register', "Passwords do not match", 'danger');
    }

    // Declaring database variables for user as PHP array
    $data = [];
    $data['fullname'] = $fullname;
    $data['username'] = $username;
    $data['email'] = $email;
    $data['password'] = password_hash($password2, PASSWORD_DEFAULT);
    $data['timezone'] = $timezone;

    try {
        // Making a query to insert user details into the database
        $sql = "INSERT INTO users (fullname, username, email, timezone, password) VALUES (:fullname, :username, :email, :timezone, :password)";
        $query = query_db($sql, $data);
        // Sending registeration success email
        $email_values = [
            'name'=> $username, 
            'message'=> "Welcome $username, your account was successfully created and you are now eligible to explore our ecosystem. Kindly login to get started!"
        ];
        sendMail($email, "Registeration successful", $email_values);

        // Referral system
        if (!empty($ref) && username_exists($ref)) {
            $referrer = query_fetch("SELECT * FROM users WHERE username = '$ref' LIMIT 1")[0];
            $new_user = query_fetch("SELECT * FROM users WHERE username = '$username' LIMIT 1")[0];
            // Saving affiliation
            $sql = "INSERT INTO affiliates (user_id, referrer_id) VALUES (:user_id, :referrer_id)";
            $query = query_db($sql, ['user_id'=>$new_user['id'], 'referrer_id'=>$referrer['id']]);
            // Notifying referrer of referral activity via notification
            $sql = "INSERT INTO notifications (user_id, message) VALUES (:user_id, :message)";
            $query = query_db($sql, ['user_id'=>$referrer['id'], 'message'=> "User ($username) signed up using your referral ID recently"]);
            // Notifying referrer of referral activity via email
            $email_values = [
                'name'=> $referrer['username'], 
                'message'=> "Hello ".$referrer['username'].", this is to notify you of a sign up (user - $username) using your referral ID. Login into your account for more info."
            ];
            sendMail($referrer['email'], "Referral Activity", $email_values);
        }
        // Redirecting user to login page
        redirect('login', "You were successfully registered", 'success');
    } catch(Exception $e) {
        redirect('register', "Registeration failed: $e", 'danger');
    }

}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'setting'=> $setting,
    'title'=> $title,
];

landing_view('register', $context);