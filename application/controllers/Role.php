<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class Role extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("AuthRole");
    }

    public function index_get($id = NULL) {
        $data = [];
        if ($id) {
            $data = $this->AuthRole->show(array("id" => $id));
        } else {
            $data = $this->AuthRole->all();
        }
        $this->response->success($data);
    }

    public function index_post() {
        $data = $this->request->get_request_data();
        $result = $this->AuthRole->create($data);
        $result ? $this->response->success() : $this->response->fail();
    }

    public function index_put($id = NULL) {
        $data = $this->request->get_request_data();
        $result = $this->AuthRole->update($id, $data);
        $result ? $this->response->success() : $this->response->fail();
    }

    public function index_delete($id = NULL) {
        $result = $this->AuthRole->delete($id);
        $result ? $this->response->success() : $this->response->fail();
    }

}
