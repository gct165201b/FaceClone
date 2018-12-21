<?php
session_start();

include_once './operations.inc.php';
include_once '../Config/Database.php';

if(isset($_GET['accept'])) {
    $sender_id = $_GET['accept']; // validation required.
    $accepter_id = $_SESSION['u_id'];

    $database = new Database();

    $connection = $database->connect();

    if(!accept_request($connection, $sender_id, $accepter_id)) {
        $connection = null;
        header("Location: ../../home.php");
        exit();
    } else {
        delete_request($connection, $sender_id, $accepter_id);
        $connection = null;
        header("Location: ../../home.php?request=accepted");
        exit();
    }


}

if(isset($_GET['decline'])) {
    $sender_id = $_GET['decline']; // validation required.
    $accepter_id = $_SESSION['u_id'];

    $database = new Database();

    $connection = $database->connect();

    delete_request($connection, $sender_id, $accepter_id);
    $connection = null;
    header("Location: ../../home.php?request=declined");
    exit();

}


if(isset($_GET['addfriend'])) {
    $req_to = $_GET['addfriend'];
    $req_from = $_SESSION['u_id'];

    $database = new Database();

    $connection = $database->connect();

    send_request($connection , $req_from, $req_to);

    $connection = null;

    header("Location: ../../home.php");
    exit();
}


if(isset($_GET['unfriend'])) {
    $friend = $_GET['unfriend'];
    $u_id = $_SESSION['u_id'];

    $database = new Database();

    $connection = $database->connect();

    unfriend($connection , $friend, $u_id);

    $connection = null;

    header("Location: ../../home.php");
    exit();
}
