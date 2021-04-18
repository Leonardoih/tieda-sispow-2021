<?php
require_once "conexion.php";

class CtrlPersonas extends Conexion
{

    private $strnombres;
    private $strapellidos;
    private $identificacion;
    private $strdireccion;
    private $celular;
    private $strcorreo;
    private $conexion = null;


    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conectar();
    }

    public function listaPersonas()
    {
        $sql = "SELECT * FROM personas";
        $ejecutar = $this->conexion->query($sql);
        $respuesta = $ejecutar->fetchAll(PDO::FETCH_ASSOC);
        return $respuesta;
    }


    public function insertarPersona(
        String $nombres,
        String $apellidos,
        int $identificacion,
        String $direccion,
        int $celular,
        String $correo  
    ) {
        $this->strnombres = $nombres;
        $this->strapellidos = $apellidos;
        $this->identificacion = $identificacion;
        $this->strdireccion = $direccion;
        $this->celular = $celular;
        $this->strcorreo = $correo;       
        
        $sql = "INSERT INTO personas(nombres, apellidos, nro_identificacion,direccion,celular,correo)
                    VALUES  (?,?,?,?,?,?)";
        $insertar = $this->conexion->prepare($sql);

        $arreglodatos = array($this->strnombres, $this->strapellidos, $this->identificacion,
         $this->strdireccion, $this->celular, $this->strcorreo );

        $respuestainsertar = $insertar->execute($arreglodatos);
        $codigo = $this->conexion->lastInsertId();

        return $codigo;
    }


    public function actualizarPersona(
        int $id,
        String $nombres,
        String $apellidos,
        int $identificacion,
        String $direccion,
        int $celular,
        String $correo
    ) {
        $this->strnombres = $nombres;
        $this->strapellidos = $apellidos;
        $this->identificacion = $identificacion;
        $this->strdireccion = $direccion;
        $this->celular = $celular;
        $this->strcorreo = $correo;
        
        $sql = "UPDATE personas SET nombres=?,apellidos=?,nro_identificacion=?,direccion=?,celular=?,correo=? WHERE id_persona=$id";
        $actualizar = $this->conexion->prepare($sql);

        $registro = array($this->strnombres, $this->strapellidos, $this->identificacion, $this->strdireccion, $this->celular, $this->strcorreo );
        $ejecutar = $actualizar->execute($registro);
    }

    public function eliminarPersona(int $id)
    {
        $sql = "DELETE FROM persona WHERE id_persona=?";
        $dato = array($id);
        $eliminar = $this->conexion->prepare($sql);
        $borrado  = $eliminar->execute($dato);
        return $borrado;
    }

    public function buscarPersona(int $id, String $correo)
    {
        $sql = "SELECT * FROM personas WHERE nro_identificacion=? OR correo=?";
        $dato = array($id,$correo);
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute($dato);
        $respuesta = $consulta->fetch(PDO::FETCH_ASSOC);
        return $respuesta;
    }

    public function buscarPersonaId(int $id)
    {
        $sql = "SELECT * FROM personas WHERE id_persona =?";
        $dato = array($id);
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute($dato);
        $respuesta = $consulta->fetch(PDO::FETCH_ASSOC);
        return $respuesta;
    }

   

    
}
