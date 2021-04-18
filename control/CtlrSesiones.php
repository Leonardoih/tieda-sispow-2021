<?php

require_once "conexion.php";

class CtlrSesiones extends Conexion
{
    private $strfecha_inicio;
    private $strfecha_fin;
    private $strhora_inicio;
    private $strhora_fin;
    private $intcliente;
    private $intadministrador;
    private $inttipo_usuario;
    private $conexion;

    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conectar();
    }



    public function sesionInicio(
        String $fecha_inicio,
        String $hora_inicio,
        int $cliente,
        int $tipo_usuario
    ) {

        $this->strfecha_inicio = $fecha_inicio;
        $this->strhora_inicio = $hora_inicio;
        $this->intcliente = $cliente;
        $this->inttipo_usuario = $tipo_usuario;

        $sql = "INSERT INTO sesiones(fecha_inicio,hora_inicio,cliente,tipo_de_usuario) 
                VALUES (?,?,?,?)";

        $insertar = $this->conexion->prepare($sql);

        $arreglodatos = array($this->strfecha_inicio, $this->strhora_inicio, $this->intcliente, $this->inttipo_usuario);

        $respuestainsertar = $insertar->execute($arreglodatos);


        return $respuestainsertar;
    }


    public function sesionFin(
        String $fecha_fin,
        String $hora_fin
    ) {

        $this->strfecha_fin = $fecha_fin;
        $this->strhora_inicio = $hora_fin;

        $ultima_sesion = $this->conexion->lastInsertId();
      
        $sql = "UPDATE sesiones SET fecha_fin=?,hora_fin=? WHERE id_sesion=$ultima_sesion";

        $insertar = $this->conexion->prepare($sql);

        $arreglodatos = array($this->strfecha_fin, $this->strhora_fin);

        $respuestainsertar = $insertar->execute($arreglodatos);

        return $respuestainsertar;
    }
}