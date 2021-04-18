<?php
session_start();
require('fpdf/fpdf.php');
require_once "../control/CtrlVentas.php";
require_once "../control/CtrlClientes.php";
$ctrlventas = new CtrlVentas();
$ctrlclientes = new CtrlClientes();

$login = $_SESSION['login'];



if($login['tipo_usuario'] != 1 && !empty($_POST['id_venta']) ){
	
	$id_cliente = $login['id_cliente'];
	$id_venta = $_POST['id_venta'];
	$infocliente = $ctrlclientes->getIdCliente($id_cliente);

	$venta = $ctrlventas->detalleVenta($id_cliente, $id_venta);
} else

if (!empty($_POST['id_venta'])  && !empty($_POST['id_cliente']) ) {

	$id_venta = $_POST['id_venta'];
	$id_cliente = $_POST['id_cliente'];
	$infocliente = $ctrlclientes->getIdCliente($id_cliente);
    $venta = $ctrlventas->detalleVenta($id_cliente, $id_venta);
}


class pdf extends FPDF
{
	public function header()
	{
		$this->SetFillColor(253, 135,39);
		$this->Rect(0,0, 220, 50, 'F');
		$this->SetY(25);
		$this->SetFont('Arial','B', 25);
		$this->SetTextColor(255,255,255);
		$this->Image('img/logo2.png', 10, 10,10);
		$this->Write(2,'FACTURA', 0, 0, 'C');
		

	}

	public function footer()
	{
		$this->SetFillColor(253, 135,39);
		$this->Rect(0, 250, 220, 50, 'F');
		$this->SetY(-20);
		$this->SetFont('Arial', '', 14);
		$this->SetTextColor(255,255,255);
		$this->SetX(70);
		$this->Write(5, 'Sisposw 2020 -TPS97');
		
	}
}

$fpdf = new pdf('P','mm','letter',true);
$fpdf->AddPage('portrait', 'letter');
$fpdf->SetMargins(10,30,20,20);
$fpdf->SetFont('Arial', '', 13);
$fpdf->SetTextColor(255,255,255);

$historial = $ctrlventas->listaVentasCliente($id_cliente);


$fpdf->SetY(15);
$fpdf->SetX(110);
$fpdf->Write(5, 'Cliente: '.$infocliente['nombres'].' '. $infocliente['apellidos']);
$fpdf->Ln();
$fpdf->SetX(110);
$fpdf->Write(5, 'Nro. Documento: 	'.' '.$infocliente['nro_identificacion']);
$fpdf->Ln();
$fpdf->SetX(110);
$fpdf->Write(5, 'Fecha Compra: 	'.' '.$historial[0]['fecha_venta']);
$fpdf->Ln();
$fpdf->SetX(110);
$fpdf->Write(5, 'Dirección: 	' .' '.$infocliente['direccion']);
$fpdf->Ln();
$fpdf->SetX(110);
$fpdf->Write(5, 'Correo: 	' .' '.$infocliente['correo']);
$fpdf->Ln();



$fpdf->SetTextColor(0,0,0);

$fpdf->SetTextColor(44, 62, 80);
$fpdf->SetY(60);
$fpdf->SetX(70);
$fpdf->Write(5, 'Detalle de la Compra ');

$fpdf->SetY(80);
$fpdf->SetTextColor(255,255,255);
$fpdf->SetFillColor(178, 186, 187 );
$fpdf->Cell(70, 10, 'PRODUCTO', 0, 0, 'C', 1);
$fpdf->Cell(40, 10, 'P. UNITARIO', 0, 0, 'C', 1);
$fpdf->Cell(25, 10, 'CANTIDAD', 0, 0, 'C', 1);
$fpdf->Cell(40, 10, 'SUBTOTAL', 0, 0, 'C', 1);
$fpdf->Ln();

$fpdf->SetTextColor(0,0,0);
$fpdf->SetFillColor(255,255,255);

foreach ($venta as  $det) { 
	$fpdf->Cell(70, 10,$det['producto'], 0, 0, 'C', 1);
	$fpdf->Cell(40, 10, number_format($det['precio'],2,',','.'), 0, 0, 'C', 1);
	$fpdf->Cell(20, 10, $det['cantidad'], 0, 0, 'C', 1);
	$fpdf->Cell(40, 10, number_format($det['subtotal'],2,',','.'), 0, 0, 'C', 1);
	$fpdf->Ln();
}

$fpdf->Cell(150, 20, 'TOTAL  '.'    $'.number_format($det['total'],2,',','.'), 0, 0, 'R', 1);

$fpdf->Ln();

$fpdf->SetTextColor(44, 62, 80);
$fpdf->SetX(70);
$fpdf->Write(5, '!Gracias por su compra¡');

// die();
$fpdf->OutPut();