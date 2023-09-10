window.onload = function () {
    dp = []
    for (let i = 0; i < labels.length; i++) {
        dp.push({ label: labels[i], y: data[i] });
    }

    var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    exportEnabled: true,
    axisX: {
        title: "Bairro"
    },
    axisY: {
        title: "Quantidade de vendas"
    },
    data: [//array of dataSeries              
    
        { //dataSeries object
            /*** Change type "column" to "bar", "area", "line" or "pie"***/
            type: "column",
            dataPoints: dp
        }
    ]
     });

    chart.render();
  }