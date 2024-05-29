<?php 
if ($peticionAjax) {
  require_once "../model/ClienteModel.php";
}else{
  require_once "./model/ClienteModel.php";
}


class ClienteController extends ClienteModel{


  public function consultarClienteController($txtConsultaId){

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

 