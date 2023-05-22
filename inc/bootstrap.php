<?php
define("PROJECT_ROOT_PATH", __DIR__ . "/../");

require_once PROJECT_ROOT_PATH . "/inc/config.php";

require_once PROJECT_ROOT_PATH . "/Api/Router/Router.php";

require_once PROJECT_ROOT_PATH . "/Api/Controller/ProductsController.php";

require_once PROJECT_ROOT_PATH . "/Model/ProductModel.php";

require_once PROJECT_ROOT_PATH . "/Model/Products/AbstractProduct.php";

require_once PROJECT_ROOT_PATH . "/Model/Products/Book.php";

require_once PROJECT_ROOT_PATH . "/Model/Products/Dvd.php";

require_once PROJECT_ROOT_PATH . "/Model/Products/Furniture.php";