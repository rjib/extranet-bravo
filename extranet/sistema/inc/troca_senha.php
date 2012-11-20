<?php

require_once '../setup.php';
require_once '../models/tb_usuario.php';
require_once '../helper.class.php';


/*
 * var senhaAntiga 	= $("#senhaAntiga").val();
		var senhaNova 		= $("#senhaNova").val();
		var confirmaSenha 	= $("#confirmaSenha").val();
		var codigoUsuario 	= $("#codigoUsuario").val();
 * */
session_start();
$co_usuario = $_SESSION['codigoUsuario'];

if(!empty($_POST['codigoUsuario']) || !empty($_POST['senhaAntiga']) || !empty($_POST['senhaNova'])){

		$_usuario		 = new tb_usuario($conexaoERP);
		$row = $_usuario->findByUser($co_usuario);
		$senhaAntiga	 = crypt($_POST['senhaAntiga'],$row['PASS_USUARIO']);
		$pass_usuario	 = crypt($_POST['senhaNova']);
		

		try {
			
			if($senhaAntiga==$row['PASS_USUARIO']){
				$_usuario->updateSenha($co_usuario, $pass_usuario);
				$data['erro'] = 0; //sucesso na operacao
			}
			else{
				$data['erro']=1; //senha antiga nao coicide			
			}
			
		}catch (Exception $e){
			$data['erro'] = 2; // erro na persistencia

		}

}else{

	$data['erro'] = 3; //campo em branco
}
echo json_encode($data['erro']);

