<?php
	
	session_start();
	
    require("../../setup.php");
	
	if(empty($_POST["codigoPessoa"])){
		$codigoPessoa = $_SESSION['codigoPessoa'];
	}else{
		$codigoPessoa = $_POST["codigoPessoa"];
	}
	
	$codigoContatoTelefone         = $_POST["codigoContatoTelefone"]; 
	$tipoTelefoneContato           = $_POST["tipoTelefoneContato"]; 
	$flagFichaPessoaFisicaTelefone = $_POST["flagFichaPessoaFisicaTelefone"]; 
	$telefoneContato               = $_POST["telefoneContato"]; 

	if(empty($codigoContatoTelefone)){
		echo "Informe o Contato";
	}elseif(empty($tipoTelefoneContato)){
		echo "Informe o Tipo do Telefone";
	}elseif(empty($telefoneContato)) {
		echo "Informe o telefone";
	}else{
		
		if($flagFichaPessoaFisicaTelefone == "S"){
			
			$sqlTelefone = mysql_query("SELECT null FROM tb_telefone WHERE CO_PESSOA = '".$codigoPessoa."' AND FL_FICHA_PESSOA_FISICA = 'S'")
			or die("<script>
						alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
						history.back(-1);
					</script>");
			
			if(mysql_num_rows($sqlTelefone) >= 3){
				echo "[Erro] - Esta pessoa já possui 3 (três) telefones vinculados a ficha de Pessoa Física.";
			}else{			
				$query = mysql_query("INSERT INTO tb_telefone (CO_PESSOA
										  , CO_CONTATO
										  , CO_TIPO_TELEFONE
										  , NU_TELEFONE
										  , FL_FICHA_PESSOA_FISICA) 
									  VALUES ('".$codigoPessoa."'
										  , '".$codigoContatoTelefone."'
										  , '".$tipoTelefoneContato."'
										  , '".$telefoneContato."'
										  , '".$flagFichaPessoaFisicaTelefone."')");
				
				if($query){
					echo false;
				}else {
					echo "[Erro] - Não foi possível inserir o telefone no momento.";
				}
			}
			
		}else{
			
			$query = mysql_query("INSERT INTO tb_telefone (CO_PESSOA
								      , CO_CONTATO
								      , CO_TIPO_TELEFONE
								      , NU_TELEFONE
								      , FL_FICHA_PESSOA_FISICA) 
								  VALUES ('".$codigoPessoa."'
								      , '".$codigoContatoTelefone."'
								      , '".$tipoTelefoneContato."'
								      , '".$telefoneContato."'
								      , '".$flagFichaPessoaFisicaTelefone."')");
				
			if($query){
				echo false;
			}else {
				echo "[Erro] - Não foi possível inserir o telefone no momento.";
			}
			
		}
		
	}
	
?>