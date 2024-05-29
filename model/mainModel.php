<?php 

if ($peticionAjax) {
	require_once "../core/configApp.php";
}else{
	require_once "./core/configApp.php";
}
class mainModel 
{
		protected function conect(){
		$enlace = new PDO(SGDB,USER,PASSWORD);
	$enlace->exec("SET TIME_ZONE = '".date('P')."';");
		return $enlace;
	}
	protected function nombredb(){
		$nombre = DB;
		return $nombre;
	}

	protected function nombreS(){
		$nombreSERVER = SERVER;
		return $nombreSERVER;
	}



		public function uploadFilePrincipal($cargaI,$carpeta,$name){
		$imgPrincipal ="imgdefauld.jpg";
			if($cargaI != 0){
				$ruta_carpeta = "../assets/".$carpeta."/";
				$nombre_archivo = $name.date("dHis") .".". pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
				$ruta_guardar_archivo = $ruta_carpeta . $nombre_archivo;
				if(move_uploaded_file($_FILES["file"]["tmp_name"],$ruta_guardar_archivo)){
						$imgPrincipal= $nombre_archivo;
				}
			}
				return $imgPrincipal;
	}
	protected function getList($query,$idName){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
		$html.="<option value=''>-Seleccionar-</option>";
		foreach ($request as $index=>$row) {
			$html.='<option value="'.$row[$idName].'"> '.$row['name'].'</option>';
		}

		return $html;
	}

	//init andres
	

	protected function execute_query($query){
		$request=self::conect()->prepare($query);
		$request->execute();
		return $request;
	} 

	protected function listCargos(){
    $data = mainModel::getList("SELECT * FROM tcargo WHERE (idCargo!=12 and idCargo!=14) ","idCargo");
      return $data;
    }



	public static function encryption($string){
			$output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			return $output;
		}
		public static function decryption($string){
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
			return $output;
		}
		protected function generar_codigo_aleatorio($letra,$lenght,$num){

			for($i=1;$i<=$lenght;$i++){
				$numero = rand(0,9);
				$letra.=$numero;
			}
			return $letra.$num;
		}
	protected function remove_sp_chr($str)
{
    $result = str_replace(array("`", "'", ":"), '', $str);
    return $result;
}
	protected function remove_splaca($str)
{
    $result = str_replace(array("'", "`"), '', $str);
    return $result;
}


		protected function limpiar_cadena($string){
			$string =trim($string);
			$string = stripcslashes($string);
			$string = str_ireplace("<script>", "", $string);
			$string = str_ireplace("</script>", "", $string);
			$string = str_ireplace("<script src", "", $string);
			$string = str_ireplace("<script type=", "", $string);
			$string = str_ireplace("SELECT * FROM", "", $string);
			$string = str_ireplace("DELETE FROM", "", $string);
			$string = str_ireplace("INSERT INTO", "", $string);
           $string = str_ireplace("DROP TABLE", "", $string);
			$string = str_ireplace("DROP DATABASE", "", $string);
           $string = str_ireplace("TRUNCATE TABLE", "", $string);
           $string = str_ireplace("SHOW TABLES", "", $string);
			$string = str_ireplace("SHOW DATABASES", "", $string);
			$string = str_ireplace("<?php", "", $string);
			$string = str_ireplace("?>", "", $string);
			$string = str_ireplace("--", "", $string);
			$string = str_ireplace(">", "", $string);
			$string = str_ireplace("<", "", $string);
			$string = str_ireplace("[", "", $string);
			$string = str_ireplace("]", "", $string);
		    $string = str_ireplace("^", "", $string);
			$string = str_ireplace("==", "", $string);
			$string = str_ireplace(";", "", $string);
			$string = str_ireplace("::", "", $string);
			return $string;
		}
		public static function execute_queryreport($query){
		$request=self::conectREPORT()->prepare($query);
		$request->execute();
		return $request;
	} 
public static function conectREPORT(){
		$enlace = new PDO(SGDB,USER,PASSWORD);
		return $enlace;
	}

	
		protected function mensajeRespuesta($data){
			if($data['alert']=="nulo"){
				$alert="
				<script>
				 new PNotify({
					title: 'ERROR EN OPERACION',
					text: 'EL PLAYERID QUE HAS INGRESADO NO EXISTE.',
					type: 'error'
				});

				     	resetForm();
				</script>";
			}

			if($data['alert']=="error2"){
				$alert="
				<script>
				 new PNotify({
					title: 'ERROR EN OPERACION',
					text: 'EL DOCENTE YA CUENTA CON UN REGISTRO DE ENTRADA PARA ESTE CURSO.',
					type: 'error'
				});

				     	resetForm();
				</script>";
			}
			if($data['alert']=="save"){
				$alert="
				<script>
				 new PNotify({
					title: 'Operacion Exitosa',
					text: 'Datos guardados correctamente.',
					type: 'success'
				});

				     	resetForm();
				</script>";
			}
	else if($data['alert']=="saveremitransp"){
		$url=$data['report'];
				$alert="
				<script>
				 new PNotify({
					title: 'Operacion Exitosa',
					text: 'Datos guardados correctamente.',
					type: 'success'
				});
				resetForm();
				  setTimeout(ventanaReport(`".$url."`), 4000);

				</script>
				";
			}

	else if($data['alert']=="savenotifi"){
				
		$alert="	<script>
				 new PNotify({
					title: 'Operacion Exitosa',
					text: 'Datos guardados correctamente.',
					type: 'success'
				});
    	resetForm();
    	insertarnot('".$data['email']."');
				</script>	";
			}
else if($data['alert']=="savenotifipersonalizado"){
				
		$alert='	<script>
				 new PNotify({
					title: "Operacion Exitosa",
					text: "Datos guardados correctamente.",
					type: "success"
				});
    	resetForm();
    	insertarnot("'.$data['email'].'");


				</script>';
			}
else if($data['alert']=="savenotifipersonalizadocharguef2"){	
		$url=$data['report'];

		$alert='	<script>
	
			 new PNotify({
					title: "Operacion Exitosa",
					text: "Datos guardados correctamente.",
					type: "success"
				});
    	resetForm();
    	insertarnot("'.$data['email'].'");
											  setTimeout(ventanaReport("'.$url.'"), 4000);

				tabladata.ajax.reload(null, false);
				</script>';
			}

else if($data['alert']=="savenotifipersonalizadochargue"){	
		$alert='	<script>
				 new PNotify({
					title: "Operacion Exitosa",
					text: "Datos guardados correctamente.",
					type: "success"
				});
    	resetForm();
    	insertarnot("'.$data['email'].'");
				tabladata.ajax.reload(null, false);
				</script>';
			}
else if($data['alert']=="savenotifipersonalizadodispacht"){
				
		$alert='	<script>
				 new PNotify({
					title: "Operacion Exitosa",
					text: "Datos guardados correctamente.",
					type: "success"
				});
    	resetForm();
    	insertarnot("'.$data['email'].'");
			
	tabladata.ajax.reload(null, false);

				</script>';
			}			

else if($data['alert']=="savenotifipersonalizadof5"){
						$url=$data['report'];

		
$alert="	<script>
				 new PNotify({
					title: 'Operacion Exitosa',
					text: 'Datos guardados correctamente.',
					type: 'success'
				});
    	resetForm();
    	insertarnot('".$data['email']."');
	tabladata.ajax.reload(null, false);
    	    					  setTimeout(function(){
    	    					  	ventanaReport(`".$url."`);
    }  , 4200);

				</script>	";

			}

else if($data['alert']=="savenotifipersonalizadof5Remesa"){
						$url=$data['report'];

		
$alert="	<script>
				 new PNotify({
					title: 'Operacion Exitosa',
					text: 'Datos guardados correctamente.',
					type: 'success'
				});
    	resetForm();
    	insertarnot('".$data['email']."');
	tabladata.ajax.reload(null, false);
    	    					  setTimeout(function(){
    	    					  	ventanaReport(`".$url."`);
	 window.location.href = `".SERVERURL."remesa?nivel=2`;
    }  , 4200);

				</script>	";

			}

	else if($data['alert']=="savecontact"){
		$extra=$data['opcion'];		
				$alert="
				<script>
				
				 new PNotify({
					title: 'Operacion Exitosa',
					text: 'Datos guardados correctamente.',
					type: 'success'
				});
				
                ".$extra."
resetmodalFt();
				</script>
				";
			}
else if($data['alert']=="updatereport"){
		$url=$data['report'];
				$alert="
				<script>
				 new PNotify({
					title: 'Operacion Exitosa',
					text: 'Datos guardados correctamente.',
					type: 'success'
				});
				resetForm();
				  setTimeout(ventanaReport(`".$url."`), 4000);
	tabladata.ajax.reload(null, false);

				</script>";
			}
			else if($data['alert']=="saveproduct"){
				$alert="
				<script>
				 new PNotify({
					title: 'Operacion Exitosa',
					text: 'Datos guardados correctamente.',
					type: 'success'
				});
				 $('.formAjax')[0].reset();
				resetForm2();
				</script>
				";
			}
else if($data['alert']=="savemanifest"){
				$alert="
					<script>
				 new PNotify({
					title: 'Operacion Exitosa',
					text: 'Datos guardados correctamente.',
					type: 'success'
				});
	setTimeout(function(){
   window.location.reload(1);
}, 500);
				</script>
				";
			}

	else if($data['alert']=="updatenotifi"){
				

				$alert="
				<script>
				  new PNotify({
					title: 'Operacion Exitosa',
					text: 'Los datos se actualizaron con exito.',
					type: 'success'
				});
	tabladata.ajax.reload(null, false);
    	resetForm();
    	insertarnot('".$data['email']."');
				</script>
				";
			}

			
			else if($data['alert']=="update"){
				$alert="
				<script>
				  new PNotify({
					title: 'Operacion Exitosa',
					text: 'Los datos se actualizaron con exito.',
					type: 'success'
				});
	tabladata.ajax.reload(null, false);
    	resetForm();
				</script>
				";
			}else if($data['alert']=="updateremesareport"){
		$url=$data['report'];
				$alert="
				<script>
				 new PNotify({
					title: 'Operacion Exitosa',
					text: 'Datos guardados correctamente.',
					type: 'success'
				});
				resetForm();
				  setTimeout(ventanaReport(`".$url."`), 4000);
	tabladata.ajax.reload(null, false);
				</script>";
			}
			else if($data['alert']=="updatemf"){
				$alert="
				<script>
				  new PNotify({
					title: 'Operacion Exitosa',
					text: 'Los datos se actualizaron con exito.',
					type: 'success'
				});
	tabladata.ajax.reload(null, false);
			    	resetForm();
				</script>";
			}
			else if($data['alert']=="sendnotifi"){
				$alert="
				<script>
				  new PNotify({
					title: 'Operacion Exitosa',
					text: 'Los datos se actualizaron con exito.',
					type: 'success'
				});
	tabladata.ajax.reload(null, false);
    	insertarnot('".$data['email']."');
	tabladata.ajax.reload(null, false);
    	resetForm();
      </script>";
			}

else if($data['alert']=="sendnotifiemesamulti"){
				$alert="
				<script>
				  new PNotify({
					title: 'Operacion Exitosa',
					text: 'Los datos se actualizaron con exito.',
					type: 'success'
				});
	tabladata.ajax.reload(null, false);
    	insertarnot('".$data['email']."');
    	insertarnot('".$data['email2']."');

	tabladata.ajax.reload(null, false);
    	resetForm();
      </script>";
			}
			 else if($data['alert']=="sendnotifiMult"){
				$alert="
				<script>
				  new PNotify({
					title: 'Operacion Exitosa',
					text: 'Los datos se actualizaron con exito.',
					type: 'success'
				});
	tabladata.ajax.reload(null, false);
    	insertarnot('".$data['email']."');
    	    	insertarnot('".$data['email2']."');
    	resetForm();
      </script>";
			} 
				else if($data['alert']=="updateTfg"){
				$alert="
				<script>
				  new PNotify({
					title: 'Operacion Exitosa',
					text: 'Los datos se actualizaron con exito.',
					type: 'success'
				});
		setTimeout(function(){
   window.location.reload(1);
}, 5000);
				</script>
				";
			}
else if($data['alert']=="saveseguiModulo"){
				$alert="
				<script>
				  new PNotify({
					title: 'Operacion Exitosa',
					text: 'Los datos se actualizaron con exito.',
					type: 'success'
				});
    	resetmSeguimientoTrack();
				</script>";
			}

else if($data['alert']=="saveseguiModulo2"){
	$alert="			<script>
				  new PNotify({
					title: 'Operacion Exitosa',
					text: 'Los datos se actualizaron con exito.',
					type: 'success'
				});
    	resetmSeguimientoTrack();
			
setTimeout(function(){	    					  
	 window.location.href =`".SERVERURL."servicetracking?nivel=2`;
    }  , 4200);
				</script>
				";
			}
else if($data['alert']=="saveindicador"){
	$alert="<script>
				  new PNotify({
					title: 'Operacion Exitosa',
					text: 'Los datos se registraron con exito.',
					type: 'success'
				});
			
setTimeout(function(){	    					  
	 window.location.href =`".SERVERURL."indicadores?nivel=2`;
    }  , 200);
				</script>
				";
			}

else if($data['alert']=="saveseguiModulo"){
				$alert="
				<script>
				  new PNotify({
					title: 'Operacion Exitosa',
					text: 'Los datos se actualizaron con exito.',
					type: 'success'
				});
    	resetmSeguimientoTrack();
				</script>";
			}

else if($data['alert']=="saveseguiModulo2"){
	$alert="			<script>
				  new PNotify({
					title: 'Operacion Exitosa',
					text: 'Los datos se actualizaron con exito.',
					type: 'success'
				});
    	resetmSeguimientoTrack();
			
setTimeout(function(){	    					  
	 window.location.href =`".SERVERURL."servicetracking?nivel=2`;
    }  , 4200);
				</script>
				";
			}

else if($data['alert']=="saveControlcargo"){
				$alert="
				<script>
				  new PNotify({
					title: 'Operacion Exitosa',
					text: 'Los datos se actualizaron con exito.',
					type: 'success'
				});
    	resetControlcargo();
				</script>";
			}

else if($data['alert']=="saveLiquidacionCargo"){
				$alert='
				<script>
				  new PNotify({
					title: "Operacion Exitosa",
					text: "Los datos se guadaron con exito.",
					type: "success"
				});
				
listarDatableGroupLiquicargacontrol();
				</script>';
			}


else if($data['alert']=="saveControlcargo2"){
	$alert="			<script>
				  new PNotify({
					title: 'Operacion Exitosa',
					text: 'Los datos se actualizaron con exito.',
					type: 'success'
				});
    	resetControlcargo();
			
setTimeout(function(){	    					  
	 window.location.href =`".SERVERURL."charguecontrol?nivel=2`;
    }  , 4200);
				</script>
				";
			}
else if($data['alert']=="saveseguiModulo3"){
				$alert="
				<script>
				  new PNotify({
					title: 'Operacion Exitosa',
					text: 'Los datos se guardaon con exito.',
					type: 'success'
				});
    	resetmSeguimientoReg();
	tabladata2.ajax.reload(null, false);
				</script>";
			}


else if($data['alert']=="updateseguiModulo3"){
				$alert="
				<script>
				  new PNotify({
					title: 'Operacion Exitosa',
					text: 'Los datos se actualizaron con exito.',
					type: 'success'
				});
    	resetmSeguimientoRegupdate();
	tabladata.ajax.reload(null, false);

				</script>
				";
			}



				else if($data['alert']=="updateAereo"){
				$alert="
				<script>
				  new PNotify({
					title: 'Operacion Exitosa',
					text: 'Los datos se actualizaron con exito.',
					type: 'success'
				});
	tabladata2.ajax.reload(null, false);
    	resetForm();
				</script>
				";
			}


			else if($data['alert']=="updatepersonalizado"){
			      $html='';
              if ($data['operacion']=="Password") {
              	$html='resetForm();';
              	
              }

				$alert="
			<script>
				  new PNotify({
					title: 'Operacion Exitosa',
					text: ' ".$data['campo']."',
					type: 'success'
				});
                 ".$html."
				</script>
				";
			}
			else if($data['alert']=="delete"){

					$alert="
				<script>
					  new PNotify({
					title: 'Operacion Exitosa',
					text: 'Los datos se eliminaron de manera exitosa',
					type: 'success'
				});
				
				</script>
				";

			}else if($data['alert']=="duplicidad"){
						$alert="
				<script>
					  new PNotify({
					title: '¡ Algo Salio Mal !',
					text: 'El  ".$data['campo']."  ya existe en el sistema, por favor registre con otro dato',
					type: 'success'
				});
				
				</script>
				";

				
			}else if($data['alert']=="duplicidadpers"){
				$alert="
				<script>
 new PNotify({
					title: '¡ Algo Salio Mal !',
					text: 'El  ".$data['campo']."  ya existe en el sistema, por favor registre con otro email ',
					type: 'error'
				});


				   $('#idGuardar').attr('disabled',false);
          $('#idGuardar').text('Guardar');
				</script>
				";
			}

			else if($data['alert']=="error"){
				$alert="
				<script>
				new PNotify({
			title: 'Algo Salio Mal',
			text: 'Ocurrio un Error en el sistema , vuelva a intentarlo.',
			type: 'error'
		});

				</script>
				";
			}
else if($data['alert']=="errorpersonalizadofull"){
				$alert="
				<script>
				 
		new PNotify({
			title: 'Algo Salio Mal',
			text:  '".$data['message']."',
			type: 'error'
		});


				</script>
				";
			}

else if($data['alert']=="errorpersonalizado"){
				$alert="
				<script>
				 
		new PNotify({
			title: 'POR FAVOR MODIFIQUE LOS CAMPOS PARA REALIZAR LA OPERACION',
			text:  'USTED NO A MODIFICADO NADA',
			type: 'error'
		});


				</script>
				";
			}
			else if($data['alert']=="error4"){
				$alert="
				<script>
					new PNotify({
			title: 'Algo Salio Mal',
			text: 'Ocurrio un Error en el sistema , vuelva a intentarlo.',
			type: 'error'
		});

				 
   $('#idGuardarPass').attr('disabled',false);
                                  $('#idGuardarPass').text('Guardar');
				</script>
				";
			}
			else if($data['alert']=="contraseñaError"){
				$alert="
					<script>
				new PNotify({
			title: 'Algo Salio Mal',
			text: 'Contraseña Actual Invalidad , vuelva a intentarlo.',
			type: 'error'
		});

				</script>
				";
			}
			else if($data['alert']=="activate"){
				$alert="
				<script>
					  new PNotify({
					title: 'Operacion Exitosa',
					text: 'El elemento se a activado correctamente en el Sistema',
					type: 'success'
				});
				
				</script>
				";
			}else if($data['alert']=="saveFoto"){
				$alert="
				<script>
						 new PNotify({
					title: 'Operacion Exitosa',
					text: 'Datos guardados correctamente.',
					type: 'success'
				});
				 $('.formAjax')[0].reset();
				 $('#img')[0].src ='".SERVERURL."view/assets/images/nuevo.png';
				</script>
				";
			}else if($data['alert']=="updateFoto"){
				$alert="
				<script>
				  new PNotify({
					title: 'Operacion Exitosa',
					text: 'Los datos se actualizaron con exito.',
					type: 'success'
				});
               	resetForm();
				tabladata.ajax.reload(null, false);
				</script>
				";
			}
			return $alert;

		}


		protected function activateDeleteSimple($table,$idElemento,$status,$nameId){
			
			$txtStatus='';
			if($status==1){
				$newStatus=0;
							$txtStatus="dar de Baja";

			}else{
				$newStatus=1;
			  $txtStatus="dar de Alta";

			}


			$sql  =self::conect()->prepare("UPDATE $table set status = $newStatus where $nameId= :nameId");
			$sql->bindParam(":nameId",$idElemento);

			$sql->execute();
			           
 
              
			return $sql;
			//return $table."--".$idElemento;
		}	



}