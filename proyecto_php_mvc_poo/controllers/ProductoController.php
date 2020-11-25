<?php

require_once 'models/producto.php';

class ProductoController {

    public function index() {
        $producto = new Producto();
        $productos = $producto->getRandom(6);
        require_once 'views/producto/destacado.php';
    }

    public function gestion() {
        Utils::isAdmin();
        $producto = new Producto();
        $productos = $producto->getAll();
        require_once 'views/producto/gestion.php';
    }

    public function crear() {
        Utils::isAdmin();
        require_once 'views/producto/crear.php';
    }

    public function save() {
        Utils::isAdmin();
        if ($_POST) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $cat_id = isset($_POST['categoria']) ? $_POST['categoria'] : false;

            if ($nombre && $descripcion && $precio && $stock && $cat_id) {

                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCat_id($cat_id);

                if (isset($_FILES['imagen'])) {

                    $file = $_FILES['imagen'];
                    $name_file = $file['name'];
                    $type_file = $file['type'];

                    if ($type_file == "image/jpeg" || $type_file == "image/png" || $type_file == "image/jpg" || $type_file == "image/gif") {
                        
                        if (!is_dir("uploads/images")) {

                            // Se le pone true para que sea recursivo
                            mkdir("uploads/images", 0777, true);
                        }
                        
                        $producto->setImagen($name_file);
                        move_uploaded_file($file['tmp_name'], "uploads/images/" . $name_file);
                        
                    } else {
                        $_SESSION['producto'] = 'failed';
                        header("Location:" . base_url . "producto/gestion");
                    }
                }
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $save = $producto->edit();
                    
                } else {
                    $save = $producto->save();
                }


                if ($save) {
                    $_SESSION['producto'] = 'completed';
                } else {
                    $_SESSION['producto'] = 'failed';
                }
            } else {
                $_SESSION['producto'] = 'failed';
            }
        } else {
            $_SESSION['producto'] = 'failed';
        }
        
        header("Location:" . base_url . "producto/gestion");
        
    }

    public function edit() {
        Utils::isAdmin();
        $edit = true;
        $id = $_GET['id'];
        $producto = new Producto();
        $producto->setId($id);
        $pro = $producto->getOne();
        require_once 'views/producto/crear.php';
    }

    public function delete() {
        Utils::isAdmin();
        if ($_GET) {
            $id = $_GET['id'];
            $productos = new Producto();
            $productos->setId($id);
            $save = $productos->delete();
            if ($save) {
                $_SESSION['borrar'] = "completed";
            } else {
                $_SESSION['borrar'] = "failed";
            }
        } else {
            $_SESSION['borrar'] = "failed";
        }

        header("Location:" . base_url . "producto/gestion");
    }
    
    public function ver(){        
        $id = $_GET['id'];
        $producto = new Producto();
        $producto->setId($id);
        $pro = $producto->getOne();
        require_once 'views/producto/ver.php';
        
    }
}
