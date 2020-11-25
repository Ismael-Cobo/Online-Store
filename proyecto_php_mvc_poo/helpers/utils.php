<?php

class Utils {
    
    public static function deleteSesion($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
    }
    
    public static function isAdmin(){
        if(!isset($_SESSION['admin'])){
            header("Location:".base_url);
        }else{
            return true;
        }
    }
    // Necesario ya que en el controlador de productos no hay que requerir modelos de otro controlador
    public static function showCategories(){
        require_once 'models/categoria.php';
        $categoria = new Categoria();
        return $categoria->getAll();
    }
    
    public static function statsCarrito(){
        $stats = array(
            "total" => 0,
            "cantidad_unidad"=>0
        );
        if(isset($_SESSION['carrito'])){
            $i = 0;
            //Creamos el total
            foreach ($_SESSION['carrito'] as $key => $valor){
                $stats[$key]['preciototal'] = $_SESSION['carrito'][$key]['unidades']*$valor['producto']->precio;
                $stats['total'] = $stats[$key]['preciototal']+ $stats['total'];
                $stats['cantidad_unidad'] = $_SESSION['carrito'][$key]['unidades']+$stats['cantidad_unidad'];
                
                //$stats['total'] += ($valor['precio']*$valor['unidades']);
            }
            return $stats;
            
            
            
        }
    }
}