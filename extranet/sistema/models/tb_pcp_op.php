<?php 
require_once("../../setup.php");

/**
* Classe da camada de acesso a dados ordem de producao por pi
* @author Ricardo Santos Alvarenga
* @since 23/10/2012
*/

class tb_pcp_op{
	
	private $conexaoERP;
	private $_helper;
	
	public function __construct($conexaoERP){
		$this->conexaoERP = $conexaoERP;
		$this->_helper = new helper();
	
	}

	/**
	 * Metodo para listar PIs de acordo com os parametros desejados
	 * @param int $cor
	 * @param int $espessura
	 * @param int $dataInicial
	 * @param int $dataFinal
	 * @param int $co_pcp_op
	 * @param object $conexaoERP
	 * @return array
	 * @author Ricardo S. Alvarenga
	 * @since 23/10/2012
	 */
	public function listaPi($cor,$espessura,$dataInicial, $dataFinal,$co_pcp_op){	
		$row = mysql_query("SELECT 
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
		,$this->conexaoERP)
		or die($this->_helper->alertErrorBackParam('Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!','ordem_producao'));
		
		if(mysql_num_rows($row) == 0){
			$this->_helper->alertDialog('N&atilde;o existe PIs cadastrados, por favor entre em contato com o Suporte.');
			exit;
		}//fim mysql_num_rows
	 return $row;
	}//fim listaPi
	
	/**
	 * Metodo para marcar PI como processado (gerado AD)
	 * @param int $id_pcp_op
	 * @return boolean
	 * @author Ricardo S Alvarenga 
	 * @since 25/10/2012
	 */
	public function atualizaSelecionados($id_pcp_op){
		try {
			$sql = "UPDATE 
						tb_pcp_op 
					SET FL_SELECIONADO ='S' 
					WHERE CO_PCP_OP =".$id_pcp_op;
			mysql_query($sql,$this->conexaoERP);
		}catch (Exception $e){
			$this->_helper->alertError('Ocorreu algum erro durante a atualização, favor entrar em contato com o suporte!');
			exit;
		}		
	}
		
}//fim classe