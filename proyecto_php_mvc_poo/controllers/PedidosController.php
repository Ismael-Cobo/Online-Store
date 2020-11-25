<?php

require_once 'models/pedido.php';

class PedidosController {

    public function hacer() {
        require_once 'views/pedido/index.php';
    }

    public function add() {
        if (isset($_POST)) {
            //Creando variables para los setter del objeto pedido
            $usuario_id = $_SESSION['identity']->id;
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direcion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            //Stats del carrito para la obtención del total y las unidades
            $stats = Utils::statsCarrito();
            $coste = $stats['total'];

            $errores = array();
            $pedido = new Pedido();


            if (is_string($provincia) && !empty($provincia) && !preg_match('/[0-9]/', $provincia)) {
                $pedido->setProvincia($provincia);
            } else {
                $errores['provincia'] = "La provincia no es válida";
            }

            if (is_string($localidad) && !empty($localidad) && !preg_match('/[0-9]/', $localidad)) {
                $pedido->setLocalidad($localidad);
            } else {
                $errores['localidad'] = "La localidad no es válida";
            }

            if (is_string($direcion) && !empty($direcion)) {
                $pedido->setDireccion($direcion);
            } else {
                $errores['direcion'] = "La direcion no es válida";
            }



            if (count($errores) == 0) {
                $pedido->setUsuario_id($usuario_id);
                $pedido->setCoste($coste);

                $save = $pedido->save();
                $save_linea = $pedido->save_linea();
                if ($save && $save_linea) {
                    $_SESSION['pedido']['completed'] = "El pedido se ha completado con éxito";
                    
                    header("Location: " . base_url . "pedidos/confirm");
                    die();
                } else {
                    $_SESSION['error-pedido'] = $errores;
                    $_SESSION['error-pedido']['failed'] = "Ha habido un error1";
                }
            } else {
                $_SESSION['error-pedido'] = $errores;
                $_SESSION['error-pedido']['failed'] = "Ha habido un error2";
            }
        } else {
            $_SESSION['error-pedido']['failed'] = "Ha habido un error3";
        }

        header("Location: " . base_url . "pedidos/hacer");
    }
    
    public function confirm(){        
        if(isset($_SESSION['identity'])){
            // Conseguir objeto de pedido
            $usuario_id = $_SESSION['identity']->id;
            $pedidos = new Pedido();
            $pedidos->setUsuario_id($usuario_id);
            $pedido = $pedidos->getOneByIdUser();
            
            $producto = new Pedido();
            $productos = $producto->getProductosByPedidoId($pedido->id);
          require_once 'views/pedido/confirm.php';  
        }else{
            header("Location: ".base_url);
        }
        
    }
    
    public function view(){
        if(isset($_SESSION['identity'])){
            
            $usuario_id = $_SESSION['identity']->id;
            
            $pedido = new Pedido();
            $pedido->setUsuario_id($usuario_id);
            $pedidos = $pedido->getAllByIdUser();
            
            
            require_once 'views/pedido/view.php';
        }else{
            header("Location: ".base_url);
        }
        
    }
    
    public function details(){
        if(isset($_SESSION['identity']) && isset($_GET['id'])){
            $id = $_GET['id'];
            $usuario_id = $_SESSION['identity']->id;
            
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedidos = $pedido->getOneById();
            $pedidov2 = $pedido->getOneById()->fetch_object();
            if($pedidos->fetch_object()->usuario_id != $usuario_id){
                header("Location: ".base_url);
            }
            
            $producto = new Pedido();
            $productos = $producto->getProductosByPedidoId($pedidov2->id);
            
            require_once 'views/pedido/details.php';
            
        }else{
            header("Location: ".base_url);
        }
        
    }
    
    public function gestionar(){
        Utils::isAdmin();
        $gestion = true;
        $pedido = new Pedido();
        $pedidos = $pedido->getAll();
        
        require_once 'views/pedido/view.php';
    }

}
