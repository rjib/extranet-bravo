<?php
/**
* Pagina responsavel por listar e importar arquivos AD
* @autor Ricardo Alvarenga
* @version 1.0 16/10/2012
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
	$("#arquivo_ad").button();
	$("#arquivo_ad_enviar").button();
});
	

</script>
<div id="ie6-container-wrap">
    <div id="container">
        <table width="1003" align="center" style="margin-top:30px; padding-left:5px; margin-bottom:10px;">
           <tr>
            <td colspan="4"><img src="img/title/title_importar_ad.jpg" width="1003" height="40" /></td>
          </tr>          
        </table>
        <table width="1000" align="center" style="margin-bottom:5px;">
          <tr>
          	<td width="234"><input type="file" id="arquivo_ad" value="Importar Arquivo AD" title="Importar Arquivo AD"></td>
            <td width="754"><input type="button" id="arquivo_ad_enviar" value="Enviar" title="Importar Arquivo AD"></td>
          </tr>                   
        </table>
        <table id="pesquisaListaAd" width="1003" border="0" cellpadding="3" cellspacing="2" class="LISTA" align="center" >
            <tr>
            	<th align="left"><b>Pesquisar:&nbsp;&nbsp;</b><input type="text" class="INPUT02" id="searching" value="Pesquisar..." size="60" maxlength="80" /></td>
            </tr>
        </table>
        <table id="gridListaAd" class="LISTA" width="1003" border="1" cellspacing="1" cellpadding="0" bgcolor="#FFFFFF" align="center">
			<tr>                
                <th scope="col">Código</th>
                <th scope="col">Arquivo</th>                  
                <th scope="col">Data Inclusão</th>
                <th scope="col">Autor</th>
                <th scope="col">Ação</th>            
          </tr>
              <!--	BEGIN BLOCK_LISTA_AD -->
              <tr align="center">          	                 
                <td>{CODIGO}</td>
                <td>{NO_ARQUIVO}</td>  
                <td>{DT_INCLUSAO}</td>                              
                <td>{AUTOR}</td>
                <td><a href="#" id="{CODIGO}"><img title="Gerar Etiqueta" src="img/btn/btn_gerar_etiqueta.gif" /></a></td>                                                                                                                  
              </tr>
              <!-- END BLOCK_LISTA_AD -->
              <!-- BEGIN BLOCK_NENHUM_REGISTRO -->
              <tr align="center">  
                <td colspan="5">Nenhum registro encontrado!</td>
              </tr>
              <!-- END BLOCK_NENHUM_REGISTRO -->
        </table>
    </div>    
</div>
<!---INICIO FOOTER--->
<?php require("inc/footer.php"); ?>
<!---FINAL FOOTER--->