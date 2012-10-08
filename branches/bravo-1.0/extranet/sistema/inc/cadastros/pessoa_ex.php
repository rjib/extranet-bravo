<?php

    require("../../setup.php");
	
	$codigoPessoa = $_GET["codigoPessoa"];	
	
	$queryCliente = mysql_query("DELETE FROM tb_cliente WHERE CO_PESSOA = '".$codigoPessoa."'");
	if($queryCliente){
		
		$queryPessoaJuridica = mysql_query("DELETE FROM tb_pessoa_juridica WHERE CO_PESSOA = '".$codigoPessoa."'");
		if($queryPessoaJuridica){
			
			$queryPessoaFisica = mysql_query("DELETE FROM tb_pessoa_fisica WHERE CO_PESSOA = '".$codigoPessoa."'");
			if($queryPessoaFisica){
				
				$queryColaborador = mysql_query("DELETE FROM tb_colaborador WHERE CO_PESSOA = '".$codigoPessoa."'");
				if($queryColaborador){	
				    
					$queryContato = mysql_query("DELETE FROM tb_contato WHERE CO_PESSOA = '".$codigoPessoa."'");
					if($queryContato){	
						
						$queryEndereco = mysql_query("DELETE FROM tb_endereco WHERE CO_PESSOA = '".$codigoPessoa."'");
						if($queryEndereco){	
						    	
							$queryPessoa = mysql_query("DELETE FROM tb_pessoa WHERE CO_PESSOA = '".$codigoPessoa."'");
							if($queryPessoa){	
								echo false;
							}else{
								echo "[Erro] - Não foi possível excluir a Pessoa no momento.";
							}
							
						}else{
							echo "[Erro] - Não foi possível excluir o Endereço no momento.";
						}
												
					}else{
						echo "[Erro] - Não foi possível excluir o Contato no momento.";
					}
										
				}else{
					echo "[Erro] - Não foi possível excluir o Colaborador no momento.";
				}
							
			}else{
				echo "[Erro] - Não foi possível excluir a Pessoa Fisica no momento.";
			}
			
		}else{
		    echo "[Erro] - Não foi possível excluir a Pessoa Juridica no momento.";
	    }
		
	}else{
		echo "[Erro] - Não foi possível excluir o cliente no momento.";
	}
	
?>