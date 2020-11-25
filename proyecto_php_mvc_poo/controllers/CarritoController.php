<?php

require_once 'models/producto.php';

class CarritoController {

    public function index() {
        if (isset($_SESSION['carrito'])) {
            $carrito = $_SESSION['carrito'];
        }
        $stats = Utils::statsCarrito();
        if(!isset($_SESSION['identity'])){
            header("Location: ".base_url."usuario/register");
        }
        require_once 'views/carrito/index.php';
    }

    public function add() {
        if ($_GET['id']) {
            $id = $_GET['id'];
        } else {
            header("Location: " . base_url);
        }

        if (isset($_SESSION['carrito'])) {
            $cont = 0;

            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                if ($elemento['id'] == $id) {
                    $_SESSION['carrito'][$indice]["unidades"] ++;
                    $cont++;
                }
            }
        }
        if (!isset($cont) || $cont == 0) {
            $producto = new Producto();
            $producto->setId($id);
            $pro = $producto->getOne();


            if (is_object($pro)) {
                $_SESSION['carrito'][] = array(
                    "id" => $pro->id,
                    "precio" => $pro->precio,
                    "unidades" => 1,
                    "producto" => $pro,
                );
            }
        }

        header("Location:" . base_url . "carrito/index");
    }
    
    public function remove(){
        if(isset($_SESSION['carrito'] ) && isset($_SESSION['identity']) && isset($_GET['indice'])){
            $indice = $_GET['indice'];
            unset($_SESSION['carrito'][$indice]);
            
        }
        header("Location:" . base_url . "carrito/index");
    }

    public function up(){
        if(isset($_SESSION['carrito'] ) && isset($_SESSION['identity']) && isset($_GET['indice'])){
            $indice = $_GET['indice'];
            $_SESSION['carrito'][$indice]['unidades']++;
            
        }
        header("Location:" . base_url . "carrito/index");
    }
    
    public function down(){
        if(isset($_SESSION['carrito'] ) && isset($_SESSION['identity']) && isset($_GET['indice'])){
            $indice = $_GET['indice'];
            $_SESSION['carrito'][$indice]['unidades']--;
            if($_SESSION['carrito'][$indice]['unidades'] == 0) {
                unset($_SESSION['carrito'][$indice]);
            }
        }
         header("Location:" . base_url . "carrito/index");
    }
    
    public function delete() {
        unset($_SESSION['carrito']);
        header("Location:" . base_url . "carrito/index");
    }

}
