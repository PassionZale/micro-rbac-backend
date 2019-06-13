<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class Category extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("CategoryModel");
    }

    public function index_get($id = NULL) {
        $data = [];
        if ($id) {
            $data = $this->CategoryModel->show(array("id" => $id));
        } else {
            $data = $this->CategoryModel->all();
        }
        $this->response->success($data);
    }

    public function index_post() {
        $data = $this->request->get_request_data();
        $result = $this->CategoryModel->create($data);
        $result ? $this->response->success() : $this->response->fail();
    }

    public function index_put($id = NULL) {
        $data = $this->request->get_request_data();
        $result = $this->CategoryModel->update($id, $data);
        $result ? $this->response->success() : $this->response->fail();
    }

    public function index_delete($id = NULL) {
        $result = $this->CategoryModel->delete($id);
        $result ? $this->response->success() : $this->response->fail();
    }

}
