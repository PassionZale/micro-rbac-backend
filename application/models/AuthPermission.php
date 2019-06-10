<?php

class AuthPermission extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function all($condition = array()) {
        $query = $this->db->where($condition)->get("auth_permission");
        return $query->result_array();
    }

    public function show($condition = array()) {
        $query = $this->db->where($condition)->get("auth_permission");
        return $query->row_array();
    }

    public function update($id, $data) {
        $data["updated_at"] = time();
        return $this->db->where("id", $id)->update("auth_permission", $data);
    }

    public function create($data = array()) {
        $data["created_at"] = time();
        return $this->db->insert("auth_permission", $data);
    }

    public function delete($id) {
        return $this->db->where("id", $id)->delete("auth_permission");
    }

}
