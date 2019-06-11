<?php

class AuthRole extends CI_Model {

    protected $tableName = "auth_role";
    protected $relationTableName = "auth_role_permission";

    function __construct() {
        parent::__construct();
    }

    public function all($condition = array()) {
        $query = $this->db->where($condition)->get($this->tableName);
        return $query->result_array();
    }

    public function show($condition = array()) {
        $query = $this->db->where($condition)->get($this->tableName);
        return $query->row_array();
    }

    public function update($id, $data) {
        if (isset($data["permissionIds"])) {
            $this->db->where("role_id", $id)->delete($this->relationTableName);
            foreach ($data["permissionIds"] as $permissionId) {
                $rolePermission = array(
                    "role_id" => $id,
                    "permission_id" => $permissionId
                );
                $this->db->insert($this->relationTableName, $rolePermission);
            }
        }
        return $this->db->where("id", $id)->update($this->tableName, array(
                    "name" => $data["name"],
                    "code" => $data["code"],
                    "updated_at" => time()
        ));
    }

    public function create($data = array()) {
        $result = $this->db->insert($this->tableName, array(
            "name" => $data["name"],
            "code" => $data["code"],
            "created_at" => time()
        ));

        if (!$result) {
            return FALSE;
        }

        $roleId = $this->db->insert_id();

        $this->db->trans_begin();

        foreach ($data["permissionIds"] as $permissionId) {
            $rolePermission = array(
                "role_id" => $roleId,
                "permission_id" => $permissionId
            );
            $result = $this->db->insert($this->relationTableName, $rolePermission);
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
    }

    public function delete($id) {
        $this->db->where("role_id", $id)->delete($this->relationTableName);
        return $this->db->where("id", $id)->delete($this->tableName);
    }

}
