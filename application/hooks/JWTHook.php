<?php

class JWTHook {

    protected $CI;
    protected $access_routes;

    public function __construct() {
        $this->CI = &get_instance();
        $this->access_routes = ['auth/login'];
        $this->CI->load->library("authorization");
    }

    public function index() {
        $route = $this->CI->uri->uri_string();
        if (!in_array($route, $this->access_routes)) {
            $jwt = $this->CI->request->get_request_header("Authorization");
            if (!$jwt) {
                $this->fail(403, 11000, "Request lacks the authorization token");
            }
            try {
                $this->CI->authorization->validateToken($jwt);
            } catch (Exception $ex) {
                $this->fail(401, $ex->getCode(), $ex->getMessage());
            }
        }
    }

    private function fail($http_code, $code, $message) {
        header('Content-Type: application/json; charset=utf-8');
        set_status_header($http_code);
        $response = array(
            "code" => $code,
            "data" => "response by JWT hook",
            "message" => $message,
            "success" => FALSE,
            "time" => time()
        );
        exit(json_encode($response));
    }

}
