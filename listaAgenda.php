<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html ; charset=utf-8');
echo "<meta http-equiv=\"Content-type\" content=\"text/html; charset=utf-8\" />";
require_once 'CrudDAO.Class.php';

$dao = new CrudDAO();

$stid = $dao->read("agenda_contato");
echo"<style type='text/css'> th, td{padding:10px;} </style>";
echo "<a href='novoContato.php'>Novo Contato</a><hr/>";
print "<table border='1' cellspacing='0'>"
      ."<tr  style='padding:10px; margin:10px;'><th>Nome</th>  <th>Sobrenome</th>  <th>Gênero</th>  <th>Telefone</th>  <th>Celular</th> <th>E-mail</th><th colspan='2'>Controle</th></tr>";
$i=0;
while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
   
   print '<tr>';
   print "<td>".$row["NOME"]." </td> "
        ."<td>".$row["SOBRENOME"]."</td>"
        ."<td>".$row["GENERO"]."</td>"
        ."<td>".$row["TELEFONE"]."</td>"
        ."<td>".$row["CELULAR"]."</td>"
        ."<td>".$row["EMAIL"]."</td>"; 
   echo  "<td> <a href='novoContato.php?id=".$row["ID"]."'>Editar</a></td>";
   echo  "<td> <a href='excluir.php?id=".$row["ID"]."'>Excluir</a></td>";
   print '</tr>';

//var_dump($row);
$i++;
}
print '</table>';

