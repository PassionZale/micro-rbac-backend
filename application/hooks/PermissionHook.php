<?php

class PermissionHook {

    private $CI;
    private $access_sources;

    function __construct() {
        $this->CI = &get_instance();
        $this->access_sources = ["auth", "make"];
        $this->CI->load->library("authorization");
        $this->CI->load->model("AuthUser");
        $this->CI->load->model("AuthPermission");
    }

    public function index() {
        $source = $this->CI->uri->rsegment(1, 0);
        if (!in_array($source, $this->access_sources)) {
            $jwt = $this->CI->request->get_request_jwt();
            $data = $this->CI->authorization->validateToken($jwt);
            $user = $this->CI->AuthUser->userinfo($data["user_id"]);
            // 判断是否为超级用户
            if (!$user["is_superuser"] == 1) {
                // 判断账户禁用状态
                if (!$user["is_active"] == 1) {
                    exit_json_response(403, 11000, "账户被禁用", "response by PERMISSION hook");
                } else {
                    // 判断是否包含所需要的权限
                    $method = $this->CI->request->get_request_method();
                    $permission_route = "$method.$source";
                    // 判断 permission route 是否存在于 auth_permission 表中
                    $permission_route_exit = $this->CI->AuthPermission->show(array("route" => $permission_route));
                    if ($permission_route_exit) {
                        // 判断用户是否拥有 permission route 权限
                        $valid = self::has_permission($user["permissions"], $permission_route);
                        if (!$valid) {
                            $permission_need = $this->CI->AuthPermission->show(array("route" => $permission_route));
                            exit_json_response(403, 11000, '权限不足,此操作需要权限:' . $permission_need['name'], "response by PERMISSION hook");
                        }
                    }
                }
            }
        }
    }

    private function has_permission($permissions, $permission_route) {
        $valid = array_filter($permissions, function($val) use ($permission_route) {
            return $val["route"] === $permission_route;
        });
        return count($valid) > 0 ? TRUE : FALSE;
    }

}
