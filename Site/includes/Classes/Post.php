<?php

class Post {
    private $post_id;
    private $post_author;
    private $post_content;
    private $post_date;

    public function __construct() {
        $this->post_id = 0;
        $this->post_author = null;
        $this->post_content = null;
        $this->post_date = null;
    }

    // setters

    public function set_post_id($p_id) {
        $this->post_id = $p_id;
    }

    public function set_post_author($p_author) {
        $this->post_author = $p_author;
    }

    public function set_post_content($p_content) {
        $this->post_content = $p_content;
    }

    public function set_post_date($p_date) {
        $this->post_date = $p_date;
    }

    // getters

    public function get_post_id() {
        return $this->post_id;
    }

    public function get_post_author() {
        return $this->post_author;
    }

    public function get_post_content() {
        return $this->post_content;
    }

    public function get_post_date() {
        return $this->post_date;
    }
}
