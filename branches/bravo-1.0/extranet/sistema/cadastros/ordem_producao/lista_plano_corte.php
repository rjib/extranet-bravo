<?php

	/**
	 * Script responsÃ¡vel por listar todos os planos de corte
	 * @author Ricardo Alvarenga <ralvarenga@bravo.com.br>
	 * 
	 */
require_once 'setup.php';
require_once APP_PATH.'sistema/helper.class.php';
require_once APP_PATH.'sistema/models/tb_pcp_ad.php';
//$_helper = new helper();
//$_modelAD = new tb_pcp_ad($conexaoERP);
	 
?>

<script>

	/**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/

	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estilizaÃ§Ã£o nos controles
	 var controlsscript		=	'inc/ordem_producao_lista_plano_corte_grid.php';	//Documento com o conteÃºdo do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid serÃ¡ carregado
	 var gridscript	=	'inc/ordem_producao_lista_plano_corte_grid.php';			//Documento com o conteÃºdo do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//ParÃ¢metros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div responsÃ¡vel por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou animaÃ§Ã£o durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
	
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/
</script>
<script type="text/javascript" src="js/paging.js"></script>
<script type="text/javascript" src="js/cadastros/ordem_producao_lista_plano_corte.js"></script>
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

<!--INICIO CONTEUDO-->
<div id="ie6-container-wrap">
<div id="container">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
        <td>
	        <table width="1003" border="0" align="center" cellpadding="0" cellspacing="0">
	            <tr>
	              <td valign="top">&nbsp;</td>
              </tr>
	            <tr>
	              <td valign="top">&nbsp;</td>
              </tr>
	            <tr>
	              <td><img src="img/title/title_importar_plano_corte_optisave.png" width="1003" height="40" /></td>
              </tr>
              <tr>
	              <td>&nbsp;</td>
              </tr>
	            <tr>
	              <td> 
                  <table width="1003" border="0" cellpadding="3" cellspacing="2" class="LISTA" >
	                <tr>
	                  <th align="left"><b>Pesquisar:&nbsp;&nbsp;</b><input type="text" class="INPUT02" id="searching" value="Pesquisar..." size="60" maxlength="80" /></th>
                    </tr>
                  </table>
                  </td>
              </tr>
	            <tr> 
		            <td valign="top">
                    <div id="grid" class="grid"></div>
                    <div class="controls"></div>
                    <div id="console"></div>     
                    </td>
	            </tr>
	        </table>
        </td>
    </tr>
</table>
<div id="boxImportarAC" class="FONT04">
	<form method="post" enctype="multipart/form-data" name="formUpload" id="formUpload">
			<table align="center" style="margin-bottom:5px;">
			  <tr>
			  	<td width="234"><b>Arquivo de origem:</b>&nbsp;<span style="color: black;" id="arquivoOrigem"></span></td>
			  </tr>
	          <tr>                    	
	          	<td width="234"><input onchange="javascript:getNameArquivo()" size="20" type="file" id="arquivo_ac" name="arquivo_ac" value="Importar Arquivo AC" title="Importar Arquivo AC"></td>
	            <td width="754"><input type="button" id="btEnviarAC" value="Enviar" title="Importar Arquivo AC"><input type="hidden" value="" id="nomeAD" name="nomeAD"></td>
	          </tr> 
	          <tr>
	          	<td><b>Arquivo Selecionado:</b><div id="arquivoSelecionado">Nenhum</div></td>
	          </tr>      
	        </table>
	</form>
</div>
<div id="boxLoading"> <p align="center">
        <span><img src="img/loader.gif"/></span><br>
       O arquivo esta sendo enviado, por favor aguarde...
    </p>
 </div>
 <div id="boxDivergencias"></div>
 <div id="boxFinishi" style="text-align: center;">Operação realizada com sucesso.</div>
 </div>
</div>
<!--FINAL CONTEUDO-->

<!--INICIO FOOTER-->
<?php require("inc/footer.php"); ?>
<!--FINAL FOOTER-->