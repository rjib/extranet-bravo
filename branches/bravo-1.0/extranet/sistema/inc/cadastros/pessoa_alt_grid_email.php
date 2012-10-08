<?php
	
    require("../../setup.php");
	
	$sqlEmail = mysql_query("SELECT EMAIL.CO_EMAIL
							     , DATE_FORMAT(EMAIL.DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
								 , CONTATO.NO_CONTATO
								 , TIPO_EMAIL.NO_TIPO_EMAIL
								 , EMAIL.NO_EMAIL
							 FROM tb_email EMAIL
						         INNER JOIN tb_contato CONTATO
								     ON EMAIL.CO_CONTATO = CONTATO.CO_CONTATO
								 INNER JOIN tb_tipo_email TIPO_EMAIL
								     ON EMAIL.CO_TIPO_EMAIL = TIPO_EMAIL.CO_TIPO_EMAIL
							 WHERE EMAIL.CO_PESSOA = '".$_GET['codigoPessoa']."'",$conexaoERP)
	or die(mysql_error());

	if(mysql_num_rows($sqlEmail) == 0){
	    echo "<table width='100%' border='0' cellspacing='0' cellpadding='4' class='LISTA'>";
		echo "<tr>";
		echo "<th align='center'>";
		echo "<font class='FONT06'><b>N&atilde;o h&aacute; e-mail registrado no momento!</b></font>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
	}else{
?>
<script type="text/javascript">
$(document).ready(function(){
     
   $("#confirmaExcluirEmail").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: 'Excluir Email',
		buttons: {
			"Sim": function() {
				$.get('inc/cadastros/pessoa_email_ex.php', {codigoEmail: codigoEmail}, function(resposta) {
																																																																																																				
					if(resposta != false){
						$('<p>' + resposta + '</p>').dialog({
							modal: true,
							resizable: false,
							title: 'Aten&ccedil;&atilde;o',
							buttons: {
								Ok: function() {
									$( this ).dialog( "close" );
									$( "#confirmaExcluirEmail" ).dialog( "close" );
								}
							}
						});
					}else{
					    $('<p>E-mail excluido com sucesso!</p>').dialog({
							modal: true,
							resizable: false,
							title: 'Aten&ccedil;&atilde;o',
							buttons: {
								Ok: function() {
									$( this ).dialog( "close" );
									$( "#confirmaExcluirEmail" ).dialog( "close" );
								}
							}
						});
					}
						
			});
		},
		'Nao': function() {
			$( this ).dialog( "close" );
		}
	},
	close: function() {
	    $("#gridEmail").load("inc/cadastros/pessoa_alt_grid_email.php?codigoPessoa=<?php echo $_GET['codigoPessoa']; ?>");
	}
	});
	
	$('a[name=excluirEmail]').click(function(e){
		e.preventDefault();
		codigoEmail = $(this).attr("id");
		$("#confirmaExcluirEmail").dialog( "open" );
    });
		
});
</script>
<div id="confirmaExcluirEmail">
	<p>Deseja realmente excluir esse registro?</p>
</div>
            <table width="960" border="0" cellpadding="3" cellspacing="2" class="LISTA">                        
            <thead>
            <tr>
            <th width="120">Data Cadastro</th>
            <th width="280" align="left">Contato</th>
            <th width="200" align="left">Tipo E-mail</th>
            <th align="left">E-mail</th>
            <th width="60">Acao</th>
            </tr>
            </thead>
            <tbody>
			<?php
                while($rowEmail=mysql_fetch_array($sqlEmail)){
            ?>            
            <tr>
            <td align="center"><?php echo $rowEmail['DT_CADAS']; ?></td>
            <td><?php echo $rowEmail['NO_CONTATO']; ?></td>
            <td><?php echo $rowEmail['NO_TIPO_EMAIL']; ?></td>
            <td><?php echo $rowEmail['NO_EMAIL']; ?></td>
            <td align="center">
            <a title="Excluir" href="#" name="excluirEmail" id="<?php echo $rowEmail['CO_EMAIL']; ?>"><img src="img/btn/btn_excluir.gif" width="25" height="19" border="0"/></a>
            </td>
            </tr>                   
			<?php
            }
            ?>
            </tbody>
            </table>
			<?php
			}
			?>