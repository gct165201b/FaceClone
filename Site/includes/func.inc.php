<?php


 // Contains top section of the html document and sets the title.
function get_header($title) {

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php echo $title; ?></title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
    <?php
}


// Give the user a message that his account is created or not.
function signup_status() {

    if(isset($_GET['field'])) {
        if($_GET['field'] === 'empty') {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Registration failed! </strong> Some Fields are Empty!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            </div>
                 ";
        }
    } else if(isset($_GET['signup'])) {
        if($_GET['signup'] === 'failed' || $_GET['signup'] !== 'success') {

            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Registration failed! </strong> username may be taken.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            </div>
                 ";

        } else if($_GET['signup'] === 'success') {
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Account Created! </strong> Login
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            </div>
                 ";
        }
    }
}
