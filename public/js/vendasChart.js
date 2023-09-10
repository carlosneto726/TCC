/*
 * Arquivo javascript que renderiza o 
 * gráfico da quantidade de vendas por tempo, 
 * formata os dados, renderiza 
 * a planilha e exporta em Excel.
 * https://canvasjs.com/javascript-charts/
 */
// Função executada assim que a página carrega
window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true, // Habilitando a animação
        exportEnabled: true, // Habilitando o botão de baixar a imagem
        axisX: { // Definindo o titulo do eixo X
            title: "Data (Dia-Mês-Ano)",
            valueFormatString: "DD-MMM" ,
            labelAngle: -50
        },
        axisY: { // Definindo o titulo do eixo Y
            title: "Quantidade de vendas"
        },
        data: [ // Todos os dados referentes ao gráfico
            {
                type: "line", // Tipo do gráfio
                dataPoints: getData() // Inserindo os dados
            }
        ]
    });
    chart.render(); // Renderizando o gráfico
    renderPlanilha(); // Rederizando a Planilha
}
// Retorna um Json onde labels é o nome do 
// bairro e data é a quantidade de vendas
function getData(){
    dp = []
    for (let i = 0; i < labels.length; i++) {
        dp.push({ x: new Date(labels[i]['vdata']), y: labels[i]['dataduplicada'] });
    }
    return dp;
}
// A função define as colunas e as linhas da 
// tabela que fica embaixo do gráfico
function renderPlanilha(){
    var tbHead = document.getElementById("labels");
    var tbBody = document.getElementById("data");
    data = 0;
    // Inserindo os titulos das colunas
    tbHead.innerHTML =  "<th scope='col'>Data</th>" +
                        "<th scope='col'>Quantidade</th>";
    // Para cada produto
    for (let j = 0; j < labels.length; j++) {
        data += labels[j]['dataduplicada'];
        // Inserindo as linhas da tabela
        tbBody.innerHTML +=
                        "<tr>" +
                        "   <td>"+ labels[j]['vdata'] +"</td>" +
                        "   <td>"+ labels[j]['dataduplicada'] +"</td>" +
                        "</tr>";
    }
    tbBody.innerHTML +=
        "<tr>" +
        "   <td colspan='3' align='center'>Quantidade total de vendas: "+data+"</td>" +
        "</tr>";
}
// Função chamada pelo o botão de baixar a planilha
function exportTableToExcel(nomeArquivo) {
    var a = document.createElement('a');
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('tabela');
    var table_html = table_div.outerHTML.replace(/ /g, '%20');
    a.href = data_type + ', ' + table_html;
    var data = new Date();
    // Definindo o nome do aquivo (nome do gráfico + data atual no formato dd-mm-yyyy)
    var filename = nomeArquivo.toLowerCase().replace(" ", "") + data.getDate() +"-"+ (parseInt(data.getMonth()) + 1) +"-"+ data.getFullYear();
    a.download = filename+'.xls';
    a.click();
}
