<?php
	
	require("../../setup.php");
	
	$sqlCliente = mysql_query("SELECT CLIENTE.CO_CLIENTE
							       , DATE_FORMAT(CLIENTE.DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
								   , CLIENTE.CO_PESSOA
								   , SITUACAO.NO_SITUACAO 
								   , DATE_FORMAT(CLIENTE.DT_ATIVACAO, '%d/%m/%Y') AS DT_ATIVACAO
								   , CLIENTE.OBS_CLIENTE
							   FROM tb_cliente CLIENTE
								   INNER JOIN tb_situacao SITUACAO
								       ON CLIENTE.CO_SITUACAO = SITUACAO.CO_SITUACAO
							   WHERE CLIENTE.CO_PESSOA = '".$_GET['codigoPessoa']."'",$conexaoERP)
	or die(mysql_error());

	if(mysql_num_rows($sqlCliente) == 0){
	    echo "<table width='100%' border='0' cellspacing='0' cellpadding='4' class='LISTA'>";
		echo "<tr>";
		echo "<th align='center'>";
		echo "<font class='FONT06'><b>N&atilde;o h&aacute; cliente registrado no momento!</b></font>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
	}else{
?>
<script type="text/javascript">
$(document).ready(function(){
   
   $("#confirmaExcluirCliente").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: 'Excluir Cliente',
		buttons: {
			"Sim": function() {
				$.get('inc/cadastros/pessoa_cliente_ex.php', {codigoCliente: codigoCliente}, function(resposta) {
																																																																																																				
					if(resposta != false){
						$('<p>' + resposta + '</p>').dialog({
							modal: true,
							resizable: false,
							title: 'Aten&ccedil;&atilde;o',
							buttons: {
								Ok: function() {
									$(this).dialog("close");
									$("#confirmaExcluirCliente").dialog("close");
								}
							}
						});
					}else{
					    $('<p>Cliente excluido com sucesso!</p>').dialog({
							modal: true,
							resizable: false,
							title: 'Aten&ccedil;&atilde;o',
							buttons: {
								Ok: function() {
									$(this).dialog("close");
									$("#confirmaExcluirCliente").dialog("close");
									$("#botaoAdicionarCliente").show('fast');
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
	    $("#gridCliente").load("inc/cadastros/pessoa_alt_grid_cliente.php?codigoPessoa=<?php echo $_GET['codigoPessoa']; ?>");
	}
	});
   
   $('a[name=alterarCliente]').click(function (event){
        event.preventDefault();
		$("#formularioAlterarCliente").load('inc/cadastros/pessoa_cliente_form_alt.php?codigoCliente='+$(this).attr("id"));
        $("#formularioAlterarCliente").dialog({
			autoOpen: true,
			height: 350,
			width: 600,
			modal: true,
			resizable: false,
			title: 'Alterar Cliente',
			buttons: {
				'Salvar': function() {
													
					var codigoCliente      = $("#codigoCliente").val(); 
					var situacaoCliente    = $("#situacaoClienteAlterar").val(); 
					var observacaoCliente  = $("#observacaoClienteAlterar").val(); 
					
					$.post('inc/cadastros/pessoa_cliente_alt.php', {codigoCliente: codigoCliente, situacaoCliente: situacaoCliente observacaoCliente: observacaoCliente}, function(resposta) {
																																																																																																					
							if (resposta != false) {
								$('<p>' + resposta + '</p>').dialog({
									modal: true,
									resizable: false,
									title: 'Aten&ccedil;&atilde;o',
									buttons: {
										Ok: function() {
											$( this ).dialog( "close" );
										}
									}
								});
							} 
							else {
								
								$('<p>Altera&ccedil;&atilde;o efetuada com sucesso!</p>').dialog({
									modal: true,
									resizable: false,
									title: 'Aten&ccedil;&atilde;o',
									buttons: {
										Ok: function() {
											$(this).dialog("close");
											$("#formularioAlterarCliente").dialog("close");
											$("#botaoAdicionarCliente").hide();
										}
									}
								});
								
								$("#situacaoClienteAlterar").val(""); 
								$("#observacaoClienteAlterar").val(""); 
								
							}
					});
									
				},
				'Cancelar': function() {
					$(this).dialog("close");
				}
			},
			close: function() {
				$("#gridCliente").load("inc/cadastros/pessoa_alt_grid_cliente.php?codigoPessoa=<?php echo $_GET['codigoPessoa']; ?>");
			}
		});
    });
      
    $('a[name=excluirCliente]').click(function(e){
		e.preventDefault();
		codigoCliente = $(this).attr("id");
		$("#confirmaExcluirCliente").dialog("open");
    });
		
});
</script>
<div id="confirmaExcluirCliente">
	<p>Deseja realmente excluir esse registro?</p>
</div>
<div id="formularioAlterarCliente"></div>
            <table width="960" border="0" cellpadding="3" cellspacing="2" class="LISTA">                        
            <thead>
            <tr>
            <th width="60">Codigo</th>
            <th width="120" align="center">Data Cadastro</th>
            <th width="100" align="center">Cliente Desde</th>
            <th width="120" align="left">Situacao</th>
            <th align="left">Observacoes</th>
            <th width="70">Acao</th>
            </tr>
            </thead>
            <tbody>
			<?php
                while($rowCliente=mysql_fetch_array($sqlCliente)){
            ?>            
            <tr>
            <td align="center"><?php echo $rowCliente['CO_CLIENTE']; ?></td>
            <td align="center"><?php echo $rowCliente['DT_CADAS']; ?></td>
            <td align="center"><?php echo $rowCliente['DT_ATIVACAO']; ?></td>
            <td><?php echo $rowCliente['NO_SITUACAO']; ?></td>
            <td><?php echo $rowCliente['OBS_CLIENTE']; ?></td>
            <td align="center">
            <a title="Alterar" href="#" name="alterarCliente" id="<?php echo $rowCliente['CO_CLIENTE']; ?>"><img src="img/btn/btn_editar.gif" width="25" height="19" border="0"/></a>
            <a title="Excluir" href="#" name="excluirCliente" id="<?php echo $rowCliente['CO_CLIENTE']; ?>"><img src="img/btn/btn_excluir.gif" width="25" height="19" border="0"/></a>
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