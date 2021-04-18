<?php

require_once "conexion.php";

class CtrlVentas extends Conexion
{
    private $conexion;

    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conectar();
    }

    public function listaVentas()
    {
        $sql = "SELECT v.id_venta,p.nombres,v.fecha_venta,v.total,v.metodo_pag,c.id_cliente  FROM ventas v INNER JOIN clientes c ON c.id_cliente=v.cliente INNER JOIN personas p ON 
        p.id_persona = c.persona";
        $ejecutar = $this->conexion->query($sql);
        $respuesta = $ejecutar->fetchall(PDO::FETCH_ASSOC);
        return $respuesta;
    }

    public function listaVentasCliente($id_cliente)
    {
        $sql = "SELECT * FROM ventas WHERE cliente=" . $id_cliente;
        $ejecutar = $this->conexion->query($sql);
        $respuesta = $ejecutar->fetchall(PDO::FETCH_ASSOC);
        return $respuesta;
    }

    public function crearVenta($id, $productos, $total,$metodo_pag)
    {

        //crear venta
        $sql = "INSERT INTO ventas(cliente,fecha_venta,total,metodo_pag)
                VALUES (?,now(),?,?)";

        $insertar = $this->conexion->prepare($sql);

        $arreglodatos = array($id,$total,$metodo_pag);

        $respuestainsertar = $insertar->execute($arreglodatos);

        //obtner la ultima venta (id_venta)
        $idUltimaVenta = $this->conexion->lastInsertId();

        //realizar los insert en el detalle
        foreach ($productos as $p) {

            $sql = "INSERT INTO det_ventas(venta,producto,cantidad,subtotal)
             VALUES (?,?,?,?)";
            $insertar = $this->conexion->prepare($sql);

            $arreglodatos = array($idUltimaVenta, $p['id'], $p['cantidad'], $p['subtotal']);
            $respuestainsertar = $insertar->execute($arreglodatos);

            $this->actualizarExistencias($p['id'], $p['cantidad']);
        }
    }

    public function actualizarExistencias($id, $cant_desc)
    {

        $sql = "SELECT existencia FROM productos WHERE id_producto=?";

        $dato = array($id);

        $consulta = $this->conexion->prepare($sql);

        $consulta->execute($dato);

        $resp = $consulta->fetch(PDO::FETCH_ASSOC);

        $existencia_actual = 0;

        if ($resp) {
            $existencia_actual = $resp['existencia'];
        }

        $existencia_actual -= $cant_desc;

        $sql = "UPDATE productos SET existencia=? WHERE id_producto=?";
        $dato = array($existencia_actual, $id);

        $actualizar = $this->conexion->prepare($sql);

        echo $respuestaactualizar = $actualizar->execute($dato);
    }


    function detalleVenta($id_cliente, $id_venta){
        $sql = "SELECT po.nombre as producto,d.cantidad,po.precio,d.subtotal,v.total FROM ventas v
        INNER JOIN clientes c ON v.cliente=c.id_cliente INNER JOIN det_ventas d 
        on v.id_venta=d.venta inner join productos po on d.producto=po.id_producto
        INNER JOIN personas p ON c.persona=p.id_persona WHERE c.id_cliente=".$id_cliente." AND v.id_venta=".$id_venta;
        

        $ejecutar = $this->conexion->query($sql);
        $respuesta = $ejecutar->fetchall(PDO::FETCH_ASSOC);

        return $respuesta;
    }
}
// $CtrlVenta = new CtrlVentas();


// $carrito = $_SESSION['carrito'];
// $total = $_SESSION['total'];

// echo $total;
// print_r($carrito);
// $CtrlVenta->crearVenta($carrito, $total);

// echo "OK venta";
// //remover carrito de compra
// session_destroy();
// //remover total


// header("location:../index.php");
