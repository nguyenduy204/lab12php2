<?php
include_once __DIR__ . '/controllers/ProductController.php';

$controller = new ProductController();

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'create':
        $controller->createProduct();
        break;

    case 'edit':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $controller->editProduct($id);
        }
        break;

    case 'update':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $controller->updateProduct($id);
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $controller->deleteProduct($id);
        }
        break;

    default:
        $controller->listProducts();
        break;
}
?>
