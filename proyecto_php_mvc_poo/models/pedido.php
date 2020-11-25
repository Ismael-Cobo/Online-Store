<?php

class Pedido {

    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }
    
    function getId() {
        return $this->id;
    }

    function getUsuario_id() {
        return $this->usuario_id;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function getLocalidad() {
        return $this->localidad;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getCoste() {
        return $this->coste;
    }

    function getEstado() {
        return $this->estado;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getHora() {
        return $this->hora;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

    function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setCoste($coste) {
        $this->coste = $coste;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    
    
    public function getAll() {
        $sql = "SELECT * FROM pedidos;";

        $prodcutos = $this->db->query($sql);
        return $prodcutos;
    }

    public function getOneByIdUser() {
        $sql = "SELECT * FROM pedidos WHERE usuario_id = {$this->getUsuario_id()} "
             . "ORDER BY ID DESC LIMIT 1";

        $producto = $this->db->query($sql);
        return $producto->fetch_Object();
    }
    
    public function getOneById() {
        $sql = "SELECT * FROM pedidos WHERE id = {$this->getId()}";

        $producto = $this->db->query($sql);
        // No le pido que me haga el fetch_object() ya que si no me lo haria en todos y mejor lo hago en el bucle
        return $producto;
    }
    
    public function getAllByIdUser() {
        $sql = "SELECT * FROM pedidos WHERE usuario_id = {$this->getUsuario_id()} "
             . "ORDER BY ID ASC";

        $producto = $this->db->query($sql);
        // No le pido que me haga el fetch_object() ya que si no me lo haria en todos y mejor lo hago en el bucle
        return $producto;
    }
    
    
    
    public function getProductosByPedidoId($id) {
        $sql = "SELECT p.*, lp.unidades FROM lineas_pedidos lp"
             . " INNER JOIN productos p ON p.id = lp.producto_id"
             . " WHERE lp.pedido_id = {$id} ";

        $producto = $this->db->query($sql);
        
        // No le pido que me haga el fetch_object() ya que si no me lo haria en todos y mejor lo hago en el bucle
        return $producto;
    }

    public function save() {
        $result = false;
        $sql = "INSERT INTO pedidos VALUES(NULL, {$this->getUsuario_id()}, '{$this->getProvincia()}', '{$this->getLocalidad()}', '{$this->getDireccion()}', {$this->getCoste()} ,'confirm', CURDATE(), CURTIME())";
        $save = $this->db->query($sql);
        if ($save) {
            $result = $save;
        }
        return $result;
    }
    
    public function save_linea(){
        $result = false;
        $sql = "SELECT LAST_INSERT_ID() as 'pedido_id'";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido_id;
        foreach ($_SESSION['carrito'] as $productos){            
            $insert = "INSERT INTO lineas_pedidos VALUES(NULL, {$pedido_id}, {$productos['producto']->id}, {$productos['unidades']})";
            $query2 = $this->db->query($insert);
        }
        
        if ($query2) {
            $result = $query2;
        }
        return $result;
    }


}
