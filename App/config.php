<?php
   function conectar(){
		/*$link = mysqli_connect("localhost", "acuerdos_assas", "4cu3rd0545545");
		mysqli_select_db($link, "acuerdos_assas");*/
		$link = mysqli_connect("localhost", "root", "");
		mysqli_select_db($link, "as_sas");
		return $link;
	}
?>