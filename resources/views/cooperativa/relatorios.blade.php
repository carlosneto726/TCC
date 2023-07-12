@extends('templates.template')
@section('content')

<div class="navbar navbar-expand-lg bg-body-tertiary w-100 mb-5" style="margin-top: -25px; background-color: var(--light-gray);">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{url("/relatorios/vendas")}}">Vendas do ano</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url("/relatorios/maisvendidos")}}">Mais vendidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url("/relatorios/receita")}}">Receita</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url("/relatorios/locaisvendidos")}}">Locais mais vendidos</a>
            </li>
        </ul>
    </div>
</div>


<div class="container d-flex align-itens-center">
    <img class="mx-auto img-fluid shadow-lg" src="{{$grafico}}">
</div>

@endsection