 
<?php 
 if (isset($_SESSION['Nameuser'])) {
      echo'<script> window.location.href="'.SERVERURL.'home/"</script>';
 }
 ?>
 <style type="text/css">
  .flotante {
    display:scroll;
        position:fixed;
        bottom:0px;
        right:0px;
        font-size: 17px;
}
   .contenedor1 {
 width: 100%;
    padding: 0 7%;
    display: table;
    margin: 0;
    max-width: none;
    height: 100vh;
   
 }

.divtab{
    
   transition: all 50ms linear;
}

 </style>

  <!-- start: page -->

    <section class="body-sign contenedor2 divtab" id="loguinDiv" >
      <div class="center-sign">
        <a href="#" class="logo pull-left">
          <img src="<?php echo SERVERURL; ?>assets/wce.png" height="54" alt="WCE Admin" />
        </a>

        <div class="panel panel-sign">
          <div class="panel-title-sign mt-xl text-right">
            <h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Ingresar</h2>
          </div>
          <div class="panel-body">
            <form class="formGeneral" method="POST" action="<?php echo SERVERURL; ?>ajax/loginAjax.php">
               <?php 

   require_once "./model/mainModel.php";
  $passEncry='';
if (isset($_COOKIE['pass_R_WCE'])) {
 $passEncry=mainModel::decryption($_COOKIE['pass_R_WCE']);
}

  ?>
  <!--AQUI ESTA EL INPUT PARA TU EMAIL-->
              <div class="form-group mb-lg">
                <label>Email <span class="required">*</span></label>
                <div class="input-group input-group-icon">
                              <input type="hidden" name="login" >

                  <input  type="email" name="email" id="email" placeholder="Email@gmail.com" autofocus class="form-control input-lg"  <?php if (isset($_COOKIE['Email_R_WCE'])) { ?> value="<?php echo $_COOKIE['Email_R_WCE']; ?>" <?php } ?> required />
                  <span class="input-group-addon">
                    <span class="icon icon-lg">
                      <i class="fa fa-user"></i>
                    </span>
                  </span>
                </div>
              </div>
  <!--AQUI ESTA EL INPUT PARA TU CONTRASEÑA-->
              <div class="form-group mb-lg">
                <div class="clearfix">
                  <label class="pull-left">Contraseña <span class="required">*</span></label>
                </div>
                <div class="input-group input-group-icon">
                  <input  name="password" id="password" placeholder="Password" type="password" class="form-control input-lg" <?php if (isset($_COOKIE['pass_R_WCE'])) { ?> value="<?php echo $passEncry; ?>" <?php } ?>  required />
                  <span class="input-group-addon">
                    <span class="icon icon-lg">
                      <i class="fa fa-lock"></i>
                    </span>
                  </span>
                </div>
              </div>

<!--
              <div class="form-group mb-lg">
                <div class="clearfix">
                  <label class="pull-left">Tipo de usuario <span class="required">*</span></label>
                </div>
                <div class="input-group input-group-icon">
                <select class="form-control">
                  <option value="1">ADMINISTRADOR</option>
                  <option value="2">EMPLEADO</option>
                </select>
                  <span class="input-group-addon">
                    <span class="icon icon-lg">
                      
                    </span>
                  </span>
                </div>
              </div>-->

              <div class="row">
                <div class="col-sm-8">
                  <div class="checkbox-custom checkbox-default">
                    <input id="RememberMe" name="rememberme" type="checkbox" value="chk_rec" <?php if(isset($_COOKIE["pass_R_WCE"])) { ?> checked <?php } ?>/>
                    <label for="RememberMe">Recordar</label>
                  </div>
                </div>
                <div class="col-sm-4 text-right">
                  <button type="submit" class="btn btn-primary hidden-xs">Iniciar</button>
                  <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Iniciar</button>
                </div>
              </div>

              <div class="mb-xs text-center">
              </div>
            </form>
          </div>
        </div>

       
      </div>
      
    </section>
