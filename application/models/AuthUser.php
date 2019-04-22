<?php

class AuthUser extends CI_Model {

    public function __construct() {
        parent::__construct();
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
