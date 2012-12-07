<?php
	
	session_start();
	
    require("../../setup.php");
	
	$pessoaTipo         = $_POST["pessoaTipo"];
	$codigoPessoa       = $_POST["codigoPessoa"];
	$nome               = $_POST["nome"];
	$email              = $_POST["email"];
	$site               = $_POST["site"];
		
	$razaoSocial        = $_POST["razaoSocial"];
	$cnpj               = $_POST["cnpj"];
	$ie                 = $_POST["ie"];
		
	$cpf                = $_POST["cpf"];
	$rg                 = $_POST["rg"];
	$orgaoExpedidor     = $_POST["orgaoExpedidor"];
	$dataEmissao        = $_POST["dataEmissao"];
	$sexo               = $_POST["sexo"];
	$dataNascimento     = $_POST["dataNascimento"];
	$estadoCivilAlterar = $_POST["estadoCivilAlterar"];
	$nacionalidade      = $_POST["nacionalidade"];
	$codigoEstado       = $_POST["codigoEstado"];
	$codigoCidade       = $_POST["codigoCidade"];
	$nivelFormacao      = $_POST["nivelFormacao"];
	$profissao          = $_POST["profissao"];
	$nomePai            = $_POST["nomePai"];
	$nomeMae            = $_POST["nomeMae"];
	
	if($pessoaTipo == "J"){
		if (empty($nome)) {
		    echo "Informe o Nome";
		}elseif (empty($razaoSocial)){
			echo "Informe a Raz&atilde;o Social";
		}elseif (empty($cnpj)){
			echo "Informe o CNPJ";
		}else{
			
			$query = mysql_query("UPDATE tb_pessoa SET
								      NO_PESSOA     = '".$nome."'
							          , TP_PESSOA   = '".$pessoaTipo."'
							          , EM_PESSOA   = '".$email."'
							          , SITE_PESSOA = '".$site."' 
							      WHERE CO_PESSOA = '".$codigoPessoa."'");
			
			if($query){
				
				$query = mysql_query("UPDATE tb_pessoa_juridica SET 
									      CNPJ_PESSOA_JURIDICA = '".$cnpj."'  
										  , IE_PESSOA_JURIDICA = '".$ie."'
									  WHERE CO_PESSOA = '".$codigoPessoa."')");
				
				if($query){
					echo false;
				}else{
					echo "[Erro] - Não foi possível alterar a pessoa no momento.";
				}
				
			}else{
			    echo "[Erro] - Não foi possível alterar a pessoa no momento.";
		    }
				
		}
	
	}elseif($pessoaTipo == "F"){
		
		if (empty($nome)) {
		    echo "Informe o Nome";
		}elseif (empty($cpf)){
			echo "Informe o CPF";
		}elseif (empty($rg)){
			echo "Informe o RG";
		}elseif ($sexo == "0"){			
		    echo "Informe o Sexo";
		}elseif (empty($dataNascimento)){	
		    echo "Informe a Data Nascimento";
		}elseif ($nacionalidade == "0"){			
		    echo "Informe a Nacionalidade";
		}elseif ($codigoEstado == "0"){			
		    echo "Informe a Unidade Federativa";
		}elseif ($codigoCidade == "0"){			
		    echo "Informe o Municipio";
		}else{
			
			$query = mysql_query("UPDATE tb_pessoa SET 
								      NO_PESSOA     = '".$nome."' 
							          , TP_PESSOA   = '".$pessoaTipo."' 
							          , EM_PESSOA   = '".$email."'
							          , SITE_PESSOA = '".$site."'  
							      WHERE CO_PESSOA = '".$codigoPessoa."'");
			
			if($query){
				
				list ($dataEmissaoDia, $dataEmissaoMes, $dataEmissaoAno) = split ('[/.-.]', $dataEmissao);
				$dataEmissaoFormatada = $dataEmissaoAno."-".$dataEmissaoMes."-".$dataEmissaoDia;
				
				list ($dataNascimentoDia, $dataNascimentoMes, $dataNascimentoAno) = split ('[/.-.]', $dataNascimento);
				$dataNascimentoFormatada = $dataNascimentoAno."-".$dataNascimentoMes."-".$dataNascimentoDia;
								
				$query = mysql_query("UPDATE tb_pessoa_fisica SET 
									      CO_ESTADO_CIVIL               = '".$estadoCivilAlterar."' 
										  , CPF_PESSOA_FISICA           = '".$cpf."' 
										  , RG_PESSOA_FISICA            = '".$rg."'
										  , RG_ORGAO_PESSOA_FISICA      = '".$orgaoExpedidor."'
										  , DT_EMISSAO_RG_PESSOA_FISICA = '".$dataEmissaoFormatada."'
										  , DT_NASCIMENTO_PESSOA_FISICA = '".$dataNascimentoFormatada."'
									      , TP_SEXO_PESSOA_FISICA       = '".$sexo."'
										  , CO_NACIONALIDADE            = '".$nacionalidade."'
										  , CO_UF                       = '".$codigoEstado."'
										  , CO_MUNICIPIO                = '".$codigoCidade."'
										  , CO_NIVEL_FORMACAO           = '".$nivelFormacao."'
										  , CO_PROFISSAO                = '".$profissao."'
										  , NO_PAI                      = '".$nomePai."'
									      , NO_MAE	                    = '".$nomeMae."'								   
									  WHERE CO_PESSOA = '".$codigoPessoa."'");
				
				
				if($query){
					echo false;
				}else{
					echo "[Erro] - Não foi possível alterar a pessoa no momento.";
				}
				
			}else{
			    echo "[Erro] - Não foi possível alterar a pessoa no momento.";
		    }
				
		}
	}else{
	    echo "[Erro] - Não foi possível alterar a pessoa no momento.";
	}
	
?>