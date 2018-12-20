<?php

include '../Classes/User.php';
include '../Config/Database.php';
include './operations.inc.php';
// check for submit button
if(isset($_POST['signup'])) {

    // Get all variables
    $username = isset($_POST['username']) ? $_POST['username'] : null;
    $location = isset($_POST['location']) ? $_POST['location'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

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
        header("Location: ../../index.php?signup=faild");
        exit();
    } else {
        header("Location: ../../index.php?signup=success");
        exit();
    }

} else {
    header("Location: ../../index.php");
    exit();
}
