

<?php
//esto tengo que hacer referencia al controledor y ajax respectivo de mi modulo 
          require_once "./controller/ClienteController.php";
          $inst= new ClienteController();  
          $titulo = "Clientes"; 
          $ajaxGlobal="clienteAjax";   
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
            <h2>CONSULTA DE CLIENTES</h2>

            <div class="right-wrapper pull-right">
              <ol class="breadcrumbs">
                <li>
                  <a href="<?php echo SERVERURL ?>home">
                    <i class="fa fa-home"></i>
                  </a>
                </li>
                <!--AQUI VAN LAS ETIQUETAS DE LA RUTA DEL MODULO -->
                <li><span>Inicio</span></li>
                <li><span>Consulta de Cliente</span></li>
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
                    <a href="#lista" data-toggle="tab"><i class="fa fa-user"></i> CLIENTE  </a>
                  </li>
                  
                </ul>

                <!--CONTENIDOS DE LOS TAPS-->
                <div class="tab-content">
  <!--INICIO DEL CONTENIDO DE LISTA-->

                  <div id="lista" class="tab-pane active">
                    <div class="row">
                      <div  class="col-md-12 ml-xs alert alert-default" style="display: inline-block;">
                        <div class="row">
                    <div class="col-md-12">
                     
                      <div class="col-md-2">
                        <h4> PLAYER ID</h4>
                      </div>

                      <div class="col-md-3">
                        
                        <input type="text" id="idConsultaCliente" class="form-control" maxlength="10" placeholder="Ingresar id">

                      </div>
                      <div class="col-md-2">
                        <button  class="btn btn-success" onclick="consultarCliente()"> CONSULTAR </button>

                      </div>



                    </div>
                  </div>
</div>
<div class="col-sm-6" id="idPanelConsulta">

  

</div>
</div>

                </div>
              </div>

              </div>
            </section>
            