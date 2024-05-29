<?php 
 $url=$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
 $url=$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
      $route=explode("/",$url);
 if($route[0]=="http://localhost/appBet"){
 $link="http://localhost/appBet/"; 
}else{
$link="http://localhost/appBet/";
}
  define('SERVERURL',$link);
const COMPANY = "WCE";

//const SERVERURL2 = "http://localhost/appProyecto/";
