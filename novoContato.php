<?php

header('Content-Type: text/html ; charset=utf-8');
echo "<meta http-equiv=\"Content-type\" content=\"text/html; charset=utf-8\" />";
$url="";
$contatos= array("nome"=>"", "sobrenome"=>"", "genero"=>"", "telefone"=>"", "celular"=>"", "email"=>"");
$id=0;
$iduser=0;
$label="";
if(isset($_GET["id"]) && $_GET["id"]>0){


$id = $_GET["id"];
$url="editar.php";
$label="Editar";

require_once 'CrudDAO.Class.php';
$dao = new CrudDAO();

$stid = $dao->read("agenda_contato", null, "where id=".$id);
oci_fetch_all($stid, $contato);

$iduser = $res["IDUSUARIOS"][0];
$nome=$res["NOME"][0];
$sobrenome=$res["SOBRENOME"][0];


$iduser = $contato["ID"][0];
$contatos["nome"]=$contato["NOME"][0];
$contatos["sobrenome"]=$contato["SOBRENOME"][0];
$contatos["genero"] = $contato["GENERO"][0];
$contatos["telefone"] = $contato["TELEFONE"][0];
$contatos["celular"] = $contato["CELULAR"][0];
$contatos["email"] = $contato["EMAIL"][0];

if(isset($iduser) && $iduser>0){
$url="editar.php";
$label="Editar";
}else{
$url="inserir.php";
$label="Cadastrar";
}

}else{
$url="inserir.php";
$label="Cadastrar";
}
?>
<style type="text/css">
    body{ font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;}
    
    input[type="text"], input[type="email"], select{ 
        width: 20%;
        height: 30px;
        padding: 5px;
        border: 1px solid #ccc ;        
        border-radius: 3px;
        box-shadow: 0px 2px 2px #ccc;
    }
    
    input[type="submit"]{
        background: #666;        
        color: #fff;
        width: 100px;
        height: 30px;
        padding: 5px;
        border: 1px solid #ccc ;        
        border-radius: 3px;
        box-shadow: 0px 2px 2px #ccc;
        cursor: pointer;
    }   
    
    input[type="submit"]:hover{
            background: #ccc;        
            color: #333;
    }
    
     hr{ width: 0%; opacity: 0;}
</style>

<form method="post" action="<?=$url ?>">
<input type="hidden" name="id" id="id" value="<?=$iduser ?>"/>
Nome:<br/>
<input type="text" name="nome" id="nome" value="<?=$contatos["nome"] ?>" /><hr/>
Sobrenome:<br/>
<input type="text" name="sobrenome" id="sobrenome" value="<?=$contatos["sobrenome"] ?>" /><hr/>

Gênero:<br/>
<select name="genero" id="genero">
    <option value="<?=$contatos["genero"] ?>"><?=$contatos["genero"] ?></option>
    <option value="F">F</option>
    <option value="M">M</option>
    
</select><hr/>

Telefone:<br/>
<input type="text" name="telefone" id="telefone" value="<?=$contatos["telefone"] ?>" /><hr/>

Celular:<br/>
<input type="text" name="celular" id="celular" value="<?=$contatos["celular"] ?>" /><hr/>

E-mail:<br/>
<input type="email" name="email" id="email" value="<?=$contatos["email"] ?>" /><hr/>
<input type="submit" name="cadastrar" id="cadastrar" value="<?=$label ?>" /><br/>

</form>
<hr/>
<a href='listaAgenda.php'> << Voltar</a>
