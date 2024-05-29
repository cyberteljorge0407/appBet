
<style>

 .panel-body{
  background-color: rgba(29, 33, 12, 0.9);
 }
 .panel-title{
  color: #CF050C;
 }
  .bdprincipal {
 width: 100%;
    padding: 0 7%;
    display: table;
    margin: 0;
    max-width: none;
    
    height: 100vh;
     
 }
 .content-body{
  padding: 0px !important;
 }
</style>
<?php  require_once "./controller/HomeController.php"; $inst= new HomeController(); ?>   

          <header class="page-header">
            <h2>Dashboard</h2>
          
            <div class="right-wrapper pull-right">
              <ol class="breadcrumbs">
                <li>
                  <a href="<?php echo SERVERURL ?>">
                    <i class="fa fa-home"></i>
                  </a>
                </li>
                <li><span>Home</span></li>
               
              </ol>
          
              <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
            </div>
          </header>
          <!-- start: page -->
            <section class="bdprincipal">
              <div class="row" style=" margin-top: 2em;">
          <?php //echo $inst->pintarhomeController(); $datayear= $inst->getChartHome();  ?>
             
            </div>

            <div class="row" style="margin-top: 6%;"> 
               <div class="col-md-5">
                <section class="panel">
                  <div class="panel-body">
                    <!-- Flot: Bars -->
                    <div class="col-md-8">
                    <h2 class="panel-title">RECARGAS </h2>
                   <p class="panel-subtitle">(<?php echo $inst->numRecargas(); ?>)</p>
                  </div>
                  <div class="col-md-4">
                    <i class="fa-solid fa-file-invoice-dollar" style="font-size: xxx-large;"></i>
                  </div>
                  </div>
                  </section>
                  
                  </div>






                 <div class="col-md-5">


                   <section class="panel">
                  <div class="panel-body">
                    <!-- Flot: Bars -->
                    <div class="col-md-8">
                    <h2 class="panel-title">CLIENTES </h2>
                   <p class="panel-subtitle">(<?php echo $inst->numClientes(); ?>)</p>
                  </div>
                  <div class="col-md-4">
                    <i class="fa fa-users" style="font-size: xxx-large;"></i>

                  </div></div>
                  </section>

                </div>



                




             
            </div>
             
          
            </section>
                
           
       
          <!-- end: page -->
