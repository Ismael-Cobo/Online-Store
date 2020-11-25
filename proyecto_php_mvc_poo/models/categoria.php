<?php

class Categoria {

    private $id;
    private $nombre;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function getAll() {
        $sql = "SELECT * FROM categorias";
        $categoria = $this->db->query($sql);
        return $categoria;
    }
    
    public function getOne(){
        $sql = "SELECT * FROM categorias WHERE id = {$this->id}";
        $categoria = $this->db->query($sql);
        return $categoria->fetch_object();
    }


    public function save(){
        $result = FALSE;
        $sql = "INSERT INTO categorias VALUES (null, '{$this->getNombre()}');";
        $categoria = $this->db->query($sql);
        
        if($categoria){
            $result = $categoria;
        }
        return $result;
    }
    
    public function comprovar(){
        $result = FALSE;
        $sql = "SELECT nombre FROM categorias WHERE nombre = '{$this->getNombre()}'";
        $categoria = $this->db->query($sql);
        
        if($categoria && $categoria->num_rows == 1){
            $result = true;
        }
        return $result;
    }
    
}
