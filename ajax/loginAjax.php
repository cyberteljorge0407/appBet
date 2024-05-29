<?php


$peticionAjax=true;

require_once "../core/config.php";

if(isset($_POST['login']) || isset($_GET['salir'])){
	
require_once "../controller/LoginController.php";
 $inst = new LoginController();
	if(isset($_POST['login'])){
$inst->signInController();	
	}
	if (isset($_GET['salir'])) {
	echo $inst->sessionDistroy();
}




}else{


	echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}

