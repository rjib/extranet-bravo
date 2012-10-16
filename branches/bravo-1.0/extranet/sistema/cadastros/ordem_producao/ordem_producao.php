<?php
/*
* Pagina responsavel por listar OP em aberto somente PI
* @autor Ricardo Alvarenga
* @version 1.0 15/10/2012
*/
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
	$( "#dataInicial" ).datepicker();
	$( "#dataInicial" ).mask('99/99/9999');
	$( "#dataFinal" ).datepicker();
	$( "#dataFinal" ).mask('99/99/9999');
	/*$("#pesquisaListaPi").hide();
	$("#btGerarArquivo").hide();
	$("#gridListaPi").hide();
	*/
});	

</script>
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
          	<td width="142"><font class="FONT04"><b>Data Emissão:</b></font></td>
            <td width="60"><input size="10" id="dataInicial" title="Data Inicial" name="dataInicial" type="text" class="INPUT03"></td>
            <td width="7"><font class="FONT04"><b>à</b></font></td>
            <td width="694"><input class="INPUT03" size="10" id="dataFinal" title="Data Final" name="dataFinal" type="text"></td>
          </tr>
          <tr>
          	<td><font class="FONT04"><b>Cor:</b></font></td>
            <td colspan="3">
            	<select title="Selecione a Cor" class="SELECT01">
                	<!-- BEGIN BLOCK_CORES -->
                	<option>{CORES}</option>
                    <!-- END BLOCK_CORES -->
                </select>
            </td>
          </tr>
          <tr>
          	<td><font class="FONT04"><b>Espessura:</b></font></td>
            <td colspan="3">
            	<select class="SELECT01" title="Selecione a Espessura">
                	<!-- BEGIN BLOCK_ESPESSURA -->
                	<option>{ESPESSURA}</option>
                    <!-- END BLOCK_ESPESSURA -->
                </select>
            </td>
          </tr>
          <tr>
          	<td width="142"><font class="FONT04"><b>Imprimir ja selecionado?</b></font></td>
            <td width="60"><input type="radio" name="ck" id="ck" value="S" checked />Sim&nbsp;<input id="ck" name="ck" type="radio" value="N" />Não</td>
			<td colspan="2"><button type="button" id="btPesquisarPI" name="btPesquisarPI" title="Consultar">Consultar</button></td>            
          </tr>       
        </table>
                </td>
            </tr>
        </table>
        <table id="pesquisaListaPi" width="1003" border="0" cellpadding="3" cellspacing="2" class="LISTA" align="center" >
            <tr>
            	<th align="left"><b>Pesquisar:&nbsp;&nbsp;</b><input type="text" class="INPUT02" id="searching" value="Pesquisar..." size="60" maxlength="80" /></td>
            </tr>
        </table>
        <table id="gridListaPi" class="LISTA" width="1003" border="1" cellspacing="1" cellpadding="0" bgcolor="#FFFFFF" align="center">
			<tr>                
                <th scope="col"><input title="Selecionar todos PIs" type="checkbox" id="ck_todos_pi" name="ck_todos_pi" /></th>
                <th scope="col">Cor</th>
                <th scope="col">Codigo Int.</th>
                <th scope="col">Produto</th>
                <th scope="col">Comprimento</th>
                <th scope="col">Largura</th>     
                <th scope="col">Espessura</th>  
                <th scope="col">Qtde. Neces.</th>      
                <th scope="col">Qtde. a Prod.</th>               
          </tr>
              <!--	BEGIN BLOCK_LISTA_PI -->
              <tr align="center">          	                 
                <td><input title="Selecionar PI" type="checkbox" value="{COD_PI}" id="ck_pi[]" name="ck_pi[]" /></td>
                <td>{COR}</td>
                <td>{CODIGO_INTERNO}</td>  
                <td>{PRODUTO}</td>                              
                <td>{COMPRIMENTO}</td>
                <td>{LARGURA}</td>
                <td>{ESPESSURA}</td>
                <td>{QTDE_NECESSARIA}</td>
                <td>{QTDE_PRODUZIR}</td>                                                                                                                     
              </tr>
              <!-- END BLOCK_LISTA_PI -->
              <!-- BEGIN BLOCK_NENHUM_REGISTRO -->
              <tr align="center">  
                <td colspan="9">Nenhum registro encontrado!</td>
              </tr>
              <!-- END BLOCK_NENHUM_REGISTRO -->
        </table>
    </div>
    <table align="center" width="1003" style="margin-top:-40px">
                  <tr>
              	<td align="right">
                	<button type="button" id="btGerarArquivo" name="btGerarArquivo" title="Gerar Arquivo">Gerar Arquivo AC</button></td>
                </td>
              </tr>
    </table>
    
</div>
<!---INICIO FOOTER--->
<?php require("inc/footer.php"); ?>
<!---FINAL FOOTER--->