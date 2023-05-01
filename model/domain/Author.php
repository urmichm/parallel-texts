<?php 

class Author {

    private $id;
    private $name;
    private $login;
    private $email;
    private $created_at;
    private $password;

    public function get_id() {
        return $this->id;
    }

    public function get_name() {
        return $this->name;
    }

    public function get_login() {
        return $this->login;
    }

    public function get_email() {
        return $this->email;
    }

    public function get_created_at() {
        return $this->created_at;
    }

    public function get_password() {
        return $this->password;
    }



}

?>