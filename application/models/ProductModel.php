<?php

class ProductModel extends CI_Model {

    protected $tableName = "product";

    function __construct() {
        parent::__construct();
    }

    public function all($condition = array()) {
        $query = $this->db->where($condition)->get($this->tableName);
        return $query->result_array();
    }

    public function page_list($params = array()) {
        $this->db->select("p.*, b.name as brand_name, c.name as category_name");
        $this->db->from("$this->tableName as p");
        isset($params["name"]) && $this->db->like("p.name", $params["name"]);
        (isset($params["brandId"]) && $params["brandId"] != FALSE) && $this->db->where("p.brand_id", $params["brandId"]);
        (isset($params["categoryId"]) && $params["categoryId"] != FALSE) && $this->db->where("p.category_id", $params["categoryId"]);
        $total = $this->db->count_all_results("", FALSE);
        $this->db->order_by("created_at", "DESC");
        $this->db->limit($params["pageSize"], ($params["page"] - 1) * $params["pageSize"]);
        $this->db->join("brand as b", "b.id = p.brand_id");
        $this->db->join("category as c", "c.id = p.category_id");
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
