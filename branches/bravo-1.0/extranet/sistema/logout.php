<?php

	
	unset($_SESSION['codigoUsuario']);
	unset($_SESSION['nomePessoa']);
	unset($_SESSION['loginUsuario']);
	session_unset();
	session_destroy();
	
	echo "<script>
		      window.location = '../index.php';
		  </script>";	
?>