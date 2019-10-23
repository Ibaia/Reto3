<?php
include_once ("../Model/Usuario/usuarioModel.php");

$email = $_POST["email"];
//
$sql = "SELECT * FROM usuarios WHERE email LIKE '$email'";

$result = //EXECUTE SQL

$erantzuna = array();
$erantzuna["existe"] = false;


if($_POST["pass"] == $result["pass"]){
    $erantzuna["existe"] = true;
    
}


if($email == "admin@gmail.com")
    $erantzuna["mota"] = "admin";
else
    $erantzuna["mota"] = "user";
        
        
echo json_encode($erantzuna)

?>