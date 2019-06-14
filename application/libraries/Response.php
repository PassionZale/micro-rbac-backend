<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Response {

    protected $CI;

    function __construct() {
        $this->CI = & get_instance();
    }

    public function set_response($data = NULL, $message = "成功", $code = 200, $http_code = 200) {
        ob_start();

        $success = $code === 200 ? TRUE : FALSE;

        $response = array(
            "data" => $data,
            "message" => $message,
            "code" => $code,
            "success" => $success,
            "time" => time()
        );

        $this->CI->output->set_status_header($http_code);
        $this->CI->output->set_content_type('application/json', 'utf-8');

        $this->CI->output->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        ob_end_flush();
    }

    public function success($data = NULL) {
        $this->set_response($data);
    }

    public function fail($message = "失败", $code = 10001, $http_code = 400) {
        $this->set_response(NULL, $message, $code, $http_code);
    }

}
