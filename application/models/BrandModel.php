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

    public function page_list($params = array()) {
        $this->db->select("*");
        $this->db->from($this->tableName);
        isset($params["name"]) && $this->db->like("name", $params["name"]);
        $total = $this->db->count_all_results("", FALSE);
        $this->db->order_by("created_at", "DESC");
        $this->db->limit($params["pageSize"], ($params["page"] - 1) * $params["pageSize"]);
        $list = $this->db->get()->result_array();
        return ["total" => $total, "list" => $list, "page" => $params["page"], "pageSize" => $params["pageSize"]];
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
        // TODO 判断品牌是否被关联
        return $this->db->where("id", $id)->delete($this->tableName);
    }

}
