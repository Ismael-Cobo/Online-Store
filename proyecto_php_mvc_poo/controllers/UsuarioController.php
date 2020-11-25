<?php

// Cargo el modelo del usuario
require_once 'models/usuario.php';

class UsuarioController {

    public function register() {
        require_once 'views/usuario/registro.php';
    }

    public function save() {
        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            $usuario = new Usuario();

            $errores = array();
            if (is_string($nombre) && !empty($nombre) && !preg_match('/[0-9]/', $nombre)) {

                $usuario->setNombre($nombre);
            } else {
                $errores['name'] = "El nombre de usuario no es válido";
            }

            if (is_string($apellidos) && !empty($apellidos) && !preg_match('/[0-9]/', $apellidos)) {
                $usuario->setApellidos($apellidos);
            } else {
                $errores['surname'] = "Los apellidos del usuario no son válidos";
            }

            if (isset($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $usuario->setEmail($email);
            } else {
                $errores['email'] = "El email introducido no es válido";
            }

            if (!empty($password)) {
                $usuario->setPassword($password);
            } else {
                $errores['password'] = "La password no es válida";
            }



            if (count($errores) == 0) {
                $save = $usuario->save();
                // me saca tambien los errores var_dump($usuario);
                if ($save) {
                    $_SESSION['register'] = "completed";
                } else {
                    $_SESSION['register'] = "failed";
                }
            } else {
                $_SESSION['errores_login'] = $errores; 
                $_SESSION['register'] = "failed";
            }
        } else {
            $_SESSION['register'] = "failed";
        }
        header('Location:' . base_url . 'Usuario/register');
    }

    public function login() {
        if (isset($_POST)) {
            $usuario = new Usuario;

            $email = $usuario->setEmail($_POST['email']);
            $password = $usuario->setPassword($_POST['password']);
            $identity = $usuario->login();
            
            if($identity){
                $_SESSION['identity'] = $identity;
                if($identity->rol == 'admin'){
                    $_SESSION['admin'] = true;
                }
            }else{
                $_SESSION['error-login'] = "Credenciales de acceso invalidas";
            }
        }
        
        header("Location:".base_url);
    }
    
    public function logout(){
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
            unset($_SESSION['carrito']);
        }
        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }
        
        header("Location:".base_url);
    }
    
}

