@extends('templates.template')
@section('content')

<div class="navbar navbar-expand-lg bg-dark w-100" data-bs-theme="dark" style="margin-top: -25px;">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <a href="/chats/?orderby=data" class="text-decoration-none">
                <li class="nav-link">Data</li>
            </a>
            <a href="/chats/?orderby=ordem_alfabetica" class="text-decoration-none">
                <li class="nav-link">Ordem alfabética</li>
            </a>
        </ul>
    </div>
</div>

<div class="container">
    <div class="d-flex align-items-center p-3 my-3 rounded shadow-lg">
        <img class="me-3" src="{{asset("icons/list-check.svg")}}" width="48" height="38">
        <div class="lh-1">
            <h1 class="h4 mb-0 lh-1">Pedidos Pendentes</h1>
            <small></small>
        </div>
    </div>

    @if(count($pedidos_pendentes) == 0)
        <div class="d-flex align-items-center p-3 my-3 rounded shadow-lg">
            <div class="lh-1">
                <h1 class="h5 mb-0 lh-1">Você não possui nenhum pedido pendente</h1>
                <small>Recarregue a pagina ou clique <a href="{{url("/pedidos")}}">aqui</a></small>
            </div>
        </div>
    @endif

    @foreach ($pedidos_pendentes as $pedido)

        <div class="my-3 p-3 bg-body rounded shadow">
            <h6 class="border-bottom pb-2 mb-0">
                <div class="d-flex">
                    <span>ID: {{$pedido->id}}</span>
                    <a class="btn btn btn-sm ms-auto" href="{{url("/pedidos/concluir?id_pedido=".$pedido->id)}}" style="background-color: var(--light-green);">Concluir pedido</a>
                    <a class="btn btn-danger btn-sm ms-1" href="{{url("/pedidos/cancelar?id_pedido=".$pedido->id)}}">Cancelar pedido</a>
                </div>
            </h6>

            @foreach ($pedido->produtos as $produto)
                <div class="d-flex text-body-secondary pt-3 border-bottom">
                    <img 
                    src="{{asset("storage/".$produto->pimg)}}" 
                    class="bd-placeholder-img flex-shrink-0 me-2 rounded object-fit-contain mb-2" 
                    width="64" 
                    height="64">
                    <div class="pb-3 mb-0 small lh-sm w-100">
                        <div class="d-flex justify-content-between">
                            <strong class="text-gray-dark">{{$produto->pnome}}</strong>
                            <strong>
                                R$ {{number_format($produto->ppreco,2,",",".")}} X {{$produto->pqtd}} (R$ {{number_format(($produto->ppreco * $produto->pqtd),2,",",".")}})
                            </strong>
                        </div>
                        <span class="d-block">Estoque: {{$produto->pestoque}}</span>
                    </div>
                </div>
            @endforeach

            <small class="d-flex mt-3">
                <span><a  href="{{url("/pedidos/chat/".$pedido->id)}}">{{$pedido->nome_usuario}}</a> | {{$pedido->data}}</span>
                <strong class="ms-auto">Total: R${{number_format($pedido->preco_total,2,",",".")}}</strong>
            </small>
        </div>
    @endforeach


    <hr> <!-- =============================================================================================================== -->

    <div class="d-flex align-items-center p-3 my-3 rounded shadow-lg">
        <img class="me-3" src="{{asset("icons/list-check.svg")}}" width="48" height="38">
        <div class="lh-1">
            <h1 class="h4 mb-0 lh-1">Pedidos Encerrados</h1>
            <small></small>
        </div>
    </div>

    @if(count($pedidos_concluidos) == 0)
        <div class="d-flex align-items-center p-3 my-3 rounded shadow-lg">
            <div class="lh-1">
                <h1 class="h5 mb-0 lh-1">Você ainda não possui nenhum pedido encerrado</h1>
            </div>
        </div>
    @endif

    @foreach ($pedidos_concluidos as $pedido)

        <div class="my-3 p-3 bg-body rounded shadow">
            <h6 class="border-bottom pb-2 mb-0">
                <div class="d-flex">
                    <span>ID: {{$pedido->id}}</span>
                    <span class="ms-auto fw-bold">@if($pedido->status == "1") CONCLUÍDO @elseif($pedido->status == "2") CANCELADO @endif</span>
                </div>
            </h6>

            @foreach ($pedido->produtos as $produto)
                <div class="d-flex text-body-secondary pt-3 border-bottom">
                    <img src="{{asset("storage/".$produto->pimg)}}" class="bd-placeholder-img flex-shrink-0 me-2 rounded object-fit-contain mb-2 opacity-25" width="64" height="64">
                    <div class="pb-3 mb-0 small lh-sm w-100">
                        <div class="d-flex justify-content-between">
                            <strong class="text-gray-dark">{{$produto->pnome}}</strong>
                            <strong>
                                R$ {{number_format($produto->ppreco,2,",",".")}} X {{$produto->pqtd}} (R$ {{number_format(($produto->ppreco * $produto->pqtd),2,",",".")}})
                            </strong>
                        </div>
                        <span class="d-block">Estoque: {{$produto->pestoque}}</span>
                    </div>
                </div>
            @endforeach

            <small class="d-flex mt-3">
                <span><a  href="{{url("/pedidos/chat/".$pedido->id)}}">{{$pedido->nome_usuario}}</a> | {{$pedido->data}}</span>
                <strong class="ms-auto">Total: R${{number_format($pedido->preco_total,2,",",".")}}</strong>
            </small>
        </div>
    @endforeach
</div>
@endsection