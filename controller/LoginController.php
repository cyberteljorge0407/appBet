<?php 
if ($peticionAjax==true) {
	require_once "../model/mainModel.php";
}else{
	require_once "./model/mainModel.php";
}

class LoginController extends mainModel
{
	
	public function signInController(){

 	$tipeuser=0;
  	    $email= mainModel::limpiar_cadena($_POST['email']);
		$password= mainModel::limpiar_cadena($_POST['password']);
		$rememberme="";
		if (isset($_POST['rememberme'])) {
		$rememberme=mainModel::limpiar_cadena($_POST['rememberme']);
		}

  $consulta =mainModel::execute_query("SELECT t1.* , t2.name as nameType FROM tusuarios as t1 INNER JOIN ttypeuser as t2 on t1.idTypeUser = t2.idTypeUser  WHERE  t1.email='$email' AND  t1.password='$password'");
	
		if($consulta->rowCount()>=1){
			
			 	$tipeuser=1;

			$req = $consulta->fetch(PDO::FETCH_ASSOC);
     $dato=$req['idUser'];
     $idPersonal=mainModel::encryption($dato);
      $fullname=$req["names"];
      $nombreCargo = $req["nameType"];
  	 
        $primername=explode(" ",$fullname);
        $password=mainModel::encryption($password);
       session_start();
       
       $_SESSION['Encryuser']=$idPersonal;
       $_SESSION['Nameuser']=$primername[0];
       $_SESSION['Encrycargo']=$idCargo;
			$_SESSION['cargo'] = $nombreCargo;
       $_SESSION['Emailuser']=$email;
       $_SESSION['token_wce']=md5(uniqid(mt_rand(),true));


      header("location: ".SERVERURL."home");
		}
		
		
	}

public function sessionDistroy(){
	session_start();
	session_destroy();
	header("location: ".SERVERURL."login");
	//echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}	
}