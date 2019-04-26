<?php

class AuthPermission extends CI_Model{

    function __construct() {
        parent::__construct();
    }

    public function getAll($condition = array()) {
        $query = $this->db->where($condition)->get("auth_permission");
        return $query->result_array();
    }

    public function getItem($condition = array()) {
        $query = $this->db->where($condition)->get("auth_permission");
        return $query->row_array();
    }

    public function updateItem() {
        
    }

    public function createItem() {
        
    }

    public function deleteItem() {
        
    }

}
