<?php

defined("BASEPATH") OR exit("No direct script access allowed");

require_once APPPATH . "libraries/REST_Controller.php";

use Restserver\Libraries\REST_Controller;

class Auth extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("authorization");
        $this->load->model("AuthUser");
    }

    public function login_post() {
        $username = $this->post("username");
        $password = $this->post("password");

        $condition = array("username" => $username);
        $user = $this->AuthUser->show($condition);

        if ($user) {
            if ($user["is_active"] == 1) {
                $verify = password_verify($password, $user["password"]);
                if ($verify) {
                    $data = array(
                        "userId" => $user["id"],
                    );
                    $jwt = $this->authorization->generateToken($data);
                    return $this->response(array(
                                "data" => $jwt,
                                "message" => "登录成功"
                                    ), 200);
                } else {
                    return $this->response(["message" => "账户或密码错误"], 401);
                }
            } else {
                return $this->response(["message" => "该账户已被禁用"], 403);
            }
        }
        return $this->response(["message" => "账户或密码错误"], 401);
    }

    public function user_get() {
        $jwt = $this->head("Authorization");
        $data = $this->authorization->validateToken($jwt);
        $this->response(["data" => $data]);
    }

}
