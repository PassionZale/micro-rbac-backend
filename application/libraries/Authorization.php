<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Authorization {

    protected $CI;
    private $key;
    private $alg;
    private $exp;
    private $leeway;

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->config->load("jwt");
        $this->key = $this->CI->config->item('jwt_key');
        $this->alg = $this->CI->config->item('jwt_alg');
        $this->exp = $this->CI->config->item('jwt_exp');
        $this->leeway = $this->CI->config->item('jwt_leeway');
    }

    public function generateToken($data) {
        $data['exp'] = time() + $this->exp;
        return JWT::encode($data, $this->key, $this->alg);
    }

    public function validateToken($token) {
        JWT::$leeway = $this->leeway;
        try {
            $decoded = JWT::decode($token, $this->key, array($this->alg));
            return (array) $decoded;
        } catch (\Firebase\JWT\SignatureInvalidException $e) {
            // 签名不正确
            throw new Exception($e->getMessage(), 11001);
        } catch (\Firebase\JWT\BeforeValidException $e) {
            // 签名在某个时间点之后才能用
            throw new Exception($e->getMessage(), 11002);
        } catch (\Firebase\JWT\ExpiredException $e) {
            // JWT 过期
            throw new Exception($e->getMessage(), 11003);
        } catch (Exception $e) {
            //其他错误
            throw new Exception($e->getMessage(), 11000);
        }
    }

}
