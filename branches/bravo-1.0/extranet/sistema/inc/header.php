<?php
require_once 'setup.php';
require_once 'models/tb_modulos.php';
require_once 'helper.class.php';

$moduloModel = new tb_modulos($conexaoERP);
$co_papel = $_SESSION['codigoPapel'];


?>

<table width="1003" height="92" border="0" align="center" cellpadding="0" cellspacing="0" background="img/header.jpg">
            <tr>
                <td align="right"><table width="609" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="600" height="60" align="center" background="img/bg_menu_header.jpg"><table width="592" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="223">
                        <ul class="menu" id="menu">
						    <li>
                                <a href="inicio.php" class="menulink">
                            	<img src="img/btn/btn_menu_opcoes.jpg" alt="MENU OPÇÕES" width="223" height="60" border="0"/>
                            	</a>
                        		<ul>
								<?php $principalCadastros = $moduloModel->verificaPermissaoModuloPrincipal($co_papel, array('Cadastros','Controle de Acesso'));
                                     if($principalCadastros){
                                    ?>
                                    <li>
                        				<a href="#" class="sub">Cadastros</a>
                        				<ul>
                                        	
                                        	
                                        	<?php 
                                        	$subControleAcesso = $moduloModel->verificaPermissaoModuloPrincipal($co_papel, array('Controle de Acesso'));
                                        	if($subControleAcesso){
                                        	?>
                                        	
                                            <li class="topline">
                                                <a href="#" class="sub">Controle Acesso</a>
                                                <ul>
                                                <?php 
                                                $subControleAcessoVisitantes = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Controle de Acesso', 'Visitantes');
                                                if($subControleAcessoVisitantes){
                                                ?>
												    <li class="topline"><a href="inicio.php?pg=acesso_visitante">Visitantes</a></li>
												<?php
												} 
                                                $subControleAcessoConsultores = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Controle de Acesso', 'Consultores');
                                                if($subControleAcessoConsultores){
                                                ?>
                                                    <li><a href="inicio.php?pg=acesso_consultor">Consultores</a></li>
                                                <?php }?>
                        						</ul>
                                        	</li>
                                             <?php
                                             } 
                                             $cadastrosBairos = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Bairros');
                                             if($cadastrosBairos){
                                             ?>		                                    
		                                    <li><a href="inicio.php?pg=bairro">Bairros</a></li>
                                             <?php 
                                             }
                                             $cadastrosCargos = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Cargos');
                                             if($cadastrosCargos){
                                             ?>	
		                                    <li><a href="inicio.php?pg=cargo">Cargos</a></li>
		                                    <?php }
		                                    $cadastrosCartao = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Cartão Identificação');
		                                    if($cadastrosCartao){		                                    
		                                    ?> 
		                                    <li><a href="inicio.php?pg=cartao_identificacao">Cartão Identificação</a></li>
		                                    <?php }
		                                    $cadastrosCep = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'CEPs');
		                                    if($cadastrosCep){		                                    
		                                    ?>
		                                    <li><a href="inicio.php?pg=cep">CEPs</a></li>
		                                    <?php }
		                                    $cadastrosCidades = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Cidades');
		                                    if($cadastrosCidades){		                                    
		                                    ?>
		                                    <li><a href="inicio.php?pg=municipio">Cidades</a></li>
		                                    <?php }
		                                    $cadastrosColaboradores = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Colaboradores');
		                                    if($cadastrosColaboradores){		                                    
		                                    ?> 
		                                    <li><a href="inicio.php?pg=colaborador">Colaboradores</a></li>
		                                    <?php }
		                                    $cadastrosConsultores = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Consultores');
		                                    if($cadastrosConsultores){
		                                    ?>
		                                    <li><a href="inicio.php?pg=consultor">Consultores</a></li>
		                                    <?php }
		                                    $cadastrosEstados = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Estados');
		                                    if($cadastrosEstados){		                                    
		                                    ?> 
		                                    <li><a href="inicio.php?pg=uf">Estados</a></li>
		                                    <?php }
		                                    $cadastrosCivil = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Estado Civil');
		                                    if($cadastrosCivil){		                                    
		                                    ?>
		                                    <li><a href="inicio.php?pg=estado_civil">Estado Civil</a></li>
		                                    <?php }
		                                    $cadastrosNacionalidade = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Nacionalidade');
		                                    if($cadastrosNacionalidade){		                                    
		                                    ?>
		                                    <li><a href="inicio.php?pg=nacionalidade">Nacionalidade</a></li>
		                                    <?php }
		                                    $cadastrosNivelFormacao = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Nível de Formação');
		                                    if($cadastrosNivelFormacao){		                                    
		                                    ?> 
		                                    <li><a href="inicio.php?pg=nivel_formacao">Nível Formação</a></li>
		                                    <?php }
		                                    $cadastroPessoas = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Pessoas');
		                                    if($cadastroPessoas){		                                    
		                                    ?>
		                                    <li><a href="inicio.php?pg=pessoa">Pessoas</a></li>
		                                    <?php }
		                                    $cadastroSetores = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Setores');
		                                    if($cadastroSetores){		                                    
		                                    ?>
		                                    <li><a href="inicio.php?pg=setor">Setores</a></li>
		                                    <?php }
		                                    $cadastroUsuario = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Cadastros', 'Usuários');
		                                    if($cadastroUsuario){ ?>
		                                    <li><a href="inicio.php?pg=usuario">Usuários</a></li>
		                                    <?php } ?>
		                             </ul>		                             
									</li>
									<?php }?>
                                    <?php 
                                    $principalPCP = $moduloModel->verificaPermissaoModuloPrincipal($co_papel, array('PCP'));
                                    if($principalPCP){                                    
                                    ?>
                                     <li>
                                     
                        				<a href="#" class="sub">PCP</a>
                        				<ul>
                        					<?php 
                        					$pcpPlanoCorte = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'PCP', 'Gerar Plano de Corte');
                        					if($pcpPlanoCorte){
                        					?>
                            				<li class="topline"><a href="inicio.php?pg=ordem_producao">Gerar Plano de Corte</a></li>
                            				<?php }
                            				$pcpImportar = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'PCP', 'Importar Plano de Corte Optisave');
                            				if($pcpImportar){                            				
                            				?>
                            				<li><a href="inicio.php?pg=lista_plano_corte">Importar Plano de Corte do Optisave</a></li>
                            				<?php }
                            				$pcpListaCores = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'PCP', 'Lista de Cores');
                            				if($pcpListaCores){                            				
                            				?>
                                            <li><a href="inicio.php?pg=lista_cores">Lista de Cores</a></li>
                                            <?php 
                                            }
                                            $pcpOrdem = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'PCP', 'Ordem de Produção');
                                            if($pcpOrdem){
                                            ?>
                                            <li><a href="inicio.php?pg=lista_op">Ordem de Produção</a></li>
                                            <?php }
                                            
                                            ?>                                            
                        				</ul>
									</li>   
									<?php }     
									$principalTipos = $moduloModel->verificaPermissaoModuloPrincipal($co_papel, array('Tipos'));
									if($principalTipos){
										?>
                                    <li>
										<a href="#" class="sub">Tipos</a>
										<ul>
										<?php 
										$tiposSanguineo = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Tipos', 'Sanguineo');
										if($tiposSanguineo){										
										?>
                                            <li class="topline"><a href="inicio.php?pg=tipo_sanguineo">Sanguineo</a></li>
                                            <?php }
                                            $cadastrosConsultores = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Tipos', 'E-Mail');
                                            if($cadastrosConsultores){                                            
                                            ?>
                                            <li><a href="inicio.php?pg=tipo_email">E-Mail</a></li>
										<?php } 
										$tipoTelefone = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Tipos', 'Telefone');
										if($tipoTelefone){									
										?>                                            
                                            
                                            <li><a href="inicio.php?pg=tipo_telefone">Telefone</a></li>
                                            <?php }
                                            $tipoVeiculo = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Tipos', 'Veiculo');
                                            if($tipoVeiculo){
                                            ?>                                            
                                            <li><a href="inicio.php?pg=tipo_veiculo">Veiculo</a></li>
                                            <?php } ?>
                        				</ul>
                        			</li>
                                      <?php }
                                      $principalConfig = $moduloModel->verificaPermissaoModuloPrincipal($co_papel, array('Configurações'));
                                      if($principalConfig){
                                     
                                      ?>                                                            
                                    <li>
                                    
                        				<a href="#" class="sub">Configurações</a>
                        				<ul>
                        				<?php 
                        				$configuracoesModulos = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Configurações', 'Módulos');
                        				if($configuracoesModulos){
                        				?>
                            				<li class="topline"><a href="inicio.php?pg=modulos">Módulos</a></li> 
                            			<?php  }
                            			$configuracoesPapel = $moduloModel->PossuiPermissaoParaModuloPrincipal($co_papel, 'Configurações', 'Papel');
                            			if($configuracoesPapel){
                            			?>	                            				
                            				<li><a href="inicio.php?pg=papel">Papel</a></li>  
                            				<?php }?>
                            				<li><a title="trocar senha" href="inicio.php?pg=alt_senha">Trocar senha</a> </li>
                        				</ul>
									</li>  
									<?php }?>
                                                                        		
							</ul>
						</li>
					</ul>
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