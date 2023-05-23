<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $this->routes = [
            'GET:/products' => 'ProductsController@get',
            'POST:/products' => 'ProductsController@save',
            'DELETE:/products' => 'ProductsController@delete',
        ];
    }

    public function handleRequest()
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, DELETE');
        header('Access-Control-Allow-Headers: *');

        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUrl = $_SERVER['PATH_INFO'];
        $routeKey = $requestMethod . ':' . $requestUrl;

        if (isset($this->routes[$routeKey])) {
            $route = $this->routes[$routeKey];
            [$controllerName, $methodName] = explode('@', $route);

            $controller = new $controllerName();
            $controller->$methodName();
        } else {
            http_response_code(500);
            echo json_encode([
                'status' => http_response_code(),
                'massege' => 'Endpoint not found!',
            ]);
        }
    }

    protected function getUriSegments()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode( '/', $uri );
        return $uri;
    }
}
