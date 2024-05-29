<?php 

if ($peticionAjax) {
	require_once "../model/mainModel.php";
}else{
	require_once "./model/mainModel.php";
}

class HomeController extends mainModel
{
 
 public function numRecargas(){
 	//session_start();
 	$idUser = mainModel::decryption($_SESSION['Encryuser']);

 	$sql = mainModel::execute_query("SELECT COUNT(*) as numRecargas from trecharge where idUser =  ".$idUser);
 	$row= $sql->fetch(PDO::FETCH_ASSOC);

 	return $row["numRecargas"];
 }

 public function numClientes(){
$idUser = mainModel::decryption($_SESSION['Encryuser']);

 	$sql = mainModel::execute_query("SELECT COUNT(*) as numPlayer from tplayer ");
 	$row= $sql->fetch(PDO::FETCH_ASSOC);

 	return $row["numPlayer"];
 }



	
}