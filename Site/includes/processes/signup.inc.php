<?php

include_once '../Classes/User.php';
include_once '../Config/Database.php';
include_once './operations.inc.php';
// check for submit button
if(isset($_POST['signup'])) {

    // Get all variables
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $location = isset($_POST['location']) ? $_POST['location'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Check for empty Fields

    if(empty($username) || $username === '') {
        header("Location: ../../index.php?signup_field=empty");
        exit();
    } else if(empty($location) || $location === '') {
        header("Location: ../../index.php?signup_field=empty");
        exit();
    } else if(empty($password) || $password === '') {
        header("Location: ../../index.php?signup_field=empty");
        exit();
    }

    // Create a User Object

    $user = new User();
     // set values
    $user->set_username($username);
    $user->set_password($password);
    $user->set_location($location);

    // Instantiate Database Object

    $database = new Database();

    $connection = $database->connect(); // connect and store connection in object.

    // store user in database.

    if(!store_user($connection, $user)) {
        $connection = null; // close connection.
        $user = null;
        header("Location: ../../index.php?signup=faild");
        exit();
    } else {
        $connection == null; // close connection.
        $user = null;
        header("Location: ../../index.php?signup=success");
        exit();
    }

} else {
    header("Location: ../../index.php");
    exit();
}
