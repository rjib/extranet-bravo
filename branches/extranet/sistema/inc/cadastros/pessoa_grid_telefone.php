<?php
	
	session_start();

    require("../../setup.php");
	
	if(empty($_SESSION['codigoPessoa'])){
		echo "<table width='100%' border='0' cellspacing='0' cellpadding='4' class='LISTA'>";
		echo "<tr>";
		echo "<th align='center'>";
		echo "<font class='FONT06'><b>N&atilde;o h&aacute; telefone registrado no momento!</b></font>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
	}else{
	
	    $sqlTelefone = mysql_query("SELECT TELEFONE.CO_TELEFONE
								        , DATE_FORMAT(TELEFONE.DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
								        , CONTATO.NO_CONTATO
								        , TIPO_TELEFONE.NO_TIPO_TELEFONE
								        , TELEFONE.NU_TELEFONE
								    FROM tb_telefone TELEFONE
								        INNER JOIN tb_contato CONTATO
								            ON TELEFONE.CO_CONTATO = CONTATO.CO_CONTATO
								        INNER JOIN tb_tipo_telefone TIPO_TELEFONE
								            ON TELEFONE.CO_TIPO_TELEFONE = TIPO_TELEFONE.CO_TIPO_TELEFONE
								    WHERE TELEFONE.CO_PESSOA = '".$_SESSION['codigoPessoa']."'",$conexaoERP)
	    or die(mysql_error());

		if(mysql_num_rows($sqlTelefone) == 0){
		    echo "<table width='100%' border='0' cellspacing='0' cellpadding='4' class='LISTA'>";
			echo "<tr>";
			echo "<th align='center'>";
			echo "<font class='FONT06'><b>N&atilde;o h&aacute; telefone registrado no momento!</b></font>";
			echo "</td>";
			echo "</tr>";
			echo "</table>";
		}else{
?>
<script type="text/javascript">
$(document).ready(function(){
     
   $("#confirmaExcluirTelefone").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: 'Excluir Telefone',
		buttons: {
			"Sim": function() {
				$.get('inc/cadastros/pessoa_telefone_ex.php', {codigoTelefone: codigoTelefone}, function(resposta) {
																																																																																																				
					if(resposta != false){
						$('<p>' + resposta + '</p>').dialog({
							modal: true,
							resizable: false,
							title: 'Aten&ccedil;&atilde;o',
							buttons: {
								Ok: function() {
									$( this ).dialog( "close" );
									$( "#confirmaExcluirTelefone" ).dialog( "close" );
								}
							}
						});
					}else{
					    $('<p>Telefone excluido com sucesso!</p>').dialog({
							modal: true,
							resizable: false,
							title: 'Aten&ccedil;&atilde;o',
							buttons: {
								Ok: function() {
									$( this ).dialog( "close" );
									$( "#confirmaExcluirTelefone" ).dialog( "close" );
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
	    $("#gridTelefone").load("inc/cadastros/pessoa_grid_telefone.php");
	}
	});
	
	$('a[name=excluirContatoTelefone]').click(function(e){
		e.preventDefault();
		codigoTelefone = $(this).attr("rel");
		$("#confirmaExcluirTelefone").dialog( "open" );
    });
		
});
</script>
<div id="confirmaExcluirTelefone">
	<p>Deseja realmente excluir esse registro?</p>
</div>
            <table width="960" border="0" cellpadding="3" cellspacing="2" class="LISTA">                        
            <thead>
            <tr>
            <th width="120">Data Cadastro</th>
            <th width="350" align="left">Contato</th>
            <th width="250" align="left">Tipo Telefone</th>
            <th align="left">Telefone</th>
            <th width="60">Acao</th>
            </tr>
            </thead>
            <tbody>
			<?php
                while($rowTelefone=mysql_fetch_array($sqlTelefone)){
            ?>            
            <tr>
            <td align="center"><?php echo $rowTelefone['DT_CADAS']; ?></td>
            <td><?php echo $rowTelefone['NO_CONTATO']; ?></td>
            <td><?php echo $rowTelefone['NO_TIPO_TELEFONE']; ?></td>
            <td><?php echo $rowTelefone['NU_TELEFONE']; ?></td>
            <td align="center">
            <a title="Excluir" href="#" name="excluirContatoTelefone" rel="<?php echo $rowTelefone['CO_TELEFONE']; ?>"><img src="img/btn/btn_excluir.gif" width="25" height="19" border="0"/></a>
            </td>
            </tr>                   
			<?php
            }
            ?>
            </tbody>
            </table>
			<?php
			}
			}
			?>