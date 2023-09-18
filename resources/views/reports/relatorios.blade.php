@extends('templates.template')
@section('content')

<script>
    var labels = {{ Js::from($labels) }};
    var data = {{ Js::from($data) }};
</script>

@if($tipo == "Vendas")
    <script src="{{asset("js/vendasChart.js")}}"></script>
@elseif($tipo == "Produtos Mais Vendidos")
    <script src="{{asset("js/produtosMaisVendidosChart.js")}}"></script>
@elseif($tipo == "Receita")
    <script src="{{asset("js/receitaChart.js")}}"></script>
@elseif($tipo == "Locais Mais Vendidos")
    <script src="{{asset("js/locaisMaisVendidosChart.js")}}"></script>
@endif
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

<div class="navbar navbar-expand-lg bg-dark w-100" data-bs-theme="dark" style="margin-top: -20px;">
    <div class="container">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="{{url("/cooperativa/".$_COOKIE['nome_cooperativa'])}}">{{$_COOKIE['nome_cooperativa']}}</a>
        <ul class="navbar-nav flex-row d-md-none">
            <li class="nav-item text-nowrap">
                <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </li>
        </ul>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
            <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="sidebarMenuLabel">{{$_COOKIE['nome_cooperativa']}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2" href="{{url("/relatorios/vendas")}}">
                                <img class="bi" src="{{asset("icons/calendar.svg")}}" width="16" height="16">
                                Vendas do ano
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2" href="{{url("/relatorios/maisvendidos")}}">
                                <img class="bi" src="{{asset("icons/align-top.svg")}}" width="16" height="16">
                                Mais vendidos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2" href="{{url("/relatorios/receita")}}">
                                <img class="bi" src="{{asset("icons/cash-coin.svg")}}" width="16" height="16">
                                Receita
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2" href="{{url("/relatorios/locaisvendidos")}}">
                                <img class="bi" src="{{asset("icons/localization.svg")}}" width="16" height="16">
                                Locais mais vendidos
                            </a>
                        </li>
                    </ul>

                    <hr class="my-3">

                    <ul class="nav flex-column mb-auto">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2" onclick="semana()">
                                Semana Atual
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2" href="#">
                                Mês atual
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2" href="#">
                                Ano atual
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2" href="#">
                                Visão geral
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
  
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 mb-2"><img class="me-3" src="{{asset("icons/graph-up.svg")}}" width="48" height="38"> {{$tipo}}</h1>
            </div>
    
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 mb-2"><img class="me-3" src="{{asset("icons/table.svg")}}" width="48" height="38"> Planilha</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button type="button" class="btn btn-sm btn-outline-success" onclick="exportTableToExcel('{{$tipo}}')">
                        <img src="{{asset("icons/download.svg")}}" title="Baixar planilha">
                    </button>
                </div>
            </div>
            <div class="table-responsive small">
                <table class="table table-striped table-sm" id="tabela">
                    <thead>
                        <tr id="labels">
                            <th scope="col">#</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                    </tbody>
                </table>
            </div>  
        </main>
    </div>
</div>

@endsection