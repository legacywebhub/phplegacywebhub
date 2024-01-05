<?php

// Authorizing admin
$admin = admin_logged_in();

// Authenticating view
if (!isset($_GET['id'])) {
    // Redirect if no post id passed
    redirect("posts");
} else {

    try {
        $id = intval($_GET['id']);
        $matching_posts = query_fetch("SELECT * FROM posts WHERE id = $id LIMIT 1");

        if (empty($matching_posts)) {
            // Redirect if no matching post
            redirect("posts");
        } else {
            // Else return post
            $post = $matching_posts[0];
        }
    } catch (Exception) {
        redirect("posts");
    }
}

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Edit Post";
$categories = query_fetch("SELECT * FROM post_categories");


// Handling edit post request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    
    // Checking if Admin is superuser
    if ($admin['is_superuser'] == 0) {
        redirect("posts", "Sorry.. You don't have such privilege", "danger");
    }

    // Declaring DB variables as PHP array
    $data = [
        'id' => intval($post['id']),
        'category_id' => sanitize_input($_POST['category']),
        'image' => $_POST['image'],
        'title' => sanitize_input($_POST['title']),
        'slug' => create_slug(sanitize_input($_POST['title'])),
        'content' => $_POST['content'],
        'quote' => sanitize_input($_POST['quote']),
    ];

    // Updating post document
    if (empty($_FILES['document'])) {
        $data['document'] = $post['document'];
    } else {
        // Uploading new document
        $upload_document = handle_document($_FILES['document'], 'documents');

        // If upload was successful
        if ($upload_document['status'] == "success") {
            // Deleting previous document from media if exists
            if (!empty($post['document'])) {
                // Creating link or path to the document file
                $filename = MEDIA_PATH.'documents/'.$post['document'];

                if (file_exists($filename)) {
                    // Deleting image from media folder
                    unlink($filename);
                } 
            }
            // Adding new document to DB parameters
            $data['document'] = $upload_document['new_file_name'];
        } else {
            // Else us previous document
            $data['document'] = $post['document'];
        }
    }
    
    try { // Updating post record
        $query = "UPDATE posts SET category_id = :category_id, image = :image, slug = :slug, title = :title, content = :content, quote = :quote, document = :document WHERE id = :id LIMIT 1";
        $query = query_db($query, $data);
        $message = "Post was updated successfully";
        $message_tag = "success";
        redirect('posts', $message, $message_tag);
    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect('editpost', $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin,
    'categories'=> $categories,
    'post'=> $post
];

admin_view('editpost', $context);