/*=============================================
EDITAR CLIENTE
=============================================*/
$(".tablaEmpresa").on("click", ".btnEditarEmpresa", function(){

	var idEmpresa = $(this).attr("idEmpresa");

	var datos = new FormData();
    datos.append("idEmpresa", idEmpresa);

    $.ajax({

      url:"ajax/empresas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
      
      	   $("#idEmpresa").val(respuesta["id"]);
	       $("#EditNombre").val(respuesta["nombre"]);
	       $("#EditNit").val(respuesta["nit"]);
	       $("#EditDireccion").val(respuesta["direccion"]);
	       $("#EditCorreo").val(respuesta["email"]);
	       $("#EditTelefono").val(respuesta["telefono"]);
          
	  }

  	})

})