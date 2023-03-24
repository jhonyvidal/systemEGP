const floating_btn = document.querySelector('#floating-btn');
const close_btn = document.querySelector('.close-btn');
const social_panel_container = document.querySelector('.social-panel-container');

floating_btn.addEventListener('click', () => {
	social_panel_container.classList.toggle('visible')
});

close_btn.addEventListener('click', () => {
	social_panel_container.classList.remove('visible')
});
$(document).ready(function(){
	/*=============================================
		BOTON FULL SCREEN
	=============================================*/
	$("#fullScreenImg").click(function(){
		var docElm = document.documentElement;
		if (docElm.requestFullscreen) {
			docElm.requestFullscreen();
		}
		else if (docElm.mozRequestFullScreen) {
			docElm.mozRequestFullScreen();
		}
		else if (docElm.webkitRequestFullScreen) {
			docElm.webkitRequestFullScreen();
		}
	})

	/*=============================================
		BOTON NEXT PRIMER PROCESO
	=============================================*/
	$("#startMachine").click(function(){

		if(!validationStartMachine()){return;}

		current_fs = $(this).parent().parent().parent();
		next_fs = $(this).parent().parent().parent().next();

		var horaInicio = new Date();
		h = horaInicio.getHours()
		m = horaInicio.getMinutes()
		s = horaInicio.getSeconds()
		horaInicio = h+":"+m+":"+s;
		
		var datos = new FormData();
		datos.append("horaInicioUI", $('#HoraInicioTurno').val());
		datos.append("horaFinUI", $('#HoraFinTurno').val());
		datos.append("idU", $("#idU").val());
		datos.append("idDpto", 4);
		datos.append("idProducto", $("#Artículo").val());

		$.ajax({
			url: "../../dashboard/ajax/gestionTurnos.ajax.php",
			method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				success: function(respuesta){
					$("#turno").val(respuesta);
					nextStep(current_fs,next_fs);

					window.parent.scroll({
						top: 300,
					});
				},
				error:function(err){
					console.log(err)
				}
		})
		
	});

	$(".btnPlusFunction").click(function(){
		let id = parseInt($(this).attr('id'));
		var pbuenos = parseInt($("#pBuenos").val());
		var pmalos = parseInt($("#pMalos").val())

		if(id === 1){
			$("#pBuenos").val(pbuenos + 1);
		}else if(id === 2){
			$("#pBuenos").val(pbuenos - 1);
		}
		else if(id === 3){
			$("#pMalos").val(pmalos + 1);
		}
		else if(id === 4){
			$("#pMalos").val(pmalos - 1);
		}
	})

	/*=============================================
		BOTON CLOSE MACHINE
	=============================================*/
	$("#finishMachine").click(function(){

		current_fs = $("#step2");
		next_fs = $("#step1");

		buenos = $("#pBuenos").val()
		malos = $("#pMalos").val()
		idTurno = $("#turno").val()

		var horaInicio = new Date();
		h = horaInicio.getHours()
		m = horaInicio.getMinutes()
		s = horaInicio.getSeconds()
		time = h+":"+m+":"+s;
		
		var datos = new FormData();
		datos.append("pBuenos", buenos);
		datos.append("pMalos", malos);
		datos.append("horaFin", time);
		datos.append("id", idTurno);
		
		$.ajax({
			url: "../../dashboard/ajax/gestionTurnos.ajax.php",
			method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				success: function(respuesta){
					$(".social-panel-container").hide()
					setTimeout(()=> nextStep(current_fs,next_fs), 500)	

					window.parent.scroll({
						top: 300,
					});
				},
				error:function(err){
					console.log(err)
				}
		})
	});
	/*=============================================
		BOTON INICIAR O FINALIZAR PARADA
	=============================================*/
	$(".btnCreateStop").click(function(){

		if(!validationCreateStops()){return;}

		if($(this).attr('detail') === 'start'){

			$("#start").hide()

			idTurno = $("#turno").val(); 
			idTParada = $("#tipoParada").val();  

			var horaInicio = new Date();
			h = horaInicio.getHours()
			m = horaInicio.getMinutes()
			s = horaInicio.getSeconds()
			time = h+":"+m+":"+s;
			
			var datos = new FormData();
			datos.append("horaI", time);
			datos.append("horaF", time);
			datos.append("idTurno", idTurno);
			datos.append("idActividad", $("#actividad").val());
			datos.append("idCausa", $("#causa").val());

			$.ajax({
				url: "../../dashboard/ajax/gestionTurnos.ajax.php",
				method: "POST",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					dataType:"json",
					success: function(respuesta){
						console.log(respuesta)
						$("#idParada").val(respuesta);
						$("#finish").show()
						timeProgress();
					},
					error:function(err){
						console.log(err)
					}
			})
			// setTimeout(()=>
			// $("#finish").show()
			// , 1500).then()	
			
		}else{
			$("#finish").hide()

			idParada = $("#idParada").val(); 

			var horaInicio = new Date();
			h = horaInicio.getHours()
			m = horaInicio.getMinutes()
			s = horaInicio.getSeconds()
			time = h+":"+m+":"+s;
			var horaF = $("#fechaFin").val() === "" ?  time :  $("#fechaFin").val();
			console.log(horaF)
			
			var datos = new FormData();
			datos.append("horaF", horaF);
			datos.append("idParada", idParada);

			$.ajax({
				url: "../../dashboard/ajax/gestionTurnos.ajax.php",
				method: "POST",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					dataType:"json",
					success: function(respuesta){
						$("#start").show()
					},
					error:function(err){
						console.log(err)
					}
			})
			// setTimeout(()=>
			// $("#start").show()
			// , 1500).then($("#finish").hide())	
		}
	});

	/*=============================================
		 RECURSOS SELECT CHANGES 
	=============================================*/
	$("#Recurso").change(function(){
		$("#tituloParadas").html($(this).children("option:selected").attr("descripcion"))
		$("#Descripción").val($(this).children("option:selected").attr("descripcion"))
		$("#Proceso").val($(this).children("option:selected").attr("proceso"))
	});

	/*=============================================
		 ARTICULOS SELECT CHANGES 
	=============================================*/
	$("#Artículo").change(function(){
		$("#tituloParadas").html($("#tituloParadas").html() + ' - '+ $(this).children("option:selected").html())
		$("#Unidad").val($(this).children("option:selected").attr("unidad"))
		$("#Rendimiento").val($(this).children("option:selected").attr("velocidad"))
	});

	/*=============================================
		 ARTICULOS SELECT CHANGES 
	=============================================*/
	$("#tipoParada").change(function(){
		var idTipoParada = $(this).children("option:selected").val();
		var datos = new FormData();
			datos.append("idTipoParadaScreen", idTipoParada);

		$.ajax({
			url: "../../dashboard/ajax/gestionTurnos.ajax.php",
			method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				success: function(respuesta){
					console.log(respuesta);
					$("#actividad").html("");
					$("#actividad").append(
						'<option value="">selecciona una actividad</option>'
					);
					for (item of respuesta){
						$("#actividad").append(
							'<option value="'+item.id+'">'+item.descripcion+'</option>'
						)
					}
				},
				error:function(err){
					console.log(err)
				}
		})

	});

	/*=============================================
		 ACTIVIDADES SELECT CHANGES 
	=============================================*/
	$("#actividad").change(function(){
		var idActividad = $(this).children("option:selected").val();
		var datos = new FormData();
			datos.append("idActividadScreen", idActividad);

		$.ajax({
			url: "../../dashboard/ajax/gestionTurnos.ajax.php",
			method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				success: function(respuesta){
					console.log(respuesta)
					$("#causa").html("");
					for (item of respuesta){
						$("#causa").append(
							'<option value="'+item.id+'">'+item.descripcion+'</option>'
						)
					}
				},
				error:function(err){
					console.log(err)
				}
		})
	});
	
	/*=============================================
		 RECURSOS SELECT CHANGES 
	=============================================*/
	$("#Recurso").change(function(){
		var idTipoRecurso = $(this).children("option:selected").val();
		var datos = new FormData();
			datos.append("idTipoRecursoScreen", idTipoRecurso);

		$.ajax({
			url: "../../dashboard/ajax/gestionTurnos.ajax.php",
			method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				success: function(respuesta){
					console.log(respuesta)
					$("#Artículo").html("");
					$("#Artículo").append(
						'<option value="">Seleccionar una opción</option>'
					)
					
					for (item of respuesta){
						$("#Artículo").append(
							'<option value="'+item.id+'" unidad="'+item.unidad+'" velocidad="'+item.velocidad+'">'+item.descripcion+'</option>'
						)
					}
				},
				error:function(err){
					console.log(err)
				}
		})

	});

	/*=============================================
      FUNCION SIGUIENTE PASO
    =============================================*/
    function nextStep(current_fs,next_fs){
        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;
                current_fs.css({'display': 'none','position': 'relative'});
                next_fs.css({'opacity': opacity});
            },
            duration: 500
        });
    }

	/*=============================================
      TIME STAMP
    =============================================*/
	function timeProgress(){

		var startDateTime = Date.now();
		var startStamp = startDateTime;

		var newDate = new Date();
		ih = newDate.getHours()
		im = newDate.getMinutes()
		is = newDate.getSeconds()
		time = ih+":"+im+":"+is;
		$("#fechaInicio").val(time);
		var newStamp = newDate.getTime();

		var timer;

		function updateClock() {
			newDate = new Date();
			newStamp = newDate.getTime();
			var diff = Math.round((newStamp-startStamp)/1000);
			
			var d = Math.floor(diff/(24*60*60));
			diff = diff-(d*24*60*60);
			var h = Math.floor(diff/(60*60));
			diff = diff-(h*60*60);
			var m = Math.floor(diff/(60));
			diff = diff-(m*60);
			var s = diff;
			
			document.getElementById("timeProgress").innerHTML = d+" dia(s), "+h+" hora(s), "+m+" minuto(s), "+s+" segundos(s)";
		}

		setInterval(updateClock, 1000);
	}

	/*=============================================
    	VALIDATIONS
    =============================================*/
	function validationStartMachine(){
		if($("#Recurso").val() === ""){ alert("Seleccionar recurso"); return false;}  
		if($("#Artículo").val() === ""){ alert("Seleccionar Articulo"); return false;} 
		if($("#HoraInicioTurno").val() === ""){alert("Seleccionar Hora Inicio");  return false;} 
		if($("#HoraFinTurno").val() === ""){ alert("Seleccionar Hora Fin");return false;}    
		return true;
	}

	function validationCreateStops(){
		if($("#tipoParada").val() === "" || $("#tipoParada").val() === null){ return false;}  
		if($("#actividad").val() === "" || $("#actividad").val() === null){ return false;}  
		return true;
	}

});