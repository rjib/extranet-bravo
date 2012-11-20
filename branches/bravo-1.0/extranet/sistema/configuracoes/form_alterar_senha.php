<?php
/**
 * Lista de modulos e submodulos que existam ações
 * @author Ricardo S. Alvarenga
 * @since 19/11/2012
 *
 */

require_once 'setup.php';
require_once 'helper.class.php';
require_once 'models/tb_usuario.php';


require_once 'models/tb_modulos.php';


$co_papel = $_SESSION['codigoPapel'];
$modulos = new tb_modulos($conexaoERP);
$acoes = $modulos->possuiPermissaoParaEstaArea($co_papel, CONFIGURACOES, CONFIGURACOES_TROCA_SENHA);

if($acoes['NO_MODULO'] == CONFIGURACOES_TROCA_SENHA){


$_usuario	= new tb_usuario($conexaoERP);
$_helper	= new helper();
$co_usuario = $_SESSION['codigoUsuario'];
$dadosUser = $_usuario->findByUser($co_usuario);


?>
<script type="text/javascript" src="js/cadastros/troca_senha.js"></script>
<div id="header-wrap">
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="img/bg_header.jpg">
    <tr>
    <td>
	<!--INICIO HEADER-->
	<?php require("inc/header.php"); ?>
	<!--FINAL HEADER-->
	</td>
    </tr>
</table>
</div>

<div id="ie6-container-wrap">
	<div id="container">
	    <table width="1003" border="0" align="center" cellpadding="0" cellspacing="0">
	            <tr>
	              <td valign="top">&nbsp;</td>
              </tr>
	            <tr>
	              <td valign="top">&nbsp;</td>
              </tr>
	            <tr>
	              <td><img src="img/title/title_troca_senha.jpg" width="1003" height="40" /></td>
              </tr>
	            <tr>
	              <td valign="top">&nbsp;</td>
              </tr>
        </table>
        <?php if($_SESSION['qt_acesso']==0){ $_SESSION['qt_acesso']++;?>
        <div align="center" style="margin-bottom: 10px;"><font class="FONT06"><span style="color: red; font-weight: bold;">Atenção:</span> Este é seu primeiro acesso e por questões de segurança solicitamos que altere sua senha, pode ser realizado em qualquer momento na opção configurações/trocar senha.</font></div>
        <?php  }?>
		<table width="1003" align="center" border="0" cellpadding="2" cellspacing="3" bgcolor="#F7F7F7" class="TABLE_FULL01">
		<tr>
		<td>
			<table width="998" align="center" border="0" cellpadding="2" cellspacing="3" bgcolor="#FFFFFF">
			<tr>
			    <td width="15%"><font class="FONT04"><b>Nome:</b></font></td>
			     <td><input type="text" id="nome" name="nome" disabled="disabled" size="30"  value="<?php echo $dadosUser['NO_PESSOA']?>"/></td>
			  </tr>
			  
			  	<tr>
			    <td width="15%"><font class="FONT04"><b>E-mail:</b></font></td>
			     <td><input type="text" id="email" name="email" size="30" disabled="disabled"  value="<?php echo $dadosUser['EM_PESSOA']?>"/></td>
			  </tr>
			  
			  	<tr>
			    <td width="15%"><font class="FONT04"><b>Usuário:</b></font></td>
			     <td><input type="text" id="usuario" name="usuario" size="30" disabled="disabled"  value="<?php echo $dadosUser['LG_USUARIO']?>"/></td>
			  </tr>
			
			  <tr>
			    <td width="15%"><font class="FONT04"><b>Senha antiga:</b></font></td>
			     <td><input type="password" id="senhaAntiga" name="senhaAntiga" /></td>
			  </tr>
			  <tr>
			  	 <td><font class="FONT04"><b>Nova Senha:</b></font></td>
			  	 <td><input type="password" id="senhaNova" name="senhaNova" maxlength="10"/> <span>Max. 10 caracteres</span></td>
			  </tr>
			  <tr>
			  	<td><font class="FONT04"><b>Confirma nova senha:</b></font></td>
			  	<td><input type="password" id="confirmaSenhaNova" name="confirmaSenhaNova" /></td>
			  </tr>
			  <tr>
			  	<td><input type="button" onclick="javascript:trocaSenha();" id="btNovaSenha" value="Alterar" /></td>
			  </tr>
			</table>
			</td>
		</tr>
		</table>
	</div>
	<!-- BOX MENSAGEM -->
<div id="boxMensagem"></div>
	
</div>
<!--INICIO FOOTER-->
<?php require("inc/footer.php");
}else{
	header('location:inicio.php');

}
?>


