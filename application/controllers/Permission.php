<?php

defined("BASEPATH") OR exit("No direct script access allowed");

require_once APPPATH . "libraries/REST_Controller.php";

use Restserver\Libraries\REST_Controller;

class Permission extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("AuthPermission");
    }

    public function index_get($id = NULL) {
        $data = [];
        if ($id) {
            $data = $this->AuthPermission->show(array("id" => $id));
        } else {
            $data = $this->AuthPermission->all();
        }
        $this->response(array(
            "data" => $data,
            "message" => "success"
        ));
    }

    public function index_post() {
        $data = array(
            "name" => $this->post("name"),
            "code" => $this->post("code"),
            "route" => $this->post("route")
        );
        $result = $this->AuthPermission->create($data);
        $result ? $this->response(array("message" => "操作成功",)) :
                        $this->response(array(
                            "message" => "操作失败",
                                ), 400);
    }

    public function index_put($id = NULL) {
        $data = array(
            "name" => $this->put("name"),
            "code" => $this->put("code"),
            "route" => $this->put("route")
        );

        $result = $this->AuthPermission->update($id, $data);
        $result ? $this->response(array("message" => "操作成功",)) :
                        $this->response(array("message" => "操作失败",), 400);
    }

    public function index_delete($id = NULL) {
        $result = $this->AuthPermission->delete($id);
        $result ? $this->response(array("message" => "操作成功",)) :
                        $this->response(array("message" => "操作失败",), 400);
    }

}
