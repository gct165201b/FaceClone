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
                $user->set_status($row['status']);
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
    $_SESSION['status'] = $user->get_status();
}


function get_all_posts($connection, $user_id , $default_user_id = 0) {


    $all_posts = array();

    if($default_user_id === 0) {
        $query = "SELECT * FROM posts JOIN users ON posts.p_author = users.u_id WHERE p_id NOT IN";
        $query .= "(SELECT p_id FROM post_user WHERE u_id=$user_id)";
    } else {
        $query = "SELECT * FROM posts JOIN users ON posts.p_author = users.u_id WHERE p_author = $default_user_id";
    }

    $stmt = $connection->prepare($query);

    $stmt->execute();

    $total_records = $stmt->rowCount();

    if($total_records === 0) {
        return $all_posts;
    } else {
        $i = 0;

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $post_id = $row['p_id'];
            $post_author = $row['username'];
            $post_content = $row['p_content'];
            $post_date = $row['p_date'];

            $all_posts[$i] = new Post();
            $all_posts[$i]->set_post_id($post_id);
            $all_posts[$i]->set_post_author($post_author);
            $all_posts[$i]->set_post_content($post_content);
            $all_posts[$i]->set_post_date($post_date);

            $i++;
        }


    }
    return $all_posts;
}


// Delete a post permanently.
function delete_post($connection, $post_user) {
    $query = "DELETE FROM post_user WHERE p_id=" . $post_user['post_id'] .";";
    $query .= "DELETE FROM posts WHERE p_id=" . $post_user['post_id'] . " AND p_author=" . $post_user['post_author_id'] .";";

    $stmt = $connection->prepare($query);

    if($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function hide_post($connection, $post_user) {
    $query = "INSERT INTO post_user
        SET
            p_id=" . $post_user['post_id'] . ",
            u_id=" . $post_user['post_author_id'];

    $stmt = $connection->prepare($query);

    if($stmt->execute()) {
        return true;
    } else {
        return false;
    }

}


function get_all_requests($connection, $default_user_id) {



    $all_requests = array();
    if($default_user_id === 0) {
        $query = "SELECT u_id,username FROM requests JOIN users ON users.u_id = requests.req_from";
    } else {
        $query = "SELECT u_id,username FROM requests JOIN users ON users.u_id = requests.req_from WHERE req_to = $default_user_id";
    }

    $stmt = $connection->prepare($query);

    $stmt->execute();

    $total_records = $stmt->rowCount();

    if($total_records === 0) {
        return $all_requests;
    } else {
        $i = 0;

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user_id = $row['u_id'];
            $username = $row['username'];

            $all_requests[$i] = new User();
            $all_requests[$i]->set_user_id($user_id);
            $all_requests[$i]->set_username($username);

            $i++;
        }


    }
    return $all_requests;
}

function get_all_users($connection, $uid) {


    $all_users = array();

    $query = "SELECT u_id,username FROM users WHERE u_id != $uid AND u_id NOT IN (SELECT req_to FROM requests WHERE req_from = $uid) AND u_id NOT IN (SELECT req_from FROM requests WHERE req_to = $uid) AND u_id NOT IN (SELECT f_id FROM friendship WHERE u_id = $uid) AND u_id NOT IN (SELECT u_id FROM friendship WHERE f_id = $uid)";

    $stmt = $connection->prepare($query);

    $stmt->execute();

    $total_records = $stmt->rowCount();

    if($total_records === 0) {
        return $all_users;
    } else {
        $i = 0;

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user_id = $row['u_id'];
            $username = $row['username'];

            $all_users[$i] = new User();
            $all_users[$i]->set_user_id($user_id);
            $all_users[$i]->set_username($username);

            $i++;
        }


    }
    return $all_users;
}

function get_all_friends($connection, $uid) {
    $all_friends = array();

    $query = "select users.u_id    as person,
           users.username  as person_name,
           userf.u_id   as friend_id,
           userf.username as friend_name
      from users
      join friendship
        on users.u_id = friendship.u_id
        or users.u_id = friendship.f_id
      join users userf
        on (userf.u_id = friendship.u_id and
           userf.u_id <> users.u_id)
        or (userf.u_id = friendship.f_id and
           userf.u_id <> users.u_id) where users.u_id = $uid";

    $stmt = $connection->prepare($query);

    $stmt->execute();

    $total_records = $stmt->rowCount();

    if($total_records === 0) {
        return $all_friends;
    } else {
        $i = 0;

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user_id = $row['friend_id'];
            $username = $row['friend_name'];

            $all_friends[$i] = new User();
            $all_friends[$i]->set_user_id($user_id);
            $all_friends[$i]->set_username($username);

            $i++;
        }


    }
    return $all_friends;
}

function accept_request($connection, $sender_id, $accepter_id) {
    $query = "INSERT INTO friendship
        SET
            u_id=$accepter_id,
            f_id=$sender_id";
    $stmt = $connection->prepare($query);

    if($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function delete_request($connection, $sender_id, $accepter_id) {
    $query = "DELETE FROM requests WHERE req_to=" . $accepter_id  . " AND req_from= " . $sender_id;

    $stmt = $connection->prepare($query);

    if($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function send_request($connection, $req_from, $req_to) {
    $query = "INSERT INTO requests
        SET
            req_from = $req_from,
            req_to = $req_to";
    $stmt = $connection->prepare($query);

    if($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function unfriend($connection, $friend, $u_id) {
    // DELETE FROM friendship WHERE u_id = 7 AND f_id = 13
    $query = "DELETE FROM friendship WHERE u_id = $u_id AND f_id = $friend OR u_id = $friend AND f_id = $u_id";

    $stmt = $connection->prepare($query);

    if($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function get_profile($connection, $u_id) {
    $query = "SELECT * FROM users WHERE u_id = $u_id";

    $stmt = $connection->prepare($query);

    $stmt->execute();

    $total_records = $stmt->rowCount();

    $user = new User();

    if($total_records === 0) {
        return $user;
    } else {
        if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user->set_user_id($row['u_id']);
            $user->set_username($row['username']);
            $user->set_location($row['location']);
            $user->set_status($row['status']);
            $user->set_profile_image($row['profile_image']);
        }

        return $user;
    }
}

function update_profile($connection, $user) {
    $status = $user->get_status();
    $location = $user->get_location();
    $id = $user->get_user_id();

    $query = "UPDATE users
        SET
            status = " . $connection->quote($status);
    if(empty($location) || $location === '') {
        $query .= " WHERE u_id = $id";
    } else if(!empty($location) && $location !== '') {
        $query .= ",location=" . $connection->quote($location) . " WHERE u_id = $id";
    }

    $stmt = $connection->prepare($query);

    if($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function store_post($connection, $post, $post_author_id) {
    $post_content = $post->get_post_content();

    $query = "INSERT INTO posts(p_date,p_content,p_author) VALUES ";
    $query .= "(now(), " . $connection->quote($post_content) . " , $post_author_id)";


    $stmt = $connection->prepare($query);

    if($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
