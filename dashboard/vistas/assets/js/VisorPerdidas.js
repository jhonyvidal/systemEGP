
function CrearGraficaVisor(obj,component,label,headers,array,type){
    // GRAFICA POR CIUDAD //
    const data = [];
    
    if(obj){
      obj.forEach(e => {
        labels.push(e.dimensionValues[0].value);
        data.push(e.metricValues[0].value)
      });
    }

    const ctx = document.getElementById(component).getContext('2d');
   
    const instance =  new Chart(ctx, {
        type: type,
        data: {
            labels: headers,
            datasets: [{
                label: label,
                data: array,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                  ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
              y: {
                beginAtZero: true
              }
            }
          },
    });

    setTimeout(function(){
        console.log()
    }, 2000);
  }

  $("#btnConsultar").click(function(){
        if( $("#tipoDefiltro").val() === "1"){
            consultaTipoParada();
        }else{
            consultaActividad();
        }
  })

  function consultaTipoParada(){

    const horasProgramadas = 24;
    const unidadesEsperadas = 100 * 5;

    var datos = new FormData();
	datos.append("idTipoParada", "");
    datos.append("idEmpresa",$("#idEmpresa").val());
    datos.append("fechaInicio",$("#fechaInicio").val() );
    datos.append("fechaFin", $("#fechaFin").val());

    $.ajax({

     	url:"ajax/gestionTurnos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(res){
            console.log(res);
            array= [], array2=[], array3=[], array4=[]
            headers=[]
            res.forEach(function(ind) {
                var Disponibilidad = Math.round((1- ((parseInt(ind.total) / 60) / horasProgramadas)) * 100,1);
                var Rendimiento = Math.round(((parseInt(ind.buenos) + parseInt(ind.malos)) / unidadesEsperadas) * 100,2)
                var Calidad = Math.round(parseInt(ind.malos) !== 0 ? (1-(parseInt(ind.malos) / (parseInt(ind.buenos) + parseInt(ind.malos)))) * 100 : 100,1)
                array.push(Disponibilidad)
                array2.push(Rendimiento)
                array3.push(Calidad)
                array4.push(Disponibilidad * Rendimiento * Calidad)
                headers.push(ind.nombre)
            });
            Chart.getChart("visor").destroy(), Chart.getChart("visor2").destroy(),
            Chart.getChart("visor3").destroy(),
            CrearGraficaVisor("",'visor','Disponibilidad',headers, array,'bar');
            CrearGraficaVisor("",'visor2','Rendimiento',headers, array2,'bar');
            CrearGraficaVisor("",'visor3','Calidad',headers, array3,'bar');
            CrearGraficaVisor("",'visor4','OEE',headers, array4,'bar');
            CrearGraficaVisor("",'visorStep1','OEE',headers, array4,'pie');

		},
        err:function(error){
            console.log (error);
        }
	});

  }

  function consultaActividad(){

    const horasProgramadas = 24;
    const unidadesEsperadas = 100 * 5;

    var tipoParada = $("#VisorTipoParada").val();
    var datos = new FormData();
    if($("#fechaInicio").val() !== ""){
        datos.append("fechaInicio",$("#fechaInicio").val());
    }
    if($("#fechaFin").val() !== ""){
        datos.append("fechaFin",$("#fechaFin").val());
    }

    datos.append("idEmpresa",$("#idEmpresa").val());
    datos.append("tipoParada", tipoParada);
    datos.append("idTipoActividad", "");
    $.ajax({

        url:"ajax/gestionTurnos.ajax.php",
         method: "POST",
         data: datos,
         cache: false,
         contentType: false,
         processData: false,
         dataType:"json",
         success:function(res){
            console.log (res);
            array= [], array2=[], array3=[], array4=[]
            headers=[]
            res.forEach(function(ind) {
                var Disponibilidad = Math.round((1- ((parseInt(ind.total) / 60) / horasProgramadas)) * 100,1);
                var Rendimiento = Math.round(((parseInt(ind.buenos) + parseInt(ind.malos)) / unidadesEsperadas) * 100,2)
                var Calidad = Math.round(parseInt(ind.malos) !== 0 ? (1-(parseInt(ind.malos) / (parseInt(ind.buenos) + parseInt(ind.malos)))) * 100 : 100,1)
                array.push(Disponibilidad)
                array2.push(Rendimiento)
                array3.push(Calidad)
                array4.push(Disponibilidad * Rendimiento * Calidad)
                headers.push(ind.descripcion)
            });
            Chart.getChart("visor").destroy(), Chart.getChart("visor2").destroy(),
            Chart.getChart("visor3").destroy(),Chart.getChart("visor4").destroy()
            CrearGraficaVisor("",'visor','Disponibilidad',headers, array,'bar');
            CrearGraficaVisor("",'visor2','Rendimiento',headers, array2,'bar');
            CrearGraficaVisor("",'visor3','Calidad',headers, array3,'bar');
            CrearGraficaVisor("",'visor4','OEE',headers, array4 ,'bar');
            CrearGraficaVisor("",'visorStep1','OEE',headers, array4,'pie');

       },
       err:function(error){
           console.log (error);
       }
    });

  }

  $("#tipoDefiltro").change(function(){
    var tipo = $(this).val();
    if(tipo === "1"){
        $("#selecTipoParada").hide()
        $("#tittleDinamic").html('Visor Por Tipo Parada')
    }else{
        $("#selecTipoParada").show()
        $("#tittleDinamic").html('Visor Por Actividad')
       
    }
  })


  function onload() {
    
    const horasProgramadas = 24;
    const unidadesEsperadas = 100 * 5;

	  var datos = new FormData();
    datos.append("idEmpresa",$("#idEmpresa").val());
	  datos.append("idTipoParada", "");

     $.ajax({

     	url:"ajax/gestionTurnos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(res){
            console.log (res);
            array= [], array2=[], array3=[], array4=[], arrayTotal=[]
            headers=[]
            TotalDis=0,TotalRen=0,TotalCal=0,
            res.forEach(function(ind) {
                var Disponibilidad = (1- ((parseFloat(ind.total) / 60) / horasProgramadas)).toFixed(2);
                var Rendimiento = ((parseFloat(ind.buenos) + parseFloat(ind.malos)) / unidadesEsperadas).toFixed(2)
                var Calidad = (parseFloat(ind.malos) !== 0 ? (1-(parseFloat(ind.malos) / (parseFloat(ind.buenos) + parseFloat(ind.malos))))  : 100).toFixed(2)
                array.push(Disponibilidad)
                array2.push(Rendimiento)
                array3.push(Calidad)
                array4.push((Disponibilidad * Rendimiento * Calidad * 100).toFixed(2))
                headers.push(ind.nombre)
                TotalDis = parseFloat(TotalDis)+  parseFloat(Disponibilidad);
                TotalRen = parseFloat(TotalRen) + parseFloat(Rendimiento);
                TotalCal = parseFloat(TotalCal)  +  parseFloat(Calidad);
            });
            
            TotalOEE=0;
            array4.forEach(function(ind) {
                TotalOEE = parseFloat(TotalOEE) + parseFloat(ind)
            });
            headerTotal=['OEE Total'];
            TotalOeeArray=[TotalOEE]

            arrayTotal.push(TotalDis), arrayTotal.push(TotalRen),arrayTotal.push(TotalCal)
            headerTotal2=['Disponibilidad','Rendimiento','Calidad']
           

            CrearGraficaVisor("",'visor','Disponibilidad',headers, array ,'bar');
            CrearGraficaVisor("",'visor2','Rendimiento',headers, array2 ,'bar');
            CrearGraficaVisor("",'visor3','Calidad',headers, array3 ,'bar');
            CrearGraficaVisor("",'visor4','OEE',headers, array4 ,'bar');
            CrearGraficaVisor("",'visorStep1','OEE',headerTotal, TotalOeeArray ,'pie');
            CrearGraficaVisor("",'visorStep2','OEE',headerTotal2, arrayTotal ,'pie');
            
            
		},
        err:function(error){
            console.log (error);
        }
	});

  }
  onload();


  $("#visorStep1").click(function(){
    $("#step1").hide()
    $("#step2").show()
    // $(".breadOee").removeClass("colorActiveBread")
    // $(".breadDet").removeClass("colorActiveBread")
    // $(".breadGen").addClass("colorActiveBread")
    $("#tittleDinamic").html('Visor General')
  })

  $("#visorStep2").click(function(){
    $("#step2").hide()
    $("#step3").show()
    // $(".breadOee").removeClass("colorActiveBread")
    // $(".breadDet").addClass("colorActiveBread")
    // $(".breadGen").removeClass("colorActiveBread")
    $("#tittleDinamic").html('Visor Por Tipo Parada')
    $("#formfilter").show();
  })