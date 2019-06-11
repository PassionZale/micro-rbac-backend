<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class Permission extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("AuthPermission");
    }

    public function index_get($id = NULL) {
        $data = [];
        if ($id) {
            $data = $this->AuthPermission->show(array("id" => $id));
        } else {
            $data = $this->AuthPermission->all();
        }

        $this->response->success($data);
    }

    public function index_post() {
        $data = $this->request->get_request_data();
        $result = $this->AuthPermission->create($data);
        $result ? $this->response->success() : $this->response->fail();
    }

    public function index_put($id = NULL) {
        $data = $this->request->get_request_data();
        $result = $this->AuthPermission->update($id, $data);
        $result ? $this->response->success() : $this->response->fail();
    }

    public function index_delete($id = NULL) {
        $result = $this->AuthPermission->delete($id);
        $result ? $this->response->success() : $this->response->fail();
    }

}
