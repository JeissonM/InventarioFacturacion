<?php

		$user=$_POST["id"];
		$pass=$_POST["pw"];
		include("config.php");
		$con=conectar();
		$query = "SELECT *FROM as_usuarios WHERE identificacion='".$user."' AND contrasenia='".md5($pass)."'";
		$resultado =$con -> query($query);
		if ($con->affected_rows > 0) {
			while($row=$resultado -> fetch_assoc()) {
				$id=$row["identificacion"];
		   		$nombres=$row["nombres"];
		   		$apellidos=$row["apellidos"];
		   		$rol=$row["rol"];
		   		$pt=$row["path"];
		   		$est=$row["estudios"];
		   		$dir=$row["direccion"];
		   		$not=$row["notas"];
		   		$pp=$row["perfilp"];
		   		$tel=$row["telefono"];
		   		$em=$row["email"];
			}
			session_start();
			$_SESSION ['logged'] = 'yes';
		    $_SESSION ['id'] =$id;
		    $_SESSION ['nombres'] =$nombres;
		    $_SESSION ['apellidos'] =$apellidos;
		    $_SESSION ['rol'] =$rol;
		    $_SESSION ['path'] =$pt;
		    $_SESSION ['estudios'] =$est;
		    $_SESSION ['direccion'] =$dir;
		    $_SESSION ['notas'] =$not;
		    $_SESSION ['perfilp'] =$pp;
		    $_SESSION ['telefono'] =$tel;
		    $_SESSION ['email'] =$em;
		    $query = "SELECT *FROM as_privilegios WHERE idUsuario='".$id."'";
			$resultado =$con -> query($query);
				while($row=$resultado -> fetch_assoc()) {
					$perfil=$row["perfil"];
			   		$mensajes=$row["mensajes"];
			   		$datos=$row["datos"];
			   		$config=$row["config"];
			   		$factura=$row["factura"];
			   		$facturai=$row["facturai"];
			   		$reportes=$row["reportes"];
			   		$usuarios=$row["usuarios"];
			   		$clientes=$row["clientes"];
			   		$proveedores=$row["proveedores"];
				}
			$_SESSION ['p'] = $perfil;
			$_SESSION ['m'] = $mensajes;
			$_SESSION ['d'] = $datos;
			$_SESSION ['config'] = $config;
			$_SESSION ['f'] = $factura;
			$_SESSION ['fi'] = $facturai;
			$_SESSION ['r'] = $reportes;
			$_SESSION ['u'] = $usuarios;
			$_SESSION ['clientes'] = $clientes;
			$_SESSION ['proveedores'] = $proveedores;
			$con->close();
			echo "<script>function redireccionar(){location.href='index.php'} setTimeout ('redireccionar()', 200);</script>";
		}else{
		    $con->close();
		    echo "<script type=\"text/javascript\">alert(\"Datos Incorrectos, Verifica\"); history.back(1);</script>";
		}
?>