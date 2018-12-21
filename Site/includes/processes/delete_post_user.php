<?php
session_start();

include_once '../Config/Database.php';
include_once './operations.inc.php';

$post_id = null;


    $post_author_id = $_SESSION['u_id'];

    $database = new Database();

    $connection = $database->connect();

    if(isset($_POST['delete_post'])) {
        $post_id = $_POST['delete_post'];

        $post_user = array(
            "post_author_id" => $post_author_id,
            "post_id" => $post_id
        );

        delete_post($connection, $post_user);

    } else if(isset($_POST['hide_post'])) {
        $post_id = $_POST['hide_post'];

        $post_user = array(
            "post_author_id" => $post_author_id,
            "post_id" => $post_id
        );
        hide_post($connection, $post_user);

    }

    $connection = null;

    header("Location: ../../home.php");
    exit();
