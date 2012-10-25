<?php
/**
 * Classe com helpers uteis
 * @author Ricardo S. Alvarenga
 * @since 25/10/2012
 *
 */
class helper{
	
	/**
	 * Metodo para ajustar data (DD/MM/YYYY) para (YYYYMMDD)
	 * @param string $data
	 * @return string
	 * @author Ricardo S. Alvarenga
	 * @since 25/10/2012
	 */
	public function ajustarDataYYYYmmdd($data){		
		$data 	 = substr($data ,6,4).substr($data ,3,2).substr($data ,0,2);
		return $data;
	}
}