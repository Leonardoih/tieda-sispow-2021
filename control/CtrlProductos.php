<?php
require_once "conexion.php";

class CtrlProductos extends Conexion
{

    private $strnombre;
    private $flprecio;
    private $intcantidad;
    private $flsubtotal;
    private $strimagen;
    private $strmarca;
    private $intcategoria;
    private $intexistencia;
    private $conexion;

    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conectar();
    }

    public function listaProductos()
    {
        $sql = "SELECT c.id_categoria, p.id_producto , p.nombre, p.precio, c.nombre AS categoria,p.imagen, p.marca, p.stock, p.existencia FROM productos p INNER JOIN categorias c
        on p.categoria = c.id_categoria";
        $ejecutar = $this->conexion->query($sql);
        $respuesta = $ejecutar->fetchall(PDO::FETCH_ASSOC);
        return $respuesta;
    }

    public function insertarProducto(
        String $nombre,
        float $precio,
        int $categoria,
        String $imagen,
        String $marca,
        int $stock,
        int $existencia
    ) {

        $this->strnombre = $nombre;
        $this->flprecio = $precio;
        $this->intcategoria = $categoria;
        $this->strimagen = $imagen;
        $this->strmarca = $marca;
        $this->intstock = $stock;
        $this->intexistencia = $existencia;


        $sql = "INSERT INTO productos(nombre,precio,categoria,imagen,marca,stock,existencia) 
                        VALUES (?,?,?,?,?,?,?)";
        $insertar = $this->conexion->prepare($sql);

        $arreglodatos = array(
            $this->strnombre, $this->flprecio, $this->intcategoria,  $this->strimagen,
            $this->strmarca,  $this->intstock,  $this->intexistencia
        );

        $respuestainsertar = $insertar->execute($arreglodatos);
        $codigo = $this->conexion->lastInsertId();

        return $codigo;
    }

    public function actualizarProducto(
        int $id,
        String $nombre,
        float $precio,
        int $categoria,
        String $imagen,
        String $marca,
        int $stock,
        int $existencia
    ) {
        $this->strnombre = $nombre;
        $this->flprecio = $precio;
        $this->intcategoria = $categoria;
        $this->strimagen = $imagen;
        $this->strmarca = $marca;
        $this->intstock = $stock;
        $this->intexistencia = $existencia;

        $sql = "UPDATE productos SET nombre=?,precio=?,categoria=?,imagen=?,marca=?,stock=?,existencia=? WHERE id_producto=$id";
        $actualizar = $this->conexion->prepare($sql);

        $registro = array(
            $this->strnombre, $this->flprecio, $this->intcategoria,  $this->strimagen,
            $this->strmarca,  $this->intstock,  $this->intexistencia
        );
        $ejecutar = $actualizar->execute($registro);
    }

    public function eliminarProducto(int $id)
    {
        $sql = "DELETE FROM productos WHERE id_producto=?";
        $dato = array($id);
        $eliminar = $this->conexion->prepare($sql);
        $borrado  = $eliminar->execute($dato);
        return $borrado;
    }

    public function buscarProducto(int $id)
    {
        $sql = "SELECT * FROM productos WHERE id_producto=?";
        $dato = array($id);
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute($dato);
        $respuesta = $consulta->fetch(PDO::FETCH_ASSOC);
        return $respuesta;
    }

    public function getExistencias(int $id, int $existencia)
    {
        $sql = "SELECT existencia FROM productos WHERE id_producto=?";

        $dato = array($id);
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute($dato);
        $resp = $consulta->fetch(PDO::FETCH_ASSOC);

        $existenciaActual = 0;

        if ($resp) {
            $existenciaActual = $resp['existencia'];
        }

        if ($existenciaActual >= $existencia) {
            return true;
            echo 'tiene existencia';
        } else {
            return false;
            echo "no tiene existencia ";
        }
    }

    public function alertaInvetario()
    {
        $sql = "SELECT id_producto, nombre, existencia FROM productos WHERE existencia <= stock";
        $inventario = array();
        $alerta = $this->conexion->prepare($sql);
        $alerta->execute($inventario);
        $agotados = $alerta->fetchall(PDO::FETCH_ASSOC);
        return $agotados;
    }

    public function buscarProductoCategoria(int $id)
    {
        $sql = "SELECT * FROM productos WHERE categoria=?";
        $dato = array($id);
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute($dato);
        $respuesta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $respuesta;
    }
}

// $obj = new CtrlProductos();
// $obj->stock(2,5);
