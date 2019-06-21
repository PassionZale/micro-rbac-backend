<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class Brand extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("BrandModel");
        $this->load->library('form_validation');
    }

    public function index_get($id = NULL) {
        $data = [];
        if ($id) {
            $data = $this->BrandModel->show(array("id" => $id));
        } else {
            $params = $this->input->get();
            $data = $this->BrandModel->page_list($params);
        }
        $this->response->success($data);
    }

    public function index_post() {
        $data = $this->request->get_request_data();
        $this->form_validation->set_data($data);
        if ($this->form_validation->run("brand") === FALSE) {
            $errors = $this->form_validation->error_array();
            $this->response->fail(current($errors));
        } else {
            $result = $this->BrandModel->create($data);
            $result ? $this->response->success() : $this->response->fail();
        }
    }

    public function index_put($id = NULL) {
        $data = $this->request->get_request_data();
        $this->form_validation->set_data($data);
        if ($this->form_validation->run("brand") === FALSE) {
            $errors = $this->form_validation->error_array();
            $this->response->fail(current($errors));
        } else {
            $result = $this->BrandModel->update($id, $data);
            $result ? $this->response->success() : $this->response->fail();
        }
    }

    public function index_delete($id = NULL) {
        $result = $this->BrandModel->delete($id);
        $result ? $this->response->success() : $this->response->fail();
    }

}
