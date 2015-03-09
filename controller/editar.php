<?php
/*******************************************************************
@A small web application in PHP 5. * OO to demonstrate how
@made the connection to the oracle (in this case the Oracle Xe 11g) and
@an example of generic CRUD with PDO.
@Developed by Daniel Mello Siqueira: http://danielsiqueira.net
********************************************************************/
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html ; charset=utf-8');
echo "<meta http-equiv=\"Content-type\" content=\"text/html; charset=utf-8\" />";
require_once '../model/CrudDAO.Class.php';

if(isset($_POST)){
    
    $dados = array();        
    
    foreach ($_POST as $key => $value) {
        $dados[$key] = $value;
    }
    
    $tabela="agenda_contato";
    $criterio="id=".$dados["id"];
     
    unset($dados["id"]);
    unset($dados["cadastrar"]);

    $dao = new CrudDAO();
    $dao->update($tabela, $dados, $criterio);
}

 header("Location:../listaAgenda.php");


