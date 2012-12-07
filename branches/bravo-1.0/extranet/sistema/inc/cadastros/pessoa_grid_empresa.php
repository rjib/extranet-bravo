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
    	echo "<font class='FONT06'><b>N&atilde;o h&aacute; empresa registrado no momento!</b></font>";
    	echo "</td>";
    	echo "</tr>";
    	echo "</table>";
    }else{
	
	$sqlEmail = mysql_query("SELECT PESSOA.NO_PESSOA EMPRESA
				, JURIDICA.CNPJ_PESSOA_JURIDICA CNPJ
				, PRESTADOR.CO_PESSOA CO_PESSOA
				, JURIDICA.CO_PESSOA_JURIDICA CO_PESSOA_JURIDICA
				FROM tb_prestador_servico PRESTADOR
					INNER JOIN tb_pessoa_juridica JURIDICA
						ON PRESTADOR.co_pessoa_juridica = JURIDICA.co_pessoa_juridica
					INNER JOIN tb_pessoa PESSOA ON JURIDICA.co_pessoa = PESSOA.co_pessoa
				WHERE PRESTADOR.co_pessoa = '".$codigoPessoa."'",$conexaoERP)
	or die(mysql_error());
    }

	if(mysql_num_rows($sqlEmail) == 0){
		?>
		<script type="text/javascript">
		$(document).ready(function(){

   		$("#botaoAdicionarEmpresa").show();
   		});
		</script>
		<?php 
	    echo "<table width='100%' border='0' cellspacing='0' cellpadding='4' class='LISTA'>";
		echo "<tr>";
		echo "<th align='center'>";
		echo "<font class='FONT06'><b>N&atilde;o h&aacute; empresa registrada no momento!</b></font>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
	}else{
?>
<script type="text/javascript">
$(document).ready(function(){

   $("#botaoAdicionarEmpresa").hide();
   $("#confirmaExcluirEmpresa").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: 'Excluir Empresa',
		buttons: {
			"Sim": function() {
				$.get('inc/cadastros/pessoa_empresa_ex.php', {codigoPessoa: codigoPessoa, codigoPessoaJuridica:codigoPessoaJuridica}, function(resposta) {
																																																																																																				
					if(resposta != false){
						$('<p>' + resposta + '</p>').dialog({
							modal: true,
							resizable: false,
							title: 'Aten&ccedil;&atilde;o',
							buttons: {
								Ok: function() {
									$( this ).dialog( "close" );
									$( "#confirmaExcluirEmpresa" ).dialog( "close" );
								}
							}
						});
					}else{
					    $('<p>Empresa excluida com sucesso!</p>').dialog({
							modal: true,
							resizable: false,
							title: 'Aten&ccedil;&atilde;o',
							buttons: {
								Ok: function() {
									$( this ).dialog( "close" );
									$( "#confirmaExcluirEmpresa" ).dialog( "close" );
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
	    $("#gridEmpresa").load("inc/cadastros/pessoa_alt_grid_empresa.php?codigoPessoa=<?php echo $codigoPessoa; ?>");
	}
	});
	
	$('a[name=excluirEmpresa]').click(function(e){
		e.preventDefault();
		codigoPessoa = $(this).attr("id");
		codigoPessoaJuridica = $("#codigoPessoaJuridica").val();
		$("#confirmaExcluirEmpresa").dialog( "open" );
    });
		
});
</script>
<div id="confirmaExcluirEmpresa">
	<p>Deseja realmente excluir esse registro?</p>
</div>
            <table width="960" border="0" cellpadding="3" cellspacing="2" class="LISTA">                        
            <thead>
            <tr>
            <th width="280" align="left">Empresa</th>
            <th width="200" align="left">CNPJ</th>
            <th width="60">Ação</th>
            </tr>
            </thead>
            <tbody>
			<?php
                while($rowEmail=mysql_fetch_array($sqlEmail)){
            ?>            
            <tr>
            <td><?php echo $rowEmail['EMPRESA']; ?></td>
            <td><?php echo $rowEmail['CNPJ']; ?></td>
            <td align="center">
            <a title="Excluir" href="#" name="excluirEmpresa" id="<?php echo $rowEmail['CO_PESSOA']; ?>"><img src="img/btn/btn_excluir.gif" width="25" height="19" border="0"/></a>
            <input type="hidden" id="codigoPessoaJuridica" name="codigoPessoaJuridica" value="<?php echo $rowEmail['CO_PESSOA_JURIDICA'];?>">
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