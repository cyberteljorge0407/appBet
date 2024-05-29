function eliminarRegistro(id){
	//alert("identificador  ="+id);
var url = $("#url").val();
//alert(url);

$.get(url+"ajax/mantenimientoAjax.php",{eliminar:"yes",idMantenimiento: id},function(respuesta){

if(respuesta == 1){
	location.reload();
}

});

}