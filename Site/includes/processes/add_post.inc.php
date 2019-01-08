<?php
session_start();

include_once '../Classes/Post.php';
include_once '../Config/Database.php';
include_once './operations.inc.php';

if(isset($_POST['add_post'])) {
    $post_content = isset($_POST['post_content']) ? $_POST['post_content'] : '';
    if(empty($post_content) || $post_content === '') {
        header("Location: ../../index.php?post_field=empty");
        exit();
    }

    $post = new Post();

    $post->set_post_content($post_content);

    // Create Connection to database.
    $database = new Database();

    $connection = $database->connect();

    if(!store_post($connection, $post, $_SESSION['u_id'])) {
        $connection = null; // close connection.
        $post = null;
        header("Location: ../../home.php?upload=faild");
        exit();
    } else {
        $connection == null; // close connection.
        $post = null;
        header("Location: ../../home.php?upload=success");
        exit();
    }


} else {
    header("Location: ../../home.php");
    exit();
}
