<?php

    require RUTA_APP . '/helpers/fpdf182/fpdf.php';
    require RUTA_APP . '/helpers/phpqrcode/qrlib.php';     

    class BoletoPDF extends FPDF{
        //CABECERA
        function Header(){
            $this->SetFont('Arial', 'B', 14);
            $this->image(RUTA_URL.'/images/Logo.png', 5, 5, 10, 10);
            $this->Cell(20);
            // Título
            $this->Cell(20,10,'Traveler Airlines',0,0,'C');

            $this->SetX(70);
            $this->Cell(60);
            $this->Cell(40,10,'Pase de abordaje',0,0,'C');
            // Salto de línea
            $this->Ln(20);
        }

        // Pie de página
        function Footer()
        {
            // Posición: a 1,5 cm del final
            $this->SetY(-6);
            $this->SetX(30);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Número de página
            $this->Cell(0,5,'La puerta se cierra 10 minutos antes de la salida', 0, 0,'L');
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

    function generarApodo($datos){
        $porciones = explode(" ", $datos->Nombre);
        $nombre = $porciones[0];
        $porciones = explode(" ", $datos->Apellido);
        $apellido = $porciones[0];
        return $nombre . " " . $apellido;
    }

    $pdf = new BoletoPDF();
    $pdf->SetAutoPageBreak(false);
    $pdf->SetTopMargin(5);
    $pdf->AddPage('L', array(77,178));
    $pdf->SetFont('Arial', 'B', 12);
    QRcode::png("$datos->Codigo_Vuelo-$datos->Nombre-$datos->Apellido-$datos->fecha_salida-$datos->hora_salida", 'QR.png');

    //Largo, alto, texto, borde, salto de linea, alineacion


    //NOMBRE PASAJERO
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(25, 6, 'Pasajero:', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 6, $datos->Nombre, 0, 0, 'L');
    $pdf->Cell(40, 6, $datos->Apellido, 0, 0, 'L');

    //CODIGO VUELO
    $pdf->SetY(35);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(25, 6, 'Vuelo:', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 6, $datos->Codigo_Vuelo, 0, 1, 'L');

    //FECHA VUELO
    $pdf->SetY(45);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(25, 6, 'Fecha:', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 6, $datos->fecha_salida, 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(15, 6, 'Hora:', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(20, 6, $datos->hora_salida, 0, 1, 'L');

    //PUERTA DE SALIDA
    $pdf->SetY(55);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(25, 6, 'Puerta:', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 6, 'E-01', 0, 0, 'L');

    //CÓDIGO QR
    $pdf->Image('QR.png', 10, 60, 12, 12);

    //PASE DE ABORDAJE
    $pdf->SetDash(5,5);
    $pdf->Line(120, 75, 120, 2);

    //PASAJERO
    $pdf->SetXY(125, 25);
    $pdf->Cell(20, 6, 'Pasajero:', 0, 0, 'L');
    $pdf->Cell(25, 6, generarApodo($datos), 0, 1, 'L');
    //VUELO
    $pdf->SetXY(125, 32);
    $pdf->Cell(20, 6, 'Vuelo:', 0, 0, 'L');
    $pdf->Cell(25, 6, $datos->Codigo_Vuelo, 0, 1, 'L');
    //FECHA
    $pdf->SetXY(125, 39);
    $pdf->Cell(20, 6, 'Fecha:', 0, 0, 'L');
    $pdf->Cell(25, 6, $datos->fecha_salida, 0, 1, 'L');
    //HORA
    $pdf->SetXY(125, 46);
    $pdf->Cell(20, 6, 'Hora:', 0, 0, 'L');
    $pdf->Cell(25, 6, $datos->hora_salida, 0, 1, 'L');
    //PUERTA
    $pdf->SetXY(125, 53);
    $pdf->Cell(20, 6, 'Puerta:', 0, 0, 'L');
    $pdf->Cell(25, 6, 'E-01', 0, 1, 'L');

    //CÓDIGO QR
    $pdf->Image('QR.png', 125, 60, 12, 12);

    $pdf->Output();

?>