<?php
	
	session_start();

    require("../../setup.php");	
	
	if(empty($_SESSION['codigoPessoa'])){
		echo "<table width='100%' border='0' cellspacing='0' cellpadding='4' class='LISTA'>";
		echo "<tr>";
		echo "<th align='center'>";
		echo "<font class='FONT06'><b>N&atilde;o h&aacute; endere&ccedil;o registrado no momento!</b></font>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
	}else{
	
	    $sqlEndereco = mysql_query("SELECT ENDERECO.CO_ENDERECO 
								        , CEP.NU_CEP
									    , CEP.NO_LOGRADOURO
									    , ENDERECO.NU_ENDERECO
									    , BAIRRO.NO_BAIRRO
									    , UF.DS_UF
									    , MUNICIPIO.NO_MUNICIPIO
									FROM tb_endereco ENDERECO
										INNER JOIN tb_cep CEP
									        ON ENDERECO.CO_CEP = CEP.CO_CEP
									    INNER JOIN tb_bairro BAIRRO
									        ON CEP.CO_BAIRRO = BAIRRO.CO_BAIRRO
									    INNER JOIN tb_municipio MUNICIPIO
									        ON BAIRRO.CO_MUNICIPIO = MUNICIPIO.CO_MUNICIPIO
									    INNER JOIN tb_uf UF
									        ON MUNICIPIO.CO_UF = UF.CO_UF
									WHERE ENDERECO.CO_PESSOA = '".$_SESSION['codigoPessoa']."'",$conexaoERP)
	    or die(mysql_error());

		if(mysql_num_rows($sqlEndereco) == 0){
		    echo "<table width='100%' border='0' cellspacing='0' cellpadding='4' class='LISTA'>";
			echo "<tr>";
			echo "<th align='center'>";
			echo "<font class='FONT06'><b>N&atilde;o h&aacute; endere&ccedil;o registrado no momento!</b></font>";
			echo "</td>";
			echo "</tr>";
			echo "</table>";
		}else{
?>
<script type="text/javascript">
$(document).ready(function(){
   
    $("#formularioDetalhesEndereco").dialog({
		autoOpen: false,
		height: 460,
		width: 610,
		modal: true,
		resizable: false,
		title: 'Detalhes Endere&ccedil;o2',
		buttons: {'Fechar': function() {
			$(this).dialog("close");
		}}
    });
   
   $("#confirmaExcluirEndereco").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: 'Excluir Endere&ccedil;o',
		buttons: {
			"Sim": function() {

				$.get('inc/cadastros/pessoa_endereco_ex.php', {codigoEndereco: codigoEndereco}, function(resposta) {
																																																																																																				
					if(resposta != false){
						$('<p>' + resposta + '</p>').dialog({
							modal: true,
							resizable: false,
							title: 'Aten&ccedil;&atilde;o',
							buttons: {
								Ok: function() {
									$( this ).dialog( "close" );
									$( "#confirmaExcluirEndereco" ).dialog( "close" );
								}
							}
						});
					}else{
					    $('<p>Endere&ccedil;o excluido com sucesso!</p>').dialog({
							modal: true,
							resizable: false,
							title: 'Aten&ccedil;&atilde;o',
							buttons: {
								Ok: function() {
									$( this ).dialog( "close" );
									$( "#confirmaExcluirEndereco" ).dialog( "close" );
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
	    $("#gridEndereco").load("inc/cadastros/pessoa_grid_endereco.php");
	}
	});
   
    $('a[name=detalhesEndereco]').click(function (event){
        event.preventDefault();		
        $("#formularioDetalhesEndereco").load('inc/cadastros/pessoa_endereco_detalhe.php?codigoEndereco='+$(this).attr("id"));
        $("#formularioDetalhesEndereco").dialog('open');
    });
	
	$('a[name=excluirEndereco]').click(function(e){
		e.preventDefault();
		codigoEndereco = $(this).attr("id");
		$("#confirmaExcluirEndereco").dialog("open");
    });
		
});
</script>
<div id="confirmaExcluirEndereco"><p>Deseja realmente excluir esse registro?</p></div>
<div id="formularioDetalhesEndereco"></div>
            <table width="960" border="0" cellpadding="3" cellspacing="2" class="LISTA">                        
            <thead>
            <tr>
            <th width="70">CEP</th>
            <th align="left">Logradouro</th>
            <th width="180" align="left">Bairro</th>
             <th width="150" align="left">Estado</th>
            <th width="180" align="left">Municipio</th>
            <th width="70">Ação</th>
            </tr>
            </thead>
            <tbody>
			<?php
                while($rowEndereco=mysql_fetch_array($sqlEndereco)){
            ?>            
            <tr>
            <td align="center"><?php echo $rowEndereco['NU_CEP']; ?></td>
            <td><?php echo $rowEndereco['NO_LOGRADOURO'].", ".$rowEndereco['NU_ENDERECO']; ?></td>
            <td><?php echo $rowEndereco['NO_BAIRRO']; ?></td>
            <td><?php echo $rowEndereco['DS_UF']; ?></td>
            <td><?php echo $rowEndereco['NO_MUNICIPIO']; ?></td>
            <td align="center">
            <a title="Detalhes" href="#" name="detalhesEndereco" id="<?php echo $rowEndereco['CO_ENDERECO']; ?>"><img src="img/btn/btn_mais.gif" width="25" height="19" border="0"/></a>
            <a title="Excluir" href="#" name="excluirEndereco" id="<?php echo $rowEndereco['CO_ENDERECO']; ?>"><img src="img/btn/btn_excluir.gif" width="25" height="19" border="0"/></a>
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