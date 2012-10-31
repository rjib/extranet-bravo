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
	public function insert($cod_pcp_ad, $un_complementar){
		
		try {
			$sql = "INSERT INTO tb_pcp_ad (cod_pcp_ad, un_complementar) VALUES (".addslashes($cod_pcp_ad).",".addslashes($un_complementar).")";			
		}catch (Exception $e){
			return false;
		}
	}
}
?>