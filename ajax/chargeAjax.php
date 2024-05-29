<?php
$peticionAjax=true;
require_once "../core/config.php";

if( isset($_GET['consultarCliente']) || isset($_POST['save'])  || isset($_POST['datatable'])  || isset($_GET['updateMonto']) ){
	
require_once "../controller/ChargeController.php";
 $inst = new ChargeController();


 if(isset($_GET['consultarCliente'])){

echo $inst->consultarChargeController($_GET['txtConsultaPlayer']);	
	}

	if(isset($_POST['save'])){

echo $inst->saveRecargaController();	
	}	

		if(isset($_POST['datatable'])){
	
echo $inst->listHistoryChargeController($_REQUEST,$_POST['status']);
}	


		if(isset($_GET['updateMonto'])){
	
echo $inst->updateMontoController($_GET['idCharge'],$_GET['monto']);
}	



}

