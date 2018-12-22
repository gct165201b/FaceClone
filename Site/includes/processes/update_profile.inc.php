<?php
session_start();

include_once '../Classes/User.php';
include_once '../Config/Database.php';
include_once './operations.inc.php';


if(isset($_POST['update_profile'])) {

    $status = isset($_POST['user_status']) ? $_POST['user_status'] : '';
    $location = isset($_POST['user_location']) ? $_POST['user_location'] : '';
    $user_id = $_SESSION['u_id'];
    if(empty($status) || $status === '') {
        header("Location: ../../profile.php?status_field=empty&profile=" . $_SESSION['u_id']);
        exit();
    }

    $user = new User();

    $user->set_status($status);
    if(!empty($location) && $location !== '') {
        $user->set_location($location);
    }
    $user->set_user_id($user_id);

    // Create Connection to database.
    $database = new Database();

    $connection = $database->connect();

    if(!update_profile($connection, $user)) {
        $user = null;
        $connection = null;
        header("Location: ../../profile.php?update=failed&profile=" . $_SESSION['u_id']);
        exit();
    } else {
        $user = null;
        $connection = null;

        header("Location: ../../profile.php?profile=" . $_SESSION['u_id']);
        exit();
    }


} else {
    header("Location: ../../profile.php?profile=" . $_SESSION['u_id']);
    exit();
}
