<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class PropertyValue extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("PropertyValueModel");
    }

    public function index_get($id = NULL) {
        $data = [];
        if ($id) {
            $data = $this->PropertyValueModel->show(array("id" => $id));
        } else {
            $params = $this->input->get();
            $data = $this->PropertyValueModel->page_list($params);
        }

        $this->response->success($data);
    }

    public function index_post() {
        $data = $this->request->get_request_data();
        $this->form_validation->set_data($data);
        if ($this->form_validation->run("property_value") === FALSE) {
            $errors = $this->form_validation->error_array();
            $this->response->fail(current($errors));
        } else {
            $result = $this->PropertyValueModel->create($data);
            $result ? $this->response->success($result) : $this->response->fail();
        }
    }

    public function index_put($id = NULL) {
        if (!$id) {
            return $this->response->not_found();
        }
        $data = $this->request->get_request_data();
        $this->form_validation->set_data($data);
        if ($this->form_validation->run("property_value") === FALSE) {
            $errors = $this->form_validation->error_array();
            $this->response->fail(current($errors));
        } else {
            $result = $this->PropertyValueModel->update($id, $data);
            $result ? $this->response->success() : $this->response->fail();
        }
    }

    public function index_delete($id = NULL) {
        if (!$id) {
            return $this->response->not_found();
        }
        $result = $this->PropertyValueModel->delete($id);
        $result ? $this->response->success() : $this->response->fail();
    }

}
