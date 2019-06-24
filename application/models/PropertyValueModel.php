<?php

class PropertyValueModel extends CI_Model {

    protected $tableName = "property_value";
    protected $relationTableName = "property";

    function __construct() {
        parent::__construct();
    }

    public function all($condition = array()) {
        $query = $this->db->where($condition)->order_by("created_at", "DESC")->get($this->tableName);
        return $query->result_array();
    }

    public function page_list($params = array()) {
        $this->db->select("pv.*, p.name as property_name");
        $this->db->from("$this->tableName as pv");
        (isset($params["property_id"]) && $params["property_id"] != FALSE) && $this->db->where("pv.property_id", $params["property_id"]);
        isset($params["name"]) && $this->db->like("pv.name", $params["name"]);
        $total = $this->db->count_all_results("", FALSE);
        $this->db->order_by("created_at", "DESC");
        $this->db->limit($params["pageSize"], ($params["page"] - 1) * $params["pageSize"]);
        $this->db->join("$this->relationTableName as p", "p.id = pv.property_id");
        $list = $this->db->get()->result_array();
        return ["total" => $total, "list" => $list, "page" => $params["page"], "pageSize" => $params["pageSize"]];
    }

    public function show($condition = array()) {
        $this->db->select("pv.*, p.name as property_name");
        $this->db->from("$this->tableName as pv");
        $this->db->where("pv.id", $condition["id"]);
        $this->db->join("$this->relationTableName as p", "p.id = pv.property_id");
        return $this->db->get()->row_array();
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
        // TODO 删除关联表
        return $this->db->where("id", $id)->delete($this->tableName);
    }

}
