<?php

class DAO {
  
     protected $db;
     private $host="localhost";
     private $dbname="xe";
     private $user="system";
     private $password="123";

    public function __construct() {

    
        try {
           $conn = $this->db = oci_connect($this->user,$this->password, $this->host.'/'.$this->dbname);
            if (!$conn) {
		echo "ERRO ao conectar!";
                throw new Exception("Não foi possível conectar ao banco!");
            }else{
		//echo "Conectado ao banco Oracle com sucesso!";
	}
        } catch (Exception $e) {
            echo $e->getMessage() . "<br>Error na linha:  ";
            echo "<b>" . $e->getLine() . "</b>";
           oci_close($this->db );
        }
    }
    
    public function fechar(){
         oci_close($this->db );
        
    }

}

//new DAO();
/*
ORACLE_HOME=/u01/app/oracle/product/11.2.0/xe ./configure --with-pdo-oci=instantclient,/usr/lib/oracle/11.2/client64/lib/,11.2

*/
?>



