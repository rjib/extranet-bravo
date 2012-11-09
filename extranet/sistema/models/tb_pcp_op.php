<?php 
//require_once("../../setup.php");

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
									PCP_OP.CO_PCP_AD
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
	 * $param int $co_pcp_ad	nome do arquivo
	 * @return boolean
	 * @author Ricardo S Alvarenga 
	 * @since 25/10/2012
	 */
	public function atualizaProcessado($id_pcp_op, $co_pcp_ad){
		try {
			$sql = "UPDATE 
						tb_pcp_op 
					SET CO_PCP_AD = $co_pcp_ad
					WHERE CO_PCP_OP =".$id_pcp_op;
			mysql_query($sql,$this->conexaoERP);
		}catch (Exception $e){
			$this->_helper->alertError('Ocorreu algum erro durante a atualização, favor entrar em contato com o suporte!');
			exit;
		}		
	}
	
	
	/**
	 * Metodo para listar todos os pis de um plano de corte arquivo ad
	 * @param string $co_pcp_ad	nome do arquivo ad
	 * @param string $co_cor codigo da cor
	 * @author Ricardo S. Alvarenga
	 * @since 08/11/2012
	 * @return array
	 */
	public function listarTodosPisDeUmPlanoDeCorte($co_pcp_ad,$co_cor){
		$sql = "SELECT * 
				FROM tb_pcp_op op
					INNER JOIN tb_pcp_produto prod
					ON op.co_produto = prod.co_produto
				WHERE op.co_pcp_ad = '".$co_pcp_ad."'
					AND prod.co_cor = '".$co_cor."'";
		$row = mysql_query($sql,$this->conexaoERP);
		return $row;
	}

	/**
	 * Metodo para retornar o co_pcp_op de um plano de corte arquivo ad 
	 * @param string $co_int_prod
	 * @param string $co_cor
	 * @param string $nu_lote
	 * @since 08/11/2012
	 * @return multitype:
	 */
	public function getCoPcpOPPisDeUmPlanoDeCorte($co_int_prod,$co_cor,$nu_lote){
		$sql = "SELECT op.co_pcp_op
				FROM tb_pcp_op op
				  INNER JOIN tb_pcp_produto prod
				  ON op.co_produto = prod.co_produto
				WHERE prod.co_int_produto = '".$co_int_prod."'
				AND prod.co_cor = '".$co_cor."'
				AND op.nu_lote = '".$nu_lote."'";
		$row = mysql_fetch_row(mysql_query($sql,$this->conexaoERP));		
		return $row;
	}
	
	/**
	 * Metodo para listar todos as ops que tiveram divergencias na hora de importar o .ac
	 * @param int $co_pcp_op	Primary key da tabela pcp_op
	 * @author Ricardo S. Alvarenga
	 * @since 09/11/2012
	 * @return multitype:
	 */
	public function getDivergencias($co_pcp_op){
		
		try{
			$divergencias = "";
			for($i=0;$i<count($co_pcp_op); $i++){
				if($i==0){
					$divergencias.=$co_pcp_op[$i];
				}else{
					$divergencias.=",".$co_pcp_op[$i];
				}
					
			}
			$sql ="SELECT PRODUTO.co_int_produto,
					PRODUTO.ds_produto,
					ORDEM_PRODUCAO.qtd_produto,
					ORDEM_PRODUCAO.nu_lote
			  FROM tb_pcp_op ORDEM_PRODUCAO
					INNER JOIN tb_pcp_produto PRODUTO
					ON ORDEM_PRODUCAO.co_produto = PRODUTO.co_produto
					WHERE ORDEM_PRODUCAO.co_pcp_op in(".$divergencias.")";
			$row = mysql_query($sql,$this->conexaoERP);
		}catch (Exception $e){
			echo $e;
			return false;
		}
		return $row;
	}
		
}//fim classe