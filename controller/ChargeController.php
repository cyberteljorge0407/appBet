<?php 
if ($peticionAjax) {
  require_once "../model/ChargeModel.php";
}else{
  require_once "./model/ChargeModel.php";
}


class ChargeController extends ChargeModel{

public function updateMontoController($idCharge,$monto){
  if(ChargeModel::updateMontoChargeModel($idCharge,$monto)){

       return "1";
      }else{
       return "0";
      }
      
}
 
  public function listHistoryChargeController($request,$status){
      $cnn = mainModel::conect();
      $btn="";
      $icon="";
      if($status==1){
        $btn="danger";
        $icon="trash-o fa-lg";
      }else{      
        $btn="success";
        $icon="check  fa-lg";
      }

 
      $col =array(
            0 =>  'idCharge',
            1 =>  'PlayerID',
            2 =>  'monto',
            3 =>  'nameBank',
            4 =>  'fechaVaucher',
            5 =>  'horaVaucher',
            6 =>  'nameTypeComunication',
            7 =>  'saldoActual'
      );  

 
      $index=0;
      if ($request['order'][0]['column']!=8) {
      $index=$request['order'][0]['column'];
      }
      if ($request['order'][0]['column']==8) {
      $index=0;
      }



      //aqui va la consulta a la base de datos 
      $sql ="SELECT SQL_CALC_FOUND_ROWS t1.*, t2.names as namePlayer,t2.PlayerID, t2.surnames , t3.name as nameBank , t4.name as nameTypeComunication    from trecharge as t1 INNER JOIN tplayer as t2 on t1.idPlayer =  t2.idPlayer INNER JOIN tbank as t3 on t1.idBank = t3.idBank INNER JOIN ttypecommunication as t4 on t1.idTypeComunication = t4.idTypeComunication  WHERE t1.status=$status";

      //$sql2="SELECT * from trecharge GROUP BY idPlayer DESC order by idCharge desc limit 1";

      $query= $cnn->query($sql);
       $totalData = $cnn->query("SELECT FOUND_ROWS()");
       $totalData = (int) $totalData->fetchColumn();
       //AQUI ESTA PASANDO LOS DATOS CUANDO HAGO UNA BUSQUEDA EN LA TABLA
      if(!empty($request['search']['value'])){
          $sql.=" AND names Like '".$request['search']['value']."%'  ";
      }
      $query= $cnn->query($sql);
            $totalData = $cnn->query("SELECT FOUND_ROWS()");
                  $totalData = (int) $totalData->fetchColumn();
      if(isset ($request['order'])){
      $sql.=" ORDER BY   ".$col[$index]."   ".$request['order'][0]['dir']."   LIMIT ".
          $request['start']."  ,".$request['length']."  ";
      }
      $query= $cnn->query($sql);
      $totalFilter=$totalData;
      $data=array();
      $contador=0;
      while($row = $query->fetch(PDO::FETCH_ASSOC)){
          $subdata=array();
                      $contador = $contador+1;

          $subdata[]=$contador;
          $subdata[]=$row['PlayerID'];
          $subdata[]=$row['monto'];
          $subdata[]=$row['nameBank'];
           $subdata[]=$row['nameTypeComunication'];
          $subdata[]=$row['fechaVaucher'];
          $subdata[]=$row['horaVaucher'];
         
          
          $subdata[]=$row['saldoActual'];
$operacionescrud="";
          $operacionescrud='<button type="button" onClick="visor(`'.$row['vaucher'].'`)" class="btn btn-primary" data-toggle="modal" data-target="#modalVaucher">
  <i class="fa-solid fa-magnifying-glass"></i> 
</button>';

if($row['actual']==1){
  $operacionescrud.='<button type="button" onClick="editarMonto('.$row['idCharge'].','.$row['monto'].',`'.$row['PlayerID'].'`,`'.$row['namePlayer'].'`)" class="btn btn-warning" data-toggle="modal" data-target="#modalRecargas">
  <i class="fa-solid fa-pencil"></i>
</button>';
}

              $subdata[]=$operacionescrud;     
              $data[]=$subdata;
          }
          $json_data=array(
              "draw" => isset ( $request['draw'] ) ?  intval( $request['draw'] ) : 0, 
             "recordsTotal"      =>  intval($totalData),
             "recordsFiltered"   =>  intval($totalFilter),
             "data"              =>  $data
          );
        return json_encode($json_data);
   }



  public function saveRecargaController(){
    session_start();
    $idUsuario = mainModel::decryption($_SESSION['Encryuser']);

      $playerID = mainModel::limpiar_cadena($_POST['playerID']);

    $consulta1 =mainModel::execute_query("SELECT * from tplayer where PlayerID = '".$playerID."'"); 
    if($consulta1->rowCount() >0){


      $monto=mainModel::limpiar_cadena($_POST['monto']);
       $idTypeComunication=mainModel::limpiar_cadena($_POST['idTypeComunication']);
        $idBank=mainModel::limpiar_cadena($_POST['idBank']);
         $fechaVaucher=mainModel::limpiar_cadena($_POST['fechaVaucher']);
         $horaVaucher=$_POST['horaVaucher'];

         $cargaI=mainModel::limpiar_cadena($_POST['cargaI']);
        $nameImgSubida = mainModel::uploadFilePrincipal($cargaI,"vauchers","VAUCHER");
         

   $fecha1 = strtotime($fechaVaucher);
 $fecha = date('Y-d-m',$fecha1);




      $data=[
        "playerID"=>$playerID,
        "monto"=>$monto,
        "idTypeComunication"=>$idTypeComunication,
        "idBank"=>$idBank,
        "fechaVaucher"=>$fecha,
        "horaVaucher"=>$horaVaucher,
        "vaucher"=>$nameImgSubida,
        "idUser"=>$idUsuario
      ];


   

      if(ChargeModel::saveChargeModel($data)){

        $msg=["alert"=>"save"];
      }else{
        $msg=["alert"=>"error"];
      }


    }else{
        $msg=["alert"=>"nulo"];
    }
      return mainModel::mensajeRespuesta($msg);
    

    }


public function listarTipoComunicacion(){
  return mainModel::getList("SELECT * FROM ttypecommunication ","idTypeComunication");
}

public function listarBank(){
  return mainModel::getList("SELECT * FROM tbank ","idBank");
}

  public function consultarChargeController($txtConsultaId){

      $consultaCliente= mainModel::execute_query("SELECT * FROM tplayer WHERE PlayerID='$txtConsultaId' ");
      $array=  $consultaCliente->fetch(PDO::FETCH_ASSOC);

      $cantidadRegistros = $consultaCliente->rowCount();

      if($cantidadRegistros >0){

      $html="<table class='table table-striped table-bordered'>
        <tr>
        <td>PLAYER ID: </td>
        <td>".$array["PlayerID"]." </td>  
        </tr>
        <tr>
        <td>NOMBRES: </td>
        <td>".$array["names"]." </td>  
        </tr>

         <tr>
        <td>APELLIDOS: </td>
        <td>".$array["surnames"]." </td>  
        </tr>

          <tr>
        <td>EMAIL: </td>
        <td>".$array["email"]." </td>  
        </tr>

          <tr>
        <td>SALDO: </td>
        <td>".$array["saldo"]." </td>  
        </tr>

      </table>";
      }else{
        $html="<table class='table table-striped table-bordered'>
        <tr>
        <td colspan='5'>NO SE ENCONTRON DATOS RELACIONADOS AL PLAYERID QUE HAS INGRESADO </td>
      
        </tr>
        

      </table>";
      }


      return $html;
  }



 


}

 