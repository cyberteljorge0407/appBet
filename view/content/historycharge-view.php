

<?php
//esto tengo que hacer referencia al controledor y ajax respectivo de mi modulo 
          require_once "./controller/ChargeController.php";
          $inst= new ChargeController();  
          $titulo = "HISTORIAL DE MIS RECARGAS"; 
          $ajaxGlobal="chargeAjax";   
          $multipart="enctype='multipart/form-data' ";           
          $activ2="";$activ3="";
          $activ2="active";
          $activ3="class='active'";
?>


        <style type="text/css">
          .trinactivo{
            display: none;
          }

</style>
<input type="hidden" id="url" value="<?php  echo SERVERURL ?>" >
<input type="hidden" id="ajax" value="<?php  echo $ajaxGlobal ?>" >

    <header class="page-header">
      <!--AQUI VA EL TITULO DEL MODULO -->
            <h2>HISTORIAL DE MIS RECARGAS</h2>

            <div class="right-wrapper pull-right">
              <ol class="breadcrumbs">
                <li>
                  <a href="<?php echo SERVERURL ?>home">
                    <i class="fa fa-home"></i>
                  </a>
                </li>
                <!--AQUI VAN LAS ETIQUETAS DE LA RUTA DEL MODULO -->
                <li><span>Inicio</span></li>
                <li><span>HISTORIAL DE MIS RECARGAS</span></li>
              </ol>
          
              <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
            </div>
          </header>


<section class="panel">
              <div class="panel-body pr-none" >
                <!--AQUI INICIAN LOS TABS-->
          <div class="tabs">
                <ul class="nav nav-tabs">
                  <li class="active">
                    <a href="#lista" onclick="listarDatable();" data-toggle="tab"><i class="fa fa-star"></i> Listado   </a>
                  </li>
                
                </ul>

                <!--CONTENIDOS DE LOS TAPS-->
                <div class="tab-content">
  <!--INICIO DEL CONTENIDO DE LISTA-->

                  <div id="lista" class="tab-pane active">
                    <div class="row">
                      <div  class="col-md-12 ml-xs alert alert-default" style="display: inline-block;">
                        <div class="row">
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label class="control-label" style="display: block;">Activos/Inactivos</label>
                        <div  class="switch switch-sm switch-primary">
                            <input id="myonoffswitch" type="checkbox" name="switch" data-plugin-ios-switch checked="checked"  onchange="listarDatable()" />
                        </div>
                      </div>
                    </div>
                  </div>
</div>
<div class="col-sm-12">

  <!--AQUI VAN LAS CABECERAS DE LA TABLA-->
   <table class="table table-bordered table-striped" id="datatable-default">
                  <thead>
                    <tr>
                      <th width="5%">#</th>
                      <th width="20%">PLAYER ID</th>
                      <th width="10%">MONTO</th>
                      <th width="10%">BANCO</th>
                       <th width="15%">T.COMUNICACION</th>
                       <th width="10%">FECHA (vaucher)</th>
                      <th width="10%">HORA (vaucher)</th>
                      <th width="10%">SALDO ACTUAL</th>

                       <th width="10%">VAUCHER</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
</div>
</div>

<div class="loadGuardado"></div>
                <div class="RespuestaAjax"></div>
                  </div>
                    <!--FIN DEL CONTENIDO DE LA LISTA-->


 <!--INICIO DEL CONTENIDO DE GUARDADO-->
                  <div id="guardado" class="tab-pane">
                      <div class="col-md-12 p-none">
                         <form class="formAjax" action="<?php echo SERVERURL; ?>ajax/historyChargeAjax.php" method="POST" data-form= "save" data-ajax="historyChargeAjax" data-urlhttp="<?php echo SERVERURL; ?>" autocomplete="off" >
                      
                           </form>
                    </div>
                  </div>


 <!--FIN DEL CONTENIDO DE GUARDADO-->


                </div>
              </div>

              </div>
            </section>
            

                        <!-- Modal -->
<div class="modal fade" id="modalRecargas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">RECARGAS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="idModalActualizar">
        <div class="row">
          <div class="form-row">
            <div class="form-group col-md-12">
                      <label for="inputEmail4">NOMBRE</label>
                      <input type="hidden" name="idCharge" id="idCharge">
                      <input type="text" class="form-control" name="nombre" id="nombre" disabled>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputEmail4">Player ID</label>
                      <input type="number" class="form-control" name="playerID" id="playerID" disabled>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="inputEmail4">MONTO</label>
                      <input type="number" class="form-control" name="monto" id="monto" required>
                    </div>

                   
                  </div>
</div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
       <button type="button" class="btn btn-success" onclick="actualizarRecarga()">ACTUALIZAR </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalVaucher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">VAUCHER</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="idModalVaucher">
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
       
      </div>
    </div>
  </div>
</div>
      