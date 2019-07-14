<?php

class AuthUser extends CI_Model {

    protected $tableName = "auth_user";
    protected $relationTableName = "auth_user_role";

    public function __construct() {
        parent::__construct();
    }

    public function all($condition = array(), $password = FALSE) {
        $arguments = "id, username, is_active, is_superuser, created_at, updated_at";
        $password && ($arguments .= ", password");
        $query = $this->db->select($arguments)->where($condition)->get($this->tableName);
        return $query->result_array();
    }

    public function page_list($params = array()) {
        $this->db->select("id, username, is_active, is_superuser, created_at, updated_at");
        $this->db->from($this->tableName);
        isset($params["username"]) && $this->db->like("username", $params["username"]);
        $total = $this->db->count_all_results("", FALSE);
        $this->db->order_by("created_at", "DESC");
        $this->db->limit($params["pageSize"], ($params["page"] - 1) * $params["pageSize"]);
        $list = $this->db->get()->result_array();
        return ["total" => $total, "list" => $list, "page" => $params["page"], "pageSize" => $params["pageSize"]];
    }

    public function show($condition = array(), $password = FALSE) {
        $arguments = "id, username, is_active, is_superuser, created_at, updated_at";
        $password && ($arguments .= ", password");
        $data = $this->db->select($arguments)->where($condition)->get($this->tableName)->row_array();
        if ($data) {
            $data["roleIds"] = [];
            $roles = $this->db->select("role_id")->where("user_id", $data["id"])->get($this->relationTableName)->result_array();
            if (count($roles)) {
                foreach ($roles as $role) {
                    $data["roleIds"][] = $role["role_id"];
                }
            }
        }

        return $data;
    }

    public function create($data, $is_superuser = FALSE) {
        $options = ['cost' => 8];
        $pwd_hash = password_hash($data['password'], PASSWORD_DEFAULT, $options);

        $result = $this->db->insert($this->tableName, array(
            "username" => $data["username"],
            "password" => $pwd_hash,
            "is_superuser" => $is_superuser ? 1 : 0,
            "is_active" => isset($data["is_active"]) ? $data["is_active"] : 1,
            "created_at" => time()
        ));

        if (!$result) {
            return FALSE;
        }

        if (isset($data["roleIds"])) {
            $userId = $this->db->insert_id();

            $this->db->trans_begin();

            foreach ($data["roleIds"] as $roleId) {
                $userRole = array(
                    "user_id" => $userId,
                    "role_id" => $roleId
                );
                $result = $this->db->insert($this->relationTableName, $userRole);
                if (!$result) {
                    $this->db->trans_rollback();
                    return FALSE;
                }
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
            } else {
                $this->db->trans_commit();
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }

    public function delete($id) {
        $this->db->where("user_id", $id)->delete($this->relationTableName);
        return $this->db->where("id", $id)->delete($this->tableName);
    }

    public function update($id, $data) {
        $result = $this->db->where("id", $id)->update($this->tableName, array(
            "username" => $data["username"],
            "is_superuser" => $data["is_superuser"],
            "is_active" => $data["is_active"],
            "updated_at" => time()
        ));

        if (!$result) {
            return FALSE;
        }

        if (isset($data["roleIds"])) {
            $this->db->trans_begin();

            $this->db->where("user_id", $id)->delete($this->relationTableName);

            foreach ($data["roleIds"] as $roleId) {
                $userRole = array(
                    "user_id" => $id,
                    "role_id" => $roleId
                );
                $result = $this->db->insert($this->relationTableName, $userRole);
                if (!$result) {
                    $this->db->trans_rollback();
                    return FALSE;
                }
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
            } else {
                $this->db->trans_commit();
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }

    public function update_password($id, $password) {
        $options = ['cost' => 8];
        $pwd_hash = password_hash($password, PASSWORD_DEFAULT, $options);
        $result = $this->db->where("id", $id)->update($this->tableName, array(
            "password" => $pwd_hash,
            "updated_at" => time()
        ));
        return $result;
    }

    public function userinfo($id) {
        // 查询用户信息
        $data = $this->db->select("id, username, is_active, is_superuser, created_at, updated_at")
                        ->where("id", $id)->get($this->tableName)->row_array();

        // 查询角色信息
        $this->db->select("ar.id, ar.name, ar.code");
        $this->db->from("auth_role as ar");
        $this->db->join("auth_user_role as aur", "aur.role_id = ar.id");
        $this->db->where("aur.user_id", $id);
        $query = $this->db->get();
        $data["roles"] = $query->result_array();

        // 查询权限信息
        if (count($data["roles"])) {
            $roleIds = [];
            foreach ($data["roles"] as $role) {
                array_push($roleIds, $role["id"]);
            }
            $this->db->distinct("ap.id");
            $this->db->select("ap.id, ap.name, ap.code, ap.route");
            $this->db->from("auth_permission as ap");
            $this->db->join("auth_role_permission as arp", "ap.id = arp.permission_id");
            $this->db->where_in("arp.role_id", $roleIds);
            $query = $this->db->get();
            $data["permissions"] = $query->result_array();
        } else {
            $data["permissions"] = [];
        }
        return $data;
    }

}
