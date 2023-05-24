<?php

require __DIR__ . "/DatabaseModel.php";

class ProductModel{
    private $db = null;
    private $productsTypes = ['dvd', 'book', 'furniture'];

    public function __construct()
    {
        $this->db = new DatabaseModel();
    }

    public function getAllProducts() 
    {
        $products = array();
        $query = "SELECT * FROM products ORDER BY sku";
        $res = $this->db->select($query);
        foreach ($res as $row) {
          $prodObj = $this->getProductObject($row);
          $products[] = $prodObj->getInf();
        }
        return $products;
    }

    public function createProduct($attributes) 
    {
        $productObject = $this->getProductObject($attributes);
        $field = $productObject->getDBSpecificFieldName();
        $sku = $productObject->getSKU();
        $name = $productObject->getName();
        $price = $productObject->getPrice();
        $type = $productObject->getType();
        $attribute = $productObject->getSpecificAttribute();
        $query = "INSERT INTO products (sku, name, price, $field ) VALUE ( :sku , :name , :price , :type, :attribute )";
        return $this->db->select($query, [
            ':sku' => $sku,
            ':name' => $name,
            ':type' => $type,
            ':price' => $price,
            ':attribute' => $attribute
        ]);
    }

    public function deleteProducts( $sku = array() ) 
    {
        try {
            foreach ($sku as $id) {
                $query = "DELETE FROM products WHERE sku= :sku";
                $this->db->select($query, ['sku'=> $id]);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function getProductObject($attributes) {
        if (in_array($attributes['type'], $this->productsTypes)) {
            $prodObj = new $attributes['type']();
            $prodObj->setSKU($attributes['sku']);  
            $prodObj->setName($attributes['name']);  
            $prodObj->setPrice($attributes['price']);  
            $prodObj->setSpecificAttribute($attributes[$prodObj->getDbSpecificFieldName()]);
            return $prodObj;
        }   else {
            http_response_code(404);
        }
    }
}