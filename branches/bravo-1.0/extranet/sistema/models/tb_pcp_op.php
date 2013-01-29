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
	 * Metodo para retornar o codigo do produto
	 * @param int $co_pc_op
	 * @return multitype:
	 * @author Ricardo S. Alvarenga
	 * @since 27/12/2012
	 */
	public function getCoProduto($co_pc_op){
		$query  = "select CO_PRODUTO, (qtd_produto-qtd_processada) QTD_PROCESSADA, QTD_PROCESSADA QTD_PROCESSADA_ATUAL from tb_pcp_op where co_pcp_op = ".$co_pc_op;
		$result = mysql_query($query, $this->conexaoERP);
		$row 	= mysql_fetch_array($result);
		return $row;
		
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
		$query = "SELECT 
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
									PCP_OP.QTD_PROCESSADA
								FROM
									tb_pcp_op AS PCP_OP
										INNER JOIN
									tb_pcp_produto AS PCP_PRODUTO ON PCP_OP.CO_PRODUTO = PCP_PRODUTO.CO_PRODUTO
										INNER JOIN
									tb_pcp_cor AS PCP_COR ON PCP_PRODUTO.CO_COR = PCP_COR.CO_COR
								WHERE								
									PCP_OP.DT_EMISSAO BETWEEN '".$dataInicial."' AND '".$dataFinal."'
									AND PCP_PRODUTO.CO_COR ='".$cor."' 
									AND PCP_PRODUTO.NU_ESPESSURA in (".$espessura.")
									AND PCP_OP.CO_PCP_OP = ".$co_pcp_op."
								ORDER BY PCP_PRODUTO.CO_COR ASC ";
		$row = mysql_query($query,$this->conexaoERP)
		or die($this->_helper->alertErrorBackParam('Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!','ordem_producao'));
		
		if(mysql_num_rows($row) == 0){
			$this->_helper->alertDialog('N&atilde;o existe PIs cadastrados, por favor entre em contato com o Suporte.');
			exit;
		}//fim mysql_num_rows
	 return $row;
	}//fim listaPi
	
	
	/**
	 * Metodo para marcar PI como processado (gerado AC) e adiciona a quantidade processada
	 * @param int $co_pcp_op
	 * @param int $co_pcp_ad	codigo do arquivo
	 * @param int $qtd_processada quantidade processada
	 * @return boolean
	 * @author Ricardo S Alvarenga
	 * @since 22/11/2012
	 */
	public function atualizaProcessadoComQuantidade($co_pcp_op, $qtd_processada){
		try {
			$sql = "UPDATE
			tb_pcp_op
			SET QTD_PROCESSADA = ".$qtd_processada." 
			WHERE CO_PCP_OP = ".$co_pcp_op;
			mysql_query($sql,$this->conexaoERP);
		}catch (Exception $e){
		$this->_helper->alertError('Ocorreu algum erro durante a atualização, favor entrar em contato com o suporte!');
			exit;
		}
	}
	

	/**
	 * Metodo para retornar o co_pcp_op de um plano de corte arquivo ac que não existe no arquivo AD
	 * @param string $co_int_prod
	 * @param string $co_cor
	 * @param string $nu_lote
	 * @since 08/11/2012
	 * @return multitype:
	 */
	public function getCoPcpOPPisDeUmPlanoDeCorte($co_int_prod,$co_cor,$nu_lote){
		$sql = "SELECT ORDEM_PRODUCAO.co_pcp_op
					   , ORDEM_PRODUCAO.qtd_produto
					   , CONCAT(ORDEM_PRODUCAO.co_num,ORDEM_PRODUCAO.co_item,ORDEM_PRODUCAO.co_sequencia) 
					   , ORDEM_PRODUCAO.qtd_processada
					   , ORDEM_PRODUCAO.co_pcp_op
					   , PRODUTO.nu_comprimento
				       , PRODUTO.nu_largura
				FROM tb_pcp_op ORDEM_PRODUCAO
			        INNER JOIN
			    tb_pcp_produto PRODUTO ON ORDEM_PRODUCAO.co_produto = PRODUTO.co_produto
					LEFT JOIN 
			    tb_pcp_ad_peca PCP_AD_PECA ON ORDEM_PRODUCAO.co_pcp_op = PCP_AD_PECA.co_pcp_op
				WHERE PRODUTO.co_int_produto = '".$co_int_prod."'
				 AND PRODUTO.co_cor = '".$co_cor."'
				 AND ORDEM_PRODUCAO.nu_lote = '".$nu_lote."'
				 AND ORDEM_PRODUCAO.fl_delet IS NULL
				 AND ORDEM_PRODUCAO.co_pcp_op NOT IN (SELECT DISTINCT co_pcp_op FROM tb_pcp_ad_peca AD_PECA)";
		$row = mysql_query($sql,$this->conexaoERP);		
		return $row;
	}
	
	/**
	 * Metodo para retornar se o produto é tock stok ou não
	 * @param int $co_pcp_ad
	 * @author Ricardo S. Alvarenga
	 * @since 28/01/2013
	 */
	public function getTockStok($co_pcp_ad){
		$sql = "SELECT fl_tockstok FROM tb_pcp_ad WHERE co_pcp_ad = ".$co_pcp_ad;
		$result = mysql_query($sql, $this->conexaoERP);
		$row = mysql_fetch_array($result);
		return $row[0];
		
	}
	
	public function getCoPcpOPPisDeUmPlanoDeCorteExistenteAD($co_int_prod,$co_cor,$nu_lote){
		$sql = "SELECT DISTINCT
				    ORDEM_PRODUCAO.co_pcp_op,
				    ORDEM_PRODUCAO.qtd_produto,
				    CONCAT(ORDEM_PRODUCAO.co_num,
				            ORDEM_PRODUCAO.co_item,
				            ORDEM_PRODUCAO.co_sequencia),
				    ORDEM_PRODUCAO.qtd_processada,
				    ORDEM_PRODUCAO.co_pcp_op,
				    PRODUTO.nu_comprimento,
				    PRODUTO.nu_largura
				FROM
				    tb_pcp_op ORDEM_PRODUCAO
				        INNER JOIN
				    tb_pcp_produto PRODUTO ON ORDEM_PRODUCAO.co_produto = PRODUTO.co_produto
				        LEFT JOIN
				    tb_pcp_ad_peca PCP_AD_PECA ON ORDEM_PRODUCAO.co_pcp_op = PCP_AD_PECA.co_pcp_op
				WHERE ";
		$sql .="PRODUTO.co_int_produto = '".$co_int_prod."'
				        AND PRODUTO.co_cor = '".$co_cor."'
				        AND ORDEM_PRODUCAO.nu_lote = '".$nu_lote."'
				        AND ORDEM_PRODUCAO.fl_delet IS NULL
				        AND ORDEM_PRODUCAO.co_pcp_op IN (SELECT DISTINCT AD_PECA2.co_pcp_op FROM tb_pcp_ad_peca AD_PECA2 INNER JOIN tb_pcp_op ORDEM_PRODUCAO2 ON ORDEM_PRODUCAO2.co_pcp_op = AD_PECA2.co_pcp_op WHERE ORDEM_PRODUCAO2.qtd_processada <> ORDEM_PRODUCAO2.qtd_produto)";
		$row = mysql_fetch_row(mysql_query($sql,$this->conexaoERP));
		return $row;
	}
	
	/**
	 * Metodo para retornar o co_pcp_op de um plano de corte que existe no arquivo AD
	 * @param string $co_int_prod
	 * @param string $co_cor
	 * @param string $nu_lote
	 * @since 22/11/2012
	 * @return multitype:
	 */
	public function getCoPcpOPPisDeUmPlanoDeCorteExistente($co_int_prod,$co_cor,$nu_lote,$co_pcp_ad){
								
		$sql = "SELECT ORDEM_PRODUCAO.co_pcp_op, 
					ORDEM_PRODUCAO.qtd_produto, 
					ORDEM_PRODUCAO.qtd_processada, 
					ORDEM_PRODUCAO.co_pcp_op,
					PRODUTO.nu_comprimento,
					PRODUTO.nu_largura,
					PCP_AD.fl_tockstok
				FROM tb_pcp_op ORDEM_PRODUCAO
					INNER JOIN
					tb_pcp_produto PRODUTO ON ORDEM_PRODUCAO.co_produto = PRODUTO.co_produto
					INNER JOIN
					tb_pcp_ad_peca PCP_AD_PECA ON ORDEM_PRODUCAO.co_pcp_op = PCP_AD_PECA.co_pcp_op
					INNER JOIN
					tb_pcp_ad PCP_AD ON PCP_AD_PECA.co_pcp_ad = PCP_AD.co_pcp_ad
				WHERE PRODUTO.co_int_produto = '".$co_int_prod."'
				 AND PRODUTO.co_cor = '".$co_cor."'
				 AND ORDEM_PRODUCAO.nu_lote = '".$nu_lote."'
				 AND ORDEM_PRODUCAO.fl_delet IS NULL 
				 AND PCP_AD.co_pcp_ad = ".$co_pcp_ad."  AND ORDEM_PRODUCAO.qtd_produto <> ORDEM_PRODUCAO.qtd_processada";
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
	
	/**
	 * Metodo listar todos os pis que ja foram gerados ac
	 * @param int $co_pcp_op	Primary key da tabela pcp_op
	 * @author Ricardo S. Alvarenga
	 * @since 22/11/2012
	 * @return multitype:
	 */
	public function getQtdProduto($co_pcp_op){
		$query = "SELECT qtd_produto, qtd_processada, CONCAT(co_num,co_item,co_sequencia) nu_op, nu_lote, co_produto FROM tb_pcp_op WHERE co_pcp_op = ".$co_pcp_op;
		$result = mysql_query($query, $this->conexaoERP);
		$row = mysql_fetch_row($result);
		return $row;
		
	}
	/**
	 * Metodo retornar a quantidade maxima de produtos a serem produzidas
	 * @param string $co_int_produto
	 * @param string $lote
	 * @param string $co_produto
	 * @author Ricardo S. Alvarenga
	 * @since 03/01/2012
	 * @return multitype:
	 */
	public function getTotalProduto($co_int_produto,$lote,$co_produto){
		$query = "select sum(qtd_produto) QTD_PRODUTO from tb_pcp_op OP 
					inner join tb_pcp_produto PROD on OP.CO_PRODUTO = PROD.CO_PRODUTO
				  where PROD.co_int_produto = '".$co_int_produto."' and OP.nu_lote = '".$lote."' AND OP.CO_PRODUTO = '".$co_produto."' AND OP.FL_DELET IS NULL group by OP.co_produto";
		
		$result = mysql_query($query, $this->conexaoERP);
		$row = mysql_fetch_row($result);
		return $row;
	
	}
	
	/**
	 * Metodo verificar se todas as op selecionadas sao do mesmo lote
	 * @param int $co_pcp_op	Primary key da tabela pcp_op
	 * @author Ricardo S. Alvarenga
	 * @since 23/11/2012
	 * @return multitype:
	 */
	public function getMesmoLote($co_pcp_op){
		$row = $this->getQtdProduto($co_pcp_op[0]);
		$lote = $row[3];
		for($i=0;$i<count($co_pcp_op); $i++){
			$row = $this->getQtdProduto($co_pcp_op[$i]);
			if(trim($lote) != trim($row[3])){
				return false;
			}
			
		}
		return true;
		
	}
	
	/**
	 * Metodo para retornar uma op
	 * @param int $co_pcp_op	Primary key da tabela pcp_op
	 * @author Ricardo S. Alvarenga
	 * @since 23/11/2012
	 * @return multitype:
	 */
	public function getProduto($co_pcp_op){
		$query  = "SELECT 
					    CONCAT(co_num, co_item, co_sequencia) NUM_OP,
					    OP.QTD_PRODUTO,
					    OP.DT_EMISSAO,
					    OP.NU_LOTE,
					    PRODUTO.DS_PRODUTO,
					    PRODUTO.CO_INT_PRODUTO,
					    PRODUTO.TP_PRODUTO,
					    COR.NO_COR,
					    PRODUTO.NU_ESPESSURA,
					    PRODUTO.NU_COMPRIMENTO,
					    PRODUTO.NU_LARGURA
					FROM
					    tb_pcp_op OP
					        INNER JOIN
					    tb_pcp_produto PRODUTO ON OP.co_produto = PRODUTO.co_produto
					        INNER JOIN
					    tb_pcp_cor COR ON PRODUTO.co_cor = COR.co_cor
					WHERE
					    OP.co_pcp_op = ".$co_pcp_op;
		$result = mysql_query($query, $this->conexaoERP);
		$row    = mysql_fetch_array($result);
		return $row;
	}
	
	/**
	 * Metodo para retornar parametros para enviar a casadei
	 * @param int $co_pcp_op
	 * @param int $co_produto
	 * @return multitype:
	 * @author Ricardo S. Alvarenga
	 * @since 27/12/2012
	 */
	public function getParametrosCasadei($co_pcp_op, $co_produto){
		$query = "SELECT prod.co_int_produto 
					, prod.co_cor 
					, op.nu_lote 
					, prod.nu_comprimento 
					, prod.nu_espessura 
					, prod.nu_largura 
				 from tb_pcp_op op 
					inner join tb_pcp_produto prod on op.co_produto = prod.co_produto
				where prod.co_produto = '".$co_produto."' 
				and op.co_pcp_op = ".$co_pcp_op;
		$result = mysql_query(strtoupper($query), $this->conexaoERP);
		$row    = mysql_fetch_array($result);
		return $row;
		
	}
	
		
}//fim classe