

<?php
//esto tengo que hacer referencia al controledor y ajax respectivo de mi modulo 
          require_once "./controller/ChargeController.php";
          $inst= new ChargeController();  
          $titulo = "REGARGAS"; 
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
            <h2>MODULO DE RECARGAS</h2>

            <div class="right-wrapper pull-right">
              <ol class="breadcrumbs">
                <li>
                  <a href="<?php echo SERVERURL ?>home">
                    <i class="fa fa-home"></i>
                  </a>
                </li>
                <!--AQUI VAN LAS ETIQUETAS DE LA RUTA DEL MODULO -->
                <li><span>Inicio</span></li>
                <li><span>RECARGAS</span></li>
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
                    <a href="#lista" data-toggle="tab"><i class="fa fa-user"></i> RECARGA  </a>
                  </li>
                  
                </ul>

                <!--CONTENIDOS DE LOS TAPS-->
                <div class="tab-content">
  <!--INICIO DEL CONTENIDO DE LISTA-->

                  <div id="lista" class="tab-pane active">
                    <div class="row">
                      <div  class="col-md-12 ml-xs alert alert-default" style="display: inline-block;">
                        <div class="row">
                  
                     <!--INICIO FORMULARIO-->

                     <form class="formAjax" action="<?php echo SERVERURL; ?>ajax/chargeAjax.php" method="POST" data-form= "save" data-ajax="chargeAjax" data-urlhttp="<?php echo SERVERURL; ?>" autocomplete="off" >
                       <input type="hidden"  name="save" >
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="inputEmail4">Player ID</label>
                      <input type="number" class="form-control" name="playerID" id="playerID"  maxlength="10" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputPassword4">Monto</label>
                      <input type="number" class="form-control" id="monto" name="monto"  maxlength="10" required>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="inputPassword4">Tipo de Comunicación</label>
                      <select class="form-control"id="idTypeComunication" name="idTypeComunication" required >
                        <?php 
                            echo $inst->listarTipoComunicacion();
                         ?>
                        
                      </select>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="inputPassword4">Banco</label>
                        <select class="form-control" id="idBank" name="idBank" required>
                        <?php 
                            echo $inst->listarBank();
                         ?>
                        
                      </select>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="inputPassword4">Fecha (vaucher)</label>
                      <input type="date" class="form-control" id="fechaVaucher" name="fechaVaucher" required>
                    </div>


                    <div class="form-group col-md-4">
                      <label for="inputPassword4">Hora (vaucher)</label>
                      <input type="time" class="form-control" id="horaVaucher" name="horaVaucher" required>
                    </div>

                    <div class="form-group col-md-12">
                      <label for="inputPassword4">Vaucher</label>
                     
                        <picture>
                <img class="img" id="imgADJsave" src="<?php echo SERVERURL; ?>assets/vaucher.png" style="width:200px; height:200px"> 
                                </picture>

                <input type="file"  accept="image/png,image/jpeg,image/jpg" id="fileinput'.$saveUpdate.'" class="custom-file-input imgClass2"  name="file"  onChange="cargaImgProductlt(this,'save');" >
                                                        <input type="hidden" class="cargaIB2" name="cargaI" id="cargaI2" value="0">


                    </div>

                  </div>



  <div class="container" style="text-align: center">

  <button type="submit" class="btn btn-primary">REGISTRAR RECARGA</button>
  </div>
</form>

<!--FIN DEL FORMULARIO-->
                  
                  </div>
</div>

</div>

                </div>
              </div>

              </div>
            </section>




      