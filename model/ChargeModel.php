<?php 

if ($peticionAjax) {
	require_once "../model/mainModel.php";
}else{
	require_once "./model/mainModel.php";
}

class ChargeModel extends mainModel
{
	protected function updateMontoChargeModel($idCharge,$monto){
	
			 $sql = mainModel::conect()->prepare("UPDATE trecharge set saldoActual = saldoActual - (SELECT monto from trecharge where idCharge= :idCharge ), monto = 0  WHERE idCharge = :idCharge;

			 	UPDATE trecharge set saldoActual = saldoActual + $monto , monto = :monto WHERE idCharge = :idCharge;

			 	UPDATE tplayer set saldo = (SELECT saldoActual from trecharge where idCharge = :idCharge)  WHERE idPlayer = (SELECT idPlayer from trecharge where idCharge = :idCharge);

			  ");
			 	 $sql->bindParam("idCharge",$idCharge);
				  $sql->bindParam("monto",$monto);
				   $sql->execute();
		return $sql;
	}

	protected function saveChargeModel($data){

		
		 $sql = mainModel::conect()->prepare("
		 	UPDATE trecharge set actual = 0 WHERE idPlayer = (SELECT idPlayer FROM tplayer WHERE PlayerID = :playerID );


		 	INSERT INTO trecharge(idPlayer,monto, idTypeComunication,idBank,fechaVaucher,horaVaucher, vaucher,saldoActual,idUser) VALUES((SELECT idPlayer FROM tplayer WHERE PlayerID = :playerID ),:monto,:idTypeComunication,:idBank,:fechaVaucher,:horaVaucher,:vaucher, (SELECT saldo from tplayer WHERE PlayerID = :playerID )+ :monto , :idUser  );
		 	UPDATE tplayer set saldo = ( :monto + (SELECT saldo from tplayer WHERE PlayerID = :playerID ) ) WHERE idPlayer = (SELECT idPlayer FROM tplayer WHERE PlayerID = :playerID );
		  ");
		  $sql->bindParam("playerID",$data["playerID"]);
		  $sql->bindParam("monto",$data["monto"]);
		  $sql->bindParam("idTypeComunication",$data["idTypeComunication"]);
		   $sql->bindParam("idBank",$data["idBank"]);
		    $sql->bindParam("fechaVaucher",$data["fechaVaucher"]);
		    $sql->bindParam("horaVaucher",$data["horaVaucher"]);
		     $sql->bindParam("vaucher",$data["vaucher"]);
		     $sql->bindParam("idUser",$data["idUser"]);

		  $sql->execute();
		return $sql;

	}


	protected function updateChargeModel($data){
		if($data["cargaI"]==1){

			$sql= mainModel::conect()->prepare("UPDATE testudiantes SET name = :name,lastName = :lastName,address = :address,dni= :dni,edad = :edad, idCarrera = :idCarrera , foto = :foto WHERE idEstudiantes = :idEstudiantes" );
		}else{

				$sql= mainModel::conect()->prepare("UPDATE testudiantes SET name = :name,lastName = :lastName,address = :address,dni= :dni,edad = :edad, idCarrera = :idCarrera  WHERE idEstudiantes = :idEstudiantes" );
		}
				
				$sql->bindParam("name",$data["name"]);
				 $sql->bindParam("lastName",$data["lastName"]);
				  $sql->bindParam("address",$data["address"]);
				   $sql->bindParam("dni",$data["dni"]);
				    $sql->bindParam("edad",$data["edad"]);
				     $sql->bindParam("idCarrera",$data["idCarrera"]);

				     if($data["cargaI"]==1){
				     $sql->bindParam("foto",$data["foto"]);
				 	}
				      $sql->bindParam("idEstudiantes",$data["idEstudiantes"]);
			
		$sql->execute();
		return $sql;
	}
	

}