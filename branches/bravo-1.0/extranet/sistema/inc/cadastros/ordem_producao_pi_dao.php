<?php 
require_once("../../setup.php");

/**
* Classe da camada de acesso a dados ordem de producao por pi
* @author Ricardo Santos Alvarenga
* @since 23/10/2012
*/

class ordemProducaoPi{

	public function listaPi($cor,$espessura,$dataInicial, $dataFinal,$co_pcp_op,$conexaoERP){	
		$sqlPi = mysql_query("SELECT 
									PCP_OP.CO_PCP_OP,
									PCP_COR.DS_COR,
									PCP_OP.QTD_PRODUTO,
									PCP_OP.CO_NUM,
									PCP_OP.CO_ITEM,
									PCP_PRODUTO.CO_COR,
									PCP_PRODUTO.CO_INT_PRODUTO,
									PCP_PRODUTO.DS_PRODUTO,
									PCP_PRODUTO.NU_COMPRIMENTO,
									PCP_PRODUTO.NU_LARGURA,
									PCP_OP.DT_EMISSAO,
									PCP_PRODUTO.NU_ESPESSURA,
									PCP_OP.FL_SELECIONADO
								FROM
									tb_pcp_op AS PCP_OP
										INNER JOIN
									tb_pcp_produto AS PCP_PRODUTO ON PCP_OP.CO_PRODUTO = PCP_PRODUTO.CO_PRODUTO
										INNER JOIN
									tb_pcp_cor AS PCP_COR ON PCP_PRODUTO.CO_COR = PCP_COR.CO_COR
								WHERE								
									PCP_OP.DT_EMISSAO BETWEEN '".$dataInicial."' AND '".$dataFinal."'
									AND PCP_PRODUTO.CO_COR ='".$cor."' 
									AND PCP_PRODUTO.NU_ESPESSURA ='".$espessura."'
									AND PCP_OP.CO_PCP_OP = ".$co_pcp_op."
								ORDER BY PCP_PRODUTO.CO_COR ASC "
		,$conexaoERP)
		or die("<script>
					alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
					history.back(-1);
				</script>");
		
		if(mysql_num_rows($sqlPi) == 0){
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
			
				  
		}//fim mysql_num_rows
	 return $sqlPi;
	}//fim listaPi
	
		
}//fim classe