<?php

defined("BASEPATH") OR exit("No direct script access allowed");

require_once APPPATH . "libraries/REST_Controller.php";

use Restserver\Libraries\REST_Controller;

class Permission extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("AuthPermission");
    }

    public function index_get() {
        $data = [];
        if ($this->get("id")) {
            $id = $this->get("id");
            $data = $this->AuthPermission->getItem(array("id" => $id));
        } else {
            $data = $this->AuthPermission->getAll();
        }
        $this->response($data);
    }

    public function index_post() {
        $data = array(
            "name" => $this->post("name"),
            "code" => $this->post("code")
        );
        $this->AuthPermission->createItem($data);
    }

    public function index_put() {
        
    }

    public function index_delete() {
        
    }

}
