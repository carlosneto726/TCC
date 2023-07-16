@extends('templates.template')
@section('content')

<h1 class="container fw-bold">Pedidos</h1>
<hr class="container">
<div class="container hstack rounded">

    <div class="pendentes rounded p-1 mb-auto">
        <h3 class="container">Pendentes</h3>
        @if(count($pedidos_pendentes) == 0)
            <h1 class="mt-5">Você não tem pedidos pendentes</h1>
        @endif

        @foreach ($pedidos_pendentes as $pedido)
            <div class="mb-5 p-1 rounded" style="background-color: var(--light-gray);">
                <div class="d-flex m-2">
                    <span>ID: {{$pedido->id}}</span>
                    <a class="btn btn btn-sm ms-auto" href="{{url("/pedidos/chat/".$pedido->id)}}" style="background-color: var(--light-green);">Conversar</a>
                    <a class="btn btn btn-sm ms-1" href="{{url("/pedidos/concluir?id_pedido=".$pedido->id)}}" style="background-color: var(--light-green);">Concluir pedido</a>
                    <a class="btn btn-danger btn-sm ms-1" href="{{url("/pedidos/cancelar?id_pedido=".$pedido->id)}}">Cancelar pedido</a>
                </div>
                @foreach ($pedido->produtos as $produto)
                    <div class="card mb-2" style="max-width: 700px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{asset("storage/".$produto->pimg)}}" class="img-fluid rounded" style="height: 180px; width: 900px; object-fit: cover;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{$produto->pnome}}</h5>
                                    <div class="d-flex">
                                        QTD: {{$produto->pqtd}}
                                        <br/>
                                        QTD no estoque: {{$produto->pestoque}}
                                        <p class="card-text ms-auto">
                                            <small class="fw-bold">
                                                R$ {{number_format($produto->ppreco,2,",",".")}}
                                            </small>
                                            <small>
                                                (R$ {{number_format(($produto->ppreco * $produto->pqtd),2,",",".")}})
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex">
                    <span class="me-auto">{{$pedido->nome_usuario}}</span>
                    <span class="ms-auto">Preço total do pedido: R$ {{number_format($pedido->preco_total,2,",",".")}}</span>
                </div>
            </div>
           
        @endforeach
    </div>

    <div class="concluidos rounded p-1 mb-auto">
        <h3 class="container">Concluídos</h3>
        @if(count($pedidos_concluidos) == 0)
            <h1 class="mt-5">Você não tem pedidos concluídos</h1>
        @endif

        @foreach ($pedidos_concluidos as $pedido)
            <div class="mb-5 p-1 rounded" style="background-color: var(--light-gray);">
                <div class="d-flex m-2">
                    <span>ID: {{$pedido->id}}</span>
                    <span class="ms-auto fw-bold mt-1">@if($pedido->status == "1") CONCLUÍDO @elseif($pedido->status == "2") CANCELADO @endif</span>
                    <a class="btn btn btn-sm ms-1" href="{{url("/pedidos/chat?id_pedido=".$pedido->id)}}" style="background-color: var(--light-green);">Conversar</a>
                </div>
                @foreach ($pedido->produtos as $produto)
                    <div class="card mb-2 opacity-50" style="max-width: 700px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{asset("storage/".$produto->pimg)}}" class="img-fluid rounded" style="height: 187px; width: 900px; object-fit: cover;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{$produto->pnome}}</h5>
                                    <p class="card-text text-truncate"></p>
                                    <div class="d-flex">
                                        QTD: {{$produto->pqtd}}
                                        <p class="card-text ms-auto">
                                            <small class="fw-bold">
                                                R$ {{number_format($produto->ppreco,2,",",".")}}
                                            </small>
                                            <small>
                                                (R$ {{number_format(($produto->ppreco * $produto->pqtd),2,",",".")}})
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex">
                    <span class="me-auto">{{$pedido->nome_usuario}}</span>
                    <span class="ms-auto">Preço total do pedido: R$ {{number_format($pedido->preco_total,2,",",".")}}</span>
                </div>
            </div>
           
        @endforeach
    </div>
</div>

@endsection