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
	 * @param int $cod_pcp_ad
	 * @param int $un_complementar
	 * @return boolean
	 * @author Ricardo S. Alvarenga
	 * @since 31/10/2012
	 */
	public function insert($cod_pcp_ad, $un_complementar)
	{
		$sql = "INSERT INTO tb_pcp_ad (co_pcp_ad, un_complementar)
				VALUES (".addslashes($cod_pcp_ad).",".addslashes($un_complementar).")";
		if(!mysql_query($sql,$this->conexaoERP)){
			throw new Exception('Erro na inserção dos dados, favor contacte o suporte2!');
		}
	}

	/**
	 * Metodo para exibir o max id
	 * @author Ricardo S. Alvarenga
	 * @since 01/11/2012
	 * @return boolean|multitype:
	 */
	public function maxId(){

		$sql = 'SELECT MAX(co_pcp_ad) co_pcp_max_id FROM tb_pcp_ad;';
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
	 * Metodo para verificar se exite um registro com mesmo id
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
}
?>