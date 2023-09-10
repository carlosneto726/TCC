  window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    exportEnabled: true,
    axisX: {
        title: "Produtos"
    },
    axisY: {
        title: "Quantidade"
    },
    data: [//array of dataSeries              
        { //dataSeries object
            /*** Change type "column" to "bar", "area", "line" or "pie"***/
            type: "column",
            dataPoints: getData()
        }
    ]
     });

    chart.render();
}


function getData(){
    dp = []
    for (let i = 0; i < labels.length; i++) {
        dp.push({ label: labels[i], y: data[i] });
    }
    return dp;
}

