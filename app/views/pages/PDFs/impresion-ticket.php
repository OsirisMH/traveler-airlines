<?php

    require RUTA_APP . '/helpers/fpdf182/fpdf.php';
    require RUTA_APP . '/helpers/phpqrcode/qrlib.php';
    require RUTA_APP . '/helpers/barcode.php';    

    $cantidad =  $this->ReservacionModelo->getCantidad();

    class BoletoPDF extends FPDF{
        //CABECERA
        function Header(){
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(3);

            // NOMBRE EMPRESA
            $this->Cell(40, 10, 'Traveler Airlines', 0, 0, 'C');

            // NUMERO DE EMPLEADO
            $this->SetY(10);
            $this->SetFont('Arial', '', 6);
            $this->Cell(3);
            $this->Cell(40, 10, 'Numero de empleado: '.$_SESSION['NumeroEmpleado'], 0, 1, 'C');

            // FECHA
            $fecha = getdate();
            $this->SetY(13);
            $this->Cell(3);
            $this->Cell(40, 10, 'Fecha: '. $fecha['mday'].'/'.$fecha['mon'].'/'.$fecha['year'], 0, 1, 'C');

            // NUMERO DE TICKET
            $this->SetY(16);
            $this->Cell(3);
            $this->Cell(40, 10, 'No. Ticket: ' . $_SESSION['CantidadVentas'], 0, 1, 'C');

            // VENDEDOR
            $this->SetY(19);
            $this->SetFont('Arial', 'B', 6);
            $this->Cell(7);
            $this->Cell(21, 10, 'VENDEDOR: ', 0, 0, 'C');
            $this->SetFont('Arial', '', 6);
            $this->Cell(5, 10, $_SESSION['nickname'], 0, 0, 'C');
            
            // Salto de línea
            $this->Ln(20);
        }

        // Pie de página
        function Footer()
        {
            // Posición: a 1,5 cm del final
            $this->SetY(-20);
            $this->SetX(10);
            // Arial italic 8
            $this->SetFont('Arial','I',6);
            // Número de página
            $img = barcode(RUTA_APP . '/helpers/CodigoBarra.png', 'codigo', 10, 'horizontal', 'code128');
            $this->Image(RUTA_APP . '/helpers/CodigoBarra.png', 25, 70, 14, 5, 'png');
            $this->SetY(62);
            $this->SetX(20);
            $this->Cell(10,10, 'Gracias por su compra!');
        }

        function SetDash($black=null, $white=null)
        {
            if($black!==null)
                $s=sprintf('[%.3F %.3F] 0 d',$black*$this->k,$white*$this->k);
            else
                $s='[] 0 d';
            $this->_out($s);
        }
    }

    function ocultarNumeroTarjeta($datos){
        if($datos['datos']['FormaPago'] == 'TARJETA'){
            $ultimosDigitos = substr($datos['datos']['NumeroTarjeta'], -4); 
            $tarjeta = "**** **** **** ".$ultimosDigitos;
            return $tarjeta;
        }
        return "xxxx xxxx xxxx xxxx";
    }

    $pdf = new BoletoPDF();
    $pdf->SetAutoPageBreak(false);
    $pdf->SetTopMargin(5);
    $pdf->AddPage('P', array(64,80));
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetDash(1,1);


    //METODO DE PAGO
    $pdf->SetY(23);
    $pdf->SetX(22);
    $pdf->SetFont('Arial','B',4); 
    $pdf->Cell(14, 10,"FORMA DE PAGO: ",'C');
    $pdf->SetFont('Arial','',4); 
    $pdf->Cell(10, 10,$datos['datos']['FormaPago'],'C');

    if($datos['datos']['FormaPago'] == 'TARJETA'){
        //TARJETA
        $pdf->SetY(26);
        $pdf->SetX(24);
        $pdf->SetFont('Arial','B',4); 
        $pdf->Cell(5, 10,"VISA",'C');
        $pdf->SetFont('Arial','',4); 
        $pdf->Cell(10, 10, ocultarNumeroTarjeta($datos),'C');
    }


    //CAJA
    $pdf->SetY(30);
    $pdf->SetX(4);
    $pdf->SetFont('Arial','B',4); 
    $pdf->Cell(10, 10,"NO. RES",'c');
    $pdf->SetX(14);
    $pdf->Cell(10, 10,"DESCRIPCION",'c');
    $pdf->SetX(38);
    $pdf->Cell(10, 10,"PRECIO",'c');
    $pdf->SetX(50);
    $pdf->Cell(10, 10,"IMPORTE",'c');
    $pdf->Line(4,  37, 60,  37);
    //DATOS
    $saltoLinea = 35;
    $totalNeto = 0;
    if($_SESSION['FormVueloSalida']['ClaseVuelo'] == 1){
        $clase = "TURISTA";
    }
    else{
        $clase = "EJECUTIVA";
    }
    for($i = 1; $i <= $_SESSION['FormFiltro']['CantidadPasajeros']; $i++){
        $pdf->SetY($saltoLinea);
        $pdf->SetX(4);
        $pdf->SetFont('Arial','B',4); 
        $pdf->Cell(10, 10,$cantidad + $i, 'c');
        $pdf->SetX(14);
        $pdf->Cell(10, 10,"Vuelo " .$clase. " | ".$datos['vuelo']->cod_origen. " - " .$datos['vuelo']->cod_destino."",'c');
        $pdf->SetX(38);
        $pdf->Cell(10, 10,"$".$datos['datos']['tarifa'],'c');
        $pdf->SetX(50);
        $pdf->Cell(10, 10,"$". $datos['datos']['total'],'c');
        $totalNeto += $datos['datos']['total'];
        $saltoLinea += 2;
    }
    $saltoLinea += 5;
    //FIN DATOS
    $pdf->Line(4, $saltoLinea, 60,  $saltoLinea);
    //FIN CAJA

    //TOTAL
    $pdf->SetY($saltoLinea);
    $pdf->SetX(30);
    $pdf->SetFont('Arial','B',8); 
    $pdf->Cell(10,10,"TOTAL NETO: ",'c');
    $pdf->SetFont('Arial','',8); 
    $pdf->SetY($saltoLinea);
    $pdf->SetX(50);
    $pdf->Cell(4,10,"$". $totalNeto,'c');

    $pdf->OutPut();
?>