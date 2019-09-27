<?php
	session_start();
	if (!empty($_SESSION['logged'])){
		 $_SESSION= array();
		  session_destroy();
		  header("Location: ../index.html");
		  exit;
	}else{
		  session_destroy();
		  header("Location: ../index.html");
		  exit;
	}
?>