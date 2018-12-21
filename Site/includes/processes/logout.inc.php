<?php
session_start();




    session_unset($_SESSION['u_id']);
    session_unset($_SESSION['username']);
    session_unset($_SESSION['location']);

    
    header("Location: ../../index.php");
    exit();
