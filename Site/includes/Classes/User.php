<?php

class User {
    private $u_id;
    private $username;
    private $password;
    private $status;
    private $location;
    private $profile_img;


    public function __construct() {
        $u_id = null;
        $username = null;
        $password = null;
        $status = null;
        $location = null;
        $profile_img = null;
    }


    // setters

    public function set_user_id($u_id) {
        $this->$u_id = $u_id;
    }

    public function set_username($username) {
        $this->username = $username;
    }

    public function set_password($password) {
        $this->password = $password;
    }

    public function set_status($status) {
        $this->status = $status;
    }

    public function set_location($location) {
        $this->location = $location;
    }

    public function set_profile_image($p_img) {
        $this->profile_img = $p_img;
    }

    // Getters

    public function get_user_id() {
        return $this->u_id;
    }

    public function get_username() {
        return $this->username;
    }

    public function get_password() {
        return $this->password;
    }

    public function get_status() {
        return $this->status;
    }

    public function get_location() {
        return $this->location;
    }

    public function get_profile_img() {
        return $this->profile_img;
    }



    // For Testing

    public function print_user() {
        echo 'Username: ' . $this->username;
        echo 'Password: ' . $this->password;
        echo 'Status: ' . $this->status;
        echo 'Location: ' . $this->location;
        echo 'Profile Image: ' . $this->profile_img;
    }
}
