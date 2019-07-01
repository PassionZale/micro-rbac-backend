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
        $this->db->select("p.id, p.brand_id, p.category_id as category_child_id, c.pid as category_parent_id, p.name");
        $this->db->where("p.id", $condition["id"]);
        $this->db->join("category as c", "c.id = p.category_id");
        $product = $this->db->get("$this->tableName as p")->row_array();

        $skus = $this->db->where("product_id", $product["id"])->get("product_sku")->result_array();
        foreach ($skus as $sku) {
            $sku["name"] = $product["name"];
            $sku["properties"] = $this->db->where("product_sku_id", $sku["id"])->get("product_sku_property")->result_array();
            $product["skus"][] = $sku;
        }
        return $product;
    }

    public function update($id, $data) {

        $product = array(
            "name" => $data["name"],
            "brand_id" => $data["brand_id"],
            "category_id" => $data["category_id"],
            "updated_at" => time()
        );

        $result = $this->db->where("id", $id)->update($this->tableName, $product);

        if (!$result) {
            return FALSE;
        }

        $productSkus = $this->db->where("product_id", $id)->get("product_sku")->result_array();
        $productSkuIds = [];
        foreach ($productSkus as $sku) {
            $productSkuIds[] = $sku["id"];
        }

        $this->db->where_in("id", $productSkuIds)->delete("product_sku");
        $this->db->where_in("product_sku_id", $productSkuIds)->delete("product_sku_property");

        foreach ($data["skus"] as $sku) {
            $product_sku = array(
                "product_id" => $id,
                "stock" => $sku["stock"],
                "price" => $sku["price"],
            );
            $result = $this->db->insert("product_sku", $product_sku);

            if (!$result) {
                return FALSE;
            }

            $product_sku_id = $this->db->insert_id();

            foreach ($sku["properties"] as $product_sku_property) {
                $product_sku_property["product_sku_id"] = $product_sku_id;
                $this->db->insert("product_sku_property", $product_sku_property);
            }
        }
        
        return TRUE;
    }

    public function create($data = array()) {

        $product = array(
            "name" => $data["name"],
            "brand_id" => $data["brand_id"],
            "category_id" => $data["category_id"],
            "created_at" => time()
        );

        $result = $this->db->insert($this->tableName, $product);

        if (!$result) {
            return FALSE;
        }

        $product_id = $this->db->insert_id();

        foreach ($data["skus"] as $sku) {
            $product_sku = array(
                "product_id" => $product_id,
                "stock" => $sku["stock"],
                "price" => $sku["price"],
            );
            $result = $this->db->insert("product_sku", $product_sku);

            if (!$result) {
                return FALSE;
            }

            $product_sku_id = $this->db->insert_id();

            foreach ($sku["properties"] as $product_sku_property) {
                $product_sku_property["product_sku_id"] = $product_sku_id;
                $this->db->insert("product_sku_property", $product_sku_property);
            }
        }

        return TRUE;
    }

    public function delete($id) {
        // TODO 判断品牌是否被关联
        return $this->db->where("id", $id)->delete($this->tableName);
    }

}
