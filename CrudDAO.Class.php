<?php
require_once 'DAO.php';
/*****  CRUD PARA BANCO ORACLE *****/
class CrudDAO extends DAO {

    public function __construct() {

        parent::__construct(); //Faz a Conexão com o banco através da do construtor da classe Pai Conexão
    }
    
    /**Criar tabela**/
      public function createTable($query) {
        try {          
             $stmt = $query;
             $s = oci_parse($this->db, $stmt);
             $r = oci_execute($s);  // automatically commit
             parent::fechar();
             echo "Tabela criada com sucesso!"; 
        } catch (Exception $e) {
            echo $e->getMessage() . "<br>Error na linha:  "; //Pega a mensagem de erro definida
            echo "<b>" . $e->getTraceAsString() . "</b>"; //Mostra a linha do  erro!
            parent::fechar();
        }

 
    }
    
    
    
/********************Insere os dados**********************************/
    public function insert($tabela, Array $dados) {
  

        foreach ($dados as $inds => $vals) {
            $campos[] = $inds;
            $valores[] = $vals;
        }
        $campos = implode(",", $campos);
        $sequence = $valores[0]; 
	unset($valores[0]);
        $valores = "'" . implode("','", $valores) . "'";
	$valores = $sequence.", ".$valores;

        try {
            $stmt ="insert into {$tabela}({$campos}) values({$valores})";          
            $s = oci_parse($this->db, $stmt);
            $r = oci_execute($s);  // automatically commit
        } catch (Exception $e) {
            echo $e->getMessage() . "<br>Error na linha:  ";
            echo "<b>" . $e->getTraceAsString() . "</b>";
             parent::fechar();
        }
    }
    
        public function insertfree($tabela, Array $dados) {
  
        foreach ($dados as $inds => $vals) {
            $campos[] = $inds;
            $valores[] = $vals;
        }
        $campos = implode(",", $campos);
        $sequence = $valores[0]; 
	unset($valores[0]);
        $valores = "'" . implode("','", $valores) . "'";
	$valores = $sequence.", ".$valores;

        try {
            $stmt ="insert into {$tabela}({$campos}) values({$valores})";
            echo $stmt;
            $s = oci_parse($this->db, $stmt);
            $r = oci_execute($s);  // automatically commit
        } catch (Exception $e) {
            echo $e->getMessage() . "<br>Error na linha:  ";
            echo "<b>" . $e->getTraceAsString() . "</b>";
             
        }


    }

    /* Chamo método dessa forma:
     * $db = new Model(); 
     * $db->conecta();//Faz a conexão com o banco
     * $db->insert('tabela', array('campo1'=>'valor1', 'campo2'=>'valor2'));
     */
/********************Le os dados do banco(Retorna os dados)*****************************/
    public function read($tabela, $campos=null, $criterio=null) {
        
        ($campos == null) ? $campos = "*" : $campos = $campos;
        ($criterio == null) ? $criterio = "" : $criterio = $criterio;
        try{
	
	 $stid = oci_parse($this->db, "select {$campos} from {$tabela} {$criterio}");
	 $r = oci_execute($stid);
        return $stid;
        }
 catch (Exception $e){
      echo $e->getMessage() . "<br>Error na linha:  "; //Pega a mensagem de erro definida
            echo "<b>" . $e->getTraceAsString()."</b>"; //Mostra a linha do  erro! 
              parent::fechar();
 }
    }

public function returnCount($tabela){

   try {
     $query = "select count(*) c from ".$tabela;
     $stid = oci_parse($this->db, $query);
     oci_execute($stid);
     oci_fetch_all($stid, $res);
       echo "Number of rows: ", $res['C'][0], "<br>";
    } catch (Exception $e) {
       echo $e->getMessage() . "<br>Error na linha:  ";
       echo "<b>" . $e->getTraceAsString() . "</b>";
             
        }



}
/********************Atualiza os dados**********************************/
    public function update($tabela, Array $dados, $criterio) {

        foreach ($dados as $inds => $vals) {
            ////Se for inteiro atualiza como inteiro, senão acrescenta '' e atualiza como string
            (is_int($vals)) ? $vals = $vals : $vals = "'{$vals}'";
            $campos[] = "{$inds} ={$vals}";
        }
        $campos = implode(", ", $campos);
        try {
            $stmt ="update {$tabela} set {$campos} where {$criterio}";          
            $s = oci_parse($this->db, $stmt);
            $r = oci_execute($s);  // automatically commit

        } catch (Exception $e) {
            echo $e->getMessage() . "<br>Error na linha:  "; //Pega a mensagem de erro definida
            echo "<b>" . $e->getTraceAsString() . "</b>"; //Mostra a linha do  erro!  
            parent::fechar();
        }
    }
    
    public function updatefree($tabela, Array $dados, $criterio) {

        foreach ($dados as $inds => $vals) {
            ////Se for inteiro atualiza como inteiro, senão acrescenta '' e atualiza como string
            (is_int($vals)) ? $vals = $vals : $vals = "'{$vals}'";
            $campos[] = "{$inds} ={$vals}";
        }
        $campos = implode(", ", $campos);
        try {
            $stmt ="update {$tabela} set {$campos} where {$criterio}";          
            $s = oci_parse($this->db, $stmt);
            $r = oci_execute($s);  // automatically commit
        
        } catch (Exception $e) {
            echo $e->getMessage() . "<br>Error na linha:  "; //Pega a mensagem de erro definida
            echo "<b>" . $e->getTraceAsString() . "</b>"; //Mostra a linha do  erro!  
            
        }
    }
    


    
    /********************Deleta os dados**********************************/
    public function delete($tabela, $criterio) {
        try {          
             $stmt = "delete from {$tabela}  where {$criterio}";
             $s = oci_parse($this->db, $stmt);
             $r = oci_execute($s);  // automatically commit
             parent::fechar();
        } catch (Exception $e) {
            echo $e->getMessage() . "<br>Error na linha:  "; //Pega a mensagem de erro definida
            echo "<b>" . $e->getTraceAsString() . "</b>"; //Mostra a linha do  erro!
            parent::fechar();
        }

 
    }
    
    
    
    
    public function deletefree($tabela, $criterio) {
       try {          
             $stmt = "delete from {$tabela}  where {$criterio}";
             $s = oci_parse($this->db, $stmt);
             $r = oci_execute($s);  // automatically commit
             
        } catch (Exception $e) {
            echo $e->getMessage() . "<br>Error na linha:  "; //Pega a mensagem de erro definida
            echo "<b>" . $e->getTraceAsString() . "</b>"; //Mostra a linha do  erro!
            
        }
    }   

}

?>
