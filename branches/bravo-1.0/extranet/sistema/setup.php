<?php
/**
 * Constantes do sistema
 * @author Ricardo S. Alvarenga
 **/
define('URL', 'http://localhost/extranet-bravo/extranet/');
define ('DS', DIRECTORY_SEPARATOR);
define ('APP_PATH',realpath(dirname(__FILE__).DS.'..').DS);
define('DIMENSAO_MINIMA', 240);
define('MAX_PILHA',1350);


//MODULOS PRINCIPAIS
define('CONTROLE_DE_ACESSO', 'Controle de Acesso');
define('CADASTROS', 'Cadastros');
define('PCP', 'PCP');
define('TIPOS', 'Tipos');
define('CONFIGURACOES', 'Configurações');


//SUBMODULOS
define('CONTROLE_DE_ACESSO_VISITANTE', 'Visitantes');
define('CONTROLE_DE_ACESSO_CONSULTORES', 'Prestador de Serviço');

define('CADASTROS_BAIRROS', 'Bairros');
define('CADASTROS_CARGOS', 'Cargos');
define('CADASTROS_CARTAO_IDENTIFICACAO', 'Cartão Identificação');
define('CADASTROS_CEP', 'CEPs');
define('CADASTROS_CIDADE', 'Cidades');
define('CADASTROS_COLABORADORES', 'Colaboradores');
define('CADASTROS_CONSULTORES', 'Prestador de Serviço');
define('CADASTROS_ESTADOS', 'Estados');
define('CADASTROS_ESTADO_CIVIL', 'Estado Civil');
define('CADASTROS_NIVEL_DE_FORMACAO', 'Nível de Formação');
define('CADASTROS_NACIONALIDADE', 'Nacionalidade');
define('CADASTROS_PESSOAS', 'Pessoas');
define('CADASTROS_SETORES', 'Setores');
define('CADASTROS_USUARIOS', 'Usuários');

define('PCP_GERAR_PLANO_DE_CORTE', 'Gerar Plano de Corte');
define('PCP_IMPORTAR_PLANO_DE_CORTE_OPTISAVE', 'Importar Plano de Corte Optisave');
define('PCP_LISTA_DE_CORES', 'Lista de Cores');
define('PCP_ORDEM_DE_PRODUCAO', 'Ordem de Produção');
define('PCP_APONTAMENTO', 'Apontamento');
define('PCP_MOTIVO_PARADA', 'Motivo Parada');
define('PCP_RECURSO', 'Recursos');

define('TIPOS_SANGUINEO', 'Sanguineo');
define('TIPOS_EMAIL', 'E-mail');
define('TIPOS_TELEFONE', 'Telefone');
define('TIPOS_VEICULO', 'Veiculo');

define('CONFIGURACOES_MODULOS', 'Módulos');
define('CONFIGURACOES_PAPEIS', 'Papel');
define('CONFIGURACOES_TROCA_SENHA', 'Trocar Senha');


//fim alteracao Ricardo S. Alvarenga
	
	
	header('Content-Type: text/html; charset=utf-8');	
	$conexaoERP = mysql_connect("localhost","root","")
	or die ("<script>
			     alert('[Erro] - CONFIGURAÇÃO DO BANCO DE DADOS!');
				 window.location = 'index.php';
			 </script>");
	
	define('CONEXAOERP', $conexaoERP); //CONEXAO STATIC
	
	$dbERP = mysql_select_db("extranet",$conexaoERP)
	or die ("<script>
			     alert('[Erro] - CONFIGURAÇÃO DO BANCO DE DADOS!');
				 window.location = 'index.php';
			 </script>");	
	
	class Connection extends PDO {

	    private $dsn = 'mysql:dbname=extranet;host=localhost';
	    private $user = 'root';
	    private $pass = '';
        protected $dbh = null;

        public function __construct(){
		    try{
			    $this->dbh = parent::__construct($this->dsn , $this->user , $this->pass, array(PDO::ATTR_PERSISTENT => true));
		    }
		    catch(PDOException $e){
			    $this->dbh = 'Connection failed: '.$e->getMessage();
		    }
            return $this->dbh;
	    }

        public function __destruct(){
 		    $this->dbh = null;
	    }
		
    }
	
	mysql_query("SET NAMES 'utf8'");
    mysql_query('SET character_set_connection=utf8');
    mysql_query('SET character_set_client=utf8');
    mysql_query('SET character_set_results=utf8');
	
    
?>