<?php

class BrandModel extends CI_Model {

    protected $tableName = "brand";
    protected $relationTableName = "product";

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
        $data["updated_at"] = time();
        return $this->db->where("id", $id)->update($this->tableName, $data);
    }

    public function create($data = array()) {
        $data["created_at"] = time();
        return $this->db->insert($this->tableName, $data);
    }

    public function delete($id) {
        $this->db->where("brand_id", $id)->update($this->relationTableName, array("brand_id" => NULL));
        return $this->db->where("id", $id)->delete($this->tableName);
    }

}
