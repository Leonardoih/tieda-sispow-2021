<?php
require_once "conexion.php";


class CtrlClientes extends Conexion
{
    private $strnick_usuario;
    private $strfecha_reg;
    private $strclave;
    private $strestado;
    private $intpersona;
    private $conexion = null;


    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conectar();
    }

    public function listaClientes()
    {
        $sql = "SELECT p.id_persona, c.id_cliente, p.nombres,p.apellidos,p.nro_identificacion,p.direccion,
                p.celular,p.correo,c.nick_usuario,c.fecha_reg,c.estado 
                FROM personas p INNER JOIN clientes c ON p.id_persona=c.persona
                ";

        $ejecutar = $this->conexion->query($sql);
        $respuesta = $ejecutar->fetchall(PDO::FETCH_ASSOC);
        return $respuesta;
    }


    public function insertarCliente(
        String $nick_usuario,
        String $clave,
        String $persona
    ) {

        $this->strnick_usuario = $nick_usuario;
        $this->strclave = $clave;
        $this->intpersona = $persona;

        $sql = "INSERT INTO clientes(nick_usuario,clave,fecha_reg,estado,persona)
                VALUES  (?,?,now(),1,?)";
        $insertar = $this->conexion->prepare($sql);

        $arreglodatos = array($this->strnick_usuario, $this->strclave, $this->intpersona);

        $respuestainsertar = $insertar->execute($arreglodatos);
        $codigo = $this->conexion->lastInsertId();

        return $codigo;
    }

    public function actualizarCliente(
        int $id,
        String $nick_usuario,
        String $clave
    ) {
        $this->strnick_usuario = $nick_usuario;
        $this->strclave = $clave;

        $sql = "UPDATE clientes SET nick_usuario=?, clave=?, WHERE id_cliente=$id";
        $actualizar = $this->conexion->prepare($sql);
        $registro = array($this->strnick_usuario, $this->strclave);
        $ejecutar = $actualizar->execute($registro);
    }

    public function cambiarEstadoCliente(int $estado, int $id)
    {
        $sql = "UPDATE clientes SET estado=? WHERE id_cliente=$id";
        $dato = array($estado);

        $ejecutar = $this->conexion->prepare($sql);
        $actualizar  = $ejecutar->execute($dato);

        return $actualizar;
    }

    public function buscarCliente(String $nick)
    {
        $sql = "SELECT estado FROM clientes WHERE nick_usuario=?";
        $dato = array($nick);
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute($dato);
        $respuesta = $consulta->fetch(PDO::FETCH_ASSOC);
        return $respuesta;
    }

    public function getIdCliente(int $id)
    {
        $sql = "SELECT c.id_cliente,p.nombres,p.apellidos,p.nro_identificacion,p.direccion,p.correo, p.celular,c.persona
        FROM clientes c inner join personas p on p.id_persona=c.persona WHERE id_cliente=?";
        $dato = array($id);
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute($dato);
        $respuesta = $consulta->fetch(PDO::FETCH_ASSOC);
        return $respuesta;
    }

    // se agrego una nueva funcion para validar el login
    public function validarCliente(String $usuario, String $clave)
    {
        $sql = "SELECT c.id_cliente,p.nombres,p.apellidos,p.nro_identificacion,p.direccion,c.nick_usuario, p.correo, p.celular,c.persona
                FROM clientes c inner join personas p on p.id_persona=c.persona WHERE  c.nick_usuario=? AND c.clave=?";
        $dato = array($usuario, $clave);

        $consulta = $this->conexion->prepare($sql);
        $consulta->execute($dato);
        $respuesta = $consulta->fetch(PDO::FETCH_ASSOC);
        return $respuesta;
    }
}
