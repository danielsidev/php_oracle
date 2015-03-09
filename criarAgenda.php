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
require_once 'model/CrudDAO.Class.php';

$query="create table agenda_contato("
    ."id number(10),"
    ."nome varchar(25),"
    ."sobrenome varchar(25),"
    ."genero varchar(1),"
    ."telefone varchar(20),"
    ."celular varchar(20),"
    ."email varchar(100),"
    ."PRIMARY KEY (id))";

$dao = new CrudDAO();

$dao->createTable($query);

//header("Location:listaAgenda.php");


