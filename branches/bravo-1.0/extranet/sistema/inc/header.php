<?php

	require_once 'setup.php';
	require_once 'models/tb_modulos.php';
	require_once 'helper.class.php';
	
	$moduloModel = new tb_modulos($conexaoERP);
	$co_papel    = $_SESSION['codigoPapel'];

?>

<table width="1003" height="92" border="0" align="center" cellpadding="0" cellspacing="0" background="img/header.jpg">
            <tr>
                <td align="right"><table width="609" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="600" height="60" align="center" background="img/bg_menu_header.jpg"><table width="592" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="223">
<?php


    echo "<ul class='menu' id='menu'>";
	echo "<li>";
    echo "<a href='inicio.php' class='menulink'>";
    echo "<img src='img/btn/btn_menu_opcoes.jpg' alt='MENU OPÇÕES' width='223' height='60' border='0'/>";
    echo "</a>";
    echo "<ul>";

    $principalCadastros = $moduloModel->verificaPermissaoModuloPrincipal($co_papel, array('Cadastros','Controle de Acesso'));
    if($principalCadastros){
        echo "<li>";
        echo "<a href='#' class='sub'>Cadastros</a>";
        echo "<ul>";
        
        $subControleAcesso = $moduloModel->verificaPermissaoModuloPrincipal($co_papel, array('Controle de Acesso'));
        if($subControleAcesso){
            echo "<li class='topline'>";
            echo "<a href='#' class='sub'>Controle Acesso</a>";
            echo "<ul>";
            
            $subControleAcessoVisitantes = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Controle de Acesso', 'Visitantes');
            if($subControleAcessoVisitantes){
                echo "<li class='topline'><a href='inicio.php?pg=acesso_visitante'>Visitantes</a></li>";
			} 
           
			$subControleAcessoConsultores = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Controle de Acesso', 'Prestador de Serviço');
            if($subControleAcessoConsultores){
                echo "<li><a href='inicio.php?pg=acesso_consultor'>Prestador de Serviço</a></li>";
            }
            echo "</ul>";
            echo "</li>";
        }

        $cadastrosBairos = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Bairros');
        if($cadastrosBairos){
            echo "<li><a href='inicio.php?pg=bairro'>Bairros</a></li>";
        }
        
        $cadastrosCargos = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Cargos');
        if($cadastrosCargos){
            echo "<li><a href='inicio.php?pg=cargo'>Cargos</a></li>";
		}

		$cadastrosCartao = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Cartão Identificação');
		if($cadastrosCartao){		                                    
			echo "<li><a href='inicio.php?pg=cartao_identificacao'>Cartão Identificação</a></li>";
		}

		$cadastrosCep = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'CEPs');
        if($cadastrosCep){		                                    
		    echo "<li><a href='inicio.php?pg=cep'>CEPs</a></li>";
		}

		$cadastrosCidades = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Cidades');
		if($cadastrosCidades){		                                    
		    echo "<li><a href='inicio.php?pg=municipio'>Cidades</a></li>";
		}

		$cadastrosColaboradores = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Colaboradores');
		if($cadastrosColaboradores){		                                    
		    echo "<li><a href='inicio.php?pg=colaborador'>Colaboradores</a></li>";
		}

		$cadastrosConsultores = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Consultores');
		if($cadastrosConsultores){
			echo "<li><a href='inicio.php?pg=consultor'>Consultores</a></li>";
		}

		$cadastrosEstados = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Estados');
		if($cadastrosEstados){		                                    
		    echo "<li><a href='inicio.php?pg=uf'>Estados</a></li>";
		}
		
		$cadastrosCivil = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Estado Civil');
        if($cadastrosCivil){		                                    
		    echo "<li><a href='inicio.php?pg=estado_civil'>Estado Civil</a></li>";
		}

		$cadastrosNacionalidade = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Nacionalidade');
		if($cadastrosNacionalidade){		                                    
		    echo "<li><a href='inicio.php?pg=nacionalidade'>Nacionalidade</a></li>";
		}

		$cadastrosNivelFormacao = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Nível de Formação');
		if($cadastrosNivelFormacao){		                                    
		    echo "<li><a href='inicio.php?pg=nivel_formacao'>Nível Formação</a></li>";
		}

		$cadastroPessoas = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Pessoas');
		if($cadastroPessoas){		                                    
		    echo "<li><a href='inicio.php?pg=pessoa'>Pessoas</a></li>";
		}

		$cadastroSetores = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Setores');
		if($cadastroSetores){		                                    
		    echo "<li><a href='inicio.php?pg=setor'>Setores</a></li>";
		}

		$cadastroUsuario = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Usuários');
		if($cadastroUsuario){
		    echo "<li><a href='inicio.php?pg=usuario'>Usuários</a></li>";
		}
		
		echo "</ul>";	                             
		echo "</li>";
   }       
   
   $principalPCP = $moduloModel->verificaPermissaoModuloPrincipal($co_papel, array('PCP'));
   if($principalPCP){                                    
       echo "<li>";
       echo "<a href='#' class='sub'>PCP</a>";
       echo "<ul>";

       $pcpPlanoCorte = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'PCP', 'Gerar Plano de Corte');
       if($pcpPlanoCorte){
           echo "<li class='topline'><a href='inicio.php?pg=ordem_producao'>Gerar Plano de Corte</a></li>";
       }

       $pcpImportar = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'PCP', 'Importar Plano de Corte Optisave');
       if($pcpImportar){                            				
           echo "<li><a href='inicio.php?pg=lista_plano_corte'>Importar Plano de Corte do Optisave</a></li>";
       }

       $pcpListaCores = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'PCP', 'Lista de Cores');
       if($pcpListaCores){                            				
           echo "<li><a href='inicio.php?pg=lista_cores'>Lista de Cores</a></li>";
       }

       $pcpOrdem = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'PCP', 'Ordem de Produção');
       if($pcpOrdem){
           echo "<li><a href='inicio.php?pg=lista_op'>Ordem de Produção</a></li>";
       }

       $pcpApontamento = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'PCP', 'Apontamento');
       if($pcpApontamento){
           echo "<li><a href='inicio.php?pg=apontamento'>Apontamento</a></li>";
       }
	   
       $pcpMotivoParada = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'PCP', 'Motivo Parada');
       if($pcpMotivoParada){
	       echo "<li><a href='inicio.php?pg=motivo_parada'>Motivo Parada</a></li>";
       }

       $pcpRecurso = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'PCP', 'Recursos');
       if($pcpRecurso){
	       echo "<li><a href='inicio.php?pg=recurso'>Recursos</a></li>";
       }
	   echo "</ul>";
	   echo "</li>";
	}

	$principalCadastros = $moduloModel->verificaPermissaoModuloPrincipal($co_papel, array('Relatórios','Etiquetas'));
	if($principalCadastros){
		echo "<li>";
		echo "<a href='#' class='sub'>Relatórios</a>";
		echo "<ul>";
	
		$subControleAcesso = $moduloModel->verificaPermissaoModuloPrincipal($co_papel, array('Etiquetas'));
		if($subControleAcesso){
			echo "<li class='topline'>";
			echo "<a href='#' class='sub'>Etiquetas</a>";
			echo "<ul>";
	
			$subControleAcessoVisitantes = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Etiquetas', 'Etiqueta de Peça (CasaDei)');
			if($subControleAcessoVisitantes){
				echo "<li class='topline'><a href='inicio.php?pg=acesso_visitante'>Etiqueta de Peça (CasaDei)</a></li>";
			}
			
			echo "</ul>";
			echo "</li>";
		}
		
		echo "</ul>";
		echo "</li>";
	}
	
	$principalTipos = $moduloModel->verificaPermissaoModuloPrincipal($co_papel, array('Tipos'));
	if($principalTipos){
	    echo "<li>";
	    echo "<a href='#' class='sub'>Tipos</a>";
	    echo "<ul>";

	    $tiposSanguineo = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Tipos', 'Sanguineo');
	    if($tiposSanguineo){										
	        echo "<li class='topline'><a href='inicio.php?pg=tipo_sanguineo'>Sanguineo</a></li>";
        }
    
	    $cadastrosConsultores = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Tipos', 'E-Mail');
	    if($cadastrosConsultores){                                            
	    	echo "<li><a href='inicio.php?pg=tipo_email'>E-Mail</a></li>";
		} 
		
		$tipoTelefone = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Tipos', 'Telefone');
		if($tipoTelefone){									
			echo "<li><a href='inicio.php?pg=tipo_telefone'>Telefone</a></li>";
	    }
	    
	    $tipoVeiculo = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Tipos', 'Veiculo');
	    if($tipoVeiculo){
	    	echo "<li><a href='inicio.php?pg=tipo_veiculo'>Veiculo</a></li>";
	    }
	    echo "</ul>";
	    echo "</li>";
    }
    
    $principalConfig = $moduloModel->verificaPermissaoModuloPrincipal($co_papel, array('Configurações'));
    if($principalConfig){
    	echo "<li>";
   	 	echo "<a href='#' class='sub'>Configurações</a>";
    	echo "<ul>";
	
    	$configuracoesModulos = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Configurações', 'Módulos');
    	if($configuracoesModulos){
    		echo "<li class='topline'><a href='inicio.php?pg=modulos'>Módulos</a></li>";
    	}
    
    	$configuracoesPapel = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Configurações', 'Papel');
    	if($configuracoesPapel){
    		echo "<li><a href='inicio.php?pg=papel'>Papel</a></li>"; 
    	}
        echo "<li><a title='trocar senha' href='inicio.php?pg=alt_senha'>Trocar senha</a></li>";
        echo "</ul>";
		echo "</li>";
	}
                                                                        		
	echo "</ul>";
	echo "</li>";
	echo "</ul>";

?>
	<script type="text/javascript">
        var menu=new menu.dd("menu");
         menu.init("menu","menuhover");
    </script>
                        </td>
                        <td><img src="img/menu_header_separador.jpg" width="2" height="50" /></td>
                        <td width="299" align="left" valign="middle"><table width="100%" border="0" cellspacing="2" cellpadding="3">
                          <tr>
                            <td width="19%"><b>Usu&aacute;rio:</b></td>
                            <td width="81%"><?php echo $_SESSION['nomePessoa']; ?></td>
                          </tr>
                          <tr>
                            <td><b>Login:</b></td>
                            <td><?php echo $_SESSION['loginUsuario']; ?></td>
                          </tr>
                        </table></td>
                        <td><img src="img/menu_header_separador.jpg" width="2" height="50" /></td>
                        <td width="66" align="center" valign="middle"><b><a title="Sair" href="inicio.php?pg=logout" class="STYLE01">Sair</a></b></td>
                      </tr>
                    </table></td>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
            </tr>
        </table>