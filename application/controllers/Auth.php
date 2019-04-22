<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $key = "example_key";
        $token = array(
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => 1356999524,
            "nbf" => 1357000000,
            "exp" => time() + 180
        );
        $jwt = JWT::encode($token, $key);
        print_r($jwt);
    }

    public function decode() {
        $key = "example_key";
        $jwt = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLm9yZyIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUuY29tIiwiaWF0IjoxMzU2OTk5NTI0LCJuYmYiOjEzNTcwMDAwMDAsImV4cCI6MTU1NTkyNDE4Nn0.pV62tLqwLND2aU0n_LLtf_csqTUXFdNShBTJ7hcmApI";

        try {
            JWT::$leeway = 60; //当前时间减去60，把时间留点余地
            $decoded = JWT::decode($jwt, $key, ['HS256']); //HS256方式，这里要和签发的时候对应
            $arr = (array) $decoded;
            print_r($arr);
        } catch (\Firebase\JWT\SignatureInvalidException $e) {  //签名不正确
            echo $e->getMessage();
        } catch (\Firebase\JWT\BeforeValidException $e) {  // 签名在某个时间点之后才能用
            echo $e->getMessage();
        } catch (\Firebase\JWT\ExpiredException $e) {  // token过期
            echo $e->getMessage();
        } catch (Exception $e) {  //其他错误
            echo $e->getMessage();
        }
        //Firebase定义了多个 throw new，我们可以捕获多个catch来定义问题，catch加入自己的业务，比如token过期可以用当前Token刷新一个新Token
    }

}
