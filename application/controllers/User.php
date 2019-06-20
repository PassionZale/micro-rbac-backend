<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("AuthUser");
        $this->load->library('form_validation');
    }

    public function index_get($id = NULL) {
        $data = [];
        if ($id) {
            $data = $this->AuthUser->show(array("id" => $id));
        } else {
            $params = $this->input->get();
            $data = $this->AuthUser->page_list($params);
        }
        $this->response->success($data);
    }

    public function index_post() {
        $data = $this->request->get_request_data();
        $this->form_validation->set_data($data);
        if ($this->form_validation->run("user_create") === FALSE) {
            $errors = $this->form_validation->error_array();
            $this->response->fail(current($errors));
        } else {
            $result = $this->AuthUser->create($data);
            $result ? $this->response->success() : $this->response->fail();
        }
    }

    public function index_put($id = NULL) {
        $data = $this->request->get_request_data();
        $this->form_validation->set_data($data);
        if ($this->form_validation->run("user_update") === FALSE) {
            $errors = $this->form_validation->error_array();
            $this->response->fail(current($errors));
        } else {
            $result = $this->AuthUser->update($id, $data);
            $result ? $this->response->success() : $this->response->fail();
        }
    }
    
    public function password_put($id = NULL) {
        $data = $this->request->get_request_data();
        $this->form_validation->set_data($data);
        if ($this->form_validation->run("user_password_update") === FALSE) {
            $errors = $this->form_validation->error_array();
            $this->response->fail(current($errors));
        } else {
            $result = $this->AuthUser->update_password($id, $data["password"]);
            $result ? $this->response->success() : $this->response->fail();
        }
    }

    public function index_delete($id = NULL) {
        $result = $this->AuthUser->delete($id);
        $result ? $this->response->success() : $this->response->fail();
    }

}
