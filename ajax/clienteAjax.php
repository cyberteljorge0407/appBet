<?php
$peticionAjax=true;
require_once "../core/config.php";

if( isset($_GET['consultarCliente']) ){
	
require_once "../controller/ClienteController.php";
 $inst = new ClienteController();

 if(isset($_GET['consultarCliente'])){

echo $inst->consultarClienteController($_GET['txtConsultaPlayer']);	
	}



}

