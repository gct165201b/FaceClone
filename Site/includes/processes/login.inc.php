<?php
include_once '../Classes/User.php';
include_once '../Config/Database.php';
include_once './operations.inc.php';

// Check for submit button.
if(isset($_POST['login'])) {
    
} else {
    header("Location: ../../index.php");
    exit();
}
