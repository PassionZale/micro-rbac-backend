<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Make extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library("migrate");
    }

    public function migration() {
        $this->migrate->makeMigration();
    }

    public function superuser() {
        $this->migrate->makeSupserUser();
    }

}
