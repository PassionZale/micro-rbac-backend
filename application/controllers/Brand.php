<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class Brand extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("BrandModel");
    }

    public function index_get($id = NULL) {
        $data = [];
        if ($id) {
            $data = $this->BrandModel->show(array("id" => $id));
        } else {
            $data = $this->BrandModel->all();
        }
        $this->response->success($data);
    }

    public function index_post() {
        $data = $this->request->get_request_data();
        $result = $this->BrandModel->create($data);
        $result ? $this->response->success() : $this->response->fail();
    }

    public function index_put($id = NULL) {
        $data = $this->request->get_request_data();
        $result = $this->BrandModel->update($id, $data);
        $result ? $this->response->success() : $this->response->fail();
    }

    public function index_delete($id = NULL) {
        $result = $this->BrandModel->delete($id);
        $result ? $this->response->success() : $this->response->fail();
    }

}
