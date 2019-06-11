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
        $user = $this->AuthUser->show($condition);

        if ($user) {
            if ($user["is_active"] == 1) {
                $verify = password_verify($password, $user["password"]);
                if ($verify) {
                    $data = array(
                        "userId" => $user["id"],
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
        $jwt = $this->request->get_request_header('Authorization');
        try {
            $data = $this->authorization->validateToken($jwt);
            return $this->response->success($data);
        } catch (Exception $ex) {
            return $this->response->fail($ex->getMessage(), $ex->getCode());
        }
    }

}
