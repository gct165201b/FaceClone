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
                location = " . $connection->quote($location) . "";

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
