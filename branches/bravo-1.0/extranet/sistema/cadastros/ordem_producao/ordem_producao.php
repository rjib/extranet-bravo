<?php
/**
* Pagina responsavel por listar OP em aberto somente PI
* @autor Ricardo Alvarenga
* @version 1.0 15/10/2012
*/
require_once 'models/tb_pcp_cor.php';
require_once 'models/tb_pcp_produto.php';
require_once 'helper.class.php';

$_corModel = new tb_pcp_cor($conexaoERP);
$_produtoModel = new tb_pcp_produto($conexaoERP);
$_helper = new helper();

if(!($rowCores = $_corModel->listaTodasCores())){
	$_helper->alertError('Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
	exit;	
}
if(mysql_num_rows($rowCores)==0){	
	$_helper->alertDialog('N&atilde;o existe cores cadastradas, por favor entre em contato com o Suporte.');
	exit;
}

if(!($rowEspessura = $_produtoModel->listaTodasEspessuras())){
	$_helper->alertError('Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
	exit;
}
if(mysql_num_rows($rowEspessura)==0){
	$_helper->alertDialog('N&atilde;o existe espessuras cadastradas, por favor entre em contato com o Suporte.');
	exit;
}


?>

<div id="header-wrap">
    <table width="100%"  border="0" cellpadding="0" cellspacing="0" background="img/bg_header.jpg">
        <tr>
        <td>
        <!---INICIO HEADER--->
        <?php require("inc/header.php"); ?>
        <!---FINAL HEADER--->
        </td>
        </tr>
    </table>
</div>
<script type="text/javascript">


$(document).ready(function(){
	$("#btPesquisarPI").button();
	$("#btGerarArquivo").button();
	$("#btSelecionarTudo").button();
	$("#dataInicial").datepicker();
	$("#dataInicial").mask('99/99/9999');
	$("#dataFinal").datepicker();
	$("#dataFinal").mask('99/99/9999');
	$("#pesquisaListaPi").hide();
	$("#btGerarArquivo").hide();
	$("#grid").hide();
	$("#controls").hide();
	$("#console").hide();
	$("#btSelecionarTudo").hide();
	$("#formularioGerarArquivoAD").hide();
	$("#boxSelecionePeloMenosUm").hide();
	
	$("#unidadeComplementar").keyup(function() {
		 var valor = $("#unidadeComplementar").val().replace(/[^0-9]+/g,'');
		 $("#unidadeComplementar").val(valor);
	});


	$("#nomeArquivo").keyup(function() {
		 var valor = $("#nomeArquivo").val().replace(/[^0-9]+/g,'');
		 $("#nomeArquivo").val(valor);
	});
			

});	

</script>
<script type="text/javascript" src="js/cadastros/ordem_producao.js" charset="utf-8"></script>
<script type="text/javascript" src="js/paging.js"></script>

<div id="ie6-container-wrap">
    <div id="container">
        <table width="1003" align="center" style="margin-top:30px; padding-left:5px; margin-bottom:10px;">
           <tr>
            <td colspan="4"><img src="img/title/title_consulta_ordem_producao.jpg" width="1003" height="40" /></td>
          </tr>          
        </table >
        <table align="center" bgcolor="f7f7f7" cellspacing="5px;" class="TABLE_FULL01" width="1000">
        	<tr>
            	<td>
		            <table bgcolor="#FFFFFF" width="980" align="center" cellpadding="5" cellspacing="3">
						<tr>
				          	<td width="171"><font class="FONT04"><b>Data Emissão:</b></font></td>
				            <td width="60"><input onchange="ocultarBotoes();" size="10" id="dataInicial" title="Data Inicial" name="dataInicial" type="text" class="INPUT03"></td>
				            <td colspan="3">
				            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
					              	<tr>
					                  <td width="2%"><font class="FONT04"><b>à</b></font></td>
					                  <td width="98%">
					                    <input onchange="ocultarBotoes();" class="INPUT03" size="10" id="dataFinal" title="Data Final" name="dataFinal" type="text" /></td>
					                </tr>
		            			</table>
		            		</td>            
		          		</tr>
		         		 <tr>
		          			<td><font class="FONT04"><b>Cor:</b></font></td>
				            <td colspan="4">
				            	<select onchange="ocultarBotoes();" id="cor" title="Selecione a Cor" class="SELECT01">
				                	<!-- BEGIN BLOCK_CORES -->
				  				<?php while ($row = mysql_fetch_array($rowCores)){ 	
				                    echo "<option value='".$row['CO_COR']."'>".$row['DS_COR']."</option>";
				         		 }?>          
				                    <!-- END BLOCK_CORES -->
				                </select>
				            </td>
		          		</tr>
		          		<tr>
				          	<td><font class="FONT04"><b>Espessura:</b></font></td>
				            <td colspan="4">
				            	<select id="espessura" onchange="ocultarBotoes();" class="SELECT01" title="Selecione a Espessura">
				                	<!-- BEGIN BLOCK_ESPESSURA -->
				  				<?php while($row=mysql_fetch_array($rowEspessura)){ 	
				                    echo "<option value='".$row['ESPESSURA']."'>".$row['ESPESSURA']."</option>";
				         		 }?>  
				                    <!-- END BLOCK_ESPESSURA -->
				                </select>
				            </td>
		          		</tr>
		        		<tr>
				          	<td width="171"><font class="FONT04"><b>Exibir processados?</b></font></td>
				            <td width="60"><input type="radio" id="ck" name="ck" title="Sim" value="S"/>Sim&nbsp;<input title="Não" id="ck" name="ck" type="radio" value="N" checked />Não</td>
							<td width="81"><button type="button" id="btPesquisarPI" name="btPesquisarPI" title="Consultar">Consultar</button></td>
				            <td width="140"><button type="button" id="btSelecionarTudo" name="btSelecionarTudo" title="Gerar Arquivo">Selecionar Todos</button></td>              
				            <td width="458"><button type="button" id="btGerarArquivo" name="btGerarArquivo" title="Selecionar Todos">Gerar Arquivo AD</button></td>            
		        	 	</tr>       
		       		</table>
                </td>
            </tr>
        </table>
        <table id="pesquisaListaPi" width="1003" border="0" cellpadding="3" cellspacing="2" class="LISTA" align="center" >
            <tr>
            	<th align="left"><b>Pesquisar:&nbsp;&nbsp;</b><input type="text" class="INPUT02" id="searching" value="Pesquisar..." size="60" maxlength="80" /></th>
            </tr>
        </table> 
        <table align="center">  
       		<tr> 
		       <td valign="top">
                    <div id="grid" class="grid"></div>
                    <div id="controls" class="controls"></div>
                    <div id="console"></div>     
                    </td>
	            </tr>
        </table>
    </div>
</div>
<div id="boxAlerta" title="Atenção">
    <p align="center">
        <span style="float: left; margin: 0 7px 50px 0;"></span>
       O data de emissão deve ser informada!
    </p>
</div>
<div id="boxGerando" title="Atenção">
    <p align="center">
        <span><img src="img/loader.gif"/></span>
       O arquivo esta sendo criado, por favor aguarde...
    </p>
</div>
<div id="boxSelecionePeloMenosUm"><br><p align="center">Pelo menos um produto deve ser selecionado!</p></div>
<div id="formularioGerarArquivoAD">
	<form id="formularioGerarAD" action="javascript:void(0)" method="post">
		<table width="100%" border="0" cellspacing="2" cellpadding="3">
			<tr>
				<td width="142" align="left"><font class="FONT04"><b>Unidade Complementar:</b></font></td>
				<td colspan="3" align="left">
					<input title="Valor adicionado a largura e comprimento da peça" name="unidadeComplementar" id="unidadeComplementar" type="text" class="INPUT01" size="15" maxlength="3" />
				</td>
			</tr>
			<tr>
				<td align="left"><font class="FONT04"><b>Nome do Arquivo:</b></font></td>
				<td colspan="3" align="left"><input type="text" name="nomeArquivo" id="nomeArquivo" class="INPUT01" size="20" /></td>
			</tr>		
		</table>
	</form>
</div>


<!---INICIO FOOTER--->
<?php require("inc/footer.php"); ?>
<!---FINAL FOOTER--->