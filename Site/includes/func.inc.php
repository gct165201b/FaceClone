<?php


 // Contains top section of the html document and sets the title.
function get_header($title) {

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php echo $title; ?></title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
    <?php
}


// Give the user a message that his account is created or not.
function signup_status() {

    if(isset($_GET['signup_field'])) {
        if($_GET['signup_field'] === 'empty') {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Registration failed! </strong> Some Fields are Empty!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            </div>
                 ";
        }
    } else if(isset($_GET['signup'])) {
        if($_GET['signup'] === 'failed' || $_GET['signup'] !== 'success') {

            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Registration failed! </strong> username may be taken.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            </div>
                 ";

        } else if($_GET['signup'] === 'success') {
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Account Created! </strong> Login
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            </div>
                 ";
        }
    }
}


function login_status() {
    if(isset($_GET['login_field'])) {
        if($_GET['login_field'] === 'empty') {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Login failed! </strong> Some Fields are Empty!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            </div>
                 ";
        }
    } else if(isset($_GET['login'])) {
        if($_GET['login'] === 'failed') {

            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Login failed! </strong> username or password is invalid.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            </div>
                 ";

        }
    }
}


function display_posts() {
    // get all posts
    require('./includes/Config/Database.php');
    require('./includes/processes/operations.inc.php');

    $database = new Database();

    $connection = $database->connect();

    $post_array = get_all_posts($connection, $_SESSION['u_id']);

    $connection = null;

    if(count($post_array) === 0) {
        echo "<h4>No Posts Available!</h4>";
    } else {
        foreach ($post_array as $post) {
            // code...
            echo "<hr>";
            echo "<div class='card text-center'>";
                echo "<div class='card-body'>";
                    echo "<p class='card-text text-left'>". $post->get_post_content() ."</p>";
                echo "</div>";

                echo "<div class='card-footer'>";
                    echo "<p class='float-left'>posted on ". $post->get_post_date() ." by ". $post->get_post_author() ."</p>";

                    echo "<form action='./includes/processes/delete_post_user.php' method='post'>";
                    $btn_name = null;
                    if($post->get_post_author() === $_SESSION['username']) {
                        $btn_name = "delete_post";
                    } else {
                        $btn_name = "hide_post";
                    }
                        echo "<button type='submit' class='btn btn-sm btn-outline-danger' name='" . $btn_name . "' value='". $post->get_post_id() ."'>Delete</button>";
                    echo "</form>";
                echo "</div>";
            echo "</div>";
        }
    }
}
