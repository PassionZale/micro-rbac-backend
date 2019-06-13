<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Make extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("migrate");
    }

    public function index() {
        // TODO Swagger UI
        echo "backend is running...";
    }

    public function migration() {
        $this->migrate->makeMigration();
    }

    public function superuser() {
        $this->migrate->makeSupserUser();
    }

    public function server() {
        $ipAndPort = "127.0.0.1:18000";
        echo "Project is runing at http://$ipAndPort \n";
        echo "Press Ctrl-C to quit";
        shell_exec("php -S $ipAndPort");
    }

}
