<?php

class JWTHook {

    protected $CI;
    protected $access_routes;

    public function __construct() {
        $this->CI = &get_instance();
        $this->access_routes = ["auth/login", "make/migration", "make/superuser", "make/server"];
        $this->CI->load->library("authorization");
    }

    public function index() {
        $route = $this->CI->uri->uri_string();
        if (!in_array($route, $this->access_routes)) {
            $jwt = $this->CI->request->get_request_jwt();
            if (!$jwt) {
                exit_json_response(401, 11000, "Request lacks the authorization token");
            }
            try {
                $this->CI->authorization->validateToken($jwt);
            } catch (Exception $ex) {
                exit_json_response(403, $ex->getCode(), $ex->getMessage());
            }
        }
    }

}
