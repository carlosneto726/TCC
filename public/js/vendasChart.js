window.onload = function () {
    dp = []
    for (let i = 0; i < labels.length; i++) {
        //var dataDate = labels[i]['data'].split("-")
        var date = new Date(labels[i]['data'])
        dp.push({ label: date, y: data[i] });
    }

    var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    exportEnabled: true,
    axisX: {
        title: "Mês"
    },
    axisY: {
        title: "Quantidade"
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

