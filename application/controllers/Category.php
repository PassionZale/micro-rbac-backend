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
            // 子分类分页查询
            $params = $this->input->get();
            $data = $this->CategoryModel->page_list($params);
        }
        $this->response->success($data);
    }

    public function format_get($format = NULL) {
        if (in_array($format, unserialize(FORMAT_GROUPS))) {
            if ($format === "tree") {
                $data = $this->CategoryModel->tree();
            } else {
                $data = $this->CategoryModel->all();
            }
            $this->response->success($data);
        } else {
            $this->response->not_found();
        }
    }

    public function index_post() {
        $data = $this->request->get_request_data();
        $this->form_validation->set_data($data);
        if ($this->form_validation->run("category") === FALSE) {
            $errors = $this->form_validation->error_array();
            $this->response->fail(current($errors));
        } else {
            $result = $this->CategoryModel->create($data);
            $result ? $this->response->success() : $this->response->fail();
        }
    }

    public function index_put($id = NULL) {
        $data = $this->request->get_request_data();
        $this->form_validation->set_data($data);
        if ($this->form_validation->run("category") === FALSE) {
            $errors = $this->form_validation->error_array();
            $this->response->fail(current($errors));
        } else {
            $result = $this->CategoryModel->update($id, $data);
            $result ? $this->response->success() : $this->response->fail();
        }
    }

    public function index_delete($id = NULL) {
        $result = $this->CategoryModel->delete($id);
        $result ? $this->response->success() : $this->response->fail();
    }

}
