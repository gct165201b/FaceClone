<?php
function store_user($connection, $user) {

    // Validate

    if(!exists($connection, $user)) {

        // Create Query

        $username = $user->get_username();
        $password = $user->get_password();
        $location = $user->get_location();

        // Hash the password

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users
            SET
                username = " . $connection->quote($username) . ",
                password = " . $connection->quote($hashed_password) . ",
                location = " . $connection->quote($location);

        $stmt = $connection->prepare($query);

        if($stmt->execute()) {
            return true;
        }

        return false;
    } else {
        return false;
    }
}


// Check if user with same username exists in DB for signup
function exists($connection, $user) {
    $username = $user->get_username();
    // Create Query
    $query = "SELECT * FROM users
        WHERE username=" . $connection->quote($username);

    $stmt = $connection->prepare($query);

    $stmt->execute();

    $total_records = $stmt->rowCount();

    if($total_records > 0) {
        return true;
    } else if($total_records === 0) {
        return false;
    }
}


// Validate and return true if login is success
function login($connection, $user) {

    $username = $user->get_username();
    $password = $user->get_password();

    $query = "SELECT * FROM users WHERE username = " . $connection->quote($username) . "LIMIT 1";

    $stmt = $connection->prepare($query);

    $stmt->execute();

    $total_records = $stmt->rowCount();

    if($total_records === 0) {
        return false;
    } else {

        if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $password_check = password_verify($password, $row['password']);

            if($username !== $row['username'] || (!$password_check)) {
                return false;
            } else if($username === $row['username'] && $password_check) {
                $user->set_user_id($row['u_id']);
                $user->set_username($row['username']);
                $user->set_location($row['location']);

                return true;
            }
        }
    }
}

// Creates Session and set the values to the user values.
function create_user_session($user) {
    $_SESSION['u_id'] = $user->get_user_id();
    $_SESSION['username'] = $user->get_username();
    $_SESSION['location'] = $user->get_location();
}
