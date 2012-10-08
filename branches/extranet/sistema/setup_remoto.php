<?php
	
	header('Content-Type: text/html; charset=utf-8');       
	
	$conexaoERP = mysql_connect("186.202.152.17","s2negocios","jesusetudo")
	or die ("<script>
			     alert('[Erro] - CONFIGURAÇÃO DO BANCO DE DADOS!');
				 window.location = 'inicio.php';
			 </script>");
	
	$dbERP = mysql_select_db("s2negocios",$conexaoERP)
	or die ("<script>
			     alert('[Erro] - CONFIGURAÇÃO DO BANCO DE DADOS!');
				 window.location = 'inicio.php';
			 </script>");	
	
	class Connection extends PDO {

	    private $dsn = 'mysql:dbname=s2negocios;host=186.202.152.17';
	    private $user = 's2negocios';
	    private $pass = 'jesusetudo';
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