<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("AuthUser");
    }

    public function index_get($id = NULL) {
        $data = [];
        if ($id) {
            $data = $this->AuthUser->show(array("id" => $id));
        } else {
            $data = $this->AuthUser->all();
        }
        $this->response->success($data);
    }

    public function index_post() {
        $data = $this->request->get_request_data();
        $result = $this->AuthUser->create($data);
        $result ? $this->response->success() : $this->response->fail();
    }

    public function index_put($id = NULL) {
        $data = $this->request->get_request_data();
        $result = $this->AuthUser->update($id, $data);
        $result ? $this->response->success() : $this->response->fail();
    }

    public function index_delete($id = NULL) {
        $result = $this->AuthUser->delete($id);
        $result ? $this->response->success() : $this->response->fail();
    }

}
