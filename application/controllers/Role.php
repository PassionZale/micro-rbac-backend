<?php

defined("BASEPATH") OR exit("No direct script access allowed");

require_once APPPATH . "libraries/REST_Controller.php";

use Restserver\Libraries\REST_Controller;

class Role extends REST_Controller {

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
        $this->response(array(
            "data" => $data,
            "message" => "success"
        ));
    }

    public function index_post() {
        $data = parse_reqeust_data();
        $result = $this->AuthRole->create($data);
        $result ? $this->response(array("message" => "操作成功",)) :
                        $this->response(array(
                            "message" => "操作失败",
                                ), 400);
    }

    public function index_put($id = NULL) {
        $arguments = $this->input->raw_input_stream;
        var_dump($arguments);
        exit();
        $data = array(
            "name" => $this->put("name"),
            "code" => $this->put("code"),
            "route" => $this->put("route")
        );

        $result = $this->AuthRole->update($id, $data);
        $result ? $this->response(array("message" => "操作成功",)) :
                        $this->response(array("message" => "操作失败",), 400);
    }

    public function index_delete($id = NULL) {
        $result = $this->AuthRole->delete($id);
        $result ? $this->response(array("message" => "操作成功",)) :
                        $this->response(array("message" => "操作失败",), 400);
    }

}
