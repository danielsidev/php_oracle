<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html ; charset=utf-8');
echo "<meta http-equiv=\"Content-type\" content=\"text/html; charset=utf-8\" />";
require_once 'CrudDAO.Class.php';

if(isset($_POST)){
    
    $dados = array();        
    
    foreach ($_POST as $key => $value) {
        $dados[$key] = $value;
    }
    
    unset($dados["cadastrar"]); //O foreach pega o post do submit, logo precisamos removê-lo
    
    /* @CRIE UMA SEQUENCE PARA A TABELA
     ************************************      
      CREATE SEQUENCE seq_agenda_contato
      MINVALUE 1
      MAXVALUE 99999
      START WITH 1
      INCREMENT BY 1
      CACHE 10;
     ************************************
      */
    
    $dados["id"] = "seq_agenda_contato.nextval";
    $tabela="agenda_contato";
    
    $dao = new CrudDAO();    
    $dao->insert($tabela, $dados) ;
}
    header("Location:listaAgenda.php");
?>
