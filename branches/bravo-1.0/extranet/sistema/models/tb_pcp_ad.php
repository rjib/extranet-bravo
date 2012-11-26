<?php
/**
 * Classe da camada de acesso a dados da tabela tb_pcp_ad
 * @author Ricardo S. Alvarenga
 * @since 31/10/2012
 *
 */
class tb_pcp_ad{

	private $conexaoERP;

	public function __construct($conexaoERP){
		$this->conexaoERP = $conexaoERP;

	}

	/**
	 * Metodo para listar todos os arquivos AD
	 * @author Ricardo S. Alvarenga
	 * @since 31/10/2012
	 * @return array
	 */
	public function listaTodosArquivos(){
		try {
			$sql = "SELECT * FROM tb_pcp_ad ORDER BY CO_PCP_AD ASC";
			$row = mysql_query($sql,$this->conexaoERP);
		}catch (Exception $e){
			return false;
		}
		return $row;
	}

	/**
	 * Metodo para inserir novo arquivo AD
	 * @param int $no_pcp_ad	nome do arquivo
	 * @param int $un_complementar
	 * @return boolean
	 * @author Ricardo S. Alvarenga
	 * @since 31/10/2012
	 */
	public function insert($no_pcp_ad, $un_complementar)
	{
		$sql = "INSERT INTO tb_pcp_ad (no_pcp_ad, un_complementar)
				VALUES (".addslashes($no_pcp_ad).",".addslashes($un_complementar).")";
		if(!mysql_query($sql,$this->conexaoERP)){
			throw new Exception('Erro na inserção dos dados, favor contacte o suporte!');
		}
	}

	/**
	 * Metodo para exibir o max id
	 * @author Ricardo S. Alvarenga
	 * @since 01/11/2012
	 * @return boolean|multitype:
	 */
	public function maxId(){

		$sql = 'SELECT MAX(co_pcp_ad) co_pcp_max_id, no_pcp_ad FROM tb_pcp_ad where co_pcp_ad = (SELECT MAX(co_pcp_ad) FROM tb_pcp_ad)';
		try {
			$result = mysql_query($sql, $this->conexaoERP);
			$row = mysql_fetch_row($result);
		}catch (Exception $e)
		{
			return false;
		}
		return $row;

	}

	/**
	 * Metodo para verificar se exite um registro com mesmo código
	 * @param int $id	nome do arquivo 
	 * @return boolean|number
	 */
	public function existeRegistro($id){
		$query = 'SELECT co_pcp_ad FROM tb_pcp_ad WHERE co_pcp_ad = '.addslashes($id);
		try {
			$result = mysql_query($query);
			$row = mysql_num_rows($result);
		}catch (Exception $e){
			return false;

		}
		return $row;
	}
	
	/**
	 * Metodo para verificar se um ac ja foi gerado para um determinado .AD
	 * @author Ricardo S. Alvarenga
	 * @return String
	 * @since 09/11/2012
	 */
	public function adUploaded($co_pcp_ac){
		$sql = "SELECT COUNT(*) flg 
				FROM tb_pcp_ac 
				WHERE co_pcp_ac = ".$co_pcp_ac;
		$row = mysql_fetch_array(mysql_query($sql,$this->conexaoERP));
		
		return $row[0];
		
	}
	
	/**
	 * Metodo para retornar o lote de um arquivo ad
	 * @author Ricardo S. Alvarenga
	 * @param int $co_pcp_ad codigo do ad
	 * @return String
	 * @since 22/11/2012
	 */
	public function findByLote($co_pcp_ad){
		$query = "SELECT DISTINCT 
					    nu_lote
					FROM
					    tb_pcp_ad_peca PCP_AD_PECA
					        INNER JOIN
					    tb_pcp_op ORDEM_PRODUCAO ON PCP_AD_PECA.co_pcp_op = ORDEM_PRODUCAO.co_pcp_op
					WHERE
					    PCP_AD_PECA.co_pcp_ad = ".$co_pcp_ad;
		$row = mysql_fetch_array(mysql_query($query, $this->conexaoERP));
		return $row[0];
		
	}
}
?>