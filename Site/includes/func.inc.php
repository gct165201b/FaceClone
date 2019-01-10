<?php

include_once 'Config/Database.php';
include_once 'Classes/User.php';
include_once 'Classes/Post.php';
include_once 'processes/operations.inc.php';
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
        <script src="./js/jquery.min.js" charset="utf-8"></script>
        <script type="text/javascript">

            $(document).ready(function() {
                var postCount = 2;
                $(window).scroll(function(e) {
                    e.preventDefault();
                   if($(window).scrollTop() + $(window).height() == $(document).height()) {
                       postCount += 2;
                       $('.posts').load('load-post-ajax.php', {
                           newPostCount: postCount
                       });
                   }
                });
            });

        </script>
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


function display_posts($default_user_id = 0) {
    // get all posts


    $database = new Database();

    $connection = $database->connect();

    $post_array = get_all_posts($connection, $_SESSION['u_id'] , $default_user_id);

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


function display_requests($default_user_id = null) {


    $database = new Database();

    $connection = $database->connect();

    $requests_array = get_all_requests($connection, $default_user_id);

    $connection = null;

    if(count($requests_array) === 0) {
        echo "<h6>No Friend Request!</h6>";
    } else {
        foreach ($requests_array as $request) {
            // code...
            // <li>
            //     <!-- Link to profile of the person. -->
            //     <a href="">johndoe</a>
            //     <!-- Link to accept the friend request. -->
            //     <a href="" class="text-success">[accept]</a>
            //     <!-- Link to Reject the request -->
            //     <a href="" class="text-danger">[decline]</a>
            // </li>

            echo "<li>";
                echo "<a href='./profile.php?user_profile=" . $request->get_user_id() . "'>" . $request->get_username() . "</a>";
                echo "<a href='./includes/processes/request.inc.php?accept=" . $request->get_user_id() . "' class='text-success'>  [accept]</a>";
                echo "<a href='./includes/processes/request.inc.php?decline=" . $request->get_user_id() . "' class='text-danger'>  [decline]</a>";
            echo "</li>";
        }
    }
}

function display_users($uid) {

    $database = new Database();

    $connection = $database->connect();

    $users_array = get_all_users($connection, $uid);

    $connection = null;

    if(count($users_array) === 0) {
        echo "<h6>No Users!</h6>";
    } else {
        foreach ($users_array as $user) {


            echo "<li>";
                echo "<a href='./profile.php?profile=" . $user->get_user_id() . "'>" . $user->get_username() . "</a>";
                echo "<a href='./includes/processes/request.inc.php?addfriend=".$user->get_user_id()."' class='text-success'>  [Add]</a>";
            echo "</li>";
        }
    }
}

function display_friends($u_id) {
    $database = new Database();

    $connection = $database->connect();

    $friends_array = get_all_friends($connection, $u_id);

    $connection = null;

    if(count($friends_array) === 0) {
        echo "<h6>No Friends!</h6>";
    } else {
        foreach ($friends_array as $friend) {


            echo "<li>";
                echo "<a href='./profile.php?user_profile=" . $friend->get_user_id() . "'>" . $friend->get_username() . "</a>";
                echo "<a href='./includes/processes/request.inc.php?unfriend=" . $friend->get_user_id() . "' class='text-danger'>  [unfriend]</a>";
            echo "</li>";
        }
    }
}


function show_profile($user_id) {
    $database = new Database();

    $connection = $database->connect();

    $user = null;

    $user = get_profile($connection, $user_id);

    $connection = null;

    echo "<h4 class='mt-4'>" . $user->get_username() . "</h4>";
    if(empty($user->get_status())) {
        $status = "<small class='text-muted'>Not Set!</small>";
    } else {
        $status = $user->get_status();
    }
    echo "<small>Status: " . $status . "</small>";
    echo "<small> Location: " . $user->get_location() . "</small>";

}
