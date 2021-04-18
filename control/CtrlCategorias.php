<?php
require_once "conexion.php";
class CtrlCategorias extends Conexion
{

    private $strnombre;
    
    private $conexion = null;


    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conectar();
    }

    public function listaCategorias()
    {
        $sql = "SELECT * FROM categorias";
        $ejecutar = $this->conexion->query($sql);
        $respuesta = $ejecutar->fetchall(PDO::FETCH_ASSOC);
        return $respuesta;
    }

    public function insertarCategoria(String $nombre)
    {
        $this->strnombre = $nombre;
        

        $sql = "INSERT INTO categorias(nombre) 
                VALUES (?)";
        $insertar = $this->conexion->prepare($sql);

        $arreglodatos = array(
            $this->strnombre, $this->strnombre);

        $respuestainsertar = $insertar->execute($arreglodatos);
        $codigo = $this->conexion->lastInsertId();

        return $codigo;
    }

    public function actualizarategoria(
        int $id,
        String $nombre
    ) {
        $this->strnombre = $nombre;
     

        $sql = "UPDATE productos SET nombre=? WHERE id_categoria=$id";
        $actualizar = $this->conexion->prepare($sql);

        $registro = array($this->strnombre);
        $ejecutar = $actualizar->execute($registro);
    }

    public function eliminarCategoria(int $id)
    {
        $sql = "DELETE FROM categorias WHERE id_categoria=?";
        $dato = array($id);
        $eliminar = $this->conexion->prepare($sql);
        $borrado  = $eliminar->execute($dato);
        return $borrado;
    }

    public function buscarCategoria(int $id)
    {
        $sql = "SELECT * FROM categorias WHERE id_categoria=?";
        $dato = array($id);
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute($dato);
        $respuesta = $consulta->fetch(PDO::FETCH_ASSOC);
        return $respuesta;
    }

}
