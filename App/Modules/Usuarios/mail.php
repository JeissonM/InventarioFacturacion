<?php
include("../../config.php");
	$query="";
	$con=conectar();
	$pass=generaPass();
	$value=$_POST["email"];
	$query="UPDATE as_usuarios SET contrasenia='".md5($pass)."' WHERE email='".$value."';";
	$result =$con -> query($query);
    if ($con->affected_rows>0 and enviarEmail($value, $pass)){
        echo "Una nueva contraseña ha sido enviada a su direccion de correo, verifique!";
    }else{
        echo "La Contraseña no pudo ser reestablecida o el email ingresado no se encuentra registrado, verifique!";
    }

    function enviarEmail($value, $pass){
    	$para      = $value;
		$titulo    = 'Asignacion de Contraseña';
		$mensaje = "Hola,\r\nSu contraseña ha sido Modificada\r\nSu nueva Contraseña es: ".$pass."\r\nSi Ud. no solicito el cambio comunique al administrador";
		$cabeceras = 'De: A&S_SAS | Acuerdos y Soluciones SAS' . "\r\n" .
		    'Reply-To: INFO@ACUERDOSYSOLUCIONESSAS.COM';

		return mail($para, $titulo, $mensaje, $cabeceras);
    }

    function generaPass(){
	    //Se define una cadena de caractares. Te recomiendo que uses esta.
	    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	    //Obtenemos la longitud de la cadena de caracteres
	    $longitudCadena=strlen($cadena);
	     
	    //Se define la variable que va a contener la contraseña
	    $pass = "";
	    //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
	    $longitudPass=10;
	     
	    //Creamos la contraseña
	    for($i=1 ; $i<=$longitudPass ; $i++){
	        //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
	        $pos=rand(0,$longitudCadena-1);
	     
	        //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
	        $pass .= substr($cadena,$pos,1);
	    }
	    return $pass;
	}


?>