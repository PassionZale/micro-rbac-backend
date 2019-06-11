<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Request {

    protected $CI;

    function __construct() {
        $this->CI = & get_instance();
    }

    public function get_request_data() {
        return json_decode($this->CI->input->raw_input_stream, TRUE);
    }

    public function get_request_header($key) {
        return $this->CI->input->get_request_header($key, TRUE);
    }

}
