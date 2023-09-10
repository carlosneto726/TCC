window.onload = function () {
    dp = []
    for (let i = 0; i < labels.length; i++) {
        dp.push({ label: labels[i], y: data[i] });
    }

    var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    exportEnabled: true,
    axisX: {
        title: "Mês"
    },
    axisY: {
        title: "R$"
    },
    data: [//array of dataSeries              
        { //dataSeries object
            /*** Change type "column" to "bar", "area", "line" or "pie"***/
            type: "line",
            dataPoints: dp
        }
    ]
     });

    chart.render();
  }