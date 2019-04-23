<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("authorization");
    }

    public function encode() {
        $data = array(
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => 1356999524,
            "nbf" => 1357000000,
        );
        echo $this->authorization->generateToken($data);
    }

    public function decode() {
        $jwt = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLm9yZyIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUuY29tIiwiaWF0IjoxMzU2OTk5NTI0LCJuYmYiOjEzNTcwMDAwMDAsImV4cCI6MTU1NTk4Mzg5NX0.a2vOY_Sd-ex8KuovKb7uKWINFblpaTOK8sj9Xi8YTkM";
        $result =  $this->authorization->validateToken($jwt);
        var_dump($result);
    }

}
