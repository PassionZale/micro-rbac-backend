<?php

class CategoryModel extends CI_Model {

    protected $tableName = "category";
    protected $relationTableName = "category_property";

    function __construct() {
        parent::__construct();
    }

    public function all($condition = array()) {
        $query = $this->db->where($condition)->get($this->tableName);
        return $query->result_array();
    }

    public function page_list($params) {
        $this->db->select("c.*, p.name as pname");
        $this->db->from("$this->tableName as c");
        $this->db->where("c.pid >", 0);
        (isset($params["pid"]) && $params["pid"] != FALSE) && $this->db->where("c.pid", $params["pid"]);
        isset($params["name"]) && $this->db->like("c.name", $params["name"]);
        $total = $this->db->count_all_results("", FALSE);
        $this->db->order_by("created_at", "DESC");
        $this->db->limit($params["pageSize"], ($params["page"] - 1) * $params["pageSize"]);
        $this->db->join("$this->tableName as p", "p.id = c.pid");
        $list = $this->db->get()->result_array();
        return ["total" => $total, "list" => $list, "page" => $params["page"], "pageSize" => $params["pageSize"]];
    }

    public function cascader() {
        $this->db->select("id as value, name as label");
        $this->db->where("pid", 0);
        $this->db->from($this->tableName);
        $categories = $this->db->get()->result_array();

        $result = [];

        foreach ($categories as $key => $category) {
            $children = $this->db->select("id as value, name as label")->where("pid", $category["value"])->from($this->tableName)->get()->result_array();
            if (count($children)) {
                foreach ($children as $i => $v) {
                    $children[$i]["children"] = [];
                }
                $category["children"] = $children;
                $result[] = $category;
            }
        }

        return $result;
    }

    public function tree() {
        $categories = $this->db->select("id, name as title")->where("pid", 0)->order_by("created_at", "DESC")->get($this->tableName)->result_array();
        $result = [];
        foreach ($categories as $category) {
            $category["children"] = [];
            $result[] = $category;
        }
        return $result;
    }

    public function property($category_id) {
        $propertyIds = $this->db->select("property_id")->where("category_id", $category_id)->get($this->relationTableName)->result_array();
        $ids = [];
        foreach($propertyIds as $id) {
            $ids[] = $id["property_id"];
        }
        
        $result = [];
        
        $properties = $this->db->select("id as property_id, name as property_name")->where_in("id", $ids)->get("property")->result_array();
        foreach ($properties as $property) {
            $property["property_values"] = $this->db->select("id as property_value_id, name as property_value_name")->where("property_id", $property["property_id"])->get("property_value")->result_array();
            $result[] = $property;
        }
        
        return $result;
    }
    
    public function show($condition = array()) {
        $category = $this->db->where($condition)->get($this->tableName)->row_array();
        $categoryProperties = $this->db->where("category_id", $condition["id"])->get($this->relationTableName)->result_array();
        $category["propertyIds"] = [];
        if (count($categoryProperties) > 0) {
            foreach ($categoryProperties as $categoryProperty) {
                $category["propertyIds"][] = $categoryProperty["property_id"];
            }
        }
        return $category;
    }

    public function update($id, $data) {

        $category = array(
            "name" => $data["name"],
            "pid" => $data["pid"],
            "updated_at" => time(),
        );

        $result = $this->db->where("id", $id)->update($this->tableName, $category);
        if (!$result) {
            return FALSE;
        }

        if ($data["pid"] > 0 && isset($data["propertyIds"])) {
            $this->db->where("category_id", $id)->delete($this->relationTableName);
            if (count($data["propertyIds"]) > 0) {
                foreach ($data["propertyIds"] as $propertyId) {
                    $categoryProperty = array(
                        "category_id" => $id,
                        "property_id" => $propertyId
                    );
                    $this->db->insert($this->relationTableName, $categoryProperty);
                }
            }
        }

        return TRUE;
    }

    public function create($data = array()) {
        $category = array(
            "name" => $data["name"],
            "pid" => $data["pid"],
            "created_at" => time(),
        );

        $result = $this->db->insert($this->tableName, $category);

        if (!$result) {
            return FALSE;
        }

        $categoryId = $this->db->insert_id();

        if ($data["pid"] > 0 && isset($data["propertyIds"]) && count($data["propertyIds"]) > 0) {
            foreach ($data["propertyIds"] as $propertyId) {
                $categoryProperty = array(
                    "category_id" => $categoryId,
                    "property_id" => $propertyId
                );
                $this->db->insert($this->relationTableName, $categoryProperty);
            }
        }

        return TRUE;
    }

    public function delete($id) {
        // TODO 判断分类是否被关联
        return $this->db->where("id", $id)->delete($this->tableName);
    }

}
