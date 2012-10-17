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
									
                                    <li>
                        				<a href="#" class="sub">Cadastros</a>
                        				<ul>
                                        	
                                            <li class="topline">
                                                <a href="#" class="sub">Controle Acesso</a>
                                                <ul>
												    <li class="topline"><a href="inicio.php?pg=acesso_visitante">Visitantes</a></li>
                                                    <li><a href="inicio.php?pg=acesso_consultor">Consultores</a></li>
                        						</ul>
                                        	</li>
                                            
                                            <li><a href="inicio.php?pg=pessoa">Pessoas</a></li>
                                            <li><a href="inicio.php?pg=setor">Setores</a></li>
                                            <li><a href="inicio.php?pg=cartao_identificacao">Cartão Identificação</a></li>
                                            <li><a href="inicio.php?pg=cargo">Cargos</a></li>
                                            <li><a href="inicio.php?pg=consultor">Consultores</a></li>
                                            <li><a href="inicio.php?pg=colaborador">Colaboradores</a></li>
                                            <li><a href="inicio.php?pg=usuario">Usuários</a></li>
                                            <li><a href="inicio.php?pg=estado_civil">Estado Civil</a></li>
                                            <li><a href="inicio.php?pg=nivel_formacao">Nível Formação</a></li>
                                            <li><a href="inicio.php?pg=nacionalidade">Nacionalidade</a></li>                                            
                                            <li><a href="inicio.php?pg=papel">Papel</a></li>                                   
                        				</ul>
									</li>
                                    
                                     <li>
                        				<a href="#" class="sub">PCP</a>
                        				<ul>
                            				<li class="topline"><a href="inicio.php?pg=ordem_producao">Gerar Arquivo AC</a></li>
                            				<li><a href="inicio.php?pg=importar_ad">Importar Arquivo AD</a></li>
                                            <li><a href="inicio.php?pg=lista_cores">Lista de Cores</a></li>
                                            <li><a href="inicio.php?pg=lista_op">Ordem de Produção</a></li>                                            
                        				</ul>
									</li>        
                                                                        
                                    <li>
										<a href="#" class="sub">Tipos</a>
										<ul>
                                            <li class="topline"><a href="inicio.php?pg=tipo_sanguineo">Sanguineo</a></li>
                                            <li><a href="inicio.php?pg=tipo_email">E-Mail</a></li>
                                            <li><a href="inicio.php?pg=tipo_telefone">Telefone</a></li>
                                            <li><a href="inicio.php?pg=tipo_veiculo">Veiculo</a></li>
                        				</ul>
                        			</li>
                                    
                                    <li><a href="inicio.php?pg=uf">Estados</a></li>
                                    <li><a href="inicio.php?pg=municipio">Cidades</a></li>
                                    <li><a href="inicio.php?pg=bairro">Bairros</a></li>
                                    <li><a href="inicio.php?pg=cep">CEPs</a></li>                                                                                                      
                                    <li>
                        				<a href="#" class="sub">Configurações</a>
                        				<ul>
                            				<li class="topline"><a href="inicio.php?pg=empresa">Configuração 01</a></li>
                        				</ul>
									</li>  
                                                                        		
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