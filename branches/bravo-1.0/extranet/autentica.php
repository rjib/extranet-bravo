<?php
	
	/**
	 * Script respons�vel por autenticar o usuario conforme login e senha informados no formul�rio.
	 * 
	 * @author RouterNet - Solu��es em Tecnologia <comercial@routernet.com.br>
	 * @version 1.0 - 27/02/2012 08:00
	 * 
	 */
	 
	//ARQUIVO DE CONEXAO 
	require("sistema/setup.php"); 
						
	//CONSULTA USUARIO E SENHA INFORMADO 
	$sqlAutenticaUsuario = mysql_query("SELECT USUARIO.CO_USUARIO
										    , PESSOA.NO_PESSOA
										    , USUARIO.LG_USUARIO
										    , USUARIO.PASS_USUARIO
											, USUARIO.CO_PAPEL
										FROM tb_usuario USUARIO
										    INNER JOIN tb_colaborador COLABORADOR
											    ON USUARIO.CO_COLABORADOR = COLABORADOR.CO_COLABORADOR
										    INNER JOIN tb_pessoa PESSOA
											    ON COLABORADOR.CO_PESSOA = PESSOA.CO_PESSOA
										WHERE USUARIO.LG_USUARIO = '".$_POST['loginUsuario']."'
										AND USUARIO.ST_USUARIO = '1'") 
	or die ("<script>
			     alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
				 window.location = 'index.php';
			 </script>");		
						
	if(mysql_num_rows($sqlAutenticaUsuario) == 0) {
	    echo "<script>
			      alert('[Erro 1] - Dados do usuario incorretos.');
				  window.location = 'index.php';
			  </script>";
	}else{	
	
		$rowAutenticaUsuario = mysql_fetch_array($sqlAutenticaUsuario);
									 
		if(crypt($_POST['senhaUsuario'],$rowAutenticaUsuario['PASS_USUARIO']) == $rowAutenticaUsuario['PASS_USUARIO']){
		
		    mysql_query("UPDATE tb_usuario SET QT_ACESSO_USUARIO = QT_ACESSO_USUARIO+1 
					     WHERE CO_USUARIO = '".$rowAutenticaUsuario['CO_USUARIO']."'")
			or die ("<script>
						 alert('[Erro] - Ocorreu algum erro durante o update, favor entrar em contato com o suporte!');
						 window.location = 'index.php';
					 </script>");
					 
			//EFETUA A CAPTURA DO IP DO USUARIO
			$ipAcessoUsuario = (isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:'unknown');		
			$forward = ( isset($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:false);
			$ipAcessoUsuario=( ($ipAcessoUsuario=='unknown' &&  $foward && $forward!='unknown' )?$forward:$ipAcessoUsuario); 
			
			//INICIALIZA A SESSAO
			session_start();
					 
			//GRAVA AS VARIAVEIS NA SESSAO
			$_SESSION['codigoUsuario']   = $rowAutenticaUsuario['CO_USUARIO'];
			$_SESSION['nomePessoa']      = $rowAutenticaUsuario['NO_PESSOA'];
			$_SESSION['loginUsuario']    = $rowAutenticaUsuario['LG_USUARIO'];
			$_SESSION['codigoPapel']     = $rowAutenticaUsuario['CO_PAPEL'];
				
			$dataAcessoUsuario = date("Y-m-d");
			$horaAcessoUsuario = date("H:i:s");                  
			
			mysql_query ("INSERT INTO tb_acesso_usuario(
							  CO_USUARIO
							  , DT_ACESSO_USUARIO
							  , HR_ACESSO_USUARIO
							  , IP_ACESSO_USUARIO)
						  VALUES('".$rowAutenticaUsuario['CO_USUARIO']."'
							  , '".$dataAcessoUsuario."'
							  , '".$horaAcessoUsuario."'
							  , '".$ipAcessoUsuario."')")	
			or die ("<script>
					     alert('[Erro] - Ocorreu algum erro durante o insert de controle de acesso, favor entrar em contato com o suporte!');
						 window.location = 'index.php';
					 </script>");
							 
			echo "<script>
				      window.location = 'sistema/inicio.php';
				  </script>";	 		
			
		}else{
		    echo "<script>
			          alert('[Erro 2] - Dados do usuario incorretos.');
				      window.location = 'index.php';
			      </script>";
		} 
	}	
		
?>