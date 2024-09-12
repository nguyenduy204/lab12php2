<?php
include_once __DIR__ . '/../config/db.php';
include_once __DIR__ . '/../models/Product.php';

class ProductController {
    private $db;
    private $product;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->product = new Product($this->db);
    }

    public function createProduct() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->product->name = $_POST['name'];
            $this->product->price = $_POST['price'];
            $this->product->quantity = $_POST['quantity'];

            if ($this->product->create()) {
                header("Location: index.php");
                exit();
            } else {
                echo "Lỗi khi thêm sản phẩm";
            }
        } else {
            include_once 'views/add_product.php';
        }
    }

    public function listProducts() {
        $products = $this->product->read();
        include_once 'views/list_products.php';
    }

    public function editProduct($id) {
        $this->product->id = $id;
        $product = $this->product->readOne();
        include_once 'views/edit_product.php';
    }

    public function updateProduct($id) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->product->id = $id;
            $this->product->name = $_POST['name'];
            $this->product->price = $_POST['price'];
            $this->product->quantity = $_POST['quantity'];

            if ($this->product->update()) {
                header("Location: index.php");
                exit();
            } else {
                echo "Lỗi khi cập nhật sản phẩm";
            }
        }
    }

    public function deleteProduct($id) {
        $this->product->id = $id;
        if ($this->product->delete()) {
            header("Location: index.php");
            exit();
        } else {
            echo "Lỗi khi xóa sản phẩm";
        }
    }
}
?>
