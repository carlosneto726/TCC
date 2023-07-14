@extends('templates.template')
@section('content')

<div class="navbar navbar-expand-lg bg-body-tertiary w-100 mb-5" style="margin-top: -25px; background-color: var(--light-gray);">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{url("/caixa/total")}}">Caixa total</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url("/caixa/ano")}}">Caixa do ano</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url("/caixa/mes")}}">Caixa do mês</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url("/caixa/dia")}}">Caixa do dia</a>
            </li>
        </ul>
    </div>
</div>

<h1 class="text-center mt-5">Caixa</h1>
<div class="container mt-5 p-5 rounded" style="background-color: var(--light-gray);">
    <h3 class="conatiner">{{$ordenado}}</h3>
    <div class="d-flex flex-row justify-content-center mt-5">

        <ul class="list-group">
            <li class="list-group-item list-group-item-success active" aria-current="true">DATA</li>
            @foreach ($vendas as $venda)
                <li class="list-group-item list-group-item-success">
                    <h5>{{$venda->data}}</h5>
                </li>
            @endforeach
        </ul>
    
        <ul class="list-group">
            <li class="list-group-item list-group-item-success active" aria-current="true">ENTRADA</li>
            @foreach ($vendas as $venda)
                <li class="list-group-item list-group-item-success">
                    <h5>R$ {{number_format($venda->preco_total,2,",",".")}}</h5>
                </li>
            @endforeach
        </ul>
    </div>

    <hr>
    <div class="d-flex">
        <span class="me-auto">TOTAL</span>
        <span class="ms-auto">R$ {{ number_format($total,2,",",".") }}</span>
    </div>

</div>

@endsection