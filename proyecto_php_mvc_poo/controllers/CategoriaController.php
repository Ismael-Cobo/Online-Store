<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';
class CategoriaController {
    
    public function index(){
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        require_once 'views/categoria/index.php';
        
    }
    
    public function crear(){
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }
    
    public function save(){
        Utils::isAdmin();
        
        if(isset($_POST) && isset($_POST['nombre'])){
            
            $nombre = $_POST['nombre'];
            
            $categoria = new Categoria();
            $categoria->setNombre($nombre);
            if($categoria->comprovar()){
                $_SESSION['error-cat'] = "failed";
                header("Location:".base_url."categoria/crear");
            }else{
                $categoria->save();
            }
            
        }
        header("Location:".base_url."categoria/index");
    }
    
    public function ver(){
        
        if($_GET['id']){
            $id = $_GET['id'];
            // Obtengo la id de la categoria y su nombre
            $categorias = new Categoria();
            $categorias->setId($id);
            // Ojo al crear la variable $categoria ya que en mi caso antes la he igualado al objeto no  a la query
            $categoria = $categorias->getOne();
            
            // Obtengo los productos con la cat_id igual al $_GET['id']
            
            $producto = new Producto();
            $producto->setCat_id($id);
            $productos = $producto->getAllCat();
            require_once 'views/categoria/ver.php';
        }else{
             header("Location:".base_url);
        }
    }
    
    
}
