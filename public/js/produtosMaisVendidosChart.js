/*
 * Arquivo javascript que renderiza o 
 * gráfico da quantidade de produto que venderam, 
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
            title: "Produtos"
        },
        axisY: { // Definindo o titulo do eixo Y
            title: "Quantidade"
        },
        data: [ // Todos os dados referentes ao gráfico
            { 
                type: "column", // Tipo do gráfio
                dataPoints: getData() // Inserindo os dados
            }
        ]
    });
    chart.render(); // Renderizando o gráfico
    renderPlanilha(); // Rederizando a Planilha
}
// Retorna um Json onde labels é o nome do 
// produto e data é a quantidade de produtos vendidos
function getData(){
    dp = []
    for (let i = 0; i < labels.length; i++) {
        dp.push({ label: labels[i]['nome'], y: data[i] });
    }
    return dp;
}
// A função define as colunas e as linhas da 
// tabela que fica embaixo do gráfico
function renderPlanilha(){
    var tbHead = document.getElementById("labels");
    var tbBody = document.getElementById("data");
    // Inserindo os titulos das colunas
    tbHead.innerHTML =  "<th scope='col'>Nome</th>" +
                        "<th scope='col'>Descrição</th>" +
                        "<th scope='col'>Preço (R$)</th>" +
                        "<th scope='col'>Vendas</th>" +
                        "<th scope='col'>Total (R$)</th>";

    // Para cada produto
    for (let j = 0; j < labels.length; j++) {
        // Inserindo as linhas da tabela
        tbBody.innerHTML +=
                        "<tr>" +
                        "   <td>"+ labels[j]['nome'] +"</td>" +
                        "   <td>"+ labels[j]['descricao'] +"</td>" +
                        "   <td>"+ labels[j]['preco'] +"</td>" +
                        "   <td>"+ data[j] +"</td>" +
                        "   <td>"+ data[j] * labels[j]['preco'] +"</td>" +
                        "</tr>";
    }
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