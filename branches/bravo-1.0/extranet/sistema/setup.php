<?php
	
	header('Content-Type: text/html; charset=utf-8');	
	$conexaoERP = mysql_connect("localhost","root","")
	or die ("<script>
			     alert('[Erro] - CONFIGURAÇÃO DO BANCO DE DADOS!');
				 window.location = 'index.php';
			 </script>");
	
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