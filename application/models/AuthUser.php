<?php

class AuthUser extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function all($condition = array()) {
        $query = $this->db->where($condition)->get("auth_user");
        return $query->result_array();
    }

    public function show($condition = array()) {
        $query = $this->db->where($condition)->get("auth_user");
        return $query->row_array();
    }

    public function create($data, $is_superuser = FALSE) {
        $options = ['cost' => 8];
        $pwd_hash = password_hash($data['password'], PASSWORD_DEFAULT, $options);
        $data['password'] = $pwd_hash;
        if ($is_superuser) {
            $data['is_superuser'] = 1;
        }
        $data["created_at"] = date('Y-m-d H:i:s');
        $data["updated_at"] = date('Y-m-d H:i:s');
        return $this->db->insert('auth_user', $data);
    }

}
