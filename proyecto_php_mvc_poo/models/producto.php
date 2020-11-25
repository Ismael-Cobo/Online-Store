<?php

class Producto {

    private $id;
    private $cat_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    function getId() {
        return $this->id;
    }

    function getCat_id() {
        return $this->cat_id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getStock() {
        return $this->stock;
    }

    function getOferta() {
        return $this->oferta;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getImagen() {
        return $this->imagen;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCat_id($cat_id) {
        $this->cat_id = $cat_id;
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    function setPrecio($precio) {
        $this->precio = $this->db->real_escape_string($precio);
    }

    function setStock($stock) {
        $this->stock = $this->db->real_escape_string($stock);
    }

    function setOferta($oferta) {
        $this->oferta = $this->db->real_escape_string($oferta);
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    public function getAll() {
        $sql = "SELECT * FROM productos;";

        $prodcutos = $this->db->query($sql);
        return $prodcutos;
    }

    public function getOne() {
        $sql = "SELECT * FROM productos WHERE id = {$this->id};";

        $producto = $this->db->query($sql);
        return $producto->fetch_Object();
    }

    public function getRandom($limit) {
        $sql = "SELECT * FROM productos ORDER BY RAND() LIMIT {$limit};";
        return $this->db->query($sql);
    }

    public function getAllCat() {
        $sql = "SELECT p.*, c.nombre as 'catnombre' FROM productos p "
               . "INNER JOIN categorias c ON c.id = p.categoria_id "
                . " WHERE c.id = {$this->getCat_id()} "
                . "ORDER BY p.id;";
        
        $producto = $this->db->query($sql);
        /*var_dump($this->db->error);
        echo "<br/>".$sql;
        die();*/
        return $producto;
    }

    public function save() {
        $result = false;
        $sql = "INSERT INTO productos VALUES(NULL, {$this->getCat_id()}, '{$this->getNombre()}', '{$this->getDescripcion()}', {$this->getPrecio()}, {$this->getStock()} ,' ', CURDATE(), '{$this->getImagen()}')";
        $save = $this->db->query($sql);
        if ($save) {
            $result = $save;
        }
        return $result;
    }

    public function edit() {
        $result = false;
        $sql = "UPDATE productos SET categoria_id = {$this->getCat_id()}, nombre =  '{$this->getNombre()}', descripcion = '{$this->getDescripcion()}', precio = {$this->getPrecio()},"
                . " stock = {$this->getStock()}";
        if (!empty($this->getImagen())) {
            $sql .= ", imagen = '{$this->getImagen()}'";
        }
        $sql .= " WHERE id = {$this->getId()};";
        $save = $this->db->query($sql);
        if ($save) {
            $result = $save;
        }
        return $result;
    }

    public function delete() {
        $result = false;
        $sql = "DELETE FROM productos WHERE id = {$this->id}";
        $save = $this->db->query($sql);
        if ($save) {
            $result = $save;
        }
        return $result;
    }

}
