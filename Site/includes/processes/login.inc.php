<?php

session_start();

include_once '../Classes/User.php';
include_once '../Config/Database.php';
include_once './operations.inc.php';

// Check for submit button.
if(isset($_POST['login'])) {

    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // check for empty Fields

    if(empty($username) || $username === '') {
        header("Location: ../../index.php?login_field=empty");
        exit();
    } else if(empty($password) || $password === '') {
        header("Location: ../../index.php?login_field=empty");
        exit();
    }

    // Create a User object.

    $user = new User();

    $user->set_username($username);
    $user->set_password($password);

    // Create Connection to database.
    $database = new Database();

    $connection = $database->connect();

    // Validate Login.

    if(!login($connection, $user)) {
        $connection = null;
        $user = null;
        header("Location: ../../index.php?login=failed");
        exit();
    } else {
        $connection = null;
        create_user_session($user);
        $user = null;

        header("Location: ../../home.php");
        exit();
    }



} else {
    header("Location: ../../index.php");
    exit();
}
