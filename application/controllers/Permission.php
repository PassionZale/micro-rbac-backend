<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class Permission extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("AuthPermission");
        $this->load->library('form_validation');
    }

    public function index_get($id = NULL) {
        $data = [];
        if ($id) {
            $data = $this->AuthPermission->show(array("id" => $id));
        } else {
            $params = $this->input->get();
            $data = $this->AuthPermission->page_list($params);
        }

        $this->response->success($data);
    }

    public function format_get($format = NULL) {
        $formats = ["checkbox", "select"];
        if (in_array($format, $formats)) {
            $data = $this->AuthPermission->all();
            $this->response->success($data);
        } else {
            $this->response->not_found();
        }
    }

    public function index_post() {
        $data = $this->request->get_request_data();
        $this->form_validation->set_data($data);
        if ($this->form_validation->run("permission") === FALSE) {
            $errors = $this->form_validation->error_array();
            $this->response->fail(current($errors));
        } else {
            $result = $this->AuthPermission->create($data);
            $result ? $this->response->success() : $this->response->fail();
        }
    }

    public function index_put($id = NULL) {
        if (!$id) {
            return $this->response->not_found();
        }
        $data = $this->request->get_request_data();
        $this->form_validation->set_data($data);
        if ($this->form_validation->run("permission") === FALSE) {
            $errors = $this->form_validation->error_array();
            $this->response->fail(current($errors));
        } else {
            $result = $this->AuthPermission->update($id, $data);
            $result ? $this->response->success() : $this->response->fail();
        }
    }

    public function index_delete($id = NULL) {
        if (!$id) {
            return $this->response->not_found();
        }
        $result = $this->AuthPermission->delete($id);
        $result ? $this->response->success() : $this->response->fail();
    }

}
