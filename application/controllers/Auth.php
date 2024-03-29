<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("authorization");
        $this->load->model("AuthUser");
    }

    public function login_post() {
        $data = $this->request->get_request_data();
        $username = $data["username"];
        $password = $data["password"];

        $condition = array("username" => $username);
        $user = $this->AuthUser->show($condition, TRUE);

        if ($user) {
            if ($user["is_active"] == 1) {
                $verify = password_verify($password, $user["password"]);
                if ($verify) {
                    $data = array(
                        "user_id" => $user["id"],
                    );
                    $jwt = $this->authorization->generateToken($data);
                    return $this->response->success($jwt);
                } else {
                    return $this->response->fail("账户或密码错误");
                }
            } else {
                return $this->response->fail("该账户已被禁用");
            }
        }
        return $this->response->fail("账户或密码错误");
    }

    public function user_get() {
        $jwt = $this->request->get_request_jwt();
        $data = $this->authorization->validateToken($jwt);
        $response = $this->AuthUser->userinfo($data["user_id"]);
        return $this->response->success($response);
    }

}
