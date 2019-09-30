<?php
$nro=$_GET["nro"];
genera($nro);
 function genera($nrofactura){
 	require('fpdf.php');
 	require('config.php');
	$pdf = new FPDF();
	$pdf->AddFont('f1','B','BaskOldFace.php');
	$pdf->AddFont('f2','B','PoorRichard.php');
	$pdf->AddFont('f1b','B','BaskOldFaceb.php');
	$pdf->AddFont('f2b','B','PoorRichardb.php');
	$pdf->AddPage('P','A4');
	//Colocamos el logo
	$pdf->Image('img/logo.png',10,5,50,35,'PNG');
	$con=conectar();
	//consultamos los datos de la factura
	$query="SELECT *FROM as_factura WHERE nofactura='{$nrofactura}';";
	$result =$con -> query($query);
	while ($row=$result -> fetch_assoc()) {
		$fecha2=$row["fecha"];
		$cliente=$row["cliente"];
		$nit2=$row["nit"];
		$direccion2=$row["direccion"];
		$ciudad=$row["ciudad"];
		$telefono=$row["telefono"];
		$subtotal=$row["subtotal"];
		$impuesto=$row["impuesto"];
		$total=$row["total"];
		$query2="SELECT * FROM `as_configuraciones` WHERE id='{$row['encab']}';";
	}
	//Consultamos los datos del encabezado que se aplicara a la factura
	$result =$con -> query($query2);
	while ($row=$result -> fetch_assoc()) {
		$resolucion=$row["resolucion"];
		$numeracion=$row["numeracion"];
		$nit=$row["nit"];
		$direccion=$row["direccion"];
		$pagina=$row["pagina"];
		$telefonos=$row["telefonos"];
		$fecha=$row["fecha"];
	}
	//ponemos los datos del encabezado
	$pdf->SetFont('arial','B',8);
	$pdf->Cell(0,0,'RESOLUCION DIAN No.'.$resolucion,0,0,'C');
	$pdf->Ln(4);
	$pdf->Cell(0,0,'FECHA '.$fecha,0,0,'C');
	$pdf->Ln(4);
	$pdf->Cell(0,0,'NUMERACION HABILITADA '.$numeracion,0,0,'C');
	$pdf->Ln(4);
	$pdf->SetFont('arial','B',11);
	$pdf->Cell(0,0,'Nit. '.$nit,0,0,'C');
	$pdf->Ln(4);
	$pdf->SetFont('arial','B',8);
	$pdf->Cell(0,0,$direccion,0,0,'C');
	$pdf->Ln(4);
	$pdf->Cell(0,0,'PAGINA WEB: '.$pagina,0,0,'C');
	$pdf->Ln(4);
	$pdf->Cell(0,0,'TEL. '.$telefonos,0,0,'C');
	$pdf->Ln(4);
	$pdf->Cell(0,0,'VALLEDUPAR-CESAR',0,0,'C');
	//ponemos la parte derecha el recuadro del numero de la factura
	$pdf->SetXY(140,19);
	$pdf->SetFont('arial','B',10);
	$pdf->Cell(0,0,'FACTURA DE VENTA',0,0,'C');
	$pdf->SetXY(150,22);
	$pdf->SetFont('arial','B',13);
	$pdf->SetTextColor(255,0,0);
	$pdf->Cell(42,8,'No.    '.$nrofactura,1,0,'C');
	$pdf->SetXY(140,34);
	$pdf->SetFont('arial','B',10);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(0,0,'REGIMEN COMUN',0,0,'C');
	//Dibujamos el recuadro para los datos del comprador
	$pdf->SetXY(10,42);
	$pdf->Cell(0,28,'',1,0,'L');
	$pdf->SetXY(12,48);
	$pdf->Cell(0,0,'Fecha:         '.$fecha2,0,0,'L');
	$pdf->SetXY(12,53);
	$varc=utf8_decode("Señor (es):");
	$pdf->Cell(0,0,$varc.'  '.$cliente,0,0,'L');
	$pdf->SetXY(12,58);
	$pdf->Cell(0,0,'Nit.               '.$nit2,0,0,'L');
	$pdf->SetXY(12,63);
	$pdf->Cell(0,0,'Direccion:   '.$direccion2.'         Ciudad: '.$ciudad.'         Telefono: '.$telefono,0,0,'L');
	//Definimos los encabezados de la tabla de detalles
	$pdf->SetXY(10,74);
	$pdf->Cell(21, 5, 'CANTIDAD', 1);
	$pdf->Cell(110, 5, 'DESCRIPCION', 1);
	$pdf->Cell(32, 5, 'VALOR UNITARIO', 1);
	$pdf->Cell(27, 5, 'VALOR TOTAL', 1);
	$pdf->Ln(8);
	//CONSULTA y llenado de los detalles de la factura
	$link=conectar();
	$query = "SELECT * FROM `as_detalle_factura` WHERE idfactura='{$nrofactura}';";
	$resultado =$link -> query($query);
	$pdf->SetFont('Arial', '', 8);
	if ($link->affected_rows > 0) {
		while($row=$resultado -> fetch_assoc()) {
			$strg=utf8_decode($row['nombre_des']);
			$cv=intval((strlen($strg)/60)+1);
			$ini=0;
			for ($i=0;$i<$cv;$i++){
				$ars[$i]=substr($strg,$ini,60);
				$ini+=60;
			}
			$pdf->Cell(21,5,$row['cant'], 0);
			$pdf->Cell(110,5, $ars[0], 0);
			$pdf->Cell(32,5, number_format($row['valoru'],2,'.',''), 0,0,'R');
			$pdf->Cell(27,5, number_format($row['valtotal'],2,'.',''), 0,0,'R');
			$pdf->Ln(5);
			for ($i=1;$i<$cv;$i++){
				$pdf->Cell(21,5,'', 0);
				$pdf->Cell(110,5, $ars[$i], 0);
				$pdf->Cell(32,5,'', 0,0,'R');
				$pdf->Cell(27,5,'', 0,0,'R');
				$pdf->Ln(5);
			}
		}
	}
	$pdf->Ln(3);
	//Inicio de la construccion del pie de pagina
	$pdf->SetFont('arial','',7);
	$envtotal=number_format($total,2,'.','');
	$nrot=numtoletras($envtotal);
	$tam=strlen($nrot);
	$tam=($tam/2)+1;
	$tam=intval($tam);
	$cadim[0]=substr($nrot,0,$tam);
	$cadim[1]=substr($nrot,$tam);
	$pdf->SetFont('arial','',8);
	$pdf->Cell(124,8,'SON: '.$cadim[0].'','LT',0,'L');
	$pdf->SetFont('arial','B',10);
	$pdf->Cell(36,8,'SUB.TOTAL $','LTR',0,'R');
	$pdf->Cell(30,8,number_format($subtotal,2,'.',''),'TR',0,'R');
	$pdf->Ln();
	$pdf->SetFont('arial','',8);
	$pdf->Cell(124,8,''.$cadim[1].'','LB',0,'L');
	$pdf->SetFont('arial','B',10);
	$pdf->Cell(36,8,'IVA $','LTR',0,'R');
	$pdf->Cell(30,8,number_format($impuesto,2,'.',''),'TR',0,'R');
	$pdf->Ln();
	$pdf->SetFont('arial','B',10);
	$pdf->Cell(160,8,'**************************************************  TOTAL  **************************************************','LTBR',0,'L');
	$pdf->SetFont('arial','B',10);
	$pdf->Cell(30,8,"$ ".number_format($total,2,'.',''),'TRB',0,'R');
	$pdf->Ln(10);
	$pdf->Cell(0,8,' RECIBI. FIRMA Y SELLO                                                                     FIRMA AUTORIZADA Y SELLO','RTL',0,'L');
	$pdf->Ln();
	$pdf->Cell(0,8,' ________________________________________                               _______________________________________','LR',0,'L');
	$pdf->Ln();
	$pdf->Cell(0,8,' C.C  O NIT','LRB',0,'L');
	$pdf->Ln(11);
	$pdf->Output('factura.pdf','I');
 }
function numtoletras($xcifra)
{
    $xarray = array(0 => "Cero",
        1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
        "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
        "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
        100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    );
//
    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, ".");
    $xaux_int = $xcifra;
    $xdecimales = "00";
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = "0" . $xcifra;
            $xpos_punto = strpos($xcifra, ".");
        }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
    }

    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = "";
    for ($xz = 0; $xz < 3; $xz++) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                break; // termina el ciclo
            }

            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                            
                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100)
                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            }
                            else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma lógica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {
                            
                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (TRUE === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux);
                                if (substr($xaux, 1, 2) == 20)
                                    $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3;
                            }
                            else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
                            
                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = subfijo($xaux);
                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO

        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena.= " DE";

        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena.= " DE";

        // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
        if (trim($xaux) != "") {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN BILLON ";
                    else
                        $xcadena.= " BILLONES ";
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN MILLON ";
                    else
                        $xcadena.= " MILLONES ";
                    break;
                case 2:
                    if ($xcifra < 1) {
                        $xcadena = "CERO PESOS CON $xdecimales";
                    }
                    if ($xcifra >= 1 && $xcifra < 2) {
                        $xcadena = "UN PESO CON $xdecimales";
                    }
                    if ($xcifra >= 2) {
                        $xcadena.= " PESOS CON $xdecimales"; //
                    }
                    break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para México se usa esta leyenda     ----------------
        $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
    } // ENDFOR ($xz)
    return trim($xcadena);
}

// END FUNCTION

function subfijo($xx)
{ // esta función regresa un subfijo para la cifra
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
        $xsub = "";
    //
    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
        $xsub = "MIL";
    //
    return $xsub;
}
?>
