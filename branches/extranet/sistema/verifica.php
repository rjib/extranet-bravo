<?php
	 
	 /**
	 * Script responsável por verificar se o usuario realmente esta logado.
	 * 
	 * @author Euripedes B. Silva Junior <euripedes.junior@yahoo.com.br>
	 * @version 1.0 - 01/08/2012 08:00
	 * 
	 */
	 
    //SE NAO TIVER VARIAVEIS REGISTRADAS RETORNA PARA A TELA DE LOGIN
	if((!isset($_SESSION['codigoUsuario']))){
		$userLogado = "0";
		echo "<script>
			      window.location = '../index.php';
		  	  </script>";
	}else{
		//OBTEM AS INFORMACOES DO USUARIO EM ACAO
		$sqlVerifica = mysql_query("SELECT CO_USUARIO FROM tb_usuario WHERE CO_USUARIO = '".$_SESSION['codigoUsuario']."'") 
		or die ("<script>
			         alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
				     window.location = '../index.php';
			     </script>");

		//VERIFICA SE RETORNOU ALGO
		if(mysql_num_rows($sqlVerifica) == 0){
			header("Location: ../index.php");
		}else { 
			$codigoUsuario  = mysql_result($sqlVerifica, 0, "CO_USUARIO");
			$userLogado = "1";		 			 
		}
	} 
?>