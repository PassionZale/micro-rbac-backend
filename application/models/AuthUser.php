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

    public function show($condition = array(), $password = FALSE) {
        $arguments = "id, username, is_active, is_superuser, created_at, updated_at";
        $password && ($arguments .= ", password");
        $query = $this->db->select($arguments)->where($condition)->get($this->tableName);
        return $query->row_array();
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
        $options = ['cost' => 8];
        $pwd_hash = password_hash($data['password'], PASSWORD_DEFAULT, $options);

        $result = $this->db->where("id", $id)->update($this->tableName, array(
            "username" => $data["username"],
            "password" => $pwd_hash,
            "is_superuser" => $is_superuser,
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

}
