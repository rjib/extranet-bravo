<?php
class tb_pcp_cor{

	private $conexaoERP;

	public function __construct($conexaoERP){
		$this->conexaoERP = $conexaoERP;

	}

	public function listaTodasCores(){
		try {
			$sql = "SELECT CO_COR, DS_COR, CO_RECNO FROM tb_pcp_cor ORDER BY DS_COR ASC";
			$row = mysql_query($sql,$this->conexaoERP);
		}catch (Exception $e){			
			return false;
		}
		return $row;
	}
}
?>