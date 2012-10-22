<?php
/**
* Pagina responsavel por listar OP em aberto somente PI
* @autor Ricardo Alvarenga
* @version 1.0 15/10/2012
*/

	$sqlCores = mysql_query("SELECT CO_COR, DS_COR, CO_RECNO FROM tb_pcp_cor ORDER BY DS_COR ASC",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
	if(mysql_num_rows($sqlCores) == 0){
	    echo "<script type='text/javascript' language='javascript'>
		      $(function($) {
			      $('<p>[Erro] - N&atilde;o existe cores cadastradas, por favor entre em contato com o Suporte.</p>').dialog({
				      modal: true,
				      resizable: false,
				      title: 'Aten&ccedil;&atilde;o',
				      buttons: {
				      Ok: function() {
				          $( this ).dialog( 'close' );
				          $(window.document.location).attr('href','inicio.php');
				      }
				  }
			  }); });
			  </script>";
	}
	
	
	$sqlEspessura = mysql_query("SELECT DISTINCT(NU_ESPESSURA) ESPESSURA FROM tb_pcp_produto WHERE NU_ESPESSURA <>''  ORDER BY ABS(NU_ESPESSURA) ASC;",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
	if(mysql_num_rows($sqlEspessura) == 0){
	    echo "<script type='text/javascript' language='javascript'>
		      $(function($) {
			      $('<p>[Erro] - N&atilde;o existe espessura cadastrado, por favor entre em contato com o Suporte.</p>').dialog({
				      modal: true,
				      resizable: false,
				      title: 'Aten&ccedil;&atilde;o',
				      buttons: {
				      Ok: function() {
				          $( this ).dialog( 'close' );
				          $(window.document.location).attr('href','inicio.php');
				      }
				  }
			  }); });
			  </script>";
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
            <td width="60"><input size="10" id="dataInicial" title="Data Inicial" name="dataInicial" type="text" class="INPUT03"></td>
            <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                  <td width="2%"><font class="FONT04"><b>à</b></font></td>
                  <td width="98%"><font class="FONT04"><b>
                    <input class="INPUT03" size="10" id="dataFinal" title="Data Final" name="dataFinal" type="text" />
                  </b></font></td>
                </tr>
            </table></td>
            
          </tr>
          <tr>
          	<td><font class="FONT04"><b>Cor:</b></font></td>
            <td colspan="4">
            	<select id="cor" title="Selecione a Cor" class="SELECT01">
                	<!-- BEGIN BLOCK_CORES -->
  				<?php while($rowCores=mysql_fetch_array($sqlCores)){ 	
                    echo "<option value='".$rowCores['CO_COR']."'>".$rowCores['DS_COR']."</option>";
         		 }?>          
                    <!-- END BLOCK_CORES -->
                </select>
            </td>
          </tr>
          <tr>
          	<td><font class="FONT04"><b>Espessura:</b></font></td>
            <td colspan="4">
            	<select id="espessura" class="SELECT01" title="Selecione a Espessura">
                	<!-- BEGIN BLOCK_ESPESSURA -->
  				<?php while($rowEspessura=mysql_fetch_array($sqlEspessura)){ 	
                    echo "<option value='".$rowEspessura['ESPESSURA']."'>".$rowEspessura['ESPESSURA']."</option>";
         		 }?>  
                    <!-- END BLOCK_ESPESSURA -->
                </select>
            </td>
          </tr>
          <tr>
          	<td width="171"><font class="FONT04"><b>Imprimir ja selecionado?</b></font></td>
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
<div id="boxGerandoArquivo" title="Gerando Arquivo AD">
    <p align="center">
       <img src="img/loader.gif" /></br>Gerando arquivo, favor aguarde...
    </p>
</div>
<!---INICIO FOOTER--->
<?php require("inc/footer.php"); ?>
<!---FINAL FOOTER--->