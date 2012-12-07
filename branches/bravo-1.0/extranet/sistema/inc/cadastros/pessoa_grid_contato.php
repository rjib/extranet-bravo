<?php
	
	session_start();

    require("../../setup.php");
        if(empty($_SESSION['codigoPessoa'])){
    	if(empty($_GET['codigoPessoa'])){
    		
    	}else{
    		$codigoPessoa = $_GET['codigoPessoa'];
    	}
    }else{
    	$codigoPessoa = $_SESSION['codigoPessoa'];
    }
    
    if(empty($_SESSION['codigoPessoa']) && empty($_GET['codigoPessoa'])){
		echo "<table width='100%' border='0' cellspacing='0' cellpadding='4' class='LISTA'>";
		echo "<tr>";
		echo "<th align='center'>";
		echo "<font class='FONT06'><b>N&atilde;o h&aacute; contato registrado no momento!</b></font>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
	}else{
	
	    $sqlContato = mysql_query("SELECT CO_CONTATO                            
	                                   , DATE_FORMAT(DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
									   , NO_CONTATO
								   FROM tb_contato
								   WHERE CO_PESSOA = '".$codigoPessoa."'",$conexaoERP)
	    or die(mysql_error());

		if(mysql_num_rows($sqlContato) == 0){
		    echo "<table width='100%' border='0' cellspacing='0' cellpadding='4' class='LISTA'>";
			echo "<tr>";
			echo "<th align='center'>";
			echo "<font class='FONT06'><b>N&atilde;o h&aacute; contato registrado no momento!</b></font>";
			echo "</td>";
			echo "</tr>";
			echo "</table>";
		}else{
?>
<script type="text/javascript">
$(document).ready(function(){
     
   $("#confirmaExcluirContato").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: 'Excluir Contato',
		buttons: {
			"Sim": function() {
				$.get('inc/pessoa_contato_ex.php', {codigoContato: codigoContato}, function(resposta) {
																																																																																																				
					if(resposta != false){
						$('<p>' + resposta + '</p>').dialog({
							modal: true,
							resizable: false,
							title: 'Aten&ccedil;&atilde;o',
							buttons: {
								Ok: function() {
									$( this ).dialog( "close" );
									$( "#confirmaExcluirContato" ).dialog( "close" );
								}
							}
						});
					}else{
					    $('<p>Contato excluido com sucesso!</p>').dialog({
							modal: true,
							resizable: false,
							title: 'Aten&ccedil;&atilde;o',
							buttons: {
								Ok: function() {
									$( this ).dialog( "close" );
									$( "#confirmaExcluirContato" ).dialog( "close" );
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
	    $("#gridContato").load("inc/pessoa_grid_contato.php");
	}
	});
	
	$('a[name=excluirContato]').click(function(e){
		e.preventDefault();
		codigoContato = $(this).attr("rel");
		$("#confirmaExcluirContato").dialog( "open" );
    });
		
});
</script>
<div id="confirmaExcluirContato">
	<p>Deseja realmente excluir esse registro?</p>
</div>
            <table width="960" border="0" cellpadding="3" cellspacing="2" class="LISTA">                        
            <thead>
            <tr>
            <th width="120">Data Cadastro</th>
            <th align="left">Contato</th>
            <th width="60">Ação</th>
            </tr>
            </thead>
            <tbody>
			<?php
                while($rowContato=mysql_fetch_array($sqlContato)){
            ?>            
            <tr>
            <td align="center"><?php echo $rowContato['DT_CADAS']; ?></td>
            <td><?php echo $rowContato['NO_CONTATO']; ?></td>
            <td align="center">
            <a title="Excluir" href="#" name="excluirContato" rel="<?php echo $rowContato['CO_CONTATO']; ?>"><img src="img/btn/btn_excluir.gif" width="25" height="19" border="0"/></a>
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