<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
    }

    public function makeMigration() {
        $this->CI->load->library("migration");
        if ($this->CI->migration->latest() === FALSE) {
            show_error($this->CI->migration->error_string());
            return;
        }

        echo "Make migration successfully! \n";
        echo "Next please run `php index.php make superuser` to create a superuser!";
    }

    public function makeSupserUser() {
        $username = $this->ask("Enter Superuser's Username: ");
        if (!$username) {
            echo "Username canot be empty!";
            return;
        }

        $password = $this->ask("Enter Superuser's Password: ");
        if (!$password) {
            echo "Password canot be empty!";
            return;
        }

        $passwordConfirm = $this->ask("Enter Superuser's Password Again: ");
        if ($password !== $passwordConfirm) {
            echo "Inconsistent input password twice";
            return;
        }

        $this->CI->load->model("AuthUser");

        $data = array(
            "username" => $username,
            "password" => $password,
        );

        $result = $this->CI->AuthUser->create($data, TRUE);

        if ($result) {
            echo "Superuser has been created successfully!";
        } else {
            echo "Superuser creation failed, please try again...";
        }
    }

    function ask($prompt) {
        echo $prompt;
        $input = fgets(STDIN);
        return trim($input);
    }

}
