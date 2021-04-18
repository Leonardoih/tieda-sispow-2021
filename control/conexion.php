<?php 
	require_once "config.php";
	class Conexion {
		
		private $conectar;

		public function __construct() {
			$cadenaconexion = "mysql:hos=".servidor.";dbname=".bd.";charset=utf8";

			try {

			$this->conectar = new PDO($cadenaconexion,usuario,clave);

			$this->conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//  echo "<script>alert('Conexion Exitosa')</script>";
			} catch (PDOException $error) {
				// echo "<script>alert('Error de conexion')</script>".$error->getMessage();
			}

		} 

		public function conectar(){
			return $this->conectar;
		} 

	}

	$cone = new Conexion();
