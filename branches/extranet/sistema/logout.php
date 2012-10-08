<?php

	unset($_SESSION['codigoUsuario']);
	unset($_SESSION['nomePessoa']);
	unset($_SESSION['loginUsuario']);
	session_unset();
	
	echo "<script>
		      window.location = '../index.php';
		  </script>";	
?>