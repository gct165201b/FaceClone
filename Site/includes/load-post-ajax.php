<?php

include_once './includes/Config/Database.php';
include_once './includes/Classes/Post.php';
include_once './includes/processes/operations.inc.php';


function display_posts($default_user_id = 0) {

    $postCount = $_POST['newPostCount'];

    // get all posts


    $database = new Database();

    $connection = $database->connect();

    $post_array = get_all_posts($connection, $_SESSION['u_id'] , $default_user_id, $postCount);

    $connection = null;

    if(count($post_array) === 0) {
        echo "<h4>No More Posts Available!</h4>";
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

get_all_posts();
