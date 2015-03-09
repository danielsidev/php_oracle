<?php
/*******************************************************************
@A small web application in PHP 5. * OO to demonstrate how
@made the connection to the oracle (in this case the Oracle Xe 11g) and
@an example of generic CRUD with PDO.
@Developed by Daniel Mello Siqueira: http://danielsiqueira.net
********************************************************************/
class DAO {
  
     protected $db;
     private $host="localhost"; // ou o ip
     private $dbname="xe"; // nome do seu banco, caso esteja com a versão do oracle enterprise
     private $user="system";//system / sysdba / ou um usuário qualquer
     private $password="123"; //sua senha

    public function __construct() {

    
        try {
           $conn = $this->db = oci_connect($this->user,$this->password, $this->host.'/'.$this->dbname);
            if (!$conn) {
		        echo "ERRO ao conectar!";
                throw new Exception("Não foi possível conectar ao banco!");
            } /* else{echo "Conectado ao banco Oracle com sucesso!";} */
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
//new DAO(); //Para testar a conexão

?>



