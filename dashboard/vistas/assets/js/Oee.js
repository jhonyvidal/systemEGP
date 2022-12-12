    function CrearProgressBar(id,shapeStyle,array,color){
      if(shapeStyle === 1){
          var circleBar = new ProgressBar.Circle(id, {
            color: "white",
            strokeWidth: 2,
            trailWidth: 10,
            trailColor: "black",
            easing: "easeInOut",
            from: { color: "#FF9900", width: 1 },
            to: { color: color, width: 10 },
            text: {
            value: '0',
            className: 'progress-text',
            style: {
                color: 'black',
                position: 'absolute',
                top: '45%',
                left: '42%',
                padding: 0,
                margin: 0,
                transform: null
            }
            },
            step: (state, shape) => {
            shape.path.setAttribute("stroke", state.color);
            shape.path.setAttribute("stroke-width", state.width);
            shape.setText(Math.round(array) + '%');
            }
        });
        
        circleBar.animate(array / 100, {
            duration: 1500
        });
      }else{
        var circleBarCiclo = new ProgressBar.Circle(id, {
          color: "white",
          strokeWidth: 2,
          trailWidth: 10,
          trailColor: "black",
          easing: "easeInOut",
          from: { color: "#FF9900", width: 1 },
          to: { color: color , width: 10 },
          text: {
            value: '0',
            className: 'progress-text',
            style: {
              color: 'black',
              position: 'absolute',
              top: '45%',
              left: '42%',
              padding: 0,
              margin: 0,
              transform: null
            }
          },
          step: (state, shape) => {
            shape.path.setAttribute("stroke", state.color);
            shape.path.setAttribute("stroke-width", state.width);
            shape.setText(array + '%');
          }
        });

        circleBarCiclo.animate(array / 100, {
          duration: 1500
        });
      }

    }

    function CrearGrafica(obj,component,style,array){
      // GRAFICA POR CIUDAD //
      const labels = [];
      const data = [];

      if(obj){
        obj.forEach(e => {
          labels.push(e.dimensionValues[0].value);
          data.push(e.metricValues[0].value)
        });
      }
      
      const ctx = document.getElementById(component).getContext('2d');

      new Chart(ctx, {
          type: 'doughnut',
          data: {
              labels: labels,
              datasets: [{
                  label: 'prueba',
                  data: array,
                  backgroundColor: [
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(255, 159, 64, 0.2)'
                  ],
                  borderColor: [
                      'rgba(255, 206, 86, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 99, 132, 1)',
                      'rgba(75, 192, 192, 1)',
                      'rgba(153, 102, 255, 1)',
                      'rgba(255, 159, 64, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true,
          }
      });
    }

    window.onload = (event) => {
      for(var i=0; i< $("#cantidad").val(); i++){
        
        var oee = $("#colOEE" + i).attr("oee") === "" ? 0 : $("#colOEE" + i).attr("oee")
        CrearProgressBar("#colOEE" + i,1,oee,"rgba(54, 162, 235, 1)")

        var total = $("#colCiclo" + i).attr("total") === "" ? 0 : $("#colCiclo" + i).attr("total")
        CrearProgressBar("#colCiclo" + i,2, total,colorValidator(total))

        var rendimiento = $("#colRen" + i).attr("rendimiento") === "" ? 0 : $("#colRen" + i).attr("rendimiento")
        CrearProgressBar("#colRen" + i,2, rendimiento,colorValidator(rendimiento))

        var calidad = $("#colCal" + i).attr("calidad") === "" ? 0 : $("#colCal" + i).attr("calidad")
        CrearProgressBar("#colCal" + i,2, calidad,colorValidator(calidad))

        var buenos = $("#myChartTest" + i).attr("data1");
        var malos = $("#myChartTest" + i).attr("data2");
        var array = [10,buenos,malos]
        CrearGrafica("",'myChartTest' + i, 'doughnut',array)
      }  
    }

    function colorValidator(key){
      if(key < 30){
        return "rgba(255, 99, 132, 0.2)" //Rojo
      }else if(key < 50){
        return "rgba(153, 102, 255, 1)" //Azul
      }else if(key < 80){
        return "rgba(255, 206, 86, 1)" //Amarillo
      }else{
        return "rgba(54, 162, 235, 1)" //Azul
      }

    }
  
  
//   setTimeout(() => {
//     CrearGrafica("",'myChartTest', 'doughnut')
//   }, 2000);




