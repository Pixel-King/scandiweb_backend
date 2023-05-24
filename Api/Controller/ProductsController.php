<?php

require __DIR__ . "/BaseController.php";

class ProductsController extends BaseController
{

    private $productModel = null;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function get()
    {
        try {
            $result = $this->productModel->getAllProducts();
            if (!isset($result))
            {
                http_response_code(404);
                $this->sendOutput('Products not found:(');
            }
            $this->sendOutput('Success!', $result);
        } catch (Exception $e) {
            http_response_code(404);
            $this->sendOutput('Something went wrong.');
        }
    }

    public function save()
    {
        try {
            $queryParams = $this->getQueryStringParams();
            if (isset($queryParams['type']) && isset($queryParams['sku']) && isset($queryParams['name']) && isset($queryParams['price']) 
                && (isset($queryParams['size']) || isset($queryParams['weight']) || isset($queryParams['dimensions']))) 
            {
                    $this->productModel->createProduct($queryParams);
                    http_response_code(201);
                    $this->sendOutput('Product successfully saved!');
            } else {
                http_response_code(422);
                $this->sendOutput('The required query parameter/s were not found!');
            }
        } catch (Exception $e) {
            $this->sendOutput('Something went wrong.');
        }
    }

    public function delete()
    {
        try {
            $sku = $_GET['sku'];
            if (isset($sku) && is_array($sku)) {
                $this->productModel->deleteProducts($sku);
                http_response_code(200);
                $this->sendOutput('Product successfully deleted!');
            } else {
                http_response_code(422);
                $this->sendOutput('The required query parameter/s were not found!');
            } 
        } catch (Exception $e) {
            $this->sendOutput('Something went wrong.');
        }
    }
}
